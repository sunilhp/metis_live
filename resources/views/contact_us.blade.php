@extends('layouts.app')

@section('content')



    <section class="terms_page">
        <div class="container">
            <div class="row"><div class="con_map" id="map-canvas"></div></div>
            <div class="contact_page_de">
                <ul>
                    <li><img src="{{ url('/resources/assets/img/E555D4F3-E845-4D9D-8234-55E259236571@1x.png')}}">West Hills, Los Angeles, CA</li>
                    <li><img src="{{ url('/resources/assets/img/3F97BE5B-CBE3-47F2-BAD3-A870C97F68EF@1x.png')}}"><a href="#">(888) 638-4763</a></li>
                    <li><img src="{{ url('/resources/assets/img/16CDBE60-BB73-4689-928D-114CE7219177@1x.png')}}"><a href="#">Send us a message</a></li>
                </ul>


                <p class="text-center">www.metisadvantage.com</p>
                <p class="text-center">Follow us on Social Media</p>

                <div class="media_icons">
                    <a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a>
                </div>

            </div>



        </div>
    </section>
    @include('layouts.footer')


@endsection
