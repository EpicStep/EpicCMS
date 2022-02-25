package database

import (
	"context"
	"fmt"
	"github.com/go-redis/redis/v8"
)

type RedisDB struct {
	Redis *redis.Client
}

func NewRedis(addr string, password string) (*RedisDB, error) {
	db := redis.NewClient(&redis.Options{
		Addr:            	addr,
		Password:           password,
		DB:                 0,
	})

	_, err := db.Ping(context.Background()).Result()

	if err != nil {
		return nil, fmt.Errorf("error connecting to redis: %w", err)
	}

	return &RedisDB{Redis: db}, nil
}

func (r *RedisDB) Close() error {
	if err := r.Redis.Close(); err != nil {
		return fmt.Errorf("error closing Redis Client: %w", err)
	}

	return nil
}