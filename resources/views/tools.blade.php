@extends('layouts.app')

@section('content')
    <section class="video_sessions">
        <div class="container">
            <a href="{{url('/tools/symptom-tracker') }}">
                <figure>
                    <img src="{{asset('resources/assets/img/icon/symptom_tracker_w.png')}}">
                </figure>
                <h2>SYMPTOM TRACKER</h2>
            </a>

            <a href="{{url('/tools/explore') }}">
                <figure>
                    <img src="{{asset('resources/assets/img/icon/explore_w.png')}}">
                </figure>
                <h2>EXPLORE</h2>
            </a>
        </div>
    </section>
    @include('layouts.footer')
@endsection
