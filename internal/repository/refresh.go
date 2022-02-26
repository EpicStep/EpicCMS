package repository

import (
	"context"
	"encoding/json"
	"errors"
	"time"

	"github.com/EpicStep/EpicCMS/internal/domain"
	"github.com/EpicStep/EpicCMS/pkg/database"
)

type RefreshRepository struct {
	db *database.RedisDB
}

func NewRefreshRepository(redis *database.RedisDB) *RefreshRepository {
	return &RefreshRepository{db: redis}
}

func (r *RefreshRepository) Set(ctx context.Context, rt *domain.RefreshToken, expiresIn time.Duration) error {
	value, err := json.Marshal(rt)
	if err != nil {
		return err
	}

	if err := r.db.Redis.Set(ctx, rt.Token, value, expiresIn).Err(); err != nil {
		return errors.New("failed to set token")
	}

	return nil
}

func (r *RefreshRepository) DeleteToken(ctx context.Context, token string) error {
	if err := r.db.Redis.Del(ctx, token).Err(); err != nil {
		return err
	}

	return nil
}

func (r *RefreshRepository) GetByToken(ctx context.Context, token string) (*domain.RefreshToken, error) {
	var rt domain.RefreshToken

	res, err := r.db.Redis.Get(ctx, token).Bytes()
	if err != nil {
		return nil, err
	}

	err = json.Unmarshal(res, &rt)
	if err != nil {
		return nil, err
	}

	return &rt, nil
}
