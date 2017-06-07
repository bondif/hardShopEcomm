<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['idSupCat', 'nameCat', 'imageCat'];
    protected $guarded = ['idCat'];
    protected $primaryKey = 'idCat';
    public $timestamps = false;

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
