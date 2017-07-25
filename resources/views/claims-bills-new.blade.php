@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal12">+Add New Claim/Bills</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"></a>
        </div>
    </section>
    <section class="mainBox">
        <div class="container">
            <div class="whiteBox">
                <div class="" tabindex="-1" role="dialog" id="myModal12">
                    <form method="post" action="{{url('advocacy/claims-bills-new')}}" id="claim-bills" enctype="multipart/form-data" class="dropzone dz-clickable">
                        {{ csrf_field() }}
                        <h2>@if(( Request::method() ==='GET' && Request::segment(2)>0)) Update @else Add New @endif Claim/Bills</h2>
                        <div class="row">
                            <span class="help-block">
                              <strong id="doctorname-error">{{ $errors->first('doctorname') }}</strong>
                            </span>
                            <h3>Name of Doctor</h3>
                            <div class="form-group">
                                <input type="text" class="inn1" placeholder="Start typing..." id="doctorname" name="doctorname" value="@if(isset($current->doctorname)){{$current->doctorname}}@endif">
                            </div>

                            <span class="help-block">
                              <strong id="subject-error">{{ $errors->first('subject') }}</strong>
                            </span>
                            <h3>Subject</h3>
                            <div class="form-group">
                                <input type="text" class="inn1 subject" placeholder="Subject..." value="@if(isset($current->subject)){{$current->subject}} {{$current->subject}}@endif" id="subject" name="subject">
                            </div>

                            <span class="help-block">
                              <strong id="amount-error">{{ $errors->first('amount') }}</strong>
                            </span>
                            <h3>Claim/Bill Amount</h3>
                            <div class="form-group">
                                $<input type="text" class="inn1 subject" placeholder="Claim/Bill Amount..." value="@if(isset($current->amount)){{$current->amount}} {{$current->amount}}@endif" id="amount" name="amount">
                            </div>
                            <span class="help-block">
                              <strong id="claimdesc-error">{{ $errors->first('claimdesc') }}</strong>
                            </span>
                            <h3>Description</h3>
                            <div class="form-group">
                                <textarea class="text_in1" placeholder="Description"  id="claimdesc" name="claimdesc">@if(isset($current->provider->first_name)){{$current->provider->first_name}} {{$current->provider->last_name}}@endif</textarea>
                            </div>
                            <span class="help-block">
                              <strong id="claimnotes-error">{{ $errors->first('claimnotes') }}</strong>
                            </span>
                            <h3>Notes:</h3>
                            <div class="form-group">
                                <textarea class="text_in1" placeholder="Notes..."  id="claimnotes" name="claimnotes" >@if(isset($current->claim_notes)){{$current->claim_notes}}@endif</textarea>

                            </div>
                            <div class="clearfix"></div>
                            <div class="dz-default dz-message document_attach"><span>Attach a document</span></div>
                                <div class="clearfix"></div>
                            <input type="hidden" id="claim_id" name="claim_id" value="0"/>
                             <div class="btns">
                                <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                                @if(( Request::method() ==='GET' && Request::segment(2)>0))
                                    <button tyle="submit" class="submit_btn">UPDATE</button>
                                @else
                                    <a href="#" class="submit_btn" id="cb-submit">SAVE</a>
                                @endif
                            </div>
                        </div>
                    </form>


                </div>

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


</script>
    <script type="text/javascript">
/*
        Dropzone.options.claimBills = {
            uploadMultiple: false,
            parallelUploads: 3,
            acceptedFiles: ".doc,.docx,.pdf,.jpg",
            dictDefaultMessage: "Drop your Documents here..",

        };
        */


        Dropzone.options.claimBills = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 100,
            maxFiles: 2,
            dictDefaultMessage: "Drop your Documents here..",

            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("#cb-submit").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                   // e.preventDefault();
                    //e.stopPropagation();

                    var doctorname = $('#doctorname').val();
                    var subject = $('#subject').val();
                    var amount = $('#amount').val();
                    var claimdesc = $('#claimdesc').val();
                    var claimnotes = $('#claimnotes').val();

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/metis/advocacy/claims-bills-new',
                        dataType: 'json',
                        data: { doctorname: doctorname, amount: amount, subject: subject, claimdesc: claimdesc, claimnotes: claimnotes},
                        success: function(response) {
                                if(response.success){
                                    $('#doctorname-error,#subject-error,#amount-error,#claimdesc-error,#claimnotes-error').empty();
                                    $('#claim_id').val(response.claim_id);
                                    myDropzone.processQueue();
                                    window.location.href="/metis/advocacy/claims-bills";

                                }else{
                                    $('#claim-bills').addClass( "has-error" );
                                    $('#doctorname-error,#subject-error,#amount-error,#claimdesc-error,#claimnotes-error').empty();
                                    if(response.errors.doctorname != ''){
                                        $('#doctorname-error').html(response.errors.doctorname);
                                    }
                                    if(response.errors.subject != ''){
                                        $('#subject-error').html(response.errors.subject);

                                    }
                                    if(response.errors.amount!=''){
                                        $('#amount-error').html(response.errors.amount);
                                    }

                                    if(response.errors.claimdesc!=''){
                                        $('#claimdesc-error').html(response.errors.claimdesc);
                                    }

                                    if(response.errors.claimnotes!=''){
                                        $('#claimnotes-error').html(response.errors.claimnotes);
                                    }

                                }

                            // window.location.href="/metis/advocacy/sessions";
                        }
                    });

                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }
    </script>
    <style>
        .text_in1 {
            font-family: Avenir-Book;
            font-style: italic;
            font-size: 15px;
            color: #a2a2a2;
            width: 100%;
            height: 30px;
            padding: 0 5px;
            border: none;
            outline: none;
            border-bottom: 1px solid #6f6f6f;
            border-radius: 0px;
        }
        .dropzone{
            border:0;
        }
    </style>

@endsection


