package database

import (
	_ "github.com/lib/pq"
	"go.uber.org/zap"
	"xorm.io/xorm"
)

type DB struct {
	Engine *xorm.Engine
}

func NewDB(driver, dsn string) (*DB, error) {
	engine, err := xorm.NewEngine(driver, dsn)
	if err != nil {
		return nil, err
	}

	engine.SetLogger(NewXormZapLogger(zap.L()))

	if err := engine.Ping(); err != nil {
		return nil, err
	}

	return &DB{
		Engine: engine,
	}, nil
}

func (db *DB) Close() error {
	return db.Engine.Close()
}