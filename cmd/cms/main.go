package main

import (
	"flag"
	cms "github.com/EpicStep/EpicCMS"
	"github.com/EpicStep/EpicCMS/internal/jsonutil"
	"github.com/EpicStep/EpicCMS/internal/router"
	"github.com/EpicStep/EpicCMS/pkg/server"
	"github.com/go-chi/chi/v5"
	"go.uber.org/zap"
	"net/http"
	"os"
	"os/signal"
)

type appArgs struct {
	addr string
	debug bool
}

func main() {
	args := appArgs{}

	flag.StringVar(&args.addr, "addr", ":8080", "TCP Listen address")
	flag.BoolVar(&args.debug, "debug", true, "Enable debug mode")

	flag.Parse()

	l := getLogger(args.debug)

	defer l.Sync() //nolint:errcheck

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

	assets, err := cms.GetFrontendAssets()
	if err != nil {
		return err
	}

	r := router.New()

	r.Route("/api", func(r chi.Router) {
		r.NotFound(func(w http.ResponseWriter, r *http.Request) {
			jsonutil.MarshalResponse(w, http.StatusNotFound, jsonutil.NewError(3, "API method not found"))
		})

		r.MethodNotAllowed(func(w http.ResponseWriter, r *http.Request) {
			jsonutil.MarshalResponse(w, http.StatusMethodNotAllowed, jsonutil.NewError(3, "HTTP method not allowed"))
		})
	})

	r.Handle("/*", http.FileServer(http.FS(assets)))

	_ = server.New(args.addr, r)

	zap.L().Info("HTTP Server started", zap.String("addr", args.addr))

	<-quit

	return nil
}