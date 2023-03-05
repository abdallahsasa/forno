@extends('dashboard.layouts.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Edit {{$category->name}} Category</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                    <li class="breadcrumb-item"><a href="/backoffice/dashboard" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active ps-0">{{$category->name}}</li>
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

                    <form method="POST" action="{{route('dashboard.category.update',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">Category Name</label>
                            <input required name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                   placeholder="Ex.. Fresh juice " value="{{$category->name}}">
                            @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlTextarea1">Category Description</label>
                            <textarea id="summernote" name="description" class="form-control" id="exampleFormControlTextarea1"
                                      rows="3">{{$category->description}}</textarea>
                            @if($errors->has('description'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
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
                                            <label class="form-label" for="exampleInputEmail1">Category
                                                Name</label>
                                            <input required name="name" type="text" class="form-control"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Category Name" value="">

                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="exampleFormControlTextarea1">Category
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
                                       value="Add Category New Translation">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" for="exampleFormControlFile1">Category Image</label>
                            <img width="15%" src="{{$category->image_url}}" class="form-label d-block w-10" for="exampleFormControlFile1" alt="">
                            <input name="image" type="file" class="form-control" id="customFile" value="{{$category->image_url}}">
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
