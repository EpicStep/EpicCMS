package domain

import (
	"golang.org/x/crypto/bcrypt"
	"strings"
	"time"
)

const UserTableName = "users"

type User struct {
	ID int64
	Email string `xorm:"not null unique"`
	NickName string `xorm:"not null unique"`
	Password string `xorm:"unique"`
	CreatedAt time.Time `xorm:"created"`
	UpdatedAt time.Time `xorm:"updated"`
}

func (u *User) Prepare() error {
	var h []byte
	var err error

	if len(u.Password) != 0 {
		h, err = bcrypt.GenerateFromPassword([]byte(u.Password), bcrypt.DefaultCost)
		if err != nil {
			return err
		}
	}

	u.Email = strings.ToLower(u.Email)
	u.Password = string(h)

	return nil
}

func (u *User) CheckPassword(plain string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(u.Password), []byte(plain))
	return err == nil
}

func (u User) TableName() string {
	return UserTableName
}
