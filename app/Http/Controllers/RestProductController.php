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
            ->orderBy('newPrice', 'desc')
            ->get();

        return $this->getProdImages($products);
    }

    public function bestProduct()
    {
        $prods = DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select(DB::raw('products.*, round(products.price * discounts.tauxDiscount/100, 2) as newPrice'))
            ->where('price', DB::raw('(select min(price) from products)'))
            ->limit(1)
            ->get();
        return $this->getProdImages($prods);
    }

    public function getBestSellers(){
        $prods = DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select(DB::raw('products.*, round(products.price * discounts.tauxDiscount/100, 2) as newPrice'))
            ->where('price', '>=', DB::raw('(select min(price) from products)'))
            ->orderBy('price', 'desc')
            ->limit(6)
            ->get();
        return $this->getProdImages($prods);
    }

    public function getFeatured(){
        $prods = DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select(DB::raw('products.*, round(products.price * discounts.tauxDiscount/100, 2) as newPrice'))
            ->where('discounts.tauxDiscount', '>=', '50.00')
            ->orderBy('newPrice', 'desc')
            ->limit(6)
            ->get();
        return $this->getProdImages($prods);
    }

    public function getBestOffers(){
        $prods = DB::table('products')
            ->join('hasDiscount', 'products.idProd', '=', 'hasDiscount.idProd')
            ->join('discounts', 'discounts.idDiscount', '=', 'hasDiscount.idDiscount')
            ->select(DB::raw('products.*, round(products.price * discounts.tauxDiscount/100, 2) as newPrice'))
            ->orderBy('newPrice', 'desc')
            ->limit(6)
            ->get();
        return $this->getProdImages($prods);
    }

    public function getImage($name){
        $path = storage_path().'/app/public'.'/images/' . $name;
		//dd(storage_path());
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    public function getIcon($name){
        $path = storage_path().'/app/public'.'/icons/' . $name . '.png';
		//dd($path);
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    public function getProdImages($products){
        foreach($products as $product){
            $images = Image::where('idProd', $product->idProd)->get(['image']);
            $product->images = $images;
        }
        return $products;
    }
}
