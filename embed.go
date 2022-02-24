package cms

import (
	"embed"
	"io/fs"
)

//go:embed web/build
var embedFrontend embed.FS

func GetFrontendAssets() (fs.FS, error) {
	f, err := fs.Sub(embedFrontend, "web/build")
	if err != nil {
		return nil, err
	}

	return f, nil
}