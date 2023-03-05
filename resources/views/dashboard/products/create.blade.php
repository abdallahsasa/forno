@extends('dashboard.layouts.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Add New Product</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                    <li class="breadcrumb-item"><a href="/backoffice/dashboard" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active ps-0">Add New Product</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            @if(session()->get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
            @if(session()->get('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card card-statistics mb-30">
                <div class="card-body">
                    <form action="{{route('product.store')}} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect1">Category Name</label>
                            <select required name="category_id" class="form-select form-select-lg mb-3" id="exampleFormControlSelect1">
                                <option selected >Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}} {{old('category_id')}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">Product Sku</label>
                            <input required name="sku" type="text" class="form-control" aria-describedby="emailHelp"
                                   placeholder="Ex.. juice-01 " value="{{old('sku')}}">
                            @if($errors->has('sku'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('sku') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">Product Name</label>
                            <input required name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                   placeholder="Enter Product Name" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlTextarea1">Product Description</label>
                                    <textarea id="summernote" name="description" class="form-control" id="exampleFormControlTextarea1"
                                              rows="2">{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                        </div>
                        <div class="mb-3">
                            <h4 class="form-label">Product Prices</h4>
                        </div>
                            <div class="repeater-add">
                                <div data-repeater-list="prices">
                                    <div data-repeater-item="">
                                        <div class="row mb-20">
                                            <div class="col-md-4">
                                                <label class="form-label" for="inputAddress5">Size</label>
                                                <select required name="size" class="form-select form-select-lg " id="size" style="padding-top: 0.6rem;padding-bottom: 0.7rem;">
                                                    <option value="" disabled selected>Size</option>
                                                    <option value="Small">Small</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Large">Large</option>
                                                    <option value="1 Liter">1 Liter</option>
                                                    <option value="1,5 Liter">1,5 Liter</option>
                                                    <option value="2 Liter">2 Liter</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="inputAddress5">Price</label>
                                                <input required name="price" step=".01" type="number" class="form-control" id="price" placeholder="Enter Product Price">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-grid">
                                                    <input class="btn btn-danger mt-30" data-repeater-delete="" type="button" value="Delete">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix mb-20">
                                    <input  class="button" data-repeater-create="" type="button" value="Add Product Price">
                                </div>
                            </div>

                        <div class="mb-3">
                            <h4 class="form-label">Product Translations</h4>
                        </div>
                            <div class="repeater-add">
                                <div data-repeater-list="translations">
                                    <div data-repeater-item="">
                                        <div class="row mb-20">
                                            <div class="col-md-3">
                                                <label class="form-label" for="exampleInputEmail1">Language</label>
                                                <select required name="language" class="form-select form-select-lg " id="size" style="padding-top: 0.6rem;padding-bottom: 0.7rem;">
                                                    <option value="" disabled >Language</option>
                                                    <option value="ar" selected >Arabic</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="exampleInputEmail1">Product Name</label>
                                                <input required name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                                       placeholder="Enter Product Name" value="{{old('name')}}">

                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="exampleFormControlTextarea1">Product Description</label>
                                                <textarea id="summernote" name="description" class="form-control" id="exampleFormControlTextarea1"
                                                          rows="2">{{old('description')}}</textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-grid">
                                                    <input class="btn btn-danger mt-30" data-repeater-delete="" type="button" value="Delete">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix mb-20">
                                    <input  class="button" data-repeater-create="" type="button" value="Add Product Translation">
                                </div>
                            </div>

                        <div class="mb-3">
                            <label class="form-label d-block" for="exampleFormControlFile1">Product Image</label>
                            <input required name="image" type="file" class="form-control"  id="customFile" value="{{old('image')}}">
                            @if($errors->has('image'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
