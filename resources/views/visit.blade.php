@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" data-toggle="modal" data-target="#myModal1">+Add Contact</a>
            <a href="#" class="ringButton"><img src="img/download.png" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="img/print.png" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="img/share.png" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            <div class="whiteBox">
                <a href="#" class="editLogo"></a>
                <h2>Mary Jones</h2>
                <div class="clearfix"></div>
                <div class="detailBox">
                    <ul>
                        <li><a href="#"><span><img src="img/crosssPic.png" alt="image"/></span><small>239-298-3970</small></a></li>
                        <li><a href="#"><span><img src="img/crosssPic.png" alt="image"/></span><small>380-293-2938</small></a></li>
                        <li><a href="#"><span><img src="img/crosssPic.png" alt="image"/></span><small>Sister-in law</small></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php /*
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
 */ ?>
@endsection
