@extends('layouts.admin', ['page' => 'categories'])

@section('container')
    @include('includes.categoryScripts')
    @include('includes.ad-banner', ['pages' => ['Categories']])

    <div class="content-top">
        <div class="col-md-12">

            @if(session()->has('message'))
                <div class="content-top-1">
                    <h6>{{ session('message') }}</h6>
                </div>
            @endif

            @if(!$categories->count())
                <div class="content-top-1">
                    <h3>We have any category :-(</h3>
                </div>
            @else
                <div class="content-top-1">
                    <h3>We have {{ $categories->count() }}
                        @if($categories->count() > 1)
                            Categories
                        @else
                            Category
                        @endif
                    </h3>
                </div>

                <div class="content-top-1">
                    <div id="accordion">
                        @foreach($categories as $category)
                            @if(!$category->idSupCat)
                            <h3>
                                <table class="table">
                                    <tr class="table-row">
                                        <td class="table-img"><img class="img-circle" src="{{ Storage::url('images/' . $category->imageCat) }}" alt="{{ $category->imageCat }}" width="100" ></td>
                                        <td>{{ $category->nameCat }}</td>
                                        <td>
                                            <span>
                                                <form action="{{ route('categories.edit', $category->idCat)}}" method="get">
                                                    {{ csrf_field() }}
                                                    <input class="btn btn-warning" type="submit" value="Update" onclick="">
                                                    <!--<button id="button-ui" type="submit"><i class="fa fa-pencil"></i></button>-->
                                                    <!--<a href="{{ route('categories.edit', $category->idCat)}}"></a><span style="//font-size: 195em;" name="edit" title="Edit" class="fa fa-pencil"></span>-->
                                                </form>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category->idCat)}}" method="post">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </h3>
                            <div>
                                <table class="table">
                                    @foreach($categories as $subCat)
                                        @if($subCat->idSupCat == $category->idCat)
                                            <tr class="table-row">
                                                <td><img src="{{ Storage::url('images/' . $subCat->imageCat) }}" alt="{{ $subCat->imageCat }}" width="100" ></td>
                                                <td>{{ $subCat->nameCat }}</td>
                                                <td>
                                                    <form action="{{ route('categories.edit', $subCat->idCat)}}" method="get">
                                                        {{ csrf_field() }}
                                                        <input class="btn btn-warning" type="submit" value="Update" id="update">
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('categories.destroy', $subCat->idCat)}}" method="post">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            @endif

        </div>
    </div>

    <div class="clearfix"> </div>
@stop

