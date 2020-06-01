@extends('user.user_shared')

@section('user_content')
    <form method="get" id="searchForm" action="{{route('user.index')}}">
        <div class="section_title">
            {{--            <h6>--}}
            <div class="form-row">
                <div class="col-7">
                    <input type="text" name="searchText" class="form-control"
                           id="searchText" value="{{$searchText}}"
                           placeholder="Search">
                </div>
            </div>
            {{--            </h6>--}}
        </div>
        <div class="col-md-6 col-12 mt-3 p-0">
            <input type="radio"
                   class="custom-control-input"
                   id="image_view" value="1" {{$view==1?'checked':''}}
                   name="view">
            <label for="image_view"
                   class="button button_1 intro_button trans_200 {{$view==1?"btn-active":""}} view_style">Image
                View</label>
            <input type="radio" {{$view==0?'checked':''}}
            class="custom-control-input"
                   id="text_view" value="0"
                   name="view">
            <label for="text_view"
                   class="button button_1 intro_button trans_200 {{$view==0?"btn-active":""}} view_style">Text
                View</label>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 col-12 p-0">
            {!! $posts->onEachSide(1)->render() !!}
        </div>

        @foreach($posts as $post)
            @if($view==1)
                <div class="col-xl-4 col-md-4 col-4 text-center  p-lg-2 p-1">
                    @if($post->media!="" || $post->media!=null)
                        @if(explode(".",$post->media)[1]==="mp4" || explode(".",$post->media)[1]==="MOV")
                            <a class="default-anchor" href="{{url('post_info/'.$post->id)}}">
                                <img width="100%" class="img-fluid img-thumbnail"
                                     src="{{url('assets/images/video.png')}}"
                                     alt="">
                                <p>{{substr($post->description,0,30)}}</p>
                            </a>

                        @else
                            <a href="{{url('post_info/'.$post->id)}}"> <img width="100%"
                                                                            class="img-fluid img-thumbnail"
                                                                            src="{{url('images/posts_images/'.$post->media)}}"
                                                                            alt="">
                            </a>
                        @endif
                    @else
                        <a class="default-anchor" href="{{url('post_info/'.$post->id)}}">
                            <img width="100%" class="img-fluid img-thumbnail"
                                 src="{{url('assets/images/default.jpg')}}"
                                 alt="">
                            <p>{{substr($post->description,0,30)}}</p>
                        </a>
                    @endif
                </div>
            @else
                <div class="col-xl-10 col-md-10 col-9 mb-1 p-2" style="background: #6BA757">
                    <a href="{{url('post_info/'.$post->id)}}" class="text_view">
                        <p  style="color:white">{{$post->title!=="hide"?$post->users->name.($post->title?' - '.$post->title:''.''):'Anonymous'}}
                            - {{substr($post->description,0,30)}}</p>
                    </a>
                </div>
                <div class="col-xl-1 col-md-2 col-3">
                    <form method="POST" id="postDestroy_{{$post->id}}" action="{{route('search.destroy',$post->id)}}">
                        @method('DELETE')
                        @csrf
                        <label class="delete_post" onclick="destroy({{$post->id}})"><i class="fa fa-trash"></i></label>
                    </form>
                </div>
            @endif
        @endforeach

    </div>

    <script>
        $("input[type='radio']").click(() => {
            $("#searchForm").submit();
        })

        // $("#delete_post").click((e) => {
        // function destroy(id) {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#57ccc3',
        //         cancelButtonColor: '#FD556D',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             $("#postDestroy_" + id).submit();
        //         }
        //     });
        // }

        // })
    </script>

@endsection
