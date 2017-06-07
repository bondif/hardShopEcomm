@extends('admin')

@section('container')

    @include('includes.ad-banner', ['pages' => ['Categories', 'Create']])
    <div class="content-top">
        <div class="col-md-12">

            <div class="content-top-1">
                <form action="{{ route('categories.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                    <div class="form-group">
                        <label for="catName" class="col-sm-2 control-label">Category name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="catName" placeholder="Category name" name="categoryName" value="{{ old('categoryName') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Super Categorie</label>
                        <div class="col-sm-8">
                            <select class="form-control1" name="superLevelCategory">
                                <option value="0" selected>Super Level Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->idCat }}"
                                    @if(old('superLevelCategory') == $category->idCat)
                                    selected
                                    @endif
                                    >{{ $category->nameCat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div align="center">
                        <div class="form-group">
                            <label for="imageCat">Category Image</label>
                            <input type="file" id="imageCat" accept="image/png" name="categoryImage" >
                            <p class="help-block">Example : image-name.png</p>
                        </div>
                    </div>
                    <div align="center">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn" value="Add Category">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>

@stop
