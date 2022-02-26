package main

import (
	"flag"
	"fmt"
	cms "github.com/EpicStep/EpicCMS"
	"github.com/EpicStep/EpicCMS/internal/domain"
	"github.com/EpicStep/EpicCMS/internal/jsonutil"
	"github.com/EpicStep/EpicCMS/internal/jwtutil"
	"github.com/EpicStep/EpicCMS/internal/router"
	"github.com/EpicStep/EpicCMS/internal/user"
	"github.com/EpicStep/EpicCMS/pkg/database"
	"github.com/EpicStep/EpicCMS/pkg/server"
	"github.com/go-chi/chi/v5"
	"go.uber.org/zap"
	"net/http"
	"os"
	"os/signal"
)

type appArgs struct {
	addr string
	driver string
	dsn string
	redisURL string
	jwtSignKey string
	debug bool
}

func main() {
	args := appArgs{}

	flag.StringVar(&args.addr, "addr", ":8080", "TCP Listen address")
	flag.StringVar(&args.driver, "driver", "postgres", "DB driver name")
	flag.StringVar(&args.dsn, "dsn", "", "DB DSN")
	flag.StringVar(&args.redisURL, "redis-url", "", "Redis URL")
	flag.StringVar(&args.jwtSignKey, "jwt", "", "JWT Secret Key")
	flag.BoolVar(&args.debug, "debug", true, "Enable debug mode")

	flag.Parse()

	if args.debug {
		args.jwtSignKey = "testing"
	}

	if args.jwtSignKey == "" {
		fmt.Println("You must to pass JWT Secret Key")
		return
	}

	jwtutil.JWTToken = []byte(args.jwtSignKey)

	l := getLogger(args.debug)

	defer l.Sync() //nolint:errcheck

	l.Debug("You run CMS in debug mode. If you in production environment disable this mode.")

	if err := run(args); err != nil {
		l.Fatal("Failed to run app", zap.Error(err))
	}
}

func getLogger(debug bool) (l *zap.Logger) {
	var err error
	if debug {
		l, err = zap.NewDevelopment()
	} else {
		l, err = zap.NewProduction()
	}

	if err != nil {
		l.Fatal("Failed to get logger", zap.Error(err))
	}

	zap.ReplaceGlobals(l)

	return l
}

func run(args appArgs) error {
	quit := make(chan os.Signal, 1)
	signal.Notify(quit, os.Interrupt)

	db, err := database.NewDB(args.driver, args.dsn)
	if err != nil {
		return err
	}

	rDB, err := database.NewRedis(args.redisURL)
	if err != nil {
		return err
	}

	// TODO: maybe relocate to repo init?
	if err := db.Engine.Sync2(new(domain.User)); err != nil {
		return err
	}

	assets, err := cms.GetFrontendAssets()
	if err != nil {
		return err
	}

	r := router.New()

	userService := user.NewService(db, rDB, zap.L())

	r.Route("/api", func(r chi.Router) {
		r.NotFound(func(w http.ResponseWriter, r *http.Request) {
			jsonutil.MarshalResponse(w, http.StatusNotFound, jsonutil.NewError(3, "API method not found"))
		})

		r.MethodNotAllowed(func(w http.ResponseWriter, r *http.Request) {
			jsonutil.MarshalResponse(w, http.StatusMethodNotAllowed, jsonutil.NewError(3, "HTTP method not allowed"))
		})

		userService.Routes(r)
	})

	r.Handle("/*", http.FileServer(http.FS(assets)))

	_ = server.New(args.addr, r)

	zap.L().Info("HTTP Server started", zap.String("addr", args.addr))

	<-quit

	return nil
}