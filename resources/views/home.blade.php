@extends('layouts.app')

@section('content')
<section class="sec1">
        <div class="container">
            <h2>Welcome</h2>
            <div class="clearfix"></div>
            <a href="{{url('/visits') }}" class="sec1In">
                <div class="iconCover">
                    <img src="{{ url('/resources/assets/img/icon1.png') }}" alt="icon"/>
                </div>
                <div class="clearfix"></div>
                <span>VISITS</span>
            </a>
            <a href="{{url('/documents') }}" class="sec1In">
                <div class="iconCover">
                    <img src="{{ url('/resources/assets/img/icon2.png') }}" alt="icon"/>
                </div>
                <div class="clearfix"></div>
                <span>DOCUMENTS</span>
            </a>
            <a href="{{url('/advocacy') }}" class="sec1In">
                <div class="iconCover">
                    <img src="{{ url('/resources/assets//img/icon3.png') }}" alt="icon"/>
                </div>
                <div class="clearfix"></div>
                <span>ADVOCACY</span>
            </a>
            <a href="{{url('/tools') }}" class="sec1In">
                <div class="iconCover">
                    <img src="{{ url('/resources/assets/img/icon4.png') }}" alt="icon"/>
                </div>
                <div class="clearfix"></div>
                <span>TOOLS</span>
            </a>
        </div>
    </section>
<section class="sec2">
        <div class="container">
            <div class="sec2In">
                <label>Do you know that you can keep track of your symptoms with <span>Symptom Tracker?</span></label>
                <div class="clearfix"></div>
                <a href="{{ url('/tools/symptom-tracker') }}" class="btnBase">Go to Symptom Tracker</a>
            </div>
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
@endsection
