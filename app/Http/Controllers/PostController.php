<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    Public function post(Request $request, $category)
    {
        $this->validator($request);
        $post = new Post;
        $post->description = $request->get('description');
        if ($request->get('time') !== null) {
            $post->item = $request->get('time') . ',';
        }
        if ($request->get('food') !== null) {
            $post->item .= $request->get('food') . ',';
        }
        if ($request->get('money') !== null) {
            $post->item .= $request->get('money') . ',';
        }
        if ($request->get('other') !== null) {
            $post->item .= $request->get('other');
        } else {
            $post->item = substr($post->item, 0, strlen($post->item) - 1);
        }
        $post->media = "";
        $post->category = $category;
        $post->user_id = $request->user()->id;

        if ($category == "give") {
            if ($request->get('anonymous') !== null) {
                $post->title = "hide";
            }
        } else {
            if ($request->get('someone') !== null) {
                $post->title = "for someone";
            }
        }
        //$query = @unserialize(file_get_contents('http://ip-api.com/php/'));
        $post->address = ($request->get('address') !== null ? $request->get('address') : "USA");
        $post->save();
        if ($request->file('gallery') !== null) {
            if (strpos($request->file('gallery')->getClientMimeType(), "video") !== false) {
                $videoName = 'v' . $post->id . '.' . $request->file('gallery')->getClientOriginalExtension();
                $post->media = $videoName;
            } else {
                $imageName = 'g' . $post->id . '.' . $request->file('gallery')->getClientOriginalExtension();
                $post->media = $imageName;
            }

        } else if ($request->file('photo') !== null) {
            $imageName = 'p' . $post->id . '.' . $request->file('photo')->getClientOriginalExtension();
            $post->media = $imageName;
        } else if ($request->file('video') !== null) {
            $videoName = 'v' . $post->id . '.' . $request->file('video')->getClientOriginalExtension();
            $post->media = $videoName;
        }
        $post->save();

        if ($request->file('gallery') !== null) {
            if (strpos($request->file('gallery')->getClientMimeType(), "video") !== false) {
                $request->file('gallery')->move(base_path() . '/public/images/posts_videos/', $videoName);
            } else {
                $request->file('gallery')->move(base_path() . '/public/images/posts_images/', $imageName);
            }
        } else if ($request->file('photo') !== null) {
            $request->file('photo')->move(base_path() . '/public/images/posts_images/', $imageName);
        } else if ($request->file('video') !== null) {
            $request->file('video')->move(base_path() . '/public/images/posts_videos/', $videoName);
        }
    }

    protected function validator(Request $request)
    {
        $item_required = "";
        if ($request->get('time') === null && ($request->get('food') === null) && ($request->get('money') === null) && ($request->get('other') === null)) {
            $item_required = 'required';
        }
        return $request->validate([
            'description' => ['required', 'string'],
            'item' => [$item_required]
        ]);
    }
}
