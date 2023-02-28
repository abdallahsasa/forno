@extends('dashboard.layouts.app')
@section('content')
    @if(session()->get('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Website Contact Information</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                    <li class="breadcrumb-item"><a href="index.html" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active ps-0">Website Contact Information</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="card card-statistics mb-30">
        <div class="card-body">

            <form method="POST" action="{{route('website_profile.update')}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4 col-xl-12 col-xxl-4 mb-3">
                        <label class="form-label" for="validationServer01">Location</label>
                        <input type="text" class="form-control " id="validationServer01"
                               placeholder="Montréal, 1510 Rue Sauvé" required="" name="location" @
                               value="{{ $data->location}} {{old('location')}}">
                        @if($errors->has('location'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4 col-xl-12 col-xxl-4 mb-3">
                        <label class="form-label" for="validationServer02">Phone Number</label>
                        <input type="text" class="form-control " id="validationServer02"
                               placeholder="+02 (044) 756-X6-52" required="" name="number" value="{{$data->number}} {{old('number')}}">
                        @if($errors->has('number'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('number') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4 col-xl-12 col-xxl-4 mb-3">
                        <label class="form-label" for="validationServer03">Email</label>
                        <input type="email" class="form-control " id="validationServer03"
                               placeholder="info@moreandmore-kw.com" required="" name="email" value="{{$data->email}} {{old('email')}}">
                        @if($errors->has('email'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4 col-xl-6 col-xxl-3 mb-3">
                        <label class="form-label" for="validationServerUsername">Facebook username</label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" id="validationServerUsername"
                                   placeholder="Facebook Username" aria-describedby="inputGroupPrepend3" required=""
                                   name="facebook" value="{{$data->facebook}} {{old('facebook')}}">
                        </div>
                        @if($errors->has('facebook'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4 col-xl-6 col-xxl-3 mb-3">
                        <label class="form-label" for="validationServer04">Instagram Username</label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" id="validationServer04"
                                   placeholder="Instagram Username" required="" name="instagram"
                                   value="{{$data->instagram}} {{old('instagram')}}">
                        </div>
                        @if($errors->has('instagram'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('instagram') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4 col-xl-6 col-xxl-3 mb-3">
                        <label class="form-label" for="validationServer05">Snapchat Username</label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" id="validationServer05"
                                   placeholder="Snapchat Username"
                                   required="" name="snapchat" value="{{$data->snapchat}} {{old('snapchat')}}">
                        </div>
                        @if($errors->has('snapchat'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('snapchat') }}
                            </div>
                        @endif
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
