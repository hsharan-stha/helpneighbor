
@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content">
                        <div class="section_title_container">
                            <div class="section_title"><h6>Hope</h6>
                                <h6>Random Acts of Kindness?</h6>
                            </div>
                            <form method="POST" id="form" action="{{route('hope.store')}}"
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
                                        <div class="col-md-4  col-4 milestone_col d-lg-none">
                                            <div class="mb-3">
                                                <input type="file"
                                                       class="custom-control-input"
                                                       id="photo" name="photo"
                                                       accept="image/*" capture="environment">
                                                <div class="input-group-btn">
                                                    <label class="g-p-v" for="photo"><i
                                                            class="fa fa-photo mr-1"></i>Upload Photo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4  col-4 milestone_col d-lg-none">
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
                                                <button type="button" class="button button_1 intro_button trans_200"
                                                        data-toggle="modal"
                                                        data-target="#myModal">Post
                                                </button>

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

        <script type="text/javascript">
            document.getElementById("player").style.display = "none";
            document.getElementById("gallery-video").style.display = "none";
            $(function () {
                $('.main_nav').find('.active').removeClass('active');
                $('#hope').addClass('active');
            });
        </script>
@endsection
