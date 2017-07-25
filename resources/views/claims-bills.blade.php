@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="{{ url('advocacy/claims-bills-new')}}" class="addCont">+Add New Claim/Bills</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"></a>
        </div>
    </section>
    <section class="visits_page">
        <div class="container">
            <div class="row">

                <div class="sorting pull-left">
                    <select>
                        <option>Medical Claims</option>
                        <option>Medical Claims</option>
                        <option>Medical Claims</option>
                        <option>Medical Claims</option>
                    </select>
                </div>

                <div class="sorting">
                    <label>Period:</label>

                    <select onChange="window.location.href='{{url('/advocacy/claims-bills/y/')}}/'+this.value;">
                        <option @if(Request::route('id')==='2017') selected @endif value="2017" >2017</option>
                        <option @if(Request::route('id')==='2018') selected @endif value="2018">2018</option>
                        <option @if(Request::route('id')==='2019') selected @endif value="2019">2019</option>
                        <option @if(Request::route('id')==='2020') selected @endif value="2020">2020</option>
                    </select>
                </div>

                <div class="clearfix"></div>

                <ul class="visit_list">
                    @forelse($sc_records as $record)
                    <li>
<span class="span0">
<img src="{{ url('/resources/assets/img/claim_icon1.png')}}">
</span>
                        <span class="span1">
<span class="span1a">{{date('d', strtotime($record->created_at))}}</span>
<span class="span1b">{{date('M', strtotime($record->created_at))}}</span>
</span>
                        <span class="span2 span2_claims">
<span class="span2a"><img src="{{ url('/resources/assets/img/08C98D5A-6921-4C68-8B9E-F4480968A645@1x.png')}}">${{$record->cb_amount}}</span>
<span class="span2b"><img src="{{ url('/resources/assets/img/A7A8639A-A062-40B7-AFFC-D694212301F6@1x.png')}}">{{$record->cb_subject}}</span>
<span class="span2b"><img src="{{ url('/resources/assets/img/BEF9DC5E-2FEE-4368-9656-0D23494A74C6@1x.png')}}">{{$record->cb_doctor_name}}</span>
</span>
                        <span class="span3">
<a href="#" class="span3b"></a>
</span>
                        <div class="detail_sec">
                            <h3>Description:</h3>
                            <p>{{$record->cb_desc}}</p>

                            <h3>Notes:</h3>
                            <p>{{$record->cb_notes}}</p>

                            <div class="clearfix"></div>
                            <ul>
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
                            No Claims/Bills.
                        </li>
                    @endforelse


                </ul>
            </div>
        </div>
    </section>
    @include('layouts.footer')

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
    </style>

    <style>
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


