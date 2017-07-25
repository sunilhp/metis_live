@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="loginForm">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="form-horizontal @if($errors->any()) has-error @endif " role="form" method="POST" action="{{ url('/password/email') }}">
         {{ csrf_field() }}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="inputCover">
            <input id="email" type="email" class="input1" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <br/>
            <button type="submit" class="submit">Reset Password</button>
    </form>
    </div>
@endsection
