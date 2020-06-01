@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content post_information">
                        <div class="section_title_container">
                            <div class="row section_title">
                                <div class="col-6">
                                    <h6 class="text-uppercase">{{$user->name}}</h6>
                                    <h6>{{$user->about_me}}</h6>
                                </div>
                                <div class="col-6">
                                    @if($redirectToUrl!=="")
                                        <a href="{{url('person/'.$redirectToUrl)}}" class="float-right">
                                            <img class="d-block" width="100"
                                                 src="{{url($user->image!="" && $user->image!=null ?'images/users_images/'.$user->image:'assets/images/person.png')}}"
                                                 alt="">
                                            <label class="d-block pt-2" style="cursor:pointer"><i
                                                    class="fa fa-edit mr-1"></i>Edit Photo</label>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @yield('user_content')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(":submit").change(() => {
            $("#userUpdateForm").submit();
        })
    </script>
@endsection
