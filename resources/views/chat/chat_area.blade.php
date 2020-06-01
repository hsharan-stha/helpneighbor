@extends('layouts.app')

@section('content')
    <div class="intro" id="chat-message">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content post_information">
                        <div class="section_title_container">
                            <div class="section_title">
                                <h6 class="text-uppercase">Chat Area</h6>
                                <h6></h6>
                            </div>
                            <div class="service text-center col-12">
                                <div class="service">
                                    @foreach($chats as $chat)
                                        @if($chat->sender_id===auth()->user()->id)
                                            <div class="message-orange">
                                                <p class="message-content">{{$chat->chat}}</p>
                                                <div class="message-timestamp-right">{{$chat->created_at}}</div>
                                            </div>
                                        @else
                                            <div class="message-blue">
                                                <p class="message-content">{{$chat->chat}}</p>
                                                <div class="message-timestamp-left">{{$chat->created_at}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div
                                        class="form-row col-12 col-lg-6 {{($chats->lastPage()===(int)$currentPage || $chats->count()===0)?'chat-text-box-pagination':'chat-text-box'}}">
                                        {!! $chats->onEachSide(1)->render() !!}
                                    </div>
                                    <div class="col-md-12 col-12 p-0">
                                        <br><br><br><br><br>
                                    </div>
                                    @if($chats->lastPage()===(int)$currentPage || $chats->count()===0)
                                        <div class="form-row chat-text-box">
                                            @csrf
                                            <input type="text" name="chat" class="form-control"
                                                   id="chat"
                                                   placeholder="Message to {{!$receiver->private && !$anonymous?$receiver->name:"Anonymous"}}">
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let objDiv = document.getElementById("chat-message");
            objDiv.scrollTop = objDiv.scrollHeight;
            let chat_text = $("#chat");
            let token = $('input[name="_token"]').val();
            chat_text.change(() => {
                let receiver_id = "{{$receiver->id}}";
                $.ajax({
                    url: "{{route('chat.store')}}",
                    method: "POST",
                    data: {_token: token, chat: chat_text.val(), receiver_id: parseInt(receiver_id)},
                    success: function (data) {
                        chat_text.val("");
                        let res = data.chat;
                        console.log(data);
                        $(".chat-text-box").prev().prev().before(" <div class=\"message-orange\">\n" +
                            "                                                <p class=\"message-content\">" + res.chat + "</p>\n" +
                            "                                                <div class=\"message-timestamp-right\">" + res.created_at.replace("T", " ").split(".")[0] + "</div>\n" +
                            "                                            </div>");
                        objDiv.scrollTop = objDiv.scrollHeight;
                        // chat_text.parent().parent().append("<p>dfsdfsdfsdf</p>");
                        // console.log(res);
                    }
                })

            });
        </script>
@endsection
