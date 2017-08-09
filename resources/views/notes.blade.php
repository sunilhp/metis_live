@extends('layouts.app')
@section('content')
    <section class="visits_page">
        <div class="container">
            <div class="row">

                <ul class="notes">
                    @forelse($records as $record)
                    <li>
                        <a href="{{url('documents/notes')}}/{{$record->id}}">
                        <span class="span1">
                        <span class="span1a">{{date('M y', strtotime($record->created_at))}}</span>
                        <span class="span1b">{{date('h:i A', strtotime($record->created_at))}}</span>
                        </span>
                        <span class="span2">
                         {{$record->notes}}
                        </span>
                        </a>
                    </li>
                    @empty
                        <li>No notes found.</li>
                    @endforelse

                </ul>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
@section('js')

@endsection
