@extends('layouts.app')


@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content">
                        <div class="section_title_container">
                            <div class="section_title"><h6>Give</h6>
                                <h6>What can you offer?</h6>
                            </div>
                            <form method="POST" id="form" action="{{route('give.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="milestones">
                                    <div class="row milestones_row">
                                        <div class="col-md-2 col-4 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('item') is-invalid @enderror"
                                                       id="time"
                                                       value="time" name="time">
                                                <label class="custom-control-label" for="time">Time</label>
                                            </div>
                                        </div>


                                        <div class="col-md-2 col-4 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('item') is-invalid @enderror"
                                                       id="food"
                                                       value="food" name="food">
                                                <label class="custom-control-label" for="food">Food</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-4 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('item') is-invalid @enderror"
                                                       id="money"
                                                       value="money" name="money">
                                                <label class="custom-control-label" for="money">Money</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-4 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('item') is-invalid @enderror"
                                                       id="other"
                                                       value="other" name="other">
                                                <label class="custom-control-label" for="other">Other</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12  col-12 milestone_col">
                                            <div class="form-group shadow-textarea">
                                            <textarea style="resize: none;" maxlength="190"
                                                      class="form-control  z-depth-1 @error('description') is-invalid @enderror"
                                                      name="description"
                                                      id="description"
                                                      rows="4" placeholder="Write something here..."></textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                     </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4 milestone_col p-0">
                                            <img src="" id="gallery-img" width="100px"/>
                                            <video width="80px" id="gallery-video" controls></video>
                                        </div>
                                        <div class="col-md-4  col-4 milestone_col p-0">
                                            <img src="" id="photo-img" width="100px"/>
                                        </div>
                                        <div class="col-md-4  col-4 milestone_col p-0">
                                            <video width="80px" id="player" controls></video>
                                        </div>
                                        <div class="col-md-4 col-lg-12 col-4 milestone_col">
                                            <div class="mb-3">
                                                <input type="file"
                                                       class="custom-control-input"
                                                       id="gallery"
                                                       name="gallery" accept="image/*,video/*">
                                                <label for="gallery" class="g-p-v"><i
                                                        class="fa fa-file-picture-o mr-1"></i>Upload Gallery</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4 milestone_col d-lg-none">
                                            <div class="mb-3">
                                                <input type="file"
                                                       class="custom-control-input"
                                                       id="photo" name="photo"
                                                       accept="image/*" capture="environment">
                                                <div class="input-group-btn">
                                                    <label class="g-p-v" for="photo"><i class="fa fa-photo mr-1"></i>Upload Photo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4 milestone_col d-lg-none">
                                            <div class="mb-3">
                                                <input type="file"
                                                       class="custom-control-input"
                                                       id="video" name="video"
                                                       accept="video/*"
                                                       capture="environment">
                                                <div class="input-group-btn">
                                                    <label for="video" class="g-p-v"><i
                                                            class="fa fa-video-camera mr-1"></i>Upload Video</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3  col-6 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                {{--                                                <button type="submit" class="button button_1 intro_button trans_200">--}}
                                                {{--                                                    Post--}}
                                                {{--                                                </button>--}}
                                                <button type="button" class="button button_1 intro_button trans_200"
                                                        data-toggle="modal"
                                                        data-target="#myModal">Post
                                                </button>

                                            </div>
                                        </div>
                                        <div class="col-md-4  col-4 milestone_col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="anonymous"
                                                       name="anonymous">
                                                <label class="custom-control-label" for="anonymous">Anonymous</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <video style="display: hidden" id="video" width="640" height="480" autoplay></video>--}}
        {{--        <a id="snap">Snap Photo</a>--}}
        {{--        <canvas id="canvas" width="640" height="480"></canvas>--}}

        <script type="text/javascript">
            document.getElementById("player").style.display = "none";
            document.getElementById("gallery-video").style.display = "none";
            $(function () {
                $('.main_nav').find('.active').removeClass('active');
                $('#give').addClass('active');
            });

            //
            // // Grab elements, create settings, etc.
            // var video = document.getElementById("video");
            //
            // // Get access to the camera!
            // if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            //     navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            //         console.log(stream);
            //         video.srcObject = stream;
            //         video.play();
            //     });
            // }
            //
            // // Elements for taking the snapshot
            // var canvas = document.getElementById('canvas');
            // var context = canvas.getContext('2d');
            // var video = document.getElementById('video');
            //
            // // Trigger photo take
            // document.getElementById("snap").addEventListener("click", function() {
            //     // context.drawImage(video, 0, 0, 640, 480);
            //     let img = new Image();
            //     context.drawImage(video,0,0);
            // });
            //
        </script>
@endsection
