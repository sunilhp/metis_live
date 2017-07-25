<!--**************mobMenu********************-->
<div class="overlay"></div>
<div class="sf-menu">
    <div class="list"><div class="listIn"><a href="#" class="action" data-toggle="modal" data-target="#logout">Logout</a><div class="close_icon"></div></div></div>
    <div class="list active">
        <div class="listIn"><div class="listUp setting">Account Settings</div><div class="arrow"></div></div>
        <div class="listInner">
            <ul>
                <li><a href="{{ url('/personal-information') }}"><span class="img1"></span><small>Personal Information</small></a></li>
                <li><a href="{{ url('/emergency-information') }}"><span class="img1"></span><small>Emergency Contacts</small></a></li>
            </ul>
        </div>
    </div>
    <div class="list active">
        <div class="listIn"><div class="listUp health">My Health Information</div><div class="arrow"></div></div>
        <div class="listInner">
            <ul>
                <li><a href="{{ url('/providers') }}"><span class="img1"></span><small>Providers</small></a></li>
                <li><a href="{{ url('/medications') }}"><span class="img2"></span><small>Medications</small></a></li>
                <li><a href="{{ url('/allergies') }}"><span class="img3"></span><small>Allergies</small></a></li>
                <li><a href="{{ url('/medical-history') }}"><span class="img4"></span><small>Medical History</small></a></li>
                <li><a href="{{ url('/insurance-information') }}"><span class="img5"></span><small>Insurance Information</small></a></li>
                <li><a href="{{ url('/preferred-pharmacy') }}"><span class="img6"></span><small>Preferred Pharmacy</small></a></li>
            </ul>
        </div>
    </div>
    <div class="list active">
        <div class="listIn"><div class="listUp about">About</div><div class="arrow"></div></div>
        <div class="listInner">
            <ul>
                <li><a href="{{ url('/faq') }}">FAQ</a></li>
                <li><a href="{{ url('/about-metis') }}">About Metis</a></li>
                <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                <li><a href="{{ url('/terms-of-use') }}">Terms of Use</a></li>
            </ul>
        </div>
    </div>
</div>
<!--**************mobMenuEnd********************-->