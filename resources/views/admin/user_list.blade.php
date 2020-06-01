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
                                    <h6 class="text-uppercase">User List</h6>
                                    <h6></h6>
                                </div>
                            </div>
                            <div class="section_title">
                                <div class="form-row">
                                    <div class="col-7">
                                        <form method="get" action="{{route('admin.index')}}">
                                            <input type="text" name="user_name" class="form-control"
                                                   id="user_name" value="{{$user_name}}"
                                                   placeholder="Search User">
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-12 p-0">
                                {!! $users->onEachSide(1)->render() !!}
                            </div>
                            <div class="service table-responsive col-md-12 p-0">
                                <table class="table table-hover table-borderless mt-5" id="chat_list_table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Avatar</th>
                                        <th>Name & Email</th>
                                        <th>Info.</th>
                                        <th>Location</th>
                                        <th>Role</th>
                                        <th align="center">Status</th>
                                        <th align="center">Action</th>
                                    </tr>
                                    </thead>
                                    @foreach($users as $user)
                                        <tbody>
                                        <tr>
                                            <td><p>{{$user->created_at}}</p></td>
                                            <td style="position: relative">
                                                <img width="40" height="40" class="rounded-circle"
                                                     onclick="getDetail({{$user->id}})"
                                                     src="{{asset($user->image!="" && $user->image!=null && !$user->private?'images/users_images/'.$user->image:'assets/images/person.png')}}"
                                                     alt="">
                                            </td>
                                            <td>
                                                <p>
                                                    <strong>{{$user->name}}</strong>
                                                </p>
                                                <p>{{$user->email}}</p>
                                                <p>{{$user->phone_number}}</p>
                                            </td>
                                            <td>
                                                <p>Healthcare Worker</p>
                                                <p style="font-size: 10px;margin-left: 10px;">{{$user->health_care_worker?"Yes":"No"}}</p>
                                                <p>{{$user->health_status!==null?"Health Status":""}}</p>
                                                <p style="font-size: 10px;margin-left: 10px;">
                                                    {{strpos($user->health_status,'1') !== false?"Not say ":" "}}
                                                    {{strpos($user->health_status,'2') !== false?"Negative ":" "}}
                                                    {{strpos($user->health_status,'3') !== false?"Positive ":" "}}
                                                    {{strpos($user->health_status,'4') !== false?"Recovered ":" "}}
                                                    {{$user->private?"Private":""}}<br>
                                                </p>
                                                <p>Privacy</p>
                                                <p style="font-size: 10px;margin-left: 10px;">
                                                    {{$user->private?"yes":"No"}}
                                                </p>
                                            </td>
                                            <td>
                                                <p>{{$user->country}}, {{$user->postcode}}</p>
                                            </td>
                                            <td><p>{{$user->roles->first()['name']}}</p></td>
                                            <td><p>
                                                <p>{{$user->deleted===null?$user->email_verified_at!==null?'Verified':'Unverified':"Deleted"}}</p></p>
                                            </td>
                                            <td>
                                                @if($user->deleted===null)
                                                    <form method="POST" id="userDestroy_{{$user->id}}"
                                                          action="{{route('admin.destroy',$user->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <label class="delete_post"
                                                               onclick="destroy_user({{$user->id}})"><i
                                                                class="fa fa-trash"></i></label>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function destroy_user(id) {
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
                        $("#userDestroy_" + id).submit();
                    }
                });
            }
        </script>
@endsection
