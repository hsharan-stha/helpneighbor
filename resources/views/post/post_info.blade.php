@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content post_information">
                        <div class="section_title_container">
                            <div class="section_title">
                                <h6 class="text-uppercase">Post for {{$post->category}}
                                </h6>
                                <h6></h6>
                            </div>
                            <div class="service text-center col-12">
                                <div class="service search-single-item">

                                    @if($post->media!=="")
                                        @if(explode(".",$post->media)[1]==="mp4" || explode(".",$post->media)[1]==="MOV")
                                            <video src="{{asset('images/posts_videos/'.$post->media)}}"
                                                   width="100%" id="player" controls></video>

                                        @else
                                            <img width="100%"
                                                 src="{{asset('images/posts_images/'.$post->media)}}"
                                                 alt="">
                                        @endif
                                    @else
                                        <img width="100%" src="{{asset('assets/images/default.jpg')}}"
                                             alt="">
                                    @endif

                                    <p style="color:white">posted at {{$post->created_at}}</p>

                                    <form method="POST" id="postDestroy_{{$post->id}}"
                                          action="{{route('search.destroy',$post->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        @if(Auth()->user()->id===$post->users->id || $role_name=='admin')
                                            <label class="delete_post" onclick="destroy({{$post->id}})"><i
                                                    class="fa fa-trash mr-2"></i></label>
                                        @endif
                                        @if(Auth()->user()->id!==$post->users->id)
                                            <label id="interest"><i
                                                    class="fa fa-bookmark{{$like>0?'':'-o'}}"></i></label>
                                        @endif
                                    </form>


                                </div>
                            </div>
                            <div class="section_title">
                                <h5 style="{{Auth()->user()->id===$post->users->id?'pointer-events:none':''}}">
                                    <a href="{{route('chat.show',$post->users->id.($post->title==="hide"?'a':''))}}">
                                        <img width="30" height="30" class=" rounded float_left"
                                             src="{{asset($post->users->image!="" && $post->users->image!=null && $post->title!=="hide" && !$post->users->private?'images/users_images/'.$post->users->image:'assets/images/person.png')}}"
                                             alt="">
                                        <p style="color: white">{{$post->title!=="hide" && !$post->users->private?$post->users->name.($post->title?' - '.$post->title:''):'Anonymous'}}</p>
                                    </a>
                                </h5>
                                <h6>{{$post->description}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let like = "{{$like}}";
            let id = "{{$post->id}}";
            $("#interest").click(() => {
                // alert(like);
                if (like > 0) {
                    postDislike(id)
                } else {
                    postLike(id);
                }
            })

            function postLike(id) {
                $.ajax({
                    url: "{{url('post_like')}}" + "/" + id,
                    method: "get",
                    success: function (data) {
                        if (data != 0) {
                            $("#interest").children().addClass("fa-bookmark");
                            $("#interest").children().removeClass("fa-bookmark-o");
                            like = 1;
                        }
                    }
                });
            }

            function postDislike(id) {
                $.ajax({
                    url: "{{url('post_dislike')}}" + "/" + id,
                    method: "get",
                    success: function (data) {
                        if (data != 0) {
                            $("#interest").children().removeClass("fa-bookmark");
                            $("#interest").children().addClass("fa-bookmark-o");
                            like = 0;
                        }
                    }
                });
            }
        </script>

@endsection
