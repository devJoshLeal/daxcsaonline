<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; // Corrected from array to string

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'email',
        'password',
        'two_factor_confirmed_at',
        'email_verified_at',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'profile_photo_path',
        'created_at',
        'updated_at'

    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function webToken(){
        return $this->hasOne(Token::class,'user_id','id');
    }
}
