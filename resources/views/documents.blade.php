@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont1">+ Upload New Document</a>
            <a href="{{ url('/documents/notes/new')}}" class="ringButton">
                <img src="{{ asset('/resources/assets/img/new_note_w.png')}}" title="Create a New Note">
            </a>
        </div>
    </section>

    <section class="video_sessions">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/medical') }}">
                        <figure>
                            <img src="{{asset('resources/assets/img/icon/medical_w.png')}}">
                        </figure>
                        <h2>MEDICAL</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/lists') }}">
                        <figure>
                            <img src="{{asset('resources/assets/img/icon/lists_w.png')}}">
                        </figure>
                        <h2>LISTS</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/insurance') }}">
                        <figure>
                            <img src="{{asset('resources/assets/img/icon/insurance_w.png')}}">
                        </figure>
                        <h2>INSURANCE</h2>
                    </a>
                </div>

                <div class="col-md-6 my_document_icons">
                    <a href="{{url('/documents/notes') }}">
                        <figure>
                            <img src="{{asset('resources/assets/img/icon/notes_w.png')}}">
                        </figure>
                        <h2>NOTES</h2>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
