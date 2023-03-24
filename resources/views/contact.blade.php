@extends('layouts.app')
@section('content')
    <!-- banner -->
    <section class="sb-banner sb-banner-color">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <!-- main title -->
                    <div class="sb-main-title-frame">
                        <div class="sb-main-title">
                            <span class="sb-suptitle sb-mb-30">Contact</span>
                            <h1 class="sb-mb-30">Get in <span>Touch with More & More</span></h1>
                            <p class="sb-text sb-text-lg sb-mb-30">We will respond within 24 hours.</p>
                            <ul class="sb-breadcrumbs">
                                <li><a href="home-1.html">Home</a></li>
                                <li><a href="menu-1.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- main title end -->
                </div>
                <div class="col-lg-5">
                    <div class="sb-contact-form-frame">
                        <div class="sb-illustration-9">
                            <img src="img/illustrations/envelope-1.png" alt="envelope" class="sb-envelope-1">
                            <img src="img/illustrations/reservation.png" alt="envelope" class="sb-envelope-2">
                            <div class="sb-cirkle-1"></div>
                            <div class="sb-cirkle-2"></div>
                            <div class="sb-cirkle-3"></div>
                        </div>
                        <div class="sb-form-content">
                            <div class="sb-main-content">
                                <h3 class="sb-mb-30">Send Message</h3>
                                <form id="form" method="POST" action="{{route('contact.store')}}">
                                    @csrf
                                    <div class="sb-group-input">
                                        <input type="text" name="name" required value="{{old('name')}}">
                                        <span class="sb-bar"></span>
                                        <label>Name</label>
                                        @if($errors->has('name'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="sb-group-input">
                                        <input type="text" name="number" required value="{{ old('number') }}">
                                        <span class="sb-bar"></span>
                                        <label>Phone Number</label>
                                        @if($errors->has('number'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errors->first('number') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="sb-group-input">
                                        <input type="email" name="email" required value="{{ old('email') }}">
                                        <span class="sb-bar"></span>
                                        <label>Email</label>
                                        @if($errors->has('email'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="sb-group-input">
                                        <textarea name="message" required> {{ old('message') }}</textarea>
                                        <span class="sb-bar"></span>
                                        <label>Message</label>
                                        @if($errors->has('message'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errors->first('message') }}
                                            </div>
                                        @endif
                                    </div>
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
                                    <p class="sb-text sb-text-xs sb-mb-30">*We promise not to disclose your <br>personal
                                        information to third parties.</p>
                                    <!-- button -->
                                    <button class="sb-btn sb-cf-submit sb-show-success">
                                        <span class="sb-icon">
                                            <img src="img/ui/icons/arrow.svg" alt="icon">
                                        </span>
                                        <span>Send</span>
                                    </button>
                                    <!-- button end -->
                                </form>
                            </div>
                            <div class="sb-success-result">
                                <img src="img/ui/success.jpg" alt="success" class="sb-mb-15">
                                <div class="sb-success-title sb-mb-15">Success!</div>
                                <p class="sb-text sb-mb-15">Your message has been sent <br>successfully</p>
                                <!-- button -->
                                <a href="home-1.html" class="sb-btn sb-btn-2">
                      <span class="sb-icon">
                        <img src="img/ui/icons/arrow-2.svg" alt="icon">
                      </span><span>Back to home</span></a>
                                <!-- button end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->
    <!-- contact info -->
    <section class="sb-p-90-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sb-features-item sb-mb-60">
                        <div class="sb-number">01</div>
                        <div class="sb-feature-text">
                            <h3 class="sb-mb-15">Welcome</h3>
                            <p class="sb-text">{{$websiteContactData->location}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sb-features-item sb-mb-60">
                        <div class="sb-number">02</div>
                        <div class="sb-feature-text">
                            <h3 class="sb-mb-15">Call</h3>
                            <p class="sb-text">{{$websiteContactData->number}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sb-features-item sb-mb-60">
                        <div class="sb-number">03</div>
                        <div class="sb-feature-text">
                            <h3 class="sb-mb-15">Write</h3>
                            <p class="sb-text">{{$websiteContactData->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact info end -->
    <!-- map -->
    <div style="display: none;" class="sb-map-frame">
        <div id="map" class="sb-map"></div>
        <div class="sb-lock"><i class="fas fa-lock"></i></div>
    </div>
    <!-- map end -->
@endsection

