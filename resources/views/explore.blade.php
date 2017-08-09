@extends('layouts.app')

@section('content')
    <div class="explore_upper">
        <div class="explore_sec1">
            <div class="container">
                <figure></figure>
                <p>Search our library to help prepare for your next doctor visit</p>
            </div>
        </div>
        <div class="explore_sec2">
            <div class="container">
                <form method="post" action="" enctype="multipart/form-data" class="dropzone" id="edit-profile" >
                    {{ csrf_field() }}
                <h2>Condition/Diagnosis:</h2>
                <div class="form-group">
                    <input type="text" class="inn1" name="s1" id="s1" placeholder="Start typing condition or diagnosis…">
                </div>

                <div class="or"><span>OR</span></div>

                <h2>Procedure:</h2>
                <div class="form-group">
                    <input type="text" class="inn1" name="s2" id="s2" placeholder="Start typing condition or diagnosis…">
                </div>
                <input type="submit" href="#" class="ser_btn" name="submit" value="Search" />
                </form>

            </div>
        </div>

    </div>
    @include('layouts.footer')
@endsection

@section('js')
<script type="application/javascript">
    var path = "{{ route('explore-list') }}";
    jQuery('#s1').typeahead({
        items: 4,

        source:function (query, process) {
            return $.get(path, { query: query }, function (response) {

                return process(response);
            });
        },
        autoSelect: true

    });

    var path = "{{ route('explore-list') }}";
    jQuery('#s2').typeahead({
        items: 4,

        source:function (query, process) {
            return $.get(path, { query: query }, function (response) {

                return process(response);
            });
        },
        autoSelect: true

    });
</script>

@endsection
