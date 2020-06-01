<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GiveController extends PostController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('give');
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
//        $this->validator($request);
//        $post = new Post;
//        $post->title = "post give";
//        $post->description = $request->get('description');
//        if ($request->get('time') !== null) {
//            $post->item = $request->get('time') . ',';
//        }
//        if ($request->get('food') !== null) {
//            $post->item .= $request->get('food') . ',';
//        }
//        if ($request->get('money') !== null) {
//            $post->item .= $request->get('money') . ',';
//        }
//        if ($request->get('other') !== null) {
//            $post->item .= $request->get('other');
//        } else {
//            $post->item = substr($post->item, 0, strlen($post->item) - 1);
//        }
//        $post->media = "";
//        $post->category = "give";
//        $post->user_id = $request->get('other') !== null ? $request->user()->id : 0;
//        $query = @unserialize(file_get_contents('http://ip-api.com/php/'));
//        $post->address = $query['country'];
//        $post->save();
//        if ($request->file('gallery') !== null) {
//            $imageName = 'g' . $post->id . '.' . $request->file('gallery')->getClientOriginalExtension();
//            $post->media = $imageName;
//        } else if ($request->file('photo') !== null) {
//            $imageName = 'p' . $post->id . '.' . $request->file('photo')->getClientOriginalExtension();
//            $post->media = $imageName;
//        } else if ($request->file('video') !== null) {
//            $videoName = 'v' . $post->id . '.' . $request->file('video')->getClientOriginalExtension();
//            $post->media = $videoName;
//        }
//        $post->save();
//
//        if ($request->file('gallery') !== null) {
//            $request->file('gallery')->move(base_path() . '/public/images/posts_images/', $imageName);
//        } else if ($request->file('photo') !== null) {
//            $request->file('photo')->move(base_path() . '/public/images/posts_images/', $imageName);
//        }
//        if ($request->file('video') !== null) {
//            $request->file('video')->move(base_path() . '/public/images/posts_videos/', $videoName);
//        }

        $this->post($request,"give");

        return redirect("give");
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
        //
    }

//    protected function validator(Request $request)
//    {
//        $item_required = "";
//        $media_required = "";
//        if ($request->get('time') === null && ($request->get('food') === null) && ($request->get('money') === null) && ($request->get('other') === null)) {
//            $item_required = 'required';
//        }
//        return $request->validate([
//            'description' => ['required', 'string'],
//            'item' => [$item_required]
//        ]);
//    }
}
