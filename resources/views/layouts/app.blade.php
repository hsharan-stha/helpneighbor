<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/pusher.min.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164147793-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-164147793-1');
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap-4.1.2/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">


</head>
<body>
<div class="super_container">

    <header class="header trans_400">
        <div class="header_content d-flex flex-row align-items-center jusity-content-start trans_400">

            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('login') }}">
                    <img class="img-fluid" src="{{asset('assets/images/logo-random.png')}}"/>
                </a>
            </div>

            <!-- Main Navigation -->
            <nav class="main_nav">
                <ul class="d-flex flex-row align-items-center justify-content-start">
                    <li id="give"><a href="{{ route('give.index') }}">Give</a></li>
                    <li id="need"><a href="{{ route('need.index') }}">Need</a></li>
                    <li id="hope"><a href="{{ route('hope.index') }}">Hope</a></li>
                    @guest
                        <li class="nav-item" style=" margin-left: auto;margin-right: 0px">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown" style=" margin-left: auto">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-0" style="background: black;"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>
            <div class="header_extra d-flex flex-row align-items-center justify-content-end ml-auto">

                <div class="social">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{ route('chat.index') }}"><i class="fa fa-commenting-o"></i></a></li>
                        {{--                        <li><a href="{{url('help')}}"><i class="fa fa-info-circle"></i></a></li>--}}
                        <li style="cursor: pointer;"><a data-toggle="modal"
                               data-target="#helpModal"><i class="fa fa-info-circle"></i></a></li>
                    </ul>
                </div>

                <!-- Hamburger -->
                <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
            </div>
        </div>
    </header>


    <div class="menu_overlay trans_400"></div>
    <div class="menu trans_400">
        <div class="menu_close_container">
            <div class="menu_close">
                <div></div>
                <div></div>
            </div>
        </div>
        <nav class="menu_nav">
            <ul>
                <li><a href="{{ route('login') }}">Home</a></li>
                <li><a href="{{ route('give.index') }}">Give</a></li>
                <li><a href="{{ route('need.index') }}">Need</a></li>
                <li><a href="{{ route('hope.index') }}">Hope</a></li>
                <li><a href="{{ route('search.index') }}">Search</a></li>
                {{--                <li><a href="{{ route('user.index') }}">User</a></li>--}}
                @guest
                    <li>
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right p-0" style="background: black"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                My Posts
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
    @yield('content')
    @auth()
        <footer class="footer  pt-2">

            <div class="row">
                <div class="col-4 col-xl-4 col-md-4 service_col">
                    <div class="service text-center">
                        <div class="service">
                            <div
                                class="icon_container d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
                                <a width="auto" href="{{route('login')}}" class="icon">
                                    <i style="color:white;font-size: 26px;padding-top:3px;" class="fa fa-home"></i>
                                </a>
                                {{--                                    <img--}}
                                {{--                                        src="{{url('assets/images/home.png')}}"--}}
                                {{--                                        alt=""></a>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 col-xl-4 col-md-4 service_col">
                    <div class="service text-center">
                        <div class="service">
                            <div
                                class="icon_container d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
                                <a href="{{route('search.index')}}" class="icon">
                                    <i style="color:white;font-size: 24px;padding-top:3px;" class="fa fa-search"></i>
                                    {{--                                    <img--}}
                                    {{--                                        src="{{url('assets/images/search.png')}}"--}}
                                    {{--                                        alt="">--}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service -->
                <div class="col-4 col-xl-4 col-md-4 service_col">
                    <div class="service text-center">
                        <div class="service">
                            <div
                                class="icon_container d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
                                <a href="{{route('user.index')}}" class="icon">
                                    <i style="color:white;font-size: 26px;padding-top:3px;" class="fa fa-user"></i>
                                    {{--                                    <img--}}
                                    {{--                                        src="{{url('assets/images/person.png')}}"--}}
                                    {{--                                        alt="">--}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </footer>
    @endauth
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">   
            <div class="modal-header">
                <h3 class="modal-title">Post ONLY GIVE-NEED-HOPE Random Acts of Kindness</h3>
                <button type="reset" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Your Post may be deleted or your account may be suspended by posting</h5>
                <h5>explicit images, illegal trade, political commentary, medical advice,</h5>
                <h5>complaining or whining, or any in appropriate material.</h5>
                <br>
                <h5 style="font-size: 14px;">Remember to stay “Physically Distant” but remain “Social”.<br> Prevent
                    spreading Covid-19.
                </h5>
            </div>
            <div class="modal-footer">
                <div class="col-md-3  col-6">
                    <button type="submit" class="button button_1 intro_button trans_200">
                        Post
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="helpModal">
    <div class="modal-dialog" style="max-width: 1000px">
        <div class="modal-content col-md-12">   
            <div class="intro_content">
                <div class="section_title_container">
                    <div class="section_title">
                        <h6>Help
                            <button type="reset" class="close" data-dismiss="modal">&times;</button>
                        </h6>
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
                        <img src="{{asset('assets/helps/icon-search.png')}}" class="mr-4"/> <label>Search</label>
                    </div>
                    <div class="col-lg-3 col-6">
                        <img src="{{asset('assets/helps/icon-profile.png')}}" class="mr-4"/> <label>Profile</label>
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
                <div class="row mt-3 mb-3 mt-lg-4">
                    <div class="col-lg-6">
                        <h6 style="color:white;font-weight:700;font-size:16px;padding-bottom: 10px;">What You
                            Can Post:</h6>
                        <img class="img-fluid mt-2" src="{{asset('assets/helps/btn-1.png')}}"/>
                        <label class="">What you can share?</label>
                        <img class="img-fluid mt-2" src="{{asset('assets/helps/btn-2.png')}}"/>
                        <label class="">What do you need?</label>
                        <img class="img-fluid mt-2" src="{{asset('assets/helps/btn-3.png')}}"/>
                        <label class="">Random Acts Of Kindness</label>
                    </div>
                    <div class="col-lg-6 mt-3  mt-lg-0">
                        <h6 style="color:white;font-weight:700;font-size:16px;padding-bottom: 10px;">To Edit
                            Profile:</h6>
                        <img src="{{asset('assets/helps/icon-edit.png')}}"/> <label class="">Edit
                            Profile</label>
                        <img src="{{asset('assets/helps/arrow.png')}}"/>
                        <img src="{{asset('assets/helps/box.png')}}" class="mr-2"/><label>Privacy</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer pl-0">
                <div class="col-md-12 col-lg-12 col-12 p-0">
                    <a href="https://www.patreon.com/RanKind" class="button button_1 intro_button trans_200 p-2">
                        Become a Patron
                    </a>
                </div>
                <div class="col-md-12 col-lg-12 mt-md-4 mt-4 col-12 p-0">
                    <a href="https://www.paypal.com/myaccount/transfer/homepage"
                       class="button button_1 intro_button trans_200 p-2">
                        Donate to PayPal
                    </a>
                    <label class="mt-2 ml-1 mt-sm-0">to: info@RanKind.net</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{asset('assets/js/sweetalert2.js')}}"></script>
<script>
    function readURL(input, tag) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(tag + '-img').attr('src', e.target.result);
                $(tag + '-img').attr('style', 'border-radius:70px');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readVideo(e, tag) {
        var file = e.target.files[0];
        tag.src = URL.createObjectURL(file);
    }

    var recorder = document.getElementById('video');
    var player = document.getElementById('player');
    var gallery = document.getElementById('gallery');
    var galleryImg = document.getElementById('gallery-img');
    var galleryVideo = document.getElementById('gallery-video');
    var video = document.getElementById('video');
    var photo = document.getElementById('photo');
    var photoImg = document.getElementById('photo-img');

    $("#photo").change(function () {
        readURL(this, "#photo");
        gallery.value = "";
        galleryImg.style.display = "none";
        if (galleryVideo !== null) {
            galleryVideo.style.display = "none";
        }
        if (video !== null)
            video.value = "";
        if (player !== null)
            player.style.display = "none";
    });

    $("#gallery").change(function (e) {
        var file = e.target.files[0];
        console.log(file);
        if (file.type.includes("video")) {
            galleryVideo.style.display = "block";
            galleryImg.style.display = "none";
            readVideo(e, galleryVideo)
        } else {
            if (galleryVideo !== null) {
                galleryVideo.style.display = "none";
            }
            galleryImg.style.display = "block";
            readURL(this, "#gallery");
        }
        photo.value = "";
        if (photoImg !== null) {
            photoImg.style.display = "none";
        }
        if (video !== null) {
            video.value = "";
        }
        if (player !== null)
            player.style.display = "none";

    });

    if (recorder !== null) {
        recorder.addEventListener('change', function (e) {
            photo.value = "";
            photoImg.style.display = "none";
            gallery.value = "";
            galleryImg.style.display = "none";
            galleryVideo.style.display = "none";
            player.style.display = "block";
            readVideo(e, player);
        });
    }

    $(":submit").click(() => {
        $("#form").submit();
    })

    $(":button[type=button]").click(() => {
        let time = $("#time");
        let food = $("#food");
        let money = $("#money");
        let other = $("#other");
        let description = $("#description");
        if (!time.is(":checked") && !food.is(":checked") && !money.is(":checked") && !other.is(":checked")) {
            time.addClass("is-invalid");
            food.addClass("is-invalid");
            money.addClass("is-invalid");
            other.addClass("is-invalid");
            return false;
        } else {
            time.removeClass("is-invalid");
            food.removeClass("is-invalid");
            money.removeClass("is-invalid");
            other.removeClass("is-invalid");
        }

        if (description.val() === "") {
            description.addClass("is-invalid");
            description.next().remove();
            description.parent().append("<span class=\"invalid-feedback\" role=\"alert\">\n" +
                "                                                <strong>The description field is required</strong>\n" +
                "                                                     </span>");
            return false;
        } else {
            description.removeClass("is-invalid");
            description.next().remove();
        }

        return true;
    })


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lon=' + longitude + '&lat=' + latitude, function (data) {
                    let country = (data['address']['country']);
                    $("form").append("<input type='hidden' name='country' value='" + country + "'/>");
                })
            }
            // ,() => {
            //     $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lon=84.81445312499999&lat=27.916766641249055', function (data) {
            //         let country = (data['address']['country']);
            //         $("form").append("<input type='hidden' name='country' value='" + country + "'/>");
            //     })
            // }
        )
    }


    function destroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'black',
            cancelButtonColor: '#FD556D',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $("#postDestroy_" + id).submit();
            }
        });
    }
</script>
@auth()
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        var pusher = new Pusher('75bdae8d568ae4544213', {
            cluster: 'eu',
            forceTLS: true
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (res) {

            let data = res.message.chat;
            let sender = res.message.sender;
            let receiver_id = "{{auth()->user()->id}}";
            let currLoc = $(location).attr('href');
            let currLocalArr = currLoc.split('/');
            if (parseInt(receiver_id) === data.receiver_id) {
                if (currLocalArr[currLocalArr.length - 2] !== "chat" ||
                    parseInt(currLocalArr[currLocalArr.length - 1]) !== parseInt(data.sender_id)) {
                    // localStorage.setItem(data.sender_id, data.sender_id);
                    Swal.fire(
                        'New Message',
                        'From ' + sender.name,
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = "{{asset('chat')}}" + "/" + data.sender_id;
                        }
                    })
                } else {
                    $(".chat-text-box").prev().prev().before("<div class=\"message-blue\">\n" +
                        "                                                <p class=\"message-content\">" + data.chat + "</p>\n" +
                        "                                                <div class=\"message-timestamp-left\">" + data.created_at.replace("T", " ").split(".")[0] + "</div>\n" +
                        "                                            </div>");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
            }
        });
    </script>
@endauth
</body>
</html>
