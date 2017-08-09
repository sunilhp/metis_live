@extends('layouts.app')

@section('content')
    <section class="downHeader">
        <div class="container">
            <a href="#" class="addCont" class="addCont" data-toggle="modal" data-target="#myModal1">+Add Contact</a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/download.png')}}" alt="Download" title="Download"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/print.png')}}" alt="Print" title="Print"/></a>
            <a href="#" class="ringButton"><img src="{{ url('/resources/assets/img/share.png')}}" alt="Share" title="Share"/></a>
        </div>
    </section>


    <section class="mainBox">
        <div class="container">
            @forelse($records as $record)
            <div class="whiteBox">

                <a href="{{ url('/emergency-information/delete', $record->id)}}" class="deleteLogo"></a>
                <a href="{{ url('/emergency-information/edit', $record->id)}}" class="editLogo"></a>
                <h2>{{ $record->first_name }} {{ $record->last_name }}</h2>
                <div class="clearfix"></div>
                <div class="detailBox">
                    <ul>
                        <li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{ $record->cell_no }}</small></a></li>
                        @if(isset($record->home_no) && trim($record->home_no)!="")<li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{ $record->home_no }}</small></a></li> @endif
                        @if(isset($record->work_no) && trim($record->work_no)!="")<li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{ $record->work_no }}</small></a></li> @endif
                        @if(isset($record->email) && trim($record->email)!="")<li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{ $record->email }}</small></a></li> @endif
                        <li><a href="#"><span><img src="{{ url('/resources/assets/img/crosssPic.png')}}" alt="image"/></span><small>{{ $record->relation }}</small></a></li>
                    </ul>
                </div>
            </div>
            @empty
                <div class="empty_provider">
                    +Add your emergency contact by clicking the button above
                </div>
            @endforelse

        </div>
    </section>
    @include('layouts.footer')
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--       <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                      </div> -->
                <div class="modal-body">
                    <section class="account">
                        <div>
                            <form method="POST" action="">
                                {{ csrf_field() }}
                            <div class="accountIn">
                                <h2> New Contact</h2>
                                <div class="clearfix"></div>

                                <div class="imageCover">
                                    <img src="{{ url('/resources/assets/img/userPic.png')}}" alt="user pic"/>
                                </div>
                                <a href="#" class="changePic">Change photo</a>
                                <div class="clearfix"></div>
                                <div class="inputCover {{ $errors->has('fname') ? ' has-error' : '' }}">
                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="fname" name="fname" placeholder="First Name" value="{{ old('fname') }}@if(isset($current->first_name)){{$current->first_name}}@endif"/>

                                </div>
                                <div class="inputCover {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}@if(isset($current->first_name)){{$current->last_name}}@endif"/>

                                </div>
                                <div class="inputCover {{ $errors->has('relation') ? ' has-error' : '' }}">
                                    @if ($errors->has('relation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('relation') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="relation" name="relation" placeholder="Relationship to me" value="{{ old('relation') }}@if(isset($current->relation)){{$current->relation}}@endif"/>

                                </div>
                                <div class="inputCover">
                                    <input type="email" class="input1" id="email" name="email"  placeholder="Email" value="{{ old('email') }}@if(isset($current->email)){{$current->email}}@endif"/>
                                </div>

                                <div class="inputCover {{ $errors->has('cellno') ? ' has-error' : '' }}">
                                    @if ($errors->has('cellno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cellno') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" class="input1" id="cellno" name="cellno" placeholder="Mobile Phone Number" value="{{ old('cellno') }}@if(isset($current->cell_no)){{$current->cell_no}}@endif"/>

                                </div>
                                <div class="inputCover">
                                    <input type="text" class="input1" id="homeno" name="homeno"  placeholder="Home Phone Number" value="{{ old('homeno') }}@if(isset($current->home_no)){{$current->home_no}}@endif"/>
                                </div>
                                <div class="inputCover">
                                    <input type="text" class="input1" id="workno" name="workno"  placeholder="Work Phone Number" value="{{ old('workno') }}@if(isset($current->work_no)){{$current->work_no}}@endif"/>
                                </div>
                                <div class="btnCover">
                                    <a href="#" class="addBtn link" data-dismiss="modal">CANCEL</a>

                                    <input type="submit" value="ADD" class="addBtn" />

                                </div>
                            </div>
                            </form>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal1-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--       <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                      </div> -->
                <div class="modal-body">
                    <section class="account">
                        <div>
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                <div class="accountIn">
                                    <h2>Update Contact</h2>
                                    <div class="clearfix"></div>

                                    <div class="imageCover">
                                        <img src="{{ url('/resources/assets/img/userPic.png')}}" alt="user pic"/>
                                    </div>
                                    <a href="#" class="changePic">Change photo</a>
                                    <div class="clearfix"></div>
                                    <div class="inputCover {{ $errors->has('fname') ? ' has-error' : '' }}">
                                        @if ($errors->has('fname'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                        @endif
                                        <input type="text" class="input1" id="fname" name="fname" placeholder="First Name" value="@if(isset($current->first_name)){{$current->first_name}}@endif"/>

                                    </div>
                                    <div class="inputCover {{ $errors->has('lname') ? ' has-error' : '' }}">
                                        @if ($errors->has('lname'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                        @endif
                                        <input type="text" class="input1" id="lname" name="lname" placeholder="Last Name" value="@if(isset($current->first_name)){{$current->last_name}}@endif"/>

                                    </div>
                                    <div class="inputCover {{ $errors->has('relation') ? ' has-error' : '' }}">
                                        @if ($errors->has('relation'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('relation') }}</strong>
                                        </span>
                                        @endif
                                        <input type="text" class="input1" id="relation" name="relation" placeholder="Relationship to me" value="@if(isset($current->relation)){{$current->relation}}@endif"/>

                                    </div>
                                    <div class="inputCover">
                                        <input type="email" class="input1" id="email" name="email"  placeholder="Email" value="@if(isset($current->email)){{$current->email}}@endif"/>
                                    </div>
                                    <div class="inputCover {{ $errors->has('cellno') ? ' has-error' : '' }}">
                                        @if ($errors->has('cellno'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('cellno') }}</strong>
                                        </span>
                                        @endif
                                        <input type="text" class="input1" id="cellno" name="cellno" placeholder="Mobile Phone Number" value="@if(isset($current->cell_no)){{$current->cell_no}}@endif"/>

                                    </div>
                                    <div class="inputCover">
                                        <input type="text" class="input1" id="homeno" name="homeno"  placeholder="Home Phone Number" value="@if(isset($current->home_no)){{$current->home_no}}@endif"/>
                                    </div>
                                    <div class="inputCover">
                                        <input type="text" class="input1" id="workno" name="workno"  placeholder="Work Phone Number" value="@if(isset($current->work_no)){{$current->work_no}}@endif"/>
                                    </div>
                                    <div class="btnCover">
                                        <a href="#" class="addBtn link" data-dismiss="modal">CANCEL</a>
                                            <input type="submit" value="UPDATE" class="addBtn" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')

@if(Request::method() ==='GET' && Request::segment(3)>0 )
    <script type="text/javascript">$(document).ready(function(){ $('#myModal1-edit').modal('show'); });</script>
@elseif(($errors->any()))
    <script type="text/javascript">$(document).ready(function(){ $('#myModal1').modal('show'); });</script>
@endif
<script type="text/javascript">
    $(document).ready(function() {
        $("#cellno,#homeno,#workno").mask("(999) 999-9999");


        $("#cellno,#homeno,#workno").on("blur", function () {
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