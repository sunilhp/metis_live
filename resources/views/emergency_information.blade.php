@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal1">+Add Contact</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)
            <div class="whiteBox">
                <a href="{{ url('/emergency-information/edit', $record->id)}}" class="editLogo"></a>
                <h2>{{ $record->first_name }} {{ $record->last_name }}</h2>
                <div class="clearfix"></div>
                <div class="detailBox">
                    <ul>
                        <li><a href="#"><span><img src="{{asset('resources/assets/img/icon/home_phone_b.png')}}"></span><small>{{ $record->home_no }}</small></a></li>
                        @if(isset($record->work_no) && trim($record->work_no)!="")<li><a href="#"><span><img src="{{asset('resources/assets/img/icon/work_phone_b.png')}}"></span><small>{{ $record->work_no }}</small></a></li> @endif
                        <li><a href="#"><span><img src="{{asset('resources/assets/img/icon/relationships_b.png')}}"></span><small>{{ $record->relation }}</small></a></li>
                    </ul>
                </div>
            </div>
            @empty
                <div class="empty_provider">
                    +Add your emergency contact by clicking the button above
                </div>
            @endforelse

        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--       <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                      </div> -->
                <div class="modal-body">
                    <section class="account">
                        <div>
                            <form method="POST" action="">
                                {{ csrf_field() }}
                            <div class="accountIn">
                                <h2>@if(( Request::method() ==='GET' && Request::segment(3)>0)) Update @else New @endif Contact</h2>
                                <div class="clearfix"></div>

                                <div class="imageCover">
                                    <img src="{{ url('/resources/assets/img/userPic.png')}}" alt="user pic"/>
                                </div>
                                <a href="#" class="changePic">Change photo</a>
                                <div class="clearfix"></div>
                                <div class="inputCover {{ $errors->has('fname') ? ' has-error' : '' }}">
                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="fname" name="fname" placeholder="First Name" value="{{ old('fname') }}@if(isset($current->first_name)){{$current->first_name}}@endif"/>

                                </div>
                                <div class="inputCover {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}@if(isset($current->first_name)){{$current->last_name}}@endif"/>

                                </div>
                                <div class="inputCover {{ $errors->has('relation') ? ' has-error' : '' }}">
                                    @if ($errors->has('relation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('relation') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="relation" name="relation" placeholder="Relationship to me" value="{{ old('relation') }}@if(isset($current->relation)){{$current->relation}}@endif"/>

                                </div>
                                <div class="inputCover {{ $errors->has('contactno') ? ' has-error' : '' }}">
                                    @if ($errors->has('contactno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contactno') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="contactno" name="contactno" placeholder="Mobile Phone Number" value="{{ old('contactno') }}@if(isset($current->contact_no)){{$current->contact_no}}@endif"/>

                                </div>
                                <div class="inputCover">
                                    <input type="text" class="input1" id="alternateno" name="alternateno"  placeholder="Alternative Phone Number" value="{{ old('alternateno') }}@if(isset($current->alternate_no)){{$current->alternate_no}}@endif"/>
                                </div>
                                <div class="btnCover">
                                    <a href="#" class="addBtn link" data-dismiss="modal">CANCEL</a>
                                    @if(( Request::method() ==='GET' && Request::segment(3)>0))
                                    <input type="submit" value="UPDATE" class="addBtn" />
                                    @else
                                    <input type="submit" value="ADD" class="addBtn" />
                                    @endif
                                </div>
                            </div>
                            </form>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
@if(($errors->any()) || ( Request::method() ==='GET' && Request::segment(3)>0 ))
    <script type="text/javascript">$(document).ready(function(){ $('#myModal1').modal('show'); });</script>
@endif
@endsection