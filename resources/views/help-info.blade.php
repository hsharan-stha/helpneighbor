@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content">
                        <div class="section_title_container">
                            <div class="section_title"><h6>Help</h6>
                                <h6></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6 style="color:white;font-weight:700;font-size:16px;padding-bottom: 10px;">Icons
                                    Info:</h6>

                            </div>
                            <div class="col-lg-3 col-6 mb-2">
                                <img src="{{asset('assets/helps/icon-chat.png')}}" class="mr-4"/> <label>Chat</label>
                            </div>
                            <div class="col-lg-3 col-6 mb-2">
                                <img src="{{asset('assets/helps/icon-home.png')}}" class="mr-4"/> <label>Home</label>
                            </div>
                            <div class="col-lg-3 col-6">
                                <img src="{{asset('assets/helps/icon-profile.png')}}" class="mr-4"/> <label>Profile</label>
                            </div>
                            <div class="col-lg-3 col-6">
                                <img src="{{asset('assets/helps/icon-search.png')}}" class="mr-4"/> <label>Search</label>
                            </div>
                        </div>
                        <div class="row mt-3 mt-lg-4">
                            <div class="col-lg-3 col-12 mb-3">
                                <img src="{{asset('assets/helps/icon-menu.png')}}"/> <label class="ml-3">Hamburger
                                    Menu</label>
                            </div>
                            <div class="col-lg-3 col-12 mb-3">
                                <img src="{{asset('assets/helps/icon-trash.png')}}"/> <label class="ml-3">Delete your
                                    posts</label>
                            </div>
                            <div class="col-lg-3 col-12 mb-3">
                                <img src="{{asset('assets/helps/icon-flag.png')}}"/> <label class="ml-3">Flag Your
                                    Items</label>
                            </div>
                        </div>
                        <div class="row mt-3 mt-lg-4">
                            <div class="col-12">
                                <h6 style="color:white;font-weight:700;font-size:16px;padding-bottom: 10px;">What You
                                    Can Post:</h6>
                            </div>
                            <div class="col-lg-12">
                                <img class="img-fluid" src="{{asset('assets/helps/btn-1.png')}}"/>
                                <label class="ml-3">What you can share?</label>
                            </div>
                            <div class="col-lg-12  mt-3">
                                <img class="img-fluid" src="{{asset('assets/helps/btn-2.png')}}"/>
                                <label class="ml-3">What do you need?</label>
                            </div>
                            <div class="col-lg-12  mt-3">
                                <img class="img-fluid" src="{{asset('assets/helps/btn-3.png')}}"/>
                                <label class="ml-3">Random Acts Of Kindness</label>
                            </div>
                        </div>
                        <div class="row mt-3 mb-2 mt-lg-4">
                            <div class="col-12">
                                <h6 style="color:white;font-weight:700;font-size:16px;padding-bottom: 10px;"">To Edit
                                Profile:</h6>
                            </div>
                            <div class="col-lg-12">
                                <img src="{{asset('assets/helps/icon-edit.png')}}"/> <label class="">Edit
                                    Profile</label>
                                <img src="{{asset('assets/helps/arrow.png')}}"/>
                                <img src="{{asset('assets/helps/box.png')}}" class="mr-2"/><label>Privacy</label>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
