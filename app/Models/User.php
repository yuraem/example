<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Payout;
use App\Models\Companies;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const PAY_SYSTEMS = [
        '' => 'Не определено',
        // 'payeer' => 'Payeer',
        'Tether' => 'Tether TRC20 (USDT)',
        // 'yandex' => 'Yandex Money',
        // 'qiwi' => 'QIWI',
    ];

    const ROLE_ADMIN = 0;
    const ROLE_USER  = 1;
    const ROLE_MANAGER  = 2;

    public static function getRoles() {
        return [            
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_USER  => 'Пользователь',
            self::ROLE_MANAGER => 'Менеджер',
        ];
    }


    public function payout() {
        return Payout::where('user_id', $this->id)->count();
    }

    public function companies() {
        return Companies::where('user_id', $this->id)->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'paysystem',
        'payid',
        'avatar',
        'role',
        'ref',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
