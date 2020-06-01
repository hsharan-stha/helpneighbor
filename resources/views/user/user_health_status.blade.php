@extends('user.user_shared')

@section('user_content')
    <form method="POST" id="userUpdateForm" action="{{route('user.update',$user->id)}}">
        @method('PATCH')
        @csrf
        <div class="col-md-12 col-12 milestone_col" style="margin-bottom: 0px;">
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox"
                       class="custom-control-input"
                       id="h_c_w" {{$user->health_care_worker?'checked':''}}
                       value="true" name="h_c_w">

                <label class="custom-control-label" for="h_c_w">I'm HealthCare Worker</label>
            </div>
        </div>

        <div class="col-md-12  col-12 milestone_col" style="margin-bottom: 0px;">
            <label>Health Status</label>
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       id="p_n_t_s" {{strpos($user->health_status,'1') !== false?'checked':''}}
                       value="true" name="p_n_t_s">
                <label class="custom-control-label" for="p_n_t_s">Prefer not to say</label>
            </div>
        </div>
        <div class="col-md-12  col-12 milestone_col" style="margin-bottom: 0px;">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       id="c_w_c_19" {{strpos($user->health_status,'2') !== false?'checked':''}}
                       value="true" name="c_w_c_19">
                <label class="custom-control-label" for="c_w_c_19">Confirmed NEGATIVE Covid-19</label>
            </div>
        </div>
        <div class="col-md-12  col-12 milestone_col" style="margin-bottom: 0px;">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       id="l_14_d" {{strpos($user->health_status,'3') !== false?'checked':''}}
                       value="true" name="l_14_d">
                <label class="custom-control-label" for="l_14_d">Confirmed POSITIVE Covid-19</label>
            </div>
        </div>
        <div class="col-md-12  col-12 milestone_col" style="margin-bottom: 0px;">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       id="f_f_14" {{strpos($user->health_status,'4') !== false?'checked':''}}
                       value="true" name="f_f_14">
                <label class="custom-control-label" for="f_f_14">Confirmed RECOVERED Covid-19</label>
            </div>
        </div>
        <div class="col-md-12 col-12 milestone_col" style="margin-bottom: 0px;">
            <label>Privacy</label>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       id="private" {{$user->private?'checked':''}}
                       value="true" name="private">
                <label class="custom-control-label" for="private">Private</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 col-12 mb-2">
                <input type="text" name="email" class="form-control"
                       id="email" value="{{$user->email}}" readonly
                       placeholder="email">
            </div>
            <div class="col-md-6 col-12 mb-2">
                <input type="text" name="postcode" class="form-control" maxlength="12"
                       id="postcode" value="{{$user->postcode}}" required
                       placeholder="post code">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 col-12 mb-2">
                <input type="text" name="phone_number" class="form-control" maxlength="24"
                       id="phone_number" value="{{$user->phone_number}}"
                       placeholder="phone number">
            </div>
            <div class="col-md-6 col-12 mb-2">
                <input type="text" class="form-control" readonly
                       id="country" value="{{$user->country}}"
                       placeholder="">
            </div>
            <div class="col-md-2  col-6 mb-2">
                <button type="submit" class="button button_1 intro_button trans_200">
                    Update
                </button>
            </div>
        </div>


    </form>
@endsection
