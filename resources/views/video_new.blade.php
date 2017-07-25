@extends('layouts.app')
@section('content')
    <section class="video_sessions">
        <div class="container">

            <a href="{{ url('/advocacy/video-confirmation') }}">
                <figure><img src="{{ url('/resources/assets/img/8E47C588-FB41-486F-A17D-73142AC34B52@1x.png')}}"></figure>
            <h2>START SCHEDULED VIDEO CHAT</h2>
            </a>

            <a href="#" data-toggle="modal" data-target="#myModal3"><figure><img src="{{ url('/resources/assets/img/0932F45C-5F48-42C7-9CB1-AF908DC07BF8@1x.png')}}"></figure>
                <h2>REQUEST VIDEO CHAT</h2></a>


        </div>
    </section>
    @include('layouts.footer')

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h2>Request a Video Session</h2>

                    <h3>I need help with:</h3>
                    <select id="help">
                        <option>Select a subject</option>
                        <option>Select a subject</option>
                        <option>Select a subject</option>
                        <option>Select a subject</option>
                    </select>
                    <h3>I would like to chat via:</h3>
                    <div class="check_upper">
                        <div class="checkbox33">
                            <p>
                                <input type="checkbox" id="test1" value="1" />
                                <label for="test1">Video Chat</label>
                            </p>
                        </div>
                        <div class="checkbox33">
                            <p>
                                <input type="checkbox" id="test2" value="1" />
                                <label for="test2">Video Call</label>
                            </p>
                        </div>
                        <div class="checkbox33">
                            <p>
                                <input type="checkbox" id="test3" value="1" />
                                <label for="test3">Secure Message</label>
                            </p>
                        </div>
                    </div>

                    <h3>Day I'd like to chat:</h3>
                    <div class="check_upper">
                        <div class="col-md-12">
                            <div class="icon1"><img src="{{ url('/resources/assets/img/485EFE4D-BEDB-4133-809F-85BD25BBD0B5@1x.png')}}"></div>
                            <div class="sel_upper">
                                <input id="sessiondate" class="input-mini timemask timepicker" type="text" name="sessiondate" placeholder="Date" value=""><span class="add-on clearpicker"><i class="icon-time"></i></span>
                            </div>

                        </div>


                    </div>
                    <h3>Time I'm available :</h3>
                    <div class="check_upper">
                        <div class="col-md-12">
                        <div class="icon1"><img src="{{ url('/resources/assets/img/12063EC7-E0CE-4847-B3C2-845AD51F47A7@1x.png')}}"></div>
                        <div class="sel_upper">
                            <input id="sessiontime" class="input-mini timemask timepicker" type="text" name="sessiontime" placeholder="Time" value=""><span class="add-on clearpicker"><i class="icon-time"></i></span>
                        </div>
                        </div>
                    </div>
                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        <a href="#" class="submit_btn" id="video-request-submit">SUBMIT</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $("#sessiondate").datetimepicker({
            minView: 2,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $("#sessiontime").datetimepicker({
            minView: 4,
            startView:0,
            showMeridian: true,
            autoclose: true,
            format: 'hh:ii'
        });
    </script>
    <style>
        .icon1 {
            width: 30px;
            height: 30px;
            float: left;
            padding-top: 5px;
        }
        .sel_upper {
            width: calc(100% - 30px);
            float: left;
        }
    </style>
@endsection