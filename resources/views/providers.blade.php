@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal7">+Add New Provider</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png') }}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png') }}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png') }}" alt="Share" title="Share"/></a>
        </div>
    </section>

    <section class="mainBox">
        <div class="container">

            @forelse($records as $record)
                <div class="whiteBox">
                    <a href="{{ url('/providers/delete', $record->id)}}" class="deleteLogo"></a>
                    <a href="{{url('/providers/'.$record->id)}}" class="editLogo"></a>
                    <h2>{{ $record->first_name }} {{ $record->last_name }}, {{ $record->provider_speciality }}</h2>
                    <div class="clearfix"></div>
                    <h3>{{ $record->provider_org }}</h3>
                    <div class="clearfix"></div>
                    <div class="detailBox">
                        <ul>
                            <li><a href="tel:{{ $record->provider_phone_no }}"><span><img src="{{ url('/resources/assets/img/crosssPic.png') }}" alt="image"/></span><small>{{ $record->provider_phone_no }}</small></a></li>
                            <li><a href="tel:{{ $record->provider_mobile_no }}"><span><img src="{{ url('/resources/assets/img/crosssPic.png') }}" alt="image"/></span><small>{{ $record->provider_mobile_no }}</small></a></li>
                            <li><a href="mailto:{{ $record->provider_email }}"><span><img src="{{ url('/resources/assets/img/crosssPic.png') }}" alt="image"/></span><small>{{ $record->provider_email }}</small></a></li>
                            <li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png') }}" alt="image"/></span><small>{{ $record->provider_address }}</small></a></li>
                        </ul>
                    </div>
                </div>

            @empty
                <div class="empty_provider">
                    +Add your providers by clicking the button above
                </div>
            @endforelse

        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="myModal7">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else New @endif Provider</h2>

                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="fname-error">{{ $errors->first('fname') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="First Name" id="fname" name="fname" value="@if(isset($current->first_name)){{$current->first_name}}@endif">
                    </div>
                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="lname-error">{{ $errors->first('lname') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Last Name" id="lname" name="lname" value="@if(isset($current->last_name)){{$current->last_name}}@endif">
                    </div>
                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="speciality-error">{{ $errors->first('speciality') }}</strong>
                        </span>
                        <select id="specialty" name="specialty">
                            <option>Specialty</option>
                            <option>Specialty</option>
                            <option>Specialty</option>
                            <option>Specialty</option>
                        </select>
                    </div>
                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="org-error">{{ $errors->first('org') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Provider Organization" id="org" name="org" value="@if(isset($current->provider_org)){{$current->provider_org}}@endif">
                    </div>
                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="address-error">{{ $errors->first('address') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Address" id="address" name="address" value="@if(isset($current->provider_address)){{$current->provider_address}}@endif">
                    </div>
                    <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="email-error">{{ $errors->first('pemail') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Email" id="pemail" name="pemail" value="@if(isset($current->provider_email)){{$current->provider_email}}@endif">
                    </div>
                    <div class="form-group has-error">
                        <span class="help-block">
                            <strong id="pnumber-error">{{ $errors->first('pnumber') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Phone Number" id="pnumber" name="pnumber" value="@if(isset($current->provider_phone_no)){{$current->provider_phone_no}}@endif">
                    </div>
                    <div class="form-group has-error">
                         <span class="help-block">
                            <strong id="mnumber-error">{{ $errors->first('mnumber') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Mobile Number" id="mnumber" name="mnumber" value="@if(isset($current->provider_mobile_no)){{$current->provider_mobile_no}}@endif">
                    </div>

                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                            @else
                            <a href="#" class="submit_btn" id="provider-submit">SAVE</a>
                        @endif

                    </div>

                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')
    @if(($errors->any()) || ( Request::method() ==='GET' && Request::segment(2)>0))
        <script type="text/javascript">$(document).ready(function(){ $('#myModal7').modal('show'); });</script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $("#pnumber,#mnumber").mask("(999) 999-9999");


            $("#pnumber,#mnumber").on("blur", function () {
                var last = $(this).val().substr($(this).val().indexOf("-") + 1);

                if (last.length == 5) {
                    var move = $(this).val().substr($(this).val().indexOf("-") + 1, 1);

                    var lastfour = last.substr(1, 4);

                    var first = $(this).val().substr(0, 9);

                    $(this).val(first + move + '-' + lastfour);
                }
            });
        });

    </script>
@endsection
