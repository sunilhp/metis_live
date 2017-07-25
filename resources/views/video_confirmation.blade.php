@extends('layouts.app')
@section('content')
    <section class="video_sessions">
        <div class="container">
            <div class="row myModal5">
            <h2>Please enter your confirmation code to start the video chat</h2>
            <div class="form-group">
                <label class="text-center">Enter it here</label>
                <input type="text" placeholder="Enter it here" id="ccode" name="ccode" class="inn12">
            </div>
            <div class="btns">
                <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                <a href="javascript:void(0);" class="submit_btn video-confirm">START</a>
            </div>
            <p><em>Tip: This code was sent to your e-mail.</em></p>
            <p>Still can’t find it?
                Click below and we’ll send it again.</p>
            <p><a class="video-resend-code" href="javascript:void(0);">Resend Code</a></p>
                <div class="video-msg"></div>
            </div>


        </div>

        <!-- OPEN FORM JS CODE -->
        <script type="text/javascript">
            var integrationWidgetID = "6be5ece5";
            var integrationSRC = "https://metisadvantage.ladesk.com/scripts/track.js";
            var integrationID = 'la_x2s6df8d';
            var myLaForm;
            function openForm() {

                var node = document.createElement("div");
                node.setAttribute("id", "modal_plugin");
                node.innerHTML =  '<div id="modal_blocker" style="position: fixed; top:0; left:0; width:100%;height:100%;opacity:0.6;z-index:999998;background:#000;"></div>'
                    + '<div id="modal_window" style="z-index:200; position:fixed; left:50%; top:50%; width:80%; max-width:1000px; height:90%; max-height:800px; z-index:999999; background:#fff; border: 0px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.5);">'
                    + '<style>iframe[id*="b_' + integrationWidgetID + '"], #modal_content_wrapper {width:100% !important; height:100% !important;} #modal_content_wrapper {z-index:2; position:relative;} #modal_loading { z-index:1; position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); } .dot { width: 10px; height: 10px; border: 2px solid rgba(0, 0, 0, 0.5); border-radius: 50%; float: left; margin: 0 5px; -webkit-transform: scale(0); transform: scale(0); -webkit-animation: fx 1000ms ease infinite 0ms; animation: fx 1000ms ease infinite 0ms; } .dot:nth-child(2) { -webkit-animation: fx 1000ms ease infinite 300ms; animation: fx 1000ms ease infinite 300ms; } .dot:nth-child(3) { -webkit-animation: fx 1000ms ease infinite 600ms; animation: fx 1000ms ease infinite 600ms; } @-webkit-keyframes fx { 50% { -webkit-transform: scale(1); transform: scale(1); opacity: 1; } 100% { opacity: 0; } } @keyframes fx { 50% { -webkit-transform: scale(1); transform: scale(1); opacity: 1; } 100% { opacity: 0; } } }</style>'
                    + '<div id="modal_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>'
                    + '<div id="modal_content_wrapper"><div id="modal_content"></div></div>'
                    + '<div id="modal_close" style="position:absolute; top:0; right:0; margin-top:-30px; margin-right:-30px; cursor:pointer; color: #fff; font-size: 25px; font-family:Arial; display: inline-block; padding:5px;">&#x2716;</div></div>';
                document.body.appendChild(node);
                var modalWrapper = document.getElementById("modal_blocker");
                var modalWindow  = document.getElementById("modal_window");
                modalWindow.style.marginTop = (-modalWindow.offsetHeight)/2 + "px";
                modalWindow.style.marginLeft = (-modalWindow.offsetWidth)/2 + "px";

                var closeModal = function(e)
                {
                    document.getElementById("modal_close").removeEventListener("onclick", closeModal);
                    document.getElementById("modal_blocker").removeEventListener("onclick", closeModal);
                    if (document.getElementById("la_x2s6df8d") != null) {
                        var scriptEl = document.getElementById(integrationID);
                        scriptEl.parentNode.removeChild(scriptEl);
                    }
                    if (document.getElementById("modal_plugin") != null) {
                        var modalEl = document.getElementById("modal_plugin");
                        modalEl.parentNode.removeChild(modalEl);
                    }
                    delete LiveAgent;
                    delete LiveAgentTracker;
                    delete LiveAgentTrackerXD;
                };

                document.getElementById("modal_close").addEventListener("click", closeModal, false);
                document.getElementById("modal_blocker").addEventListener("click", closeModal, false);

                var my_awesome_script = document.createElement('script');
                my_awesome_script.setAttribute('src',integrationSRC);
                my_awesome_script.setAttribute('id',integrationID);
                my_awesome_script.setAttribute('name','MetisCall');
                my_awesome_script.onload = function(){ myLaForm = LiveAgent.createButton(integrationWidgetID, document.getElementById('modal_content')); };
                document.body.appendChild(my_awesome_script);
                myLaForm.onClick();
            }
        </script>


        <!-- LINK FOR OPEN FORM -->
        <a href="#" onclick="openForm(); return false;">open form</a>

    </section>
    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="video-chat">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-content">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else New @endif Provider</h2>

                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="fname-error">{{ $errors->first('fname') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="First Name" id="fname" name="fname" value="@if(isset($current->first_name)){{$current->first_name}}@endif">
                        </div>
                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="lname-error">{{ $errors->first('lname') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Last Name" id="lname" name="lname" value="@if(isset($current->last_name)){{$current->last_name}}@endif">
                        </div>
                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="speciality-error">{{ $errors->first('speciality') }}</strong>
                        </span>
                            <select id="specialty" name="specialty">
                                <option>Specialty</option>
                                <option>Specialty</option>
                                <option>Specialty</option>
                                <option>Specialty</option>
                            </select>
                        </div>
                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="org-error">{{ $errors->first('org') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Provider Organization" id="org" name="org" value="@if(isset($current->provider_org)){{$current->provider_org}}@endif">
                        </div>
                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="address-error">{{ $errors->first('address') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Address" id="address" name="address" value="@if(isset($current->provider_address)){{$current->provider_address}}@endif">
                        </div>
                        <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="email-error">{{ $errors->first('pemail') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Email" id="pemail" name="pemail" value="@if(isset($current->provider_email)){{$current->provider_email}}@endif">
                        </div>
                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="pnumber-error">{{ $errors->first('pnumber') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Phone Number" id="pnumber" name="pnumber" value="@if(isset($current->provider_phone_no)){{$current->provider_phone_no}}@endif">
                        </div>
                        <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="mnumber-error">{{ $errors->first('mnumber') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Mobile Number" id="mnumber" name="mnumber" value="@if(isset($current->provider_mobile_no)){{$current->provider_mobile_no}}@endif">
                        </div>

                        <div class="btns">
                            <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                            @if(( Request::method() ==='GET' && Request::segment(2)>0))
                                <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                            @else
                                <a href="#" class="submit_btn" id="provider-submit">SAVE</a>
                            @endif

                        </div>

                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')
    <style>
    .myModal5 .btns {
    position: relative;
        bottom:0;
    }
    </style>
@endsection



