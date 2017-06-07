@extends('admin')

@section('container')

    @include('includes.ad-banner', ['pages' => ['Categories', 'Edit']])
    <div class="content-top">
        <div class="col-md-12">

            <div class="content-top-1">
                <form action="{{ route('categories.update', $cat->idCat) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                    <div class="form-group">
                        <label for="catName" class="col-sm-2 control-label">Category name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="catName" placeholder="Category name" name="categoryName" value="{{ $cat->nameCat }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Super Categorie</label>
                        <div class="col-sm-8">
                            <select class="form-control1" name="superLevelCategory">
                                <option value="0" selected>Super Level Category</option>
                                @foreach($categories as $category)
                                    @if($category->idCat != $cat->idCat)
                                        <option value="{{ $category->idCat }}"
                                        @if($cat->idSupCat == $category->idCat)
                                             selected
                                        @endif
                                        >{{ $category->nameCat }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div align="center">
                        <div class="form-group" align="center">
                            <label for="imageCat">Category Image</label>
                            <input type="file" id="imageCat" accept="image/*" name="categoryImage" value="{{ $cat->imageName }}" defaultValue="{{ $cat->imageName }}">
                            <p class="help-block">Example : image-name.jpg</p>
                            <p>Do you want to change the image ?</p>
                            <div class="checkbox">
                                <label>No <input type="radio" name="changeImage" value="no" checked></label>
                                <label>Yes <input type="radio" name="changeImage" value="yes"></label>
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn" value="Edit Category">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>
@stop