@extends('layouts.app')
@section('content')
    <section class="contact_sessions">
        <div class="container">
            <script type="text/javascript">
                (function (d, src, c) {
                    var t = d.scripts[d.scripts.length - 1], s = d.createElement('script');
                    s.id = 'la_x2s6df8d';
                    s.async = true;
                    s.src = src;
                    s.onload = s.onreadystatechange = function () {
                        var rs = this.readyState;
                        if (rs && (rs != 'complete') && (rs != 'loaded')) {
                            return;
                        }
                        c(this);
                    };
                    t.parentElement.insertBefore(s, t.nextSibling);
                })(document,
                        'https://metisadvantage.ladesk.com/scripts/track.js',
                        function (e) {
                            LiveAgent.createForm('d4b091d9', e);
                        });
            </script>
        </div>
    </section>
    @include('layouts.footer')
@endsection
@section('js')

@endsection
