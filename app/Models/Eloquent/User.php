<?php

namespace App\Models\Eloquent;

use App\Notifications\PasswordResetNotification;
use Exception;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable, CanResetPassword
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $hidden = ['password'];

    public function post()
    {
        return $this->hasMany('App\Models\Eloquent\Post', 'created_user_id');
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
        return $this->token;
    }

    public function getRememberTokenName()
    {
        throw new Exception('do not use this methods');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function createdUser()
    {
        return $this->belongsTo('App\Models\Eloquent\User', 'created_user_id');
    }
}
