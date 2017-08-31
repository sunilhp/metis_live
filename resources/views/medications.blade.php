@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#medicationModal">+Add New Medication</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>
    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)

                <div class="whiteBox">
                    <a href="{{url('/medications/'.$record->id)}}"  class="editLogo"></a>
                    <h2>{{$record->drug_name}}</h2>
                    <div class="clearfix"></div>
                    <h3></h3>
                    <div class="clearfix"></div>
                    <div class="detailBox">
                        <ul>
                            <li><span><img src="{{asset('resources/assets/img/icon/dosage_b.png')}}"></span><small>{{$record->dosage}}</small></li>
                            <li><span><img src="{{asset('resources/assets/img/icon/frequency_medicaton_b.png')}}"></span><small>{{$record->med_schedule}}</small></li>
                            <li><span><img src="{{asset('resources/assets/img/icon/received_treatment_b.png')}}"></span><small>{{$record->pres_doctor}}</small></li>
                            <li><span><img src="{{asset('resources/assets/img/icon/time_of_occurance_b.png')}}"></span><small>{{date('m/d/Y', strtotime($record->med_start))}}</small></li>
                        </ul>
                    </div>
                </div>
            @empty
                <div class="empty_provider">
                    +Add your medications by clicking the button above
                </div>
            @endforelse
        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="medicationModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content has-error">
                <form method="post" action="">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else New @endif Medication</h2>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="drugname-error">{{ $errors->first('drugname') }}</strong>
                        </span>
                        <label class="text-center">Start typing your drug name</label>
                        <input type="text" placeholder="Like Lipitor, Prilosec, etc" class="inn12"  id="drugname" name="drugname" value="@if(isset($current->drug_name)){{$current->drug_name}}@endif">
                    </div>

                    <div class="form-group text-center">
                        <span class="help-block">
                            <strong id="dosage-error">{{ $errors->first('dosage') }}</strong>
                        </span>
                        <label class="text-center">What is your current dosage?</label>
                        <select class="select12" id="dosage" name="dosage">
                            <option>10 mg</option>
                            <option>20 mg</option>
                            <option>30 mg</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="medschedule-error">{{ $errors->first('medschedule') }}</strong>
                        </span>
                        <label>How often should you take it?</label>
                        <textarea class="text_in1" placeholder="Half a tablet in the morning, once in the evening..." id="medschedule" name="medschedule">@if(isset($current->med_schedule)){{$current->med_schedule}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="medstart-error">{{ $errors->first('medstart') }}</strong>
                        </span>
                        <label>What condition is this medication for?</label>
                        <input type="text" class="inn1 inn1a1" placeholder="mm/dd/yyyy" id="medstart" name="medstart" value="@if(isset($current->med_start)){{date('m/d/Y', strtotime($current->med_start))}}@endif">
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="presdoctor-error">{{ $errors->first('presdoctor') }}</strong>
                        </span>
                        <label>Who prescribed it to you?</label>
                        <input type="text" class="inn1 inn1a1" placeholder="Name of doctor, nurse, etc." id="presdoctor" name="presdoctor" value="@if(isset($current->pres_doctor)){{$current->pres_doctor}}@endif">
                    </div>
                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                        @else
                            <a href="#" class="submit_btn" id="medication-submit">SAVE</a>
                        @endif
                    </div>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    @if(($errors->any()) || (Request::method() ==='GET' && Request::segment(2)>0))
        <script type="text/javascript">$(document).ready(function(){ $('#medicationModal').modal('show'); });</script>
    @endif
@endsection

