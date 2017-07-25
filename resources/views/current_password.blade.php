@extends('layouts.app')
@section('content')
    <section class="terms_page">
        <div class="container">
            <div class="change_pass">
                <form method="POST" action="">
                    {{ csrf_field() }}
                <div class="form-group{{ $errors->has('opassword') ? ' has-error' : '' }}">
                    <label>Current Password</label>
                    <input type="password" name="opassword" id="opassword" class="inn1" value="{{ old('opassword') }}">
                    @if ($errors->has('opassword'))
                        <span class="help-block">
                    <strong>{{ $errors->first('opassword') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>New Password</label>
                    <input type="password" name="password" id="password"  class="inn1" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('cpassword') ? ' has-error' : '' }}">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword"  class="inn1" value="{{ old('cpassword') }}">
                    @if ($errors->has('cpassword'))
                        <span class="help-block">
                    <strong>{{ $errors->first('cpassword') }}</strong>
                </span>
                    @endif
                </div>

                <input type="submit" class="save_button" value="SAVE">
                </form>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
