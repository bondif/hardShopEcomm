<?php

namespace App\Http\Controllers;

use App\Models\Category;

class RestCategoryController extends Controller
{
    public function index(){
        return Category::all(['idCat', 'nameCat', 'idSupCat']);
    }
}
