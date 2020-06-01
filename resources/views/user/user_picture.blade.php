@extends('user.user_shared')

@section('user_content')
    <form method="POST" id="userUpdateForm" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="pic_section" value="1"/>
        <div class="milestones">
            <div class="row milestones_row">


                <div class="col-md-4 col-4 milestone_col">
                    <div class="mb-3">
                        <input type="file"
                               class="custom-control-input"
                               id="gallery"
                               name="gallery" accept="image/*">
                        <label for="gallery" class="g-p-v"><i
                                class="fa fa-file-picture-o mr-1"></i>Upload Gallery</label>
                    </div>
                </div>
                <div class="col-md-4 col-4 milestone_col p-0 profile-image">

                    <img src="{{url('assets/images/person.png')}}"
                         id="gallery-img"
                         width="100%"/>
                    <img src="{{url('assets/images/person.png')}}" id="photo-img"
                         width="100%"/>
                    @if($user->image!="" && $user->image!=null)
                        <img src="{{url('images/users_images/'.$user->image)}}"
                             id="user-img"
                             width="100%"/>
                    @endif
                </div>
                <div class="col-md-4 col-4 milestone_col d-lg-none">
                    <div class="mb-3">
                        <input type="file"
                               class="custom-control-input"
                               id="photo" name="photo"
                               accept="image/*" capture>
                        <div class="input-group-btn">
                            <label class="g-p-v" for="photo"><i
                                    class="fa fa-photo mr-1"></i>Upload Photo</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3 col-12 milestone_col">
                    <div class="form-group shadow-textarea">
                                            <textarea style="resize: none;" maxlength="190"
                                                      class="form-control  z-depth-1"
                                                      name="about_me"
                                                      id="about_me"
                                                      rows="2"
                                                      placeholder="Define about me...">{{$user->about_me}}</textarea>
                    </div>
                </div>
                <div class="col-md-2  col-6 mb-3">
                    <button type="submit" class="button button_1 intro_button trans_200">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script>
        let image = '{{$user->image}}';
        if (image !== "") {
            document.getElementById("gallery-img").style.display = "none";
            document.getElementById("photo-img").style.display = "none";
        } else {
            document.getElementById("gallery-img").style.display = "none";

        }

        $(":input[type=file]").change(() => {
            if (document.getElementById("user-img") !== null)
                document.getElementById("user-img").style.display = "none";
        })
    </script>
@endsection
