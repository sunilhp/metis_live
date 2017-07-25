@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" id="message-reply"><img src="{{ url('/resources/assets/img/55BDEAAB-EAC6-49FF-BE5C-62C9CA932529@1x.png')}}"> Relpy</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>
    <div class="msg_inbox show_msg reply_msg">
        <div class="container">

            <div class="row">
                <div class="messages">
                    <ul>
                        @forelse($records as $record)

                            <li @if($record->message_by == Auth::user()->id ) class="fade_it" @endif>
                                @if($record->message_by != Auth::user()->id )
                                <figure></figure>
                                @endif
                                <div class="details">
                                    <div class="time">{{date('h:i A', strtotime($record->created_at))}}</div>
                                    <span class="span1">@if(isset($record->created_at)){{date('Y-m-d', strtotime($record->created_at))}}@endif</span>
                                    @if($record->message_by != Auth::user()->id )
                                        <span class="span2">{{$record->message->doctor_name}}</span>
                                    @endif
                                    <span class="span3">{{$record->message->message_subject}}</span>
                                    <span class="span4">{{$record->message_detail}}</span>
                                    @if($record->message_by != Auth::user()->id )
                                        <textarea class="relpy_msgbox" placeholder="Reply..." cols="59" id="msg-content"></textarea>
                                    @endif
                                </div>

                            </li>
                        @empty
                            <li class="empty_provider">
                                No messages in your inbox.
                            </li>
                        @endforelse



                    </ul>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

@endsection
@section('js')
    <script type="text/javascript">
    $('#message-reply').click(function (e) {
    e.preventDefault();

    var msgcontent = $('#msg-content').val();



        $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{url('advocacy/messages')}}/{{Request::route('id')}}',
        dataType: 'json',
        data: { msgcontent: msgcontent},
            success: function(response ) {

                if(response.success){

                window.location.href="{{url('advocacy/messages')}}";
                //alert(Object.keys(response.errors).length);

                }





            }
        });
    });
    </script>
    <style>
        .msg_inbox.reply_msg .messages ul li .relpy_msgbox {

            height: 60px;
        }
    </style>
@endsection
