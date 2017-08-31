@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#allergyModal">+Add Allergy</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png') }}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png') }}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png') }}" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)
            <div class="whiteBox">
                <a href="{{url('/allergies/'.$record->id)}}" class="editLogo"></a>
                <h2>{{$record->drug_name}}</h2>
                <div class="clearfix"></div>
                <div class="detailBox">
                    <ul>
                        <li><span><img src="{{asset('resources/assets/img/icon/time_of_occurance_b.png')}}"></span><small>{{date('m/d/Y', strtotime($record->first_occur))}}</small></li>
                        @if($record->second_occur != '0000-00-00')<li><span><img src="{{asset('resources/assets/img/icon/date_calendar_b.png')}}"></span><small>{{date('m/d/Y', strtotime($record->second_occur))}}</small></li>@endif
                        <li><span><img src="{{asset('resources/assets/img/icon/frequency_medicaton_b.png')}}"></span><small>{{$record->allergy_treatment}}</small></li>
                    </ul>
                </div>
            </div>
            @empty
                <div class="empty_provider">
                    +Add your allergy information by clicking the button above
                </div>
            @endforelse

        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade myModal5" tabindex="-1" role="dialog" id="allergyModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content has-error">
                <form method="post" action="">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else New @endif Allergy</h2>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="drugname-error">{{ $errors->first('drugname') }}</strong>
                        </span>
                        <label class="text-center">What is the allergy to?</label>
                        <input type="text" placeholder="i.e. penicillin, gluten" class="inn1 inn1a1" id="drugname" name="drugname" value="@if(isset($current->drug_name)){{$current->drug_name}}@endif">
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="firstoccur-error">{{ $errors->first('firstoccur') }}</strong>
                        </span>
                        <label class="text-center">When did it first occur?</label>
                        <input type="text" placeholder="mm/dd/yyyy" class="inn1" id="firstoccur" name="firstoccur" value="@if(isset($current->first_occur)){{date('m/d/Y', strtotime($current->first_occur))}}@endif">
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="secondoccur-error">{{ $errors->first('secondoccur') }}</strong>
                        </span>
                        <label class="text-center">When did it last occur?</label>
                        <input type="text" placeholder="mm/dd/yyyy" class="inn1" id="secondoccur" name="secondoccur" value="@if(isset($current->second_occur) && $current->second_occur != '0000-00-00'){{date('m/d/Y', strtotime($current->second_occur))}}@endif">
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="reaction-error">{{ $errors->first('reaction') }}</strong>
                        </span>
                        <label class="text-center">How severe was your reaction?</label>
                        <!-- <input type="text" placeholder="e.g. 1-2 times per week, once a year" class="inn1 inn1a1"> -->
                        <div class="range-slider allergies_silder">
                            <input class="range-slider__range" type="range" min="0" max="10" id="reaction" name="reaction" value="@if(isset($current->reaction)){{$current->reaction}}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="help-block">
                            <strong id="allergytreat-error">{{ $errors->first('allergytreat') }}</strong>
                        </span>
                        <label class="text-center">What treatment have you received?</label>
                        <input type="text" placeholder="e.g. 1-2 times per week, once a year" class="inn1 inn1a1" id="allergytreat" name="allergytreat" value="@if(isset($current->allergy_treatment)){{$current->allergy_treatment}}@endif">
                    </div>
                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                        @else
                            <a href="#" class="submit_btn" id="allergy-submit">SAVE</a>
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
        <script type="text/javascript">$(document).ready(function(){ $('#allergyModal').modal('show'); });</script>
    @endif

    <script type="text/javascript">
        var rangeSlider = function(){
            var slider = $('.range-slider'),
                range = $('.range-slider__range'),
                value = $('.range-slider__value');

            slider.each(function(){

                value.each(function(){
                    var value = $(this).prev().attr('value');
                    $(this).html(value);
                });

                range.on('input', function(){
                    $(this).next(value).html(this.value);
                });
            });
        };

        rangeSlider();
    </script>

@endsection