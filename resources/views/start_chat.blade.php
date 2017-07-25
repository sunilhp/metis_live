@extends('layouts.app')
@section('content')
<section class="chat_messenger">
        <div class="container">
            <div class="chat-messages">
                <ul>
                    <li>
                        <figure></figure>
                        <div class="details">
                            <h3>Janice</h3>
                            <div class="d_text">Hi Emma, what can I help you with today?</div>
                            <div class="date">12:10 PM</div>
                        </div>
                    </li>
                    <li>
                        <figure></figure>
                        <div class="details">
                            <h3>Janice</h3>
                            <div class="d_text">Hi Emma, what can I help you with today?</div>
                            <div class="date">12:10 PM</div>
                        </div>
                    </li>
                    <li>
                        <figure></figure>
                        <div class="details">
                            <h3>Janice</h3>
                            <div class="d_text">Hi Emma, what can I help you with today?</div>
                            <div class="date">12:10 PM</div>
                        </div>
                    </li>
                </ul>

            </div>
            <div class="clearfix"></div>
            <a href="#" class="attach_icon"></a>
            <div class="clearfix"></div>
            <textarea class="reply_box" placeholder="Reply…"></textarea>
        </div>
    </section>
    <?php /*
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
 */ ?>
    @include('layouts.footer')
@endsection
<script type="text/javascript">
    (function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
        'https://metisadvantage.ladesk.com/scripts/track.js',
        function(e){ LiveAgent.createButton('30d19802', e); });
</script>

