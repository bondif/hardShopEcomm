@extends('layouts.admin')

@section('container')

    @include('includes.ad-banner', ['pages' => ['Products']])

    <div class="content-top">
        <div class="col-md-12">

            @if(session()->has('message'))
                <div class="content-top-1">
                    <h6>{{ session('message') }}</h6>
                </div>
            @endif

            @if(!$products->count())
                <div class="content-top-1">
                    <h3>We don't have any product :-(</h3>
                </div>
            @else
                <div class="content-top-1">
                    <h3>We have {{ $products->count() }}
                        @if($products->count() > 1)
                            Products
                        @else
                            Product
                        @endif
                    </h3>
                </div>

                <div class="content-top-1">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="table-row">
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Characteristics</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Nb In Stock</th>
                                <th>Modify</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="table-row">
                                    <td class="table-img"><img class="img-thumbnail" src="{{ Storage::url('icons/' . $product->icon) }}.png" alt="{{ $product->icon }}" width="50" ></td>
                                    <td class="table-text">{{ $product->title }}</td>
                                    <td class="break table-text">{{ $product->description }}</td>
                                    <td class="break table-text">{{ $product->characteristics }}</td>
                                    <td class="table-text">{{ $product->category->nameCat }}</td>
                                    <td class="table-text">{{ $product->price ? $product->price : 'Out Of Stock' }} DH</td>
                                    <td class="table-text">{{ $product->nbInStock }}</td>
                                    <td>
                                        <form action="{{ route('products.edit', $product->idProd)}}" method="get">
                                            {{ csrf_field() }}
                                            <input class="btn btn-warning" type="submit" value="Update" id="update">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->idProd)}}" method="post">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>

@stop

