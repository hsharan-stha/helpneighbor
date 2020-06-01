@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content post_information" id="chat-list">
                        <div class="section_title_container">
                            <div class="row section_title">
                                <div class="col-12">
                                    <h6 class="text-uppercase">Chat List</h6>
                                    <h6></h6>
                                </div>
                            </div>
                            <div class="section_title">
                                {{--                                <h6>--}}
                                <div class="form-row">
                                    <div class="col-7">
                                        <form method="get" action="{{route('chat.index')}}">
                                            <input type="text" name="user_name" class="form-control"
                                                   id="user_name" value="{{$user_name}}"
                                                   placeholder="Search User">
                                        </form>
                                    </div>
                                </div>
                                {{--                                </h6>--}}
                            </div>
                            <div class="col-md-12 col-12 p-0">
                                {!! $users->onEachSide(1)->render() !!}
                            </div>
                            <div class="service col-md-12 p-0">
                                <table class="table table-hover table-borderless mt-5" id="chat_list_table">
                                    @foreach($users as $user)
                                        {{--                                        @if($user->id!==auth()->user()->id)--}}
                                        <tbody style="{{$user->id===auth()->user()->id?"pointer-events:none":''}}">
                                        <tr>
                                            <td style="position: relative;">
                                                @foreach($user->logs as $logs)
                                                    @if($logs->receiver_id===Auth()->user()->id)
                                                        <div class="message-notify">
                                                            <p style="color:black" class="message-content">New
                                                                Message</p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                {{--                                                <script>document.write(localStorage.getItem({{$user->id}}) !== null ? localStorage.getItem({{$user->id}}) : "")</script>--}}
                                                @if($user->log)
                                                    <span class="online"></span>
                                                @endif
                                                <img style="cursor: pointer" width="40" height="40"
                                                     class="rounded-circle"
                                                     onclick="getDetail({{$user->id}})"
                                                     src="{{asset($user->image!="" && $user->image!=null && !$user->private?'images/users_images/'.$user->image:'assets/images/person.png')}}"
                                                     alt="">
                                                <i style="color:white;position:absolute;cursor: pointer;top:45px;left:42px;"
                                                   class="fa fa-info-circle" onclick="getDetail({{$user->id}})"></i>
                                            </td>
                                            <td>
                                                <a href="{{route('chat.show',$user->id)}}">
                                                    <p>
                                                        <strong>Chat To
                                                            : {{!$user->private?$user->name:'user-'.$user->id}}</strong>
                                                    </p>
                                                    <p>{{$user->country}}, {{$user->postcode}}</p>
                                                </a>
                                            </td>
                                            <td><p>{{!$user->private?$user->phone_number:"##########"}}</p></td>
                                        </tr>
                                        </tbody>
                                        {{--                                        @endif--}}
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // let objDiv = document.getElementById("chat-list");
            // objDiv.scrollTop = objDiv.scrollHeight;
            function getDetail(id) {
                $.ajax({
                    url: "{{url('user')}}" + "/" + id,
                    method: "get",
                    success: function (data) {
                        // console.log(data);
                        // alert(id);
                        let health_code = data.health_status != "" && data.health_status != null ? data.health_status : '';
                        let health_status = "";
                        if (health_code.includes("1")) {
                            health_status += 'Prefer not to say<br>';
                        }
                        if (health_code.includes("2")) {
                            health_status += 'Confirmed NEGATIVE Covid-19<br>';
                        }
                        if (health_code.includes("3")) {
                            health_status += 'Confirmed POSITIVE Covid-19<br>';
                        }
                        if (health_code.includes("4")) {
                            health_status += 'Confirmed RECOVERED Covid-19<br>';
                        }
                        let health_care_worker = data.health_care_worker ? "yes" : "No";
                        let private = data.private;
                        let country = data.country;
                        let postcode = data.postcode;
                        let phone_number = data.phone_number;
                        let email = data.email;
                        let image = data.image != "" && data.image != null && !private ? "{{asset('images/users_images')}}/" + data.image : "{{asset('assets/images/person.png')}}";
                        let html = '<div class="row"><div class="user_detail col-lg-6"><p><strong>I\'m HealthCare Worker</strong><br>' + health_care_worker + '</p>' +
                            '<p><strong>Health Status</strong><br>' + health_status + '</p> <br></div>' +
                            '<div class="user_detail col-lg-6"><p><strong>Email</strong><br>' + email + '</p>' +
                            '<p><strong>Phone number</strong><br>' + phone_number + '</p>' +
                            '<p><strong>Country</strong><br>' + country + '</p>' +
                            '<p><strong>Post Code</strong><br>' + postcode + '</p></div></div>';
                        Swal.fire({
                            title: !private ? data.name : 'user-' + data.id,
                            html: !private ? html : '',
                            imageUrl: image,
                            imageWidth: 200,
                            imageHeight: 100,
                            showConfirmButton: false,
                            showCloseButton: true,
                            imageAlt: 'image not found',
                        })
                    }
                });

            }
        </script>
@endsection
