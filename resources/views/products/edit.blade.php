@extends('admin')

@section('container')

    @include('includes.ad-banner', ['pages' => ['Products', 'Edit']])

    <div class="content-top">
        <div class="col-md-12">

            <div class="content-top-1">
                <form action="{{ route('products.update', $prod->idProd) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                    <div class="form-group">
                        <label for="prodName" class="col-sm-2 control-label">Product Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="prodName" placeholder="Product title" name="productTitle" value="{{ $prod->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="crct" class="col-sm-2 control-label">Characteristics</label>
                        <div class="col-sm-8">
                            <textarea class="form-control1" name="characteristics" id="crct" placeholder="Characteristics" cols="90" rows="5">{{ $prod->characteristics }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control1" name="description" id="desc" placeholder="Description" cols="90" rows="5">{{ $prod->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" min="0" class="form-control1" id="price" placeholder="Price" name="price" value="{{ $prod->price }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nbInStock" class="col-sm-2 control-label">Nb In Stock</label>
                        <div class="col-sm-8">
                            <input type="number" min="0" class="form-control1" id="nbInStock" placeholder="Nb In Stock" name="nbInStock" value="{{ $prod->nbInStock }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-8">
                            <select class="form-control1" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->idCat }}"
                                            @if($prod->idCat == $category->idCat)
                                            selected
                                            @endif
                                    >{{ $category->nameCat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div align="center">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="productImages">Product Images</label>
                                <input type="file" id="productImages" accept="image/png" name="productImages[]" multiple>
                                <p class="help-block">Example : image-name.png</p>
                                <p>Do you want to change the images ?</p>
                                <div class="checkbox">
                                    <label>No <input type="radio" name="changeImages" value="no" checked></label>
                                    <label>Yes <input type="radio" name="changeImages" value="yes"></label>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="productThumbnail">Product Thumbnail</label>
                                <input type="file" id="productThumbnail" accept="image/png" name="productThumbnail" >
                                <p class="help-block">Example : thumbnail-name.png</p>
                                <p>Do you want to change the thumbnail ?</p>
                                <div class="checkbox">
                                    <label>No <input type="radio" name="changeThumbnail" value="no" checked></label>
                                    <label>Yes <input type="radio" name="changeThumbnail" value="yes"></label>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="productIcon">Product Icon</label>
                                <input type="file" id="productIcon" accept="image/png" name="productIcon" >
                                <p class="help-block">Example : icon-name.png</p>
                                <p>Do you want to change the icon ?</p>
                                <div class="checkbox">
                                    <label>No <input type="radio" name="changeIcon" value="no" checked></label>
                                    <label>Yes <input type="radio" name="changeIcon" value="yes"></label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" align="center">
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