package v1

// AuthResponse is SingIn a SignUp Response
type AuthResponse struct {
	JWT string `json:"JWT"`
	RefreshToken string `json:"refresh_token"`
}
