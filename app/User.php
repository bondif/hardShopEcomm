<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fName', 'lName', 'email', 'password', 'username', 'tel', 'address'
    ];
    public $timestamps = false;

    protected $primaryKey = 'idUser';
    protected $table = 'customers';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
