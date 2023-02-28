@extends('dashboard.layouts.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> All Categories</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                    <li class="breadcrumb-item"><a href="/backoffice" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active ps-0">All Categories</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table-bordered border table table-striped dataTable p-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{!!$category->description !!}</td>
                                <td class="tr-image" ><img class="image-20" src="{{$category->image_url}}"></td>
                                <td>
                                    <div class="row ">
                                        <a class="pe-2" href="{{route('dashboard.category.edit',$category->id)}}"> <i
                                                class="fa fa-pencil"></i></a>
                                        <form method="POST" action="{{route('dashboard.category.destroy',$category->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="border: none;"  class="fa fa-trash-o text-danger" onclick="return confirm('Are you sure you want to delete this {{$category->name}} ')">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
