@extends('layouts.app')

@section('content')
<div class="loginForm">
    <form class="form-horizontal @if($errors->any()) has-error @endif" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="inputCover">
                <input id="email" type="email" class="input1" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="inputCover">
                <input id="password" type="password" class="input1" name="password" value="{{ old('password') }}" placeholder="Password">
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
            <div class="inputCover">
                <input id="password-confirm" type="password" class="input1" name="password_confirmation" value="{{ old('email') }}" placeholder="Confirm Password">
            </div>
            <br/>
            <button type="submit" class="submit">Reset Password</button>
        </form>
</div>
@endsection
