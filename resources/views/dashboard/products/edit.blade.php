@extends('dashboard.layouts.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Edit Product {{$product->name}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                    <li class="breadcrumb-item"><a href="" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active ps-0">Edit Product {{$product->name}}</li>
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
                    <form action="{{route('dashboard.product.update',$product->id)}} " method="POST"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlSelect1">Category
                                                Name</label>
                                            <select required name="category_id" class="form-select form-select-lg mb-3"
                                                    id="exampleFormControlSelect1">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }} {{old("category_id")}}"
                                                            @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
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
                                            <input required name="sku" type="text" class="form-control"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Ex.. juice-01 "
                                                   value="{{$product->sku}} {{old('sku')}}">
                                            @if($errors->has('sku'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $errors->first('sku') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputEmail1">Product Name</label>
                                            <input required name="name" type="text" class="form-control"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Ex.. Milkshake"
                                                   value="{{$product->name}} {{old('name')}}">
                                            @if($errors->has('name'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Specifications</h5>
                                        <p class="text-muted"><b>Product Status</b></p>
                                        <div class="form-group mb-3">
                                            <div class="checkbox checbox-switch switch-success">
                                                <label>
                                                    <input type="checkbox" onchange="setval(this);" name="status"
                                                           id="status-toggle" value="active" checked="">
                                                    <span class="toggle-switch-inner"></span>
                                                    Checkbox Label
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputEmail1">Meta Title</label>
                                            <input name="meta_title" type="text" class="form-control"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Ex.. Orange Juice ">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputEmail1">Meta Description</label>
                                            <textarea name="meta_description" class="form-control"
                                                      placeholder="Ex.. Orange Juice Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlTextarea1">Product
                                                Description</label>
                                            <textarea id="summernote" name="description" class="form-control"
                                                      id="exampleFormControlTextarea1"
                                                      rows="3">{{$product->description}} {{old('description')}}</textarea>
                                            @if($errors->has('description'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h4 class="form-label">Product Prices</h4>
                                        </div>
                                        <div class="repeater-add">
                                            <div data-repeater-list="prices">
                                                <div data-repeater-item="">
{{--                                                    @if(isset($product->prices))
                                                        @foreach($product->prices as $prod)
                                                            <div class="row mb-20">
                                                                <div class="col-md-4">
                                                                    <label class="form-label"
                                                                           for="inputAddress5">Size</label>
                                                                    <input required name="size" type="text"
                                                                           class="form-control" id="size"
                                                                           placeholder="Enter Product Size"
                                                                           value="{{$prod->size}}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label"
                                                                           for="inputAddress5">Price</label>
                                                                    <input required name="price" step=".01"
                                                                           type="number"
                                                                           class="form-control" id="price"
                                                                           placeholder="Enter Product Price"
                                                                           value="{{$prod->price}}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="d-grid">
                                                                        <input class="btn btn-danger mt-30"
                                                                               data-repeater-delete=""
                                                                               type="button" value="Delete">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif--}}
                                                    <div class="row mb-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label"
                                                                   for="inputAddress5">Size</label>
                                                            <input  name="size" type="text"
                                                                   class="form-control" id="size"
                                                                   placeholder="Enter Product Size"
                                                                   value="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label"
                                                                   for="inputAddress5">Price</label>
                                                            <input  name="price" step=".01"
                                                                   type="number"
                                                                   class="form-control" id="price"
                                                                   placeholder="Enter Product Price"
                                                                   value="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="d-grid">
                                                                <input class="btn btn-danger mt-30"
                                                                       data-repeater-delete=""
                                                                       type="button" value="Delete">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix mb-20">
                                                <input class="button" data-repeater-create="" type="button"
                                                       value="Add Product New Price">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="form-label">Product Translations</h4>
                                        </div>
                                        <div class="repeater-add">
                                            <div data-repeater-list="translations">
                                                <div data-repeater-item="">
                                                    {{--                                                    @if(isset($product->translations))
                                                                                                        @foreach($product->translations as $translation)
                                                                                                        <div class="row mb-20">
                                                                                                            <div class="col-md-3">
                                                                                                                <label class="form-label" for="exampleInputEmail1">Language</label>
                                                                                                                <input required name="language" type="text" class="form-control" aria-describedby="emailHelp"
                                                                                                                       placeholder="Enter Language" value="{{$translation->lang}}">

                                                                                                            </div>
                                                                                                            <div class="col-md-3">
                                                                                                                <label class="form-label" for="exampleInputEmail1">Product Name</label>
                                                                                                                <input required name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                                                                                                       placeholder="Enter Product Name" value="{{$translation->name}}">

                                                                                                            </div>
                                                                                                            <div class="col-md-3">
                                                                                                                <label class="form-label" for="exampleFormControlTextarea1">Product Description</label>
                                                                                                                <textarea id="summernote" name="description" class="form-control" id="exampleFormControlTextarea1"
                                                                                                                          rows="2">{{$translation->description}}</textarea>
                                                                                                            </div>
                                                                                                            <div class="col-md-2">
                                                                                                                <div class="d-grid">
                                                                                                                    <input class="btn btn-danger mt-30" data-repeater-delete="" type="button" value="Delete">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @endforeach
                                                                                                        @endif--}}
                                                    <div class="row mb-20">
                                                        <div class="col-md-3">
                                                            <label class="form-label"
                                                                   for="exampleInputEmail1">Language</label>
                                                            <select required name="language" class="form-select form-select-lg " id="size" style="padding-top: 0.6rem;padding-bottom: 0.7rem;">
                                                                <option value="" disabled >Language</option>
                                                                <option value="ar" selected>Arabic</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="exampleInputEmail1">Product
                                                                Name</label>
                                                            <input required name="name" type="text" class="form-control"
                                                                   aria-describedby="emailHelp"
                                                                   placeholder="Enter Product Name" value="">

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="exampleFormControlTextarea1">Product
                                                                Description</label>
                                                            <textarea id="summernote" name="description"
                                                                      class="form-control"
                                                                      id="exampleFormControlTextarea1"
                                                                      rows="2"></textarea>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="d-grid">
                                                                <input class="btn btn-danger mt-30"
                                                                       data-repeater-delete="" type="button"
                                                                       value="Delete">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group clearfix mb-20">
                                                <input class="button" data-repeater-create="" type="button"
                                                       value="Add Product New Translation">
                                            </div>
                                            <div class="mb-3">
                                                <img width="25%" src="{{$product->image_url}}"/>
                                                <label class="form-label d-block" for="exampleFormControlFile1">Product
                                                    Image</label>
                                                <input name="image" type="file" class="form-control"
                                                       id="customFile"
                                                       value="{{$product->image_url}}">

                                                @if($errors->has('image'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $errors->first('image') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>

        </div>


    </div>


    <script>
        function setval(sel) {

        }
    </script>

@endsection

