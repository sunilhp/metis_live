@extends('layouts.app')

@section('content')
    <div class="explore_upper">
        <div class="explore_sec1">
            <div class="container">
                <h1><span>Results for</span>{{$search}} Condition</h1>
                <h4>PREP QUESTIONS</h4>
            </div>
        </div>
        <div class="search_result">
            <div class="container">
                <div class="row">
                    <ul>
                        @forelse($records as $record)
                        <li>{{$record->questions}}</li>
                        @empty
                            <li>
                               No related question found.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div></div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')


@endsection
