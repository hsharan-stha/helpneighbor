<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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
        $give = $request->get('give');
        $need = $request->get('need');
        $hope = $request->get('hope');
        $liked = $request->get('liked');

        $time = $request->get('time');
        $food = $request->get('food');
        $money = $request->get('money');
        $other = $request->get('other');
        $posts = Post::query();
        if ($give !== null || $need !== null || $hope !== null) {

            $posts = $posts->whereRaw("category in ('$give','$need','$hope')");
        }
        $extraParams = "";
        if ($time !== null || $food !== null || $money !== null || $other !== null) {
            if ($time !== null) {
                $extraParams = $time . ',';
            }
            if ($food !== null) {
                $extraParams .= $food . ',';
            }
            if ($money !== null) {
                $extraParams .= $money . ',';
            }
            if ($other !== null) {
                $extraParams .= $other;
            } else {
                $extraParams = substr($extraParams, 0, strlen($extraParams) - 1);
            }
            $posts = $posts->where('item', 'like', '%' . $extraParams . '%');
        }
        $posts = $posts->with(["users", "likes"]);
        if ($liked !== null) {
            $posts = $posts->whereHas('likes', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }
        if (filter_var($searchText, FILTER_VALIDATE_EMAIL)) {
            $posts = $posts->whereHas('users', function ($query) use ($searchText) {
                $query->where('email', 'like', '%' . $searchText . '%');
            });
        } elseif ($searchText !== null) {
            $posts = $posts->orwhere('description', 'like', '%' . $searchText . '%')
                ->orwhereHas('users', function ($query) use ($searchText) {
                    $query->where('name', 'like', '%' . $searchText . '%')
                        ->orwhere('postcode', 'like', '%' . $searchText . '%');
                });
        }
        $posts = $posts->whereHas('users', function ($query) {
            $query->whereRaw("deleted is null");
        });
        $posts = $posts->orderBy('id', 'desc');
        $posts = $posts->paginate($view == 1 ? 51 : 100);
        $posts = $posts->appends(['give' => $give,
            'need' => $need,
            'hope' => $hope,
            'time' => $time,
            'food' => $food,
            'money' => $money,
            'other' => $other,
            'view' => $view,
            'liked' => $liked
        ]);
        return view('search', compact('posts',
            'give',
            'need',
            'hope',
            'searchText',
            'time',
            'food',
            'money',
            'other',
            'view',
            'liked'
        ));
    }

    public function postInformation(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        $like = Like::where('user_id', Auth::id())->where('post_id', $request->post_id)->first();
        $like = $like !== null ? $like->count() : 0;
        $role_name=Auth::user()->roles->first()->name;
        //$month_day = DB::select( DB::raw("SELECT MONTHNAME('$post->created_at'),DAYNAME('$post->created_at')"));
        return view("post/post_info", compact('post', 'like','role_name'));
    }

    public function postLike(Request $request)
    {
        Like::where('user_id', Auth::id())->where('post_id', $request->post_id)->delete();
        $like = new Like();
        $like->user_id = Auth::id();
        $like->post_id = $request->post_id;
        return $like->save();
    }

    Public function postDislike(Request $request)
    {
        return Like::where('user_id', Auth::id())->where('post_id', $request->post_id)->delete();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $image_path = 'images/posts_images/' . $post->media;
        $video_path = 'images/posts_videos/' . $post->media;
        $post->delete();

        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        if (file_exists($video_path)) {
            @unlink($video_path);
        }
        return redirect('user?view=0');
    }
}
