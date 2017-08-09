@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#medHisModa">+Add Event</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)
            <div class="whiteBox">
                <a href="{{ url('/medical-history/delete', $record->id)}}" class="deleteLogo"></a>
                <a href="{{url('/medical-history/'.$record->id)}}" class="editLogo"></a>
                <h3>{{date('m/d/Y', strtotime($record->event_from))}}  - @if($record->event_to == '0000-00-00') Present @else {{date('m/d/Y', strtotime($record->event_to))}} @endif</h3>
                <div class="clearfix"></div>
                <h2>{{ucwords(str_replace('-'," ",$record->event_type))}}</h2>
                <div class="clearfix"></div>

                <div class="detailBox">
                    <ul>
                        <li><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{$record->event_occur}}</small></li>
                        @if(isset($record->event_treatment) && trim($record->event_treatment)!="") <li><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{$record->event_treatment}}</small></li> @endif
                    </ul>
                </div>
            </div>
            @empty
                <div class="empty_provider">
                    +Add your medical history information by clicking the button above
                </div>
            @endforelse

        </div>
    </section>
    @include('layouts.footer')

    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="medHisModa">
        <div class="modal-dialog" role="document">
            <div class="modal-content has-error">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else New @endif Medical Event</h2>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="eventtype-error">{{ $errors->first('eventtype') }}</strong>
                        </span>
                        <label class="text-center">Select the type of event</label>
                        @php
                        if(isset($current->event_type))
                           $active_event_type = $current->event_type;
                        else
                           $active_event_type = null;
                       @endphp
                        {{ Form::select('eventtype',
                            [
                            'accident' => 'Accident',
                            'blood-test' => 'Blood Test',
                            'chemo-therapy' => 'Chemo Therapy',
                            'ct-scan' => 'CT Scan',
                            'dental-surgery' => 'Dental Surgery',
                            'dialysis' => 'Dialysis',
                            'eeg' => 'EEG',
                            'ekg' => 'EKG',
                            'er-visit' => 'ER Visit',
                            'hospitalization' => 'Hospitalization',
                            'infusion-therapy' => 'Infusion Therapy',
                            'injury' => 'Injury',
                            'mri' => 'MRI',
                            'office-visit' => 'Office Visit',
                            'other' => 'Other',
                            'outpatient-surgery' => 'Outpatient Surgery',
                            'pet-scan' => 'PET Scan',
                            'seizure' => 'Seizure',
                            'surgery' => 'Surgery',
                            'ultrasound' => 'Ultrasound',
                            'urgent-care' => 'Urgent Care',
                            'xray' => 'Xray'
                            ],$active_event_type,['id' => 'eventtype']
                            )
                          }}
                    </div>

                    <div class="form-group">
                        <span class="help-block">
                            <strong id="eventfrom-error">{{ $errors->first('eventfrom') }}</strong>
                        </span>
                        <label class="text-center">When did it first occur?</label>
                        <input type="text" placeholder="mm/dd/yyyy" class="inn1" id="eventfrom" name="eventfrom" value="@if(isset($current->event_from)){{date('m/d/Y', strtotime($current->event_from))}}@endif">
                    </div>

                    <div class="form-group">
                        <span class="help-block">
                            <strong id="eventto-error">{{ $errors->first('eventto') }}</strong>
                        </span>
                        <label class="text-center">When did it last occur?</label>
                        <input type="text" placeholder="mm/dd/yyyy" class="inn1" id="eventto" name="eventto" value="@if(isset($current->event_to) && $current->event_to != '0000-00-00'){{date('m/d/Y', strtotime($current->event_to))}}@endif">
                    </div>

                    <div class="form-group">
                        <span class="help-block">
                            <strong id="eventoccur-error">{{ $errors->first('eventoccur') }}</strong>
                        </span>
                        <label class="text-center">How often does it occur?</label>
                        <input type="text" placeholder="e.g. 1-2 times per week, once a year" class="inn1 inn1a1" id="eventoccur" name="eventoccur" value="@if(isset($current->event_occur)){{$current->event_occur}}@endif">
                    </div>

                    <div class="form-group">
                        <span class="help-block">
                            <strong id="eventtreatment-error">{{ $errors->first('eventtreatment') }}</strong>
                        </span>
                        <label class="text-center">Have you received treatment for it?</label>
                        <input type="text" placeholder="e.g. 1-2 times per week, once a year" class="inn1 inn1a1" id="eventtreatment" name="eventtreatment" value="@if(isset($current->event_treatment)){{$current->event_treatment}}@endif">
                    </div>
                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                        @else
                            <a href="#" class="submit_btn" id="event-submit">SAVE</a>
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
        <script type="text/javascript">$(document).ready(function(){ $('#medHisModa').modal('show'); });</script>
    @endif
@endsection