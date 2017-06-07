<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class RestProductController extends Controller
{
    public function index(){
        $products =  DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select(DB::raw('products.*, round(products.price * discounts.tauxDiscount/100, 2) as newPrice'))
            ->get();
        //dd($products);
        foreach($products as $product){
            $images = Image::where('idProd', $product->idProd)->get(['image']);
            $product->images = $images;
        }
        return $products;
        /*return DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select('products.*', ['productprice*tauxDiscount/100 as newPrice'])
            ->get();*/
        //return Product::with('images')->get();
        /*$path = storage_path().'/app/public'.'/images/admin1.jpg';
        if (file_exists($path)) {
            return Response::download($path);
        }*/
    }

    public function bestProduct()
    {
        return 'It Works!';
    }

    public function getBestSellers(){
        return 'It Works!';
    }

    public function getFeatured(){
        return 'It Works!';
    }

    public function getBestOffers(){
        return 'It Works!';
    }

    public function getImage($name){
        $path = storage_path().'/app/public'.'/images/' . $name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    public function getIcon($name){
        $path = storage_path().'/app/public'.'/icons/' . $name . 'png';
        if (file_exists($path)) {
            return Response::download($path);
        }
    }
}
