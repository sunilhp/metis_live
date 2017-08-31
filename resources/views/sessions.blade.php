@extends('layouts.app')
@section('content')
    <section class="downHeader my_ses">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Start a New Session:</span>
                    <a href="{{ url('/advocacy/video-new') }}" class="ringButton"><img src="{{ url('/resources/assets/img/B97C92E3-5A54-45A9-9935-9D93EE456077@1x.png')}}"></a>
                    <span onClick="callButton.onClick();" class="ringButton"><img src="{{ url('/resources/assets/img/90AE5F81-BFC6-4386-A0CC-03232F78AF19@1x.png')}}"></span>
                    <span id="cht-btn"  onClick="chatButton.onClick();" class="ringButton"><img src="{{ url('/resources/assets/img/icon/chat_w.png')}}"></span>
                    <a href="{{ url('/advocacy/contact-form-new') }}" class="ringButton"><img src="{{ url('/resources/assets/img/contact_icon.png')}}"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="my_sessions">
        <div class="container">
            <div class="row">

                <ul class="top_tab3">
                    <li class="active"><a href="#scheduled" data-toggle="tab">SCHEDULED</a></li>
                    <li><a href="#past" data-toggle="tab">PAST</a></li>
                </ul>
                <div class="tab-content clearfix">
                        <div class="fade in active" id="scheduled">
                        <ul class="visit_list">
                            @forelse($sc_records as $record)
                            <li class="open_detail">
                                <span class="span1">
                                <span class="span1a">{{date('d', strtotime($record->request_date))}}</span>
                                <span class="span1b">{{date('M', strtotime($record->request_date))}}</span>
                                </span>
                                <span class="span2">
                                    <span class="span2a">{{date('l', strtotime($record->request_date))}}, {{date('h:i A', strtotime($record->request_time))}}</span>
                                    <span class="span2b"></span>
                                    <span class="span2b">{{$record->help}}</span>
                                </span>
                                <span class="span4">
                                    <a href="#" class="span4b">@if($record->video_chat)<img src="{{ url('/resources/assets/img/C2FF3A2C-ACF3-4EE6-B5AD-A7586100AFEE@1x.png')}}">@elseif($record->video_call)<img src="{{ url('/resources/assets/img/57D4C0E5-3605-4BD6-92CB-0652320E4D99@1x.png')}}"> @elseif($record->chat_message) Chat @endif </a>
                                </span>
                                <span class="span3">
                                    <a href="#" class="span3b"></a>
                                </span>
                            </li>
                            @empty
                            <li>
                                No scheduled session.
                            </li>
                            @endforelse
                        </ul>
                        </div>
                        <div class="fade" id="past">
                            <ul class="visit_list">
                                @forelse($pt_records as $record)
                                <li class="open_detail">
                                    <span class="span1">
                                    <span class="span1a">{{date('d', strtotime($record->request_date))}}</span>
                                    <span class="span1b">{{date('M', strtotime($record->request_date))}}</span>
                                    </span>
                                    <span class="span2">
                                        <span class="span2a">{{date('l', strtotime($record->request_date))}}, {{date('h:i A', strtotime($record->request_time))}}</span>
                                        <span class="span2b"></span>
                                        <span class="span2b">{{$record->help}}</span>
                                    </span>
                                    <span class="span4">
                                        <a href="#" class="span4b">@if($record->video_chat)<img src="{{ url('/resources/assets/img/C2FF3A2C-ACF3-4EE6-B5AD-A7586100AFEE@1x.png')}}">@elseif($record->video_call)<img src="{{ url('/resources/assets/img/57D4C0E5-3605-4BD6-92CB-0652320E4D99@1x.png')}}"> @elseif($record->chat_message) Chat @endif </a>
                                    </span>
                                    <span class="span3">
                                        <a href="#" class="span3b"></a>
                                    </span>
                                </li>
                                @empty
                                <li>
                                    No scheduled session.
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')

@endsection
@section('js')
    <style>
        #scheduled.fade,#past.fade{
            display: none;
        }
        #scheduled.active, #past.active{
            display:block;
        }
    </style>
    <script type="text/javascript">
        var chatButton;
        (function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
            'https://metisadvantage.ladesk.com/scripts/track.js',
            function(e){ chatButton = LiveAgent.createButton('30d19802', e); });
    </script>
    <script type="text/javascript">
        var callButton;
        (function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
            'https://metisadvantage.ladesk.com/scripts/track.js',
            function(e){ callButton = LiveAgent.createButton('6be5ece5', e); });
    </script>
@endsection
