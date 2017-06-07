<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'fName', 'lName', 'image', 'email', 'username', 'password'
    ];
    protected $hidden = [
        'password'
    ];
    protected $primaryKey = 'idAdmin';
    public $timestamps = false;
}
