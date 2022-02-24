package jsonutil

import (
	"encoding/json"
	"fmt"
	"net/http"
)

// MarshalResponse to client.
func MarshalResponse(w http.ResponseWriter, status int, response interface{}) {
	w.Header().Set("Content-Type", "application/json")

	data, err := json.Marshal(response)
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		return
	}

	w.WriteHeader(status)
	fmt.Fprintf(w, "%s", data)
}
