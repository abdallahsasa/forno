@extends('dashboard.layouts.app')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Requested Messages</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Requested Messages</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive mt-20">
                    <table class="table center-aligned-table">
                        <thead>
                        <tr class="text-dark">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone </th>
                            <th>Message </th>
                            <th>Date </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{$message->name}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->number}}</td>
                                <td>{{$message->message}}</td>
                                <td>{{$message->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
{{--                <div class="sm-mt-20">--}}
{{--                    <nav aria-label="Page navigation example">--}}
{{--                        <ul class="pagination justify-content-center">--}}
{{--                            <li class="page-item "><a class="page-link" href="#">Previous</a></li>--}}
{{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
@endsection
