@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont1">+ Upload New Document</a>
            <a href="{{ url('/documents/notes/new')}}" class="ringButton"><img src="{{ url('/resources/assets/img/29C6190D-913D-4E2D-8D30-BEDF232436DC@1x.png')}}"></a>

        </div>
    </section>

    <section class="video_sessions">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/medical') }}">
                    <figure></figure>
                    <h2>MEDICAL</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/claims') }}">
                    <figure></figure>
                    <h2>CLAIMS</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/insurance') }}">
                    <figure></figure>
                    <h2>INSURANCE</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/notes') }}">
                    <figure></figure>
                    <h2>NOTES</h2>
                    </a>
                </div>


            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
