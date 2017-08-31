@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal6">+Add Pharmacy</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>
    <section class="mainBox">
        <div class="container">
    @if(count($records)>0)
    @php
        $i=0;
    @endphp
    @foreach($records as $record)

    <div class="whiteBox">
        <div class="map" id="map{{$i}}"></div>
        <a href="{{ url('/preferred-pharmacy/delete', $record->id)}}" class="deleteLogo"></a>
        <a href="{{url('/preferred-pharmacy/'.$record->id)}}" class="editLogo"></a>
        <h2>{{$record->pharmacy_name}}</h2>
        <div class="clearfix"></div>
        <h3></h3>
        <div class="clearfix"></div>
        <div class="detailBox">
            <ul>
                <li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{$record->address1}} {{$record->address2}}</small></a>
                    <a href="#" class="clickForMap">Open Google Maps</a>
                </li>
                <li><a href="tel:318-445-3973"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{$record->refills_number}}</small></a></li>
                <li><a href="tel:855-283-MEDS"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{$record->toll_free}} </small></a></li>
            </ul>
        </div>
    </div>
        @php
            $i++;
        @endphp
     @endforeach
    @else
        <div class="empty_provider">
            +Add your pharmacy by clicking the button above
        </div>
    @endif

</div>
</section>
@include('layouts.footer')
<div class="modal fade myModal5" tabindex="-1" role="dialog" id="myModal6">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post" action="">
            {{ csrf_field() }}
        <div class="modal-body">
            <h2>Pharmacy</h2>

            <div class="form-group">
                <span class="help-block">
                    <strong id="pharmacyname-error">{{ $errors->first('pharmacyname') }}</strong>
                </span>
                <input type="text" class="inn1" placeholder="Name of Pharmacy" id="pharmacyname" name="pharmacyname" value="@if(isset($current->pharmacy_name)){{$current->pharmacy_name}}@endif">
            </div>
            <div class="clearfix"></div>
            <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
            <div class="form-group form-group1">
                <span class="help-block">
                    <strong id="address1-error">{{ $errors->first('address1') }}</strong>
                </span>
                <input type="text" class="inn1" placeholder="Address Line 1" id="address1" name="address1" value="@if(isset($current->address1)){{$current->address1}}@endif">
                <input type="text" class="inn1" placeholder="Address Line 2" id="address2" name="address2" value="@if(isset($current->address2)){{$current->address2}}@endif">
            </div>
            <div class="clearfix"></div>
            <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
            <div class="form-group form-group1">
                <span class="help-block">
                    <strong id="refillsnumber-error">{{ $errors->first('refillsnumber') }}</strong>
                </span>
                <input type="text" class="inn1" placeholder="Phone" id="refillsnumber" name="refillsnumber" value="@if(isset($current->refills_number)){{$current->refills_number}}@endif">
            </div>
            <div class="clearfix"></div>
            <div class="icon1"><img src="{{ url('/resources/assets/img/crosssPic.png')}}"></div>
            <div class="form-group form-group1">
                <span class="help-block">
                    <strong id="tollfree-error">{{ $errors->first('tollfree') }}</strong>
                </span>
                <input type="text" class="inn1" placeholder="Fax" id="tollfree" name="tollfree" value="@if(isset($current->toll_free)){{$current->toll_free}}@endif">
            </div>
            <div class="btns">
                <a href="#" class="cancel" data-dismiss="modal">CANCEL</a>
                @if(( Request::method() ==='GET' && Request::segment(2)>0))
                    <button tyle="submit" href="#" class="submit_btn">UPDATE</button>
                @else
                    <a href="#" class="submit_btn" id="pharmacy-submit">SAVE</a>
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
<script type="text/javascript">$(document).ready(function(){ $('#myModal6').modal('show'); });</script>
@endif
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCCxCE1arJKwyfRkwdXAELK9Q2cJ9i6XRc"></script>

<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', initialize);



    function initialize()
    {
    @php
        $i=0;
    @endphp
    @foreach($records as $record)

       var latitude=50.50;
        var longitude=50.50;
        geocoder = new google.maps.Geocoder();
        if (geocoder) {
            address =@php echo '"'.$record->address1.', '.$record->address2.'"' @endphp || 'Ferrol, Galicia, Spain';
            geocoder.geocode({
                'address': address }, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                        latitude=results[0].geometry.location.lat();
                        longitude = results[0].geometry.location.lng();

                    var latlng{{$i}} = new google.maps.LatLng(latitude,longitude);
                    var myOptions{{$i}} =
                        {
                            zoom: 13,
                            center: latlng{{$i}},
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            position: new google.maps.LatLng(latitude,longitude),
                        };


                    var map{{$i}} = new google.maps.Map(document.getElementById("map{{$i}}"), myOptions{{$i}});



                    var myMarker{{$i}} = new google.maps.Marker(
                        {
                            position: latlng{{$i}},
                            map: map{{$i}},
                            title:"{{$record->pharmacy_name}}"
                        });
                    @php
                        $i++;
                    @endphp

                     }
                 });
             }

     @endforeach
    }


</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#refillsnumber,#tollfree").mask("(999) 999-9999");


        $("#refillsnumber,#tollfree").on("blur", function () {
            var last = $(this).val().substr($(this).val().indexOf("-") + 1);

            if (last.length == 5) {
                var move = $(this).val().substr($(this).val().indexOf("-") + 1, 1);

                var lastfour = last.substr(1, 4);

                var first = $(this).val().substr(0, 9);

                $(this).val(first + move + '-' + lastfour);
            }
        });
    });

</script>
@endsection