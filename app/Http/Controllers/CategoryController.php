<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $cats = $this->getAllCats();
        return view('categories.index')->withCategories($cats);
    }


    public function create()
    {
        $cats = Category::all('idCat', 'nameCat');
        return view('categories.create')->withCategories($cats);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required|min:5|max:50',
            'categoryImage' =>'required|image|max:50'
        ]);

        $supCat = $request->input('superLevelCategory') == 0 ? null : $request->input('superLevelCategory');

        if($request->file('categoryImage')->store('/public/images')):
            Category::create([
                'idSupCat' => $supCat,
                'nameCat' => $request->input('categoryName'),
                'imageCat' => $request->file('categoryImage')->hashName()
            ]);
            session()->flash('message', 'Category added successfully');
            return redirect(route('categories.index'));
        else:
            session()->flash('message', 'Something went wrong please try again');
            return redirect(route('categories.index'));
        endif;
    }

    public function edit($id)
    {
        $cat = $this->getCatById($id);
        $cats = $this->getAllCats(['idCat', 'nameCat']);
        if($cat)
            return view('categories.edit')
                ->withCat($cat)
                ->withCategories($cats);
        return redirect(route('categories.index'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'changeImage' => 'required',
            'categoryName' => 'required|min:5|max:50'
        ]);
        if($request->input('changeImage') == 'yes')
            $this->validate($request, [
                'categoryImage' =>'required|image|max:50',
            ]);

        $cat = $this->getCatById($id);

        $supCat = $request->input('superLevelCategory') == 0 ? null : $request->input('superLevelCategory');

        if($request->input('changeImage') == 'no'):
            $cat->update([
                'idSupCat' => $supCat,
                'nameCat' => $request->input('categoryName'),
            ]);
            session()->flash('message', 'Category updated successfully');
            return redirect(route('categories.index'));
        else:
            $this->deleteImage($cat);
            if($request->file('categoryImage')->store('/public/images')):
                $cat->update([
                    'idSupCat' => $supCat,
                    'nameCat' => $request->input('categoryName'),
                    'imageCat' => $request->file('categoryImage')->hashName()
                ]);
                session()->flash('message', 'Category updated successfully');
                return redirect(route('categories.index'));
            else:
                session()->flash('message', 'Something went wrong please try again');
                return redirect(route('categories.index'));
            endif;
        endif;
    }

    public function destroy($id)
    {
        $cat = $this->getCatById($id);

        $this->deleteImage($cat);
        if($cat->delete() ):
            session()->flash('message', 'Category deleted');
            return redirect(route('categories.index'));
        else:
            session()->flash('message', 'Something went wrong please try again');
            return redirect(route('categories.index'));
        endif;
    }

    private function getCatById($id){
        return Category::find($id);
    }

    private function getAllCats($fields = '*'){
        return Category::all($fields);
    }

    private function deleteImage($cat){
        return Storage::delete('public/images/' . $cat->imageCat);
    }
}
