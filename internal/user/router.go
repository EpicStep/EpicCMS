package user

import "github.com/go-chi/chi/v5"

// Routes add new routes to chi Router.
func (s *Service) Routes(r chi.Router) {
	r.Route("/user", func(r chi.Router) {
		r.Post("/signUp", s.SignUp)
	})
}
