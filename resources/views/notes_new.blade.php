@extends('layouts.app')
@section('content')
    <form method="post" action="{{ url('/documents/notes/save')}}" id="notes-form">
    <section class="downHeader downHeader">
        <div class="container">
            <div class="pull-left"><div class="addCont addCont2" onclick="jQuery('#notes-form').submit();"><img src="{{ url('/resources/assets/img/d111.png')}}"> Save to Documents</div></div>
            <div class="pull-right">
                <div class="ringButton"><img src="{{ url('/resources/assets/img/153B22F6-69D0-4048-9416-C6091B7B57AB@1x.png')}}" onclick="jQuery('#notesDoc').click();" /></div>
                <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/4682794C-01D0-4D1C-809C-26B8A89CA985@1x.png')}}"></a>
            </div>
        </div>
    </section>

    <section class="visits_page">
        <div class="container">

                {{ csrf_field() }}
            <div class="date1">10:10 AM</div>
            <div class="clearfix"></div>
            @if ($errors->has('notes'))
                <div class="has-error">
                <span class="help-block">
                    <strong>{{ $errors->first('notes') }}</strong>
                </span>
                </div>
            @endif
            <textarea class="text123" placeholder="Start typing..." rows="20" id="notes" name="notes"></textarea>
            <input type="file" name="notesDoc" id="notesDoc" style="display: none;"/>
        </div>
    </section>
    </form>
    @include('layouts.footer')
@endsection
@section('js')

@endsection
