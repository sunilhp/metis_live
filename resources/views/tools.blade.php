@extends('layouts.app')

@section('content')
    <section class="video_sessions">
        <div class="container">
            <a href="{{url('/tools/symptom-tracker') }}">
            <figure></figure>
            <h2>SYMPTOM TRACKER</h2>
            </a>

            <a href="{{url('/tools/explore') }}">
            <figure></figure>
            <h2>EXPLORE</h2>
            </a>



        </div>
    </section>
    @include('layouts.footer')
@endsection
