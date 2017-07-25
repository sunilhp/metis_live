@extends('layouts.app')
@section('content')

    @foreach($records as $record)
        @if(($record->address1 === " "  && $record->address1 === "") || (Request::path() === 'personal-information/edit'))
        <section class="personalinfo">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 top_part">
                        <h1>Complete Your Profile!</h1>
                        <div class="clearfix"></div>

                        <form method="post" action="{{url('personal-information/edit')}}" enctype="multipart/form-data" class="dropzone" id="edit-profile" >
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="col-md-12 top_part2">
                        <h3>{{$record->fname}} {{$record->lname}}<span>{{$record->email}}</span> <a id="save-personal" href="#" class="editLogo"></a> </h3>

                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <input type="text" id="address1" class="inn1" value="{{$record->address1}}">
                            <input type="text" id="address2" class="inn1" value="{{$record->address2}}">
                        </div>
                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <input type="text" class="inn1" id="pnumber" value="{{$record->pnumber}}">

                        </div>
                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <input type="text" class="inn1" id="onumber" value="{{$record->onumber}}">

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-12 pass_word_upper">
                        <input type="password" class="inn_pass" placeholder="Current Password">
                        <a href="{{ url('/current-password')}}" class="pass_submit"></a>
                    </div>
                </div>
            </div>
        </section>
            @else
        <section class="personalinfo">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 top_part top_parta">
                        <div class="clearfix"></div>
                        <figure><img src="@if($records[0]->profile_pic!=""){{ url('/public/'.$records[0]->profile_pic)}} @else {{ url('/resources/assets/img/p_info_img.png')}} @endif"></figure>
                    </div>


                    <div class="col-md-12 top_part2">
                        <h3>{{$record->fname}} {{$record->lname}}<span>{{$record->email}}</span> <a href="{{ url('/personal-information/edit')}}" class="editLogo"></a> </h3>

                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <p>{{$record->address1}} {{$record->address2}}</p>
                        </div>


                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <p>{{$record->pnumber}}</p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
                        <div class="form-group form-group1">
                            <p>{{$record->onumber}}</p>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 pass_word_upper">
                        <input type="password" class="inn_pass" placeholder="Current Password">
                        <a href="{{ url('/current-password')}}" class="pass_submit"></a>
                    </div>
                </div>
            </div>
        </section>
        @endif

    @endforeach
    @include('layouts.footer')
@endsection
@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script type="application/javascript">
        Dropzone.options.editProfile = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize:32,
            acceptedFiles:"image/*",
            dictDefaultMessage: "<figure><img src='@if($records[0]->profile_pic!=""){{ url('/public/'.$records[0]->profile_pic)}} @else {{ url('/resources/assets/img/p_info_img.png')}} @endif'></figure>"
        }
    </script>
    <style>
        .dropzone {
            height: 140px;
            width: 150px;
            margin: auto;
            padding: 0;
            background:none;
            border:0;
        }
        .dropzone .dz-preview.dz-image-preview {
            background: none;
        }
        .dropzone .dz-preview .dz-image {
            border-radius: 50%;
        }
    </style>
@endsection