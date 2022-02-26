package user

import (
	"github.com/EpicStep/EpicCMS/internal/cookieutil"
	"github.com/EpicStep/EpicCMS/internal/domain"
	"github.com/EpicStep/EpicCMS/internal/jsonutil"
	"github.com/EpicStep/EpicCMS/internal/jwtutil"
	v1 "github.com/EpicStep/EpicCMS/pkg/api/v1"
	"github.com/asaskevich/govalidator"
	"net/http"
	"strings"
	"time"
)

type signUpRequest struct {
	Email string `json:"email" valid:"email,required"`
	NickName string `json:"nick_name" valid:"required"`
	Password string `json:"password" valid:"required, minstringlength(8)"`
	FingerPrint string `json:"finger_print" valid:"required"`
}

func (r *signUpRequest) Validate() error {
	_, err := govalidator.ValidateStruct(r)

	return err
}

func (r *signUpRequest) Bind(user *domain.User) error {
	if  err := r.Validate(); err != nil {
		return err
	}

	user.Email = strings.TrimSpace(user.NickName)
	user.NickName = strings.TrimSpace(user.NickName)
	user.Password = r.Password

	return user.Prepare()
}

func (s *Service) SignUp(w http.ResponseWriter, r *http.Request) {
	ctx := r.Context()

	var req signUpRequest
	var u domain.User

	unmarshallStatusCode, err := jsonutil.Unmarshal(w, r, &req)
	if err != nil {
		jsonutil.MarshalResponse(w, unmarshallStatusCode, jsonutil.NewError(3, err.Error()))
		return
	}

	if err := req.Bind(&u); err != nil {
		s.logger.Sugar().Debug(err)
		jsonutil.MarshalResponse(w, http.StatusUnprocessableEntity, jsonutil.NewError(3, "Validation failed"))
		return
	}

	uID, err := s.userRepo.Create(ctx, &u)
	if err != nil {
		s.logger.Sugar().Debug(err)
		jsonutil.MarshalResponse(w, http.StatusUnprocessableEntity, jsonutil.NewError(2, "Failed to create user"))
		return
	}

	refreshToken := domain.RefreshToken{
		UserID:      uID,
		Fingerprint: req.FingerPrint,
	}

	if err := refreshToken.GenerateToken(); err != nil {
		jsonutil.MarshalResponse(w, http.StatusInternalServerError, jsonutil.NewError(4, "Unexpended error"))
		return
	}

	err = s.refreshRepo.Set(ctx, &refreshToken, time.Hour * 24 * 60)
	if err != nil {
		s.logger.Sugar().Debug(err)
		jsonutil.MarshalResponse(w, http.StatusInternalServerError, jsonutil.NewError(4, "Unexpended error"))
		return
	}

	http.SetCookie(w, cookieutil.NewCookie("refresh_token", refreshToken.Token, time.Now().Add(time.Hour*24*60), int(time.Hour.Seconds())*24*60))

	jsonutil.MarshalResponse(w, http.StatusOK, jsonutil.NewSuccessfulResponse(v1.AuthResponse{
		JWT:          jwtutil.NewJWT(uID),
		RefreshToken: refreshToken.Token,
	}))
}
