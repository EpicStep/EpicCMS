package cookieutil

import (
	"net/http"
	"time"
)

func NewCookie(key string, value string, expires time.Time, maxAge int) *http.Cookie {
	cookie := http.Cookie{
		Name:       key,
		Value:      value,
		Expires:    expires,
		Path: "/",
		HttpOnly:   true,
		MaxAge: maxAge,
	}

	return &cookie
}