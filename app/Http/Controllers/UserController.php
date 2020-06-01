<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $view = $request->get('view');
        $view = $view !== null ? $view : 1;
        $searchText = $request->get('searchText');
        $posts = Post::query();
        $posts = $posts->where('description', 'like', '%' . $searchText . '%');
        $posts = $posts->where('user_id', $request->user()->id);
        $posts = $posts->with("users");
        $posts = $posts->orderBy('id', 'desc');
        $posts = $posts->paginate($view == 1 ? 51 : 100);
        $posts = $posts->appends(['searchText' => $searchText, 'view' => $view]);
        $user = $this->userDetail($request);

        $redirectToUrl = "health_status";


        return view("user/user_info", compact('posts', 'searchText', 'user', 'redirectToUrl', 'view'));
    }

    public function healthStatus(Request $request)
    {
        $redirectToUrl = "picture";
        $user = $this->userDetail($request);
        return view("user/user_health_status", compact('user', 'redirectToUrl'));
    }

    public function pictureUpdate(Request $request)
    {
        $redirectToUrl = "";
        $user = $this->userDetail($request);
        return view("user/user_picture", compact('user', 'redirectToUrl'));
    }

    public function userDetail(Request $request)
    {
        return User::where('id', $request->user()->id)->get()[0];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->get('pic_section') === null) {

            $user->health_care_worker = $request->get('h_c_w') !== null ? 1 : 0;
            $user->private = $request->get('private') !== null ? 1 : 0;
            $user->postcode = $request->get('postcode') !== null ? $request->get('postcode') : 0;
            $user->health_status = '';
            if ($request->get('p_n_t_s') !== null) {
                $user->health_status = '1,';
            }
            if ($request->get('c_w_c_19') !== null) {
                $user->health_status .= '2,';
            }
            if ($request->get('l_14_d') !== null) {
                $user->health_status .= '3,';
            }
            if ($request->get('f_f_14') !== null) {
                $user->health_status .= '4';
            } else {
                $user->health_status = substr($user->health_status, 0, strlen($user->health_status) - 1);
            }
            $user->phone_number = $request->get('phone_number');
        } else {
            if ($request->file('gallery') !== null) {
                $imageName = 'u' . $user->id . '.' . $request->file('gallery')->getClientOriginalExtension();
                $user->image = $imageName;
            } else if ($request->file('photo') !== null) {
                $imageName = 'u' . $user->id . '.' . $request->file('photo')->getClientOriginalExtension();
                $user->image = $imageName;
            }

            $user->about_me = $request->get('about_me');
        }
        $user->save();
        if ($request->file('gallery') !== null) {
            $request->file('gallery')->move(base_path() . '/public/images/users_images/', $imageName);
        } else if ($request->file('photo') !== null) {
            $request->file('photo')->move(base_path() . '/public/images/users_images/', $imageName);
        }

        return redirect("person/health_status");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
