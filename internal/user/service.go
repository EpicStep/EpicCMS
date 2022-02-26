package user

import (
	"github.com/EpicStep/EpicCMS/internal/repository"
	"github.com/EpicStep/EpicCMS/pkg/database"
	"go.uber.org/zap"
)

type Service struct {
	userRepo *repository.UserRepository
	refreshRepo *repository.RefreshRepository
	logger *zap.Logger
}

func NewService(db *database.DB, redis *database.RedisDB, logger *zap.Logger) *Service {
	return &Service{
		userRepo: repository.NewUserRepo(db),
		refreshRepo: repository.NewRefreshRepository(redis),
		logger: logger.Named("User Service"),
	}
}
