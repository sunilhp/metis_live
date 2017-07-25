@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal12">+Add New Visit</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"></a>
        </div>
    </section>
    <section class="visits_page">
        <div class="container">
            <div class="row">
                <ul class="top_tab3">
                    <li class="active"><a href="#scheduled" data-toggle="tab">SCHEDULED</a></li>
                    <li><a href="#past" data-toggle="tab">PAST</a></li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="fade in active" id="scheduled">
                       <ul class="visit_list">
                           @forelse($sc_records as $record)
                       <li>
                        <span class="span1">
                        <span class="span1a">{{date('d', strtotime($record->visit_date))}}</span>
                        <span class="span1b">{{date('M', strtotime($record->visit_date))}}</span>
                        </span>
                                   <span class="span2">
                        <span class="span2a">{{date('l', strtotime($record->visit_date))}}, {{date('h:i A', strtotime($record->visit_time))}}</span>
                        <span class="span2b">{{$record->provider->first_name}} {{$record->provider->last_name}}</span>
                        <span class="span2b">{{$record->visit_reason}}</span>
                        </span>
                                   <span class="span3">
                        <a href="#" class="span3b"></a>
                        </span>

                                   <div class="detail_sec">
                                       <a href="{{url('/visits/'.$record->id)}}" class="editicon">Edit</a>
                                       <div class="clearfix"></div>
                                       <ul>
                                           <li>
                                               <span><img src="{{ url('/resources/assets/img/E555D4F3-E845-4D9D-8234-55E259236571@1x.png')}}"></span>
                                               {{$record->provider->provider_org}} {{$record->provider->provider_address}}</li>
                                           <li>
                                               <span><img src="{{ url('/resources/assets/img/3F97BE5B-CBE3-47F2-BAD3-A870C97F68EF@1x.png')}}"></span>
                                               <a href="#">{{$record->provider->provider_phone_no}}</a></li>
                                           <li>
                                               <span><img src="{{ url('/resources/assets/img/16CDBE60-BB73-4689-928D-114CE7219177@1x.png')}}"></span>
                                               <a href="#">{{$record->provider->provider_mobile_no}}</a></li>
                                           @foreach($record->documents as $documents)
                                               <li>
                                                   <span><img src="{{ url('/resources/assets/img/578D22CA-6D85-4B0F-8453-49CEBC5BF595@1x.png')}}"></span>
                                                   <a href="{{ url('/public/'.$documents->doc_path)}}" target="_blank">{{$documents->doc_path}}</a></li>
                                           @endforeach
                                       </ul>
                                   </div>


                               </li>
                           @empty
                               <li>
                                   No scheduled visits.
                               </li>
                           @endforelse

                </ul>
                    </div>
                    <div class="fade" id="past">
                        <ul class="visit_list">
                            @forelse($pt_records as $record)
                            <li>
                        <span class="span1">
                        <span class="span1a">{{date('d', strtotime($record->visit_date))}}</span>
                        <span class="span1b">{{date('M', strtotime($record->visit_date))}}</span>
                        </span>
                                <span class="span2">
                        <span class="span2a">{{date('l', strtotime($record->visit_date))}}, {{date('h:i A', strtotime($record->visit_time))}}</span>
                        <span class="span2b">{{$record->provider->first_name}} {{$record->provider->last_name}}</span>
                        <span class="span2b">{{$record->visit_reason}}</span>
                        </span>
                                <span class="span3">
                        <a href="#" class="span3b"></a>
                        </span>

                                <div class="detail_sec">
                                    <a href="{{url('/visits/'.$record->id)}}" class="editicon">Edit</a>
                                    <div class="clearfix"></div>
                                    <ul>
                                        <li>
                                            <span><img src="{{ url('/resources/assets/img/E555D4F3-E845-4D9D-8234-55E259236571@1x.png')}}"></span>
                                            {{$record->provider->provider_org}} {{$record->provider->provider_address}}</li>
                                        <li>
                                            <span><img src="{{ url('/resources/assets/img/3F97BE5B-CBE3-47F2-BAD3-A870C97F68EF@1x.png')}}"></span>
                                            <a href="#">{{$record->provider->provider_phone_no}}</a></li>
                                        <li>
                                            <span><img src="{{ url('/resources/assets/img/16CDBE60-BB73-4689-928D-114CE7219177@1x.png')}}"></span>
                                            <a href="#">{{$record->provider->provider_mobile_no}}</a></li>
                                        @foreach($record->documents as $documents)
                                            <li>
                                                <span><img src="{{ url('/resources/assets/img/578D22CA-6D85-4B0F-8453-49CEBC5BF595@1x.png')}}"></span>
                                                <a href="{{ url('/public/'.$documents->doc_path)}}" target="_blank">{{$documents->doc_path}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>


                            </li>
                            @empty
                                <li>
                                    No scheduled visits.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal12">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @if(($errors->any()) || ( Request::method() ==='GET' && Request::segment(2)>0))
                        <form method="post" action="{{url('visits')}}/{{Request::segment(2)}}" id="visitors" enctype="multipart/form-data" class="dropzone">
                        @else
                    <form method="post" action="{{url('visits')}}" id="visitors" enctype="multipart/form-data" class="dropzone">
                        @endif
                        {{ csrf_field() }}
                    <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else Add New @endif Visit</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="help-block">
                                <strong id="visitdate-error">{{ $errors->first('visitdate') }}</strong>
                            </span>
                            <div class="icon1"><img src="{{ url('/resources/assets/img/485EFE4D-BEDB-4133-809F-85BD25BBD0B5@1x.png')}}"></div>
                            <div class="sel_upper">
                                <input class="input-mini timemask timepicker" type="text"  placeholder="Visit Date" id="visitdate" name="visitdate" value="@if(isset($current->visit_date)){{date('Y-m-d', strtotime($current->visit_date))}}@endif"><span class="add-on clearpicker"><i class="icon-time"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <span class="help-block">
                                <strong id="visittime-error">{{ $errors->first('visittime') }}</strong>
                            </span>
                            <div class="icon1"><img src="{{ url('/resources/assets/img/12063EC7-E0CE-4847-B3C2-845AD51F47A7@1x.png')}}"></div>
                            <div class="sel_upper">
                                <input class="input-mini timemask timepicker" type="text"  placeholder="Visit Time" id="visittime" name="visittime" value="@if(isset($current->visit_time)){{$current->visit_time}}@endif"><span class="add-on clearpicker"><i class="icon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <span class="help-block">
                        <strong id="providerid-error">{{ $errors->first('providerid') }}</strong>
                    </span>
                    <h3>Name of Provider</h3>
                    <div class="form-group">
                        <input type="text" class="inn1 provider-auto" placeholder="Start typing..." value="@if(isset($current->provider->first_name)){{$current->provider->first_name}} {{$current->provider->last_name}}@endif">
                    </div>
                    <span class="help-block">
                        <strong id="visitreason-error">{{ $errors->first('visitreason') }}</strong>
                    </span>
                    <h3>What’s the reason for the visit?</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" placeholder="Start typing..." id="visitreason" name="visitreason" value="@if(isset($current->visit_reason)){{$current->visit_reason}}@endif">
                    </div>
                   <span class="help-block">
                        <strong id="visitlocated-error">{{ $errors->first('visitlocated') }}</strong>
                    </span>
                   <h3>Where is it located?</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" placeholder="Start typing a body location…" id="visitlocated" name="visitlocated" value="@if(isset($current->visit_located)){{$current->visit_located}}@endif">
                    </div>
                           <span class="help-block">
                                <strong id="visitnote-error">{{ $errors->first('visitnote') }}</strong>
                            </span>
                   <h3>Notes:</h3>
                    <div class="form-group">
                        <input type="text" class="inn1" placeholder="Start typing..."  id="visitnote" name="visitnote" value="@if(isset($current->visit_notes)){{$current->visit_notes}}@endif">
                        <input type="hidden" id="providerid" name="providerid" value="@if(isset($current->provider_id)){{$current->provider_id}}@endif">
                    </div>
                    <div class="clearfix"></div>
                        <div class="dz-default dz-message document_attach "><span>Attach a document</span></div>
                    <div class="clearfix"></div>
                    <div class="btns">
                        <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                        @if(( Request::method() ==='GET' && Request::segment(2)>0))
                            <button tyle="submit" class="submit_btn">UPDATE</button>
                        @else
                            <a href="#" class="submit_btn" id="visit-submit">SAVE</a>
                        @endif
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script type="text/javascript">
    $(".visits_page ul.visit_list li .span3 .span3b").click(function(){
        //$(".visits_page ul.visit_list li").removeClass("open_detail");
        $(this).parent().parent().toggleClass("open_detail");
        //$(this).parent().find(".open_detail").slideToggle();
    });
</script>
<script type="text/javascript">
    var path = "{{ route('providerauto') }}";
    jQuery('input.provider-auto').typeahead({
        items: 4,
        updater: function(selection){
            $('#providerid').val(selection.id);
            return selection;
        },
        source:function (query, process) {
            return $.get(path, { query: query }, function (response) {

                return process(response);
            });
        },
        autoSelect: true,
        displayText: function(item){ return item.first_name+" "+item.last_name; }

    });

    $("#visitdate").datetimepicker({
        minView: 2,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $("#visittime").datetimepicker({
        minView: 4,
        startView:0,
        showMeridian: true,
        autoclose: true,
        format: 'hh:ii'
    });
</script>
    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            uploadMultiple: false,
            parallelUploads: 3,
            acceptedFiles: ".doc,.docx,.pdf,.jpg",
            dictDefaultMessage: "Drop your Documents here..",

        };
    </script>
    <style>
        #scheduled.fade,#past.fade{
            display: none;
        }
        #scheduled.active, #past.active{
            display:block;
        }
        #visitdate,  #visittime{
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

         #scheduled.fade,#past.fade{
             display: none;
         }
        #scheduled.active, #past.active{
            display:block;
        }
    </style>
    @if(($errors->any()) || ( Request::method() ==='GET' && Request::segment(2)>0))
        <script type="text/javascript">$(document).ready(function(){ $('#myModal12').modal('show'); });</script>
    @endif
@endsection


