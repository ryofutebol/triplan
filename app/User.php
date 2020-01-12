<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\JaPasswordReset;

class User extends Authenticatable
{
    use Notifiable;
	/**
	* パスワードリセット通知の送信
	*
	* @param  string  $token
	* @return void
	 */
//	public function sendPasswordResetNotification($token)
//	{
//		    $this->notify(new JaPasswordReset($token));
//	}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	];

	public function cart()
	{
		return $this->hasOne('App\Models\Cart');
	}
}
