@extends('layouts.app')

@section('content')


    <div id="myWizard">

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">

        <div class="tab-content">
            <div class="tab-pane fade in active" id="step1">



                    <h2>Please provide us with some information</h2>

                    {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <input type="text" placeholder="*First Name" class="inn1" required="required" id="fname" name="fname" value="{{ old('fname') }}">
                            @if ($errors->has('fname'))
                                <span class="help-block">
                    <strong>{{ $errors->first('fname') }}</strong>
                </span>
                            @endif

                        </div>
                        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <input type="text" placeholder="*Last Name" class="inn1" id="lname" required="required" name="lname" value="{{ old('lname') }}">
                            @if ($errors->has('lname'))
                                <span class="help-block">
                    <strong>{{ $errors->first('lname') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" placeholder="*E-mail" class="inn1" required="required" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('pnumber') ? ' has-error' : '' }}">
                            <input type="text" placeholder="*Phone Number" class="inn1" id="pnumber" name="pnumber" value="{{ old('pnumber') }}">
                            @if ($errors->has('pnumber'))
                                <span class="help-block">
                    <strong>{{ $errors->first('pnumber') }}</strong>
                </span>
                            @endif
                        </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <input id="password" type="password" class="inn1" name="password" placeholder="*Password" required="required" value="{{ old('password') }}">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password-confirm" type="password" class="inn1" name="password_confirmation" placeholder="*Confirm Password" required="required" value="{{ old('password_confirmation') }}">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif

                </div>

                        <div class="reg_btns">
                            <a href="{{ url('/') }}" class="cancel">CANCEL</a>
                            <a href="#step2" data-toggle="tab" data-step="2" class="next">NEXT</a>
                        </div>


            </div>
            <div class="tab-pane fade" id="step2">

                    <h2>Are you here via your employer?</h2>


                    <div class="reg_btns">
                        <a href="{{ url('/') }}" class="cancel1">CANCEL</a>
                        <a href="#step5" data-toggle="tab" data-step="5" class="no">NO</a>
                        <a href="#step3" data-toggle="tab" data-step="3" class="yes next">YES</a>
                    </div>

            </div>
            <div class="tab-pane fade" id="step3">
                <h2 class="more_mar">Please enter the employer’s name and ID</h2>


                <div class="form-group">
                    <input type="text" placeholder="Employer Name" class="inn1 text-center">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Employer ID" class="inn1 text-center">
                </div>

                <div class="reg_btns">
                    <a href="{{ url('/') }}" class="cancel">CANCEL</a>
                    <a id="register-otp" href="#step4" data-toggle="tab" data-step="4" class="next">NEXT</a>
                </div>


            </div>
            <div class="tab-pane fade" id="step4">
                <h2 class="more_mar">Please enter your access code below</h2>
                <div class="form-group">
                    <input type="text" placeholder="XXXXXXX" class="inn1 text-center" required="required" id="confirm-code">
                </div>

                <p><em>Tip: This code was sent to your e-mail.</em></p>
                <p>Still can’t find it?
                    Click below and we’ll send it again.</p>
                <p><a class="resend_code" id="resend_code" href="#">Resend Code</a></p>


                <div class="reg_btns">
                    <a href="{{ url('/') }}" class="cancel">CANCEL</a>
                    <a id="confirm-otp"  data-toggle="tab" class="next step5" data-step="5">NEXT</a>
                </div>

            </div>
            <div class="tab-pane fade" id="step5">
                <h2 class="less_mar">Please accept our Terms of Use</h2>
                <div class="term_sec">
                    <p>Metis Advantage Terms of Service ("Agreement")</p>
                    <p>This Agreement was last modified on September 20, 2013.</p>
                    <p>Please read these Terms of Service completely using yournowheretownblog.com which is owned and operated by Your Nowhere Town. This Agreement documents the legally binding terms and conditions attached to the use of the Site at yournowheretownblog.com.</p>
                    <p>By using or accessing the Site in any way, viewing or browsing the Site, or adding your own content to the Site, you are agreeing to be bound by these Terms of Service.</p>
                    <p>Intellectual Property</p>
                    <p>The Site and all of its original content are the sole property of Your Nowhere Town and are, as such, fully protected by the appropriate international copyright and other intellectual property rights laws.</p>
                    <p>Termination</p>
                    <p>Metis Advantage reserves the right to terminate your access to the Site, without any advance notice.</p>
                    <p>Links to Other Websites</p>
                    <p>Our Site does contain a number of links to other websites and online resources that are not owned or controlled by Metis Advantage.</p>
                    <p>Metis Advantage has no control over, and therefore cannot assume responsibility for, the content or general practices of any of these third party sites and/or services. Therefore, we strongly advise you to read the entire terms and conditions and privacy policy of any site that you visit as a result of following a link that is posted on our site.</p>
                </div>
                <div class="reg_btns">
                    <a href="{{ url('/') }}" class="cancel">CANCEL</a>
                    <a href="#step6" data-toggle="tab" data-step="6" class="next">I ACCEPT</a>
                </div>
            </div>
            <div class="tab-pane fade" id="step6">
                <h2 class="less_mar">Please accept our Privacy Policy</h2>
                <div class="term_sec">
                    <p>This privacy notice discloses the privacy practices for (website address). This privacy notice applies solely to information collected by this website. It will notify you of the following:</p>

                    <p>What personally identifiable information is collected from you through the website, how it is used and with whom it may be shared.</p>
                    <p>What choices are available to you regarding the use of your data.</p>
                    <p>The security procedures in place to protect the misuse of your information.</p>
                    <p>How you can correct any inaccuracies in the information.</p>
                    <p>Information Collection, Use, and Sharing </p>
                    <p>We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</p>

                    <p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>

                    <p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>
                </div>



                <div class="reg_btns">
                    <a href="{{ url('/') }}" class="cancel">CANCEL</a>
                    <a href="#" class="next" onclick="$('form').submit();">I ACCEPT</a>
                </div>

            </div>
        </div>

        </form>
        <div class="progress_bar"><div class="progress_bar_in" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="6" style="width: 20%;"></div></div>
    </div>










<?php /* ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}">

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php */ ?>
@endsection
