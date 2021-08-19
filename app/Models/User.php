<?php

namespace App\Models;

use App\Models\Info\UserAttr;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public const CREATED_AT = UserAttr::FECHA_CREADO;
    public const UPDATED_AT = UserAttr::FECHA_ACTUALIZADO;

    protected $fillable = [
        UserAttr::DNI,
        UserAttr::DATOS_PERSONALES,
        UserAttr::USERNAME,
        UserAttr::PASSWORD,
        UserAttr::TELEFONO,
        UserAttr::DESCRIPCION,
        UserAttr::ESTA_ACTIVO,
        UserAttr::ES_SUPERUSER,
    ];

    protected $table = UserAttr::NOMBRE_TABLA;

    protected $hidden = [
        UserAttr::PASSWORD,
    ];

    protected $casts = [
        UserAttr::ESTA_ACTIVO => 'boolean',
        UserAttr::ES_SUPERUSER => 'boolean',
    ];

    public function getUser(): User
    {
        return $this;
    }

    public function esSuperUser()
    {
        return $this[UserAttr::ES_SUPERUSER];
    }

//    public function token()
//    {
//        return $this->hasOne(Token::class, TokenAttr::USER_ID,
//            UserAttr::ID);
//    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
