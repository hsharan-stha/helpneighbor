@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content">
                        <div class="section_title_container">
                            <form method="get" id="searchForm" action="{{route('search.index')}}">
                                <div class="section_title">
                                    {{--                                    <h6>--}}
                                    <div class="form-row">
                                        <div class="col-7">
                                            <input type="text" name="searchText" class="form-control"
                                                   id="searchText" value="{{$searchText}}"
                                                   placeholder="Search">
                                        </div>
                                        <div>
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="liked" {{$liked==="liked"?'checked':''}}
                                                   value="liked" name="liked">

                                            <label for="liked" id="interest"><i
                                                    class="fa fa-bookmark{{$liked==="liked"?"":"-o"}}"></i></label>
                                        </div>
                                    </div>
                                    {{--                                    </h6>--}}
                                </div>
                                <div class="row milestones_row mt-3">
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="g"
                                                   value="give" name="give" {{$give?'checked':''}}>
                                            <label class="custom-control-label" for="g">Give</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="n"
                                                   value="need" name="need" {{$need?'checked':''}}>
                                            <label class="custom-control-label" for="n">Need</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="h"
                                                   value="hope" name="hope" {{$hope?'checked':''}}>
                                            <label class="custom-control-label" for="h">Hope</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row milestones_row">
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="time"
                                                   value="time" name="time" {{$time?'checked':''}}>
                                            <label class="custom-control-label" for="time">Time</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="food"
                                                   value="food" name="food" {{$food?'checked':''}}>
                                            <label class="custom-control-label" for="food">Food</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="money"
                                                   value="money" name="money" {{$money?'checked':''}}>
                                            <label class="custom-control-label" for="money">Money</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 milestone_col" style="margin-bottom: 0px;">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="other"
                                                   value="other" name="other" {{$other?'checked':''}}>
                                            <label class="custom-control-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 p-0">
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
                                        <div class="col-xl-4 col-md-4 col-4 text-center p-lg-2 p-1">
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
                                        <div class="col-xl-12 col-md-12 col-12 mb-1 p-2" style="background: #6BA757">
                                            <a href="{{url('post_info/'.$post->id)}}" class="text_view">
                                                <p style="color:white">{{$post->title!=="hide" && !$post->users->private?$post->users->name.($post->title?' - '.$post->title:''.''):'Anonymous'}}
                                                    - {{substr($post->description,0,30)}}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            $("#searchText").change(() => {
                $("#searchForm").submit();
            });

            $("input[type='checkbox'],input[type='radio']").click(() => {
                $("#searchForm").submit();
            });

        </script>
@endsection
