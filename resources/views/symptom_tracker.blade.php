@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal4">+Add New Symptom</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>
    <section class="symptom_tracker">
        <div class="symptom_tracker_in">
            <div class="sorting">
                <label>Show the last</label>
                <select onChange="window.location.href='{{url('tools/symptom-tracker/q')}}/'+this.value;">
                    <option>All</option>
                    <option @if(Request::route('id')==='1') selected @endif value="1" >1 days</option>
                    <option @if(Request::route('id')==='7') selected @endif value="7">7 days</option>
                    <option @if(Request::route('id')==='30') selected @endif value="30">30 days</option>
                    <option @if(Request::route('id')==='60') selected @endif value="60">60 days</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <ul>
                @forelse($records as $record)
                <li>
                    <span class="span1">
                        <span class="span1a">{{date('d', strtotime($record->sym_date))}}</span>
                        <span class="span1b">{{date('M', strtotime($record->sym_date))}}</span>
                    </span>
                    <span class="span2">
                        <span class="span2a">{{date('l', strtotime($record->sym_date))}}, {{date('h:i A', strtotime($record->sym_time))}}</span>
                        <span class="span2b">{{$record->symptom_located}}</span>
                        <span class="span2b">{{$record->symptom_cant}}</span>
                    </span>
                    <span class="span3">
                        <span class="span3a">{{$record->how_bad}}</span>
                    </span>
                </li>

                @empty
                    <li>
                        No symptoms added.
                    </li>
                @endforelse
            </ul>
        </div>




    </section>
    @include('layouts.footer')


    <div class="modal fade" tabindex="-1" role="dialog" id="myModal4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h2>Log New Symptom</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <span class="help-block">
                                <strong id="symdate-error">{{ $errors->first('symdate') }}</strong>
                            </span>
                            <div class="icon1"><img src="{{ url('/resources/assets/img/485EFE4D-BEDB-4133-809F-85BD25BBD0B5@1x.png')}}"></div>
                            <div class="sel_upper">
                                <input class="input-mini timemask timepicker" type="text"  placeholder="Today" id="symdate" name="symdate" value="@if(isset($current->visit_date)){{date('Y-m-d', strtotime($current->visit_date))}}@endif"><span class="add-on clearpicker"><i class="icon-time"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <span class="help-block">
                                <strong id="symtime-error">{{ $errors->first('symtime') }}</strong>
                            </span>
                            <div class="icon1"><img src="{{ url('/resources/assets/img/12063EC7-E0CE-4847-B3C2-845AD51F47A7@1x.png')}}"></div>
                            <div class="sel_upper">
                                <input class="input-mini timemask timepicker" type="text"  placeholder="Time" id="symtime" name="symtime" value="@if(isset($current->visit_time)){{$current->visit_time}}@endif"><span class="add-on clearpicker"><i class="icon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <span class="help-block">
                        <strong id="symptoms-error">{{ $errors->first('symptoms') }}</strong>
                    </span>
                    <h3>The symptom is:</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" id="symptoms" name="symptoms" placeholder="Start typing...">
                    </div>
                    <span class="help-block">
                        <strong id="howbad-error">{{ $errors->first('howbad') }}</strong>
                    </span>
                    <h3>How bad is it?</h3>

                    <div class="range-slider how_bad">
                        <input class="range-slider__range" type="range" value="5" min="0" max="10" id="howbad" name="howbad">
                    </div>
                    <div class="x-values">
                        <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span>

                    </div>

                    <div class="very_mild">Moderate</div>
                    <span class="help-block">
                        <strong id="located-error">{{ $errors->first('located') }}</strong>
                    </span>
                    <h3>Where is it located?</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" placeholder="Start typing a body location…" id="located" name="located">
                    </div>
                    <span class="help-block">
                        <strong id="icant-error">{{ $errors->first('icant') }}</strong>
                    </span>
                    <h3>I can’t:</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" placeholder="Start typing..." id="icant" name="icant">
                    </div>

                    <div class="notify_text">
                        Promptly notify your doctor of any and all symptoms that you may be having. If you are experiencing a life threatening emergency, please call 9-1-1 or visit your local emergency room.
                    </div>

                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        <a href="#" class="submit_btn" id="symptoms-submit">SAVE</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">



        var path = "{{ route('symptoms') }}";
        jQuery('#symptoms').typeahead({
            items: 4,

            source:function (query, process) {
                return $.get(path, { query: query }, function (response) {

                    return process(response);
                });
            },
            autoSelect: true

        });

        var bodyparts = "{{ route('body-located') }}";
        jQuery('#located').typeahead({
            items: 4,

            source:function (query, process) {
                return $.get(bodyparts, { query: query }, function (response) {

                    return process(response);
                });
            },
            autoSelect: true

        });
        var impairedactivity = "{{ route('impaired-activity') }}";
        jQuery('#icant').typeahead({
            items: 4,

            source:function (query, process) {
                return $.get(impairedactivity, { query: query }, function (response) {

                    return process(response);
                });
            },
            autoSelect: true

        });

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
    $("#symdate").datetimepicker({
        minView: 2,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $("#symtime").datetimepicker({
        minView: 4,
        startView:0,
        showMeridian: true,
        autoclose: true,
        format: 'hh:ii'
    });
        $('#symptoms-submit').click(function (e) {
            e.preventDefault();

            var symptoms = $('#symptoms').val();
            var symdate = $('#symdate').val();
            var symtime = $('#symtime').val();
            var howbad = $('#howbad').val();
            var located = $('#located').val();
            var icant = $('#icant').val();



            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url('tools/symptom-tracker')}}',
                dataType: 'json',
                data: { symptoms: symptoms, symdate: symdate, symtime: symtime, howbad: howbad, located: located, icant: icant},
                success: function(response ) {

                    if(response.success){
                        $("#myModal4").modal('toggle');
                        window.location.href="{{url('tools/symptom-tracker')}}";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('.modal-content').addClass( "has-error" );
                        $('#symptoms-error,#symdate-error,#symtime-error,#howbad-error,#located-error,#icant-error').empty();
                        if(response.errors.symptoms != ''){
                            $('#symptoms-error').html(response.errors.symptoms);
                        }
                        if(response.errors.symdate != ''){
                            $('#symdate-error').html(response.errors.symdate);

                        }
                        if(response.errors.symtime!=''){
                            $('#symtime-error').html(response.errors.symtime);
                        }

                        if(response.errors.howbad!=''){
                            $('#howbad-error').html(response.errors.howbad);
                        }

                        if(response.errors.located!=''){
                            $('#located-error').html(response.errors.located);
                        }
                        if(response.errors.icant != ''){
                            $('#icant-error').html(response.errors.icant);

                        }
                    }

                }
            });
        });
</script>
    <style>
        #symdate,  #symtime{
            width: 100%;
            margin-bottom: 20px;
            height: 30px;
            border: none;
            outline: none;
            border-radius: 0px;
            border-bottom: 1px solid #979797;
            background: url({{ url('/resources/assets/img/sel_icon.png')}}) no-repeat center right;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font-family: Avenir-Medium;
            font-size: 14px;
            color: #606060;
        }

        .icon1 {
            width: 30px;
            height: 30px;
            float: left;
            padding-top: 5px;
        }
        .sel_upper {
            width: calc(100% - 30px);
            float: left;
        }

        #myModal4 .very_mild::before, #myModal4 .very_mild::after{
            top: 15px;
        }
    </style>
@endsection
