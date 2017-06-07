<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image', 'idProd'];
    protected $guarded = ['idImage'];
    protected $primaryKey = 'idImage';
    public $timestamps = false;

    public function product(){
        $this->belongsTo('App\Models\Product', 'idProd');
    }
}
