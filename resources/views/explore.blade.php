@extends('layouts.app')

@section('content')
    <div class="explore_upper">
        <div class="explore_sec1">
            <div class="container">
                <figure></figure>
                <p>Search our library to help prepare for your next doctor visit</p>
            </div>
        </div>
        <div class="explore_sec2">
            <div class="container">
                <h2>Condition/Diagnosis:</h2>
                <div class="form-group">
                    <input type="text" class="inn1" placeholder="Start typing condition or diagnosis…">
                </div>

                <div class="or"><span>OR</span></div>

                <h2>Procedure:</h2>
                <div class="form-group">
                    <input type="text" class="inn1" placeholder="Start typing condition or diagnosis…">
                </div>
                <a href="#" class="ser_btn">Search</a>

            </div>
        </div>

    </div>
    @include('layouts.footer')
@endsection

@section('js')


@endsection
