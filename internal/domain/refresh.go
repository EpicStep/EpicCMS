package domain

import (
	"github.com/google/uuid"
	"time"
)

type RefreshToken struct {
	UserID      int64
	Fingerprint string
	Token       string
	CreatedAt   time.Time
}

func (rt *RefreshToken) GenerateToken() error {
	rt.Token = uuid.New().String()
	rt.CreatedAt = time.Now()

	return nil
}
