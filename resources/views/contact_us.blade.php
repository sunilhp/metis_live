@extends('layouts.app')

@section('content')



    <section class="terms_page">
        <div class="container">
            <div class="row"><div class="con_map" id="map-canvas"></div></div>
            <div class="contact_page_de">
                <ul>
                    <li><img src="{{ url('/resources/assets/img/E555D4F3-E845-4D9D-8234-55E259236571@1x.png')}}">West Hills, Los Angeles, CA</li>
                    <li><img src="{{ url('/resources/assets/img/3F97BE5B-CBE3-47F2-BAD3-A870C97F68EF@1x.png')}}"><a href="#">(888) 638-4763</a></li>
                    <li><img src="{{ url('/resources/assets/img/16CDBE60-BB73-4689-928D-114CE7219177@1x.png')}}"><a href="#" href="#" data-toggle="modal" data-target="#contact-message">Send us a message</a></li>
                </ul>


                <p class="text-center">www.metisadvantage.com</p>
                <p class="text-center">Follow us on Social Media</p>

                <div class="media_icons">
                    <a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a>
                </div>

            </div>



        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="contact-message">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <h2>Email Us</h2>

                        <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="name-error">{{ $errors->first('name') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Name" id="name" name="name" value="">
                        </div>

                        <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="email-error">{{ $errors->first('email') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Email" id="email" name="email" value="">
                        </div>

                        <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="subject-error">{{ $errors->first('subject') }}</strong>
                        </span>
                            <input type="text" class="inn1" placeholder="Subject" id="subject" name="subject" value="">
                        </div>
                        <div class="form-group">
                        <span class="help-block">
                            <strong id="comments-error">{{ $errors->first('comments') }}</strong>
                        </span>
                            <textarea class="text_in1" placeholder="Please type your comments here.." id="comments" name="comments"></textarea>
                        </div>
                        <div class="btns">
                            <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                            <a href="#" class="submit_btn" id="contact-submit">SEND</a>
                        </div>

                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')
    <style>
        #contact-message.myModal5 .modal-body {
            min-height: 500px;
        }
    </style>
@endsection