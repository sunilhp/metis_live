@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal8">+Add New Plan</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)
                <div class="whiteBox">
                    <a href="{{url('/insurance-information/'.$record->id)}}" class="editLogo"></a>
                    <h2>{{$record->insurance_name}}</h2>
                    <div class="clearfix"></div>
                    <div class="regence_table">
                        <ul>
                            <li><span>Group No.</span>{{$record->group_no}}</li>
                            <li><span>RxBIN</span>{{$record->rxbin}}</li>
                            <li><span>RxPCN</span>{{$record->rxpcn}}</li>
                            <li><span>RxGroup</span>{{$record->rxgroup}}</li>
                        </ul>
                    </div>

                    <div class="clearfix"></div>
                    <div class="detailBox">
                        <ul>
                            <li><span><img src="{{asset('resources/assets/img/provider.png')}}"></span><small>{{$record->insurance_name}}</small></li>
                            <li><span><img src="{{asset('resources/assets/img/icon/url_b.png')}}"></span><small>{{$record->web_url}}</small></li>
                            <li><span><img src="{{asset('resources/assets/img/icon/address_b.png')}}"></span><small>{{$record->address1}}<br>{{$record->address2}}</small></li>
                        </ul>
                    </div>
                </div>
            @empty
            <div class="empty_provider">
                +Add your insurance plan information by clicking the button above
            </div>
            @endforelse
        </div>
    </section>

    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="myModal8">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <h2>New Insurance Plan</h2>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="insurancename-error">{{ $errors->first('insurancename') }}</strong>
                        </span>
                        <input type="text" placeholder="Name of Insurance" class="inn1" id="insurancename" name="insurancename" value="@if(isset($current->insurance_name)){{$current->insurance_name}}@endif">
                    </div>

                    <div class="clearfix"></div>
                    <div class="text1a">Group No.</div>
                    <div class="form-group form-group2">
                        <span class="help-block">
                            <strong id="groupno-error">{{ $errors->first('groupno') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="" id="groupno" name="groupno" value="@if(isset($current->group_no)){{$current->group_no}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text1a">RxBIN</div>
                    <div class="form-group form-group2">
                        <span class="help-block">
                            <strong id="rxbin-error">{{ $errors->first('rxbin') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="" id="rxbin" name="rxbin" value="@if(isset($current->rxbin)){{$current->rxbin}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text1a">RxPCN</div>
                    <div class="form-group form-group2">
                        <span class="help-block">
                            <strong id="rxpcn-error">{{ $errors->first('rxpcn') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="" id="rxpcn" name="rxpcn" value="@if(isset($current->rxpcn)){{$current->rxpcn}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text1a">RxGroup</div>
                    <div class="form-group form-group2">
                        <span class="help-block">
                            <strong id="rxgroup-error">{{ $errors->first('rxgroup') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="" id="rxgroup" name="rxgroup" value="@if(isset($current->rxgroup)){{$current->rxgroup}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                    <div class="form-group form-group1">
                        <span class="help-block">
                            <strong id="phonenumber-error">{{ $errors->first('phonenumber') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Phone Number" id="phonenumber" name="phonenumber" value="@if(isset($current->phone_number)){{$current->phone_number}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                    <div class="form-group form-group1">
                        <span class="help-block">
                            <strong id="weburl-error">{{ $errors->first('weburl') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Website URL" id="weburl" name="weburl" value="@if(isset($current->web_url)){{$current->web_url}}@endif">
                    </div>
                    <div class="clearfix"></div>
                    <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                    <div class="form-group form-group1">
                        <span class="help-block">
                            <strong id="address1-error">{{ $errors->first('address1') }}</strong>
                        </span>
                        <input type="text" class="inn1" placeholder="Address Line 1" id="address1" name="address1" value="@if(isset($current->address1)){{$current->address1}}@endif">
                        <input type="text" class="inn1" placeholder="Address Line 2" id="address2" name="address2" value="@if(isset($current->address2)){{$current->address2}}@endif">
                    </div>



                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                        @else
                            <a href="#" class="submit_btn" id="insurance-submit">SAVE</a>
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
        <script type="text/javascript">$(document).ready(function(){ $('#myModal8').modal('show'); });</script>
    @endif
    <style>.help-block{ display:none;} .has-error .help-block{ display:block;}</style>
@endsection