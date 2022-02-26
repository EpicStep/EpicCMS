package jwtutil

import (
	"errors"
	"fmt"
	"github.com/golang-jwt/jwt/v4"
	"time"
)

var JWTToken []byte

func Sign(jMap jwt.MapClaims) (string, error) {
	t := jwt.NewWithClaims(jwt.SigningMethodHS256, jMap)
	tString, err := t.SignedString(JWTToken)
	if err != nil {
		return "", err
	}

	return tString, nil
}

func NewJWT(id int64) string {
	jwtS, _ := Sign(jwt.MapClaims{
		"id":  id,
		"iat": time.Now().Unix(),
		"exp": time.Now().Add(time.Minute * 30).Unix(),
	})

	return jwtS
}

func ValidateJWT(jwtToken string) (int64, error) {
	token, err := jwt.Parse(jwtToken, func(token *jwt.Token) (interface{}, error) {
		if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
			return nil, fmt.Errorf("unexpected signing method: %v", token.Header["alg"])
		}
		return JWTToken, nil
	})

	if err != nil {
		return 0, err
	}

	if claims, ok := token.Claims.(jwt.MapClaims); ok && token.Valid {
		return int64(claims["id"].(float64)), nil
	}

	return 0, errors.New("failed to parse id")
}