<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'idCat',
        'idImage',
        'title',
        'description',
        'price',
        'nbInStock',
        'icon',
        'thumbnail',
        'characteristics',
        'idCat',
    ];
    protected $guarded = ['idProd'];
    protected $primaryKey = 'idProd';
    public $timestamps = false;

    public function category(){
        return $this->belongsTo('App\Models\Category', 'idCat');
    }

    public function images(){
        $this->hasMany('App\Models\Image', 'idProd');
    }
}
