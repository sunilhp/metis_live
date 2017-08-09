@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <div id="upload-documnet" class="addCont1">+ Upload New Document</div>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/29C6190D-913D-4E2D-8D30-BEDF232436DC@1x.png')}}"></a>

        </div>
    </section>
    <section class="visits_page">
        <div class="container">
            <div id="upload-preview"></div>

            <h2>Search your documents</h2>

            <div class="form-group">
                <input type="text" class="inn2" placeholder="Start typing condition or diagnosis…">
                <input type="submit" class="in_ser" value="SEARCH">
            </div>

            <div class="row">

                <table class="document_table">
                    <thead><th>File Name</th><th>Date Saved</th></thead>
                    @forelse($records as $record)
                    <tr><td><input type="checkbox" class="check_in"><a href="{{ url('/public/'.$record->doc_path)}}" target="_blank">{{$record->doc_path}}</a></td><td>{{date('h:i A', strtotime($record->created_at))}}<span>{{date('m/d/y', strtotime($record->created_at))}}</span></td></tr>
                    @empty
                        <tr><td colspan="2">
                            No files found.
                            </td>
                        </tr>
                    @endforelse
                </table>

            </div>

        </div>
    </section>
    @include('layouts.footer')
@endsection
@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script type="application/javascript">
        $("div#upload-documnet").dropzone({
            url: "{{ url('/'.Request::segment(1).'/'.Request::segment(2))}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize:32,
            acceptedFiles:".doc, .docx, .pdf",
            dictDefaultMessage: "<a class='addCont1'>+ Upload New Document</a>",
            previewsContainer: "#upload-preview",
            init: function() {
                this.on("addedfile", function(file, responseText) {
                    $("#upload-preview").addClass("ajax-loader");
                });

                this.on("success", function(file, responseText) {
                    $("#upload-preview").removeClass("ajax-loader");
                    window.location.href="{{ url('/'.Request::segment(1).'/'.Request::segment(2))}}";
                });
            }


        });

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
       .dz-error-message{
           color:red;
       }
        .dz-success-mark,.dz-error-mark,.dz-details{
            display: none;
        }
        .ajax-loader{
            background-image: url({{ url('/resources/assets/img/loader.gif')}});
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endsection
