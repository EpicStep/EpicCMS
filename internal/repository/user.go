package repository

import (
	"context"
	"github.com/EpicStep/EpicCMS/internal/domain"
	"github.com/EpicStep/EpicCMS/pkg/database"
)

type UserRepository struct {
	db *database.DB
}

func NewUserRepo(db *database.DB) *UserRepository {
	return &UserRepository{db: db}
}

func (r *UserRepository) Create(ctx context.Context, u *domain.User) (int64, error) {
	id, err := r.db.Engine.Insert(u)

	return id, err
}