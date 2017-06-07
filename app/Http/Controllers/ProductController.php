<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $prods = $this->getAllProds();
        return view('products.index')->withProducts($prods);
    }

    public function create()
    {
        $cats = Category::where('idSupCat', '!=', null)->get(['idCat', 'nameCat']);
        return view('products.create')->withCategories($cats);
    }

    public function store(Request $request)
    {
        $toValidate = array(
            'productTitle' => 'required|min:5|max:50',
            'characteristics' =>'required|min:30|max:300',
            'description' =>'required|min:15|max:150',
            'price' =>'required|min:0|numeric',
            'nbInStock' =>'required|min:0|numeric',
            'category' =>'required|numeric',
            'productThumbnail' =>'required|image|mimes:png|max:50',
            'productIcon' =>'required|image|mimes:png|max:30'
        );
        $photos = count($request->file('productImages'));
        foreach(range(0, $photos) as $index) {
            $toValidate['productImages.' . $index] = 'image|mimes:png|max:100';
        }

        $this->validate($request, $toValidate);

        if($request->file('productThumbnail')->store('/public/images')
            and $request->file('productIcon')->store('/public/icons')
        ){
            $prod = Product::create([
                'title' => $request->input('productTitle'),
                'characteristics' => $request->input('characteristics'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'nbInStock' => $request->input('nbInStock'),
                'idCat' => $request->input('category'),
                'thumbnail' => $request->file('productThumbnail')->hashName(),
                'icon' => $request->file('productIcon')->hashName()
            ]);
            foreach ($request->file('productImages') as $image) {
                $image->store('/public/images');
                Image::create([
                    'idProd' => $prod->idProd,
                    'image' => $image->hashName()
                ]);
            }
            session()->flash('message', 'Product added successfully');
            return redirect(route('products.index'));
        } else {
            session()->flash('message', 'Something went wrong please try again');
            return redirect(route('products.index'));
        }
    }

    public function edit($id)
    {
        $prod = $this->getProdById($id);
        $cats = Category::all(['idCat', 'nameCat']);
        if($prod)
            return view('products.edit')
                ->withProd($prod)
                ->withCategories($cats);
        return redirect(route('products.index'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'productTitle' => 'required|min:5|max:50',
            'characteristics' =>'required|min:30|max:300',
            'description' =>'required|min:15|max:150',
            'price' =>'required|min:0|numeric',
            'nbInStock' =>'required|min:0|numeric',
            'category' =>'required|numeric',
            'changeImages' =>'required',
            'changeThumbnail' =>'required',
            'changeIcon' =>'required',
        ]);

        $toUpdate = array(
            'title' => $request->input('productTitle'),
            'characteristics' => $request->input('characteristics'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'nbInStock' => $request->input('nbInStock'),
            'idCat' => $request->input('category'),
        );

        $prod = $this->getProdById($id);

        if($request->input('changeImages') == 'yes'){
            $toValidate = array();
            $images = count($request->file('productImages'));
            foreach(range(0, $images) as $index) {
                $toValidate['productImages.' . $index] = 'image|mimes:png|max:200';
            }
            $this->validate($request, $toValidate);
            $this->deleteImages($prod);
            //$imagesIds = Image::where('idProd', $prod->idProd)->get(['idImage']);
            //Image::destroy($imagesIds);
            foreach ($request->file('productImages') as $image) {
                $image->store('/public/images');
                Image::create([
                    'idProd' => $prod->idProd,
                    'image' => $image->hashName()
                ]);
            }
        }

        if($request->input('changeThumbnail') == 'yes'){
            $this->validate($request, [
                'productThumbnail' =>'required|image|max:100',
            ]);
            $toUpdate['thumbnail'] = $request->file('productThumbnail')->hashName();
            $this->deleteThumbnail($prod);
            $request->file('productThumbnail')->store('/public/images');
        }

        if($request->input('changeIcon') == 'yes'){
            $this->validate($request, [
                'productIcon' =>'required|image|max:30',
            ]);
            $toUpdate['icon'] = $request->file('productIcon')->hashName();
            $this->deleteIcon($prod);
            $request->file('productIcon')->store('/public/icons');
        }

        if($prod->update($toUpdate)){
            session()->flash('message', 'Product updated successfully');
            return redirect(route('products.index'));
        } else {
            session()->flash('message', 'Something went wrong please try again');
            return redirect(route('products.index'));
        }
    }

    public function destroy($id)
    {
        $prod = $this->getProdById($id);

        $this->deleteImages($prod);
        $this->deleteThumbnail($prod);
        $this->deleteIcon($prod);
        if($prod->delete()):
            session()->flash('message', 'Product deleted');
            return redirect(route('products.index'));
        else:
            session()->flash('message', 'Something went wrong please try again');
            return redirect(route('products.index'));
        endif;
    }

    public function getAllProds($fields = '*'){
        return Product::with('category')->get();
    }

    private function getProdById($id){
        return Product::find($id);
    }

    private function deleteImages($prod){
        $images = Image::where('idProd', $prod->idProd)->get();
        foreach ($images as $image) {
            Storage::delete('public/images/' . $image->image);
        }
    }

    private function deleteThumbnail($prod){
        return Storage::delete('public/images/' . $prod->thumbnail);
    }

    private function deleteIcon($prod){
        return Storage::delete('public/icons/' . $prod->icon);
    }
}
