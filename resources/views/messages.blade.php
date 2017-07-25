@extends('layouts.app')

@section('content')
    <div class="msg_inbox">
        <div class="container">

            <div class="form-group">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <input name="q" id="q" type="text" placeholder="Search messages" class="inn1" value="{{$search}}">
                </form>
            </div>
            <div class="row">
                <div class="messages">
                    <ul>
                        @forelse($records as $record)
                        <li @if(!$record->message_status) class="online" @endif>
                            <figure></figure>
                            <div class="details">
                                <div class="time">{{date('l', strtotime($record->created_at))}}, {{date('h:i A', strtotime($record->created_at))}}</div>
                                <a href="{{url('advocacy/messages/'.$record->id)}}" class="more_arrow"></a>
                                <span class="span1">@if(isset($record->created_at)){{date('Y-m-d', strtotime($record->created_at))}}@endif</span>
                                <span class="span2">{{$record->doctor_name}}</span>
                                <span class="span3">{{$record->message_subject}}</span>
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



