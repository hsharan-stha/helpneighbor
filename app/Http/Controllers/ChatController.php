<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatEvent;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_name = $request->get('user_name');
        $users = User::orwhere('name', 'like', '%' . $user_name . '%')
            ->orwhere('email', 'like', '%' . $user_name . '%')
            ->orwhere('phone_number', 'like', '%' . $user_name . '%')
            ->with('logs')
            ->orderBy('log', 'desc')
            ->paginate(100);
        return view('chat/chat_list', compact('users', 'user_name'));
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
        $chat = new Chat();
        $chat->sender_id = Auth()->user()->id;
        $chat->receiver_id = (int)$request->get('receiver_id');
        $chat->chat = $request->get('chat');
        $chat->save();
        $chat->with("users");

        $logs = new Log();
        $logs->receiver_id = $chat->receiver_id;
        $logs->sender_id = $chat->sender_id;
        $logs->message_count = 1;
        $logs->save();

        $arr = ["chat" => $chat, 'sender' => $chat->users];
        event(new ChatEvent($arr));
        return $arr;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $anonymous = substr($id, -1) === "a" ? true : false;
        $id = rtrim($id, 'a');
        $chats = Chat::query();
        $chats = $chats->whereRaw('sender_id in (' . $id . ',' . Auth()->user()->id . ')')
            ->whereRaw('receiver_id in (' . Auth()->user()->id . ',' . $id . ')')
            ->orderby('id', 'asc');
        $currentPage = $request->get('page');
        if ($currentPage === null) {
            $currentPage = ceil($chats->count() / 100);
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }
        $chats = $chats->paginate(100);
        $receiver = User::find($id);
        $log = new Log();
        $log->where('receiver_id', Auth()->user()->id)->where('sender_id', $id)->delete();
        return view('chat/chat_area', compact('receiver', 'chats', 'currentPage', 'anonymous'));
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
}
