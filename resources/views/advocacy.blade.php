@extends('layouts.app')
@section('content')
    <section class="video_sessions">
        <div class="container">
            <a href="{{url('/advocacy/sessions') }}">
            <figure><img src="{{ url('/resources/assets/img/04847E23-F37B-4032-8675-D3ED3F22B7AB@1x.png')}}"></figure>
            <h2>SESSIONS</h2>
            </a>
            <a href="{{url('/advocacy/messages') }}">
            <figure><img src="{{ url('/resources/assets/img/message.png')}}"></figure>
            <h2>MESSAGES</h2>
            </a>
            <a href="{{url('/advocacy/claims-bills') }}">
            <figure><img src="{{ url('/resources/assets/img/claim.png')}}"></figure>
            <h2>CLAIMS/BILLS</h2>
            </a>
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

