package database

import (
	"xorm.io/xorm"
)

type DB struct {
	engine *xorm.Engine
}

func NewDB(driver, dsn string) (*DB, error) {
	engine, err := xorm.NewEngine(driver, dsn)
	if err != nil {
		return nil, err
	}

	if err := engine.Ping(); err != nil {
		return nil, err
	}

	return &DB{
		engine: engine,
	}, nil
}

func (db *DB) Close() error {
	return db.engine.Close()
}