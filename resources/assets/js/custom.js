//************************mob_menu*********************************//
$(document).ready(function(){
	$('#menu_click').click(function(){
	  $('.sf-menu').animate({
		left:'0'
	  }, 500, function(){
		  $('.overlay').css("display", "block");
		  $( "body" ).addClass( "modal-open" );
		// Animation complete.
	  });
}); 
	$('.sf-menu .close_icon , .overlay').click(function(){
		$('.sf-menu').animate({
		left:'-500'
	  }, 200, function(){
		  $('.overlay').css("display", "none");
		   $( "body" ).removeClass( "modal-open" );
		// Animation complete.
	  });	  
	});		


$('.sf-menu .list .listIn').click(function(){
  $(".sf-menu .list").removeClass("active");
  $(this).parent().addClass("active");
});

});
//************************colaps***************************/
	jQuery(function(){
		$ = jQuery;
		$(document).on("click",".panel-title a",function(){
			if($(this).find('.panel-title a[aria-expanded="true"]').length > 0){
				$(this).find('.panel-title a[aria-expanded="false"]').parent().parent().parent().removeClass("active");
			}
			if($(this).parent().parent().parent().hasClass("active")){
				//alert("cgxd");
				$(this).parent().parent().parent().removeClass("active");
			}
			else
			{
				//alert("else");
				$(this).parent().parent().parent().addClass("active");
			}
		});

	    jQuery('.click_here').click(function(){
		//alert(jQuery(this).parent().attr('class'));
			jQuery('textarea').slideToggle();
		// Animation complete.
	  	});
		jQuery('.click_here1').click(function(){
		//alert(jQuery(this).parent().attr('class'));
			jQuery('.calender').slideToggle();
		// Animation complete.
	  	});

        $('#provider-submit').click(function (e) {
            e.preventDefault();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var org = $('#org').val();
            var specialty = $('#specialty').val();
            var address = $('#address').val();
            var pemail = $('#pemail').val();
            var pnumber = $('#pnumber').val();
            var mnumber = $('#mnumber').val();


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'providers/new',
                dataType: 'json',
                data: { fname: fname, lname: lname, org: org, specialty: specialty, address: address, pemail: pemail,pnumber: pnumber, mnumber: mnumber},
                success: function(response ) {

                    if(response.success){
                        $("#myModal7").modal('toggle');
                        window.location.href="/metis/providers";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('#email-error,#fname-error,#lname-error,#address-error,#org-error,#mnumber-error,#pnumber-error').empty();
                        if(response.errors.pemail != ''){
                            $('#email-error').html(response.errors.pemail);
                        }
                        if(response.errors.fname != ''){
                            $('#fname-error').html(response.errors.fname);

                        }
                        if(response.errors.lname!=''){
                            $('#lname-error').html(response.errors.lname);
                        }

                        if(response.errors.address!=''){
                            $('#address-error').html(response.errors.address);
                        }

                        if(response.errors.org!=''){
                            $('#org-error').html(response.errors.org);
                        }
                        if(response.errors.mnumber!=''){
                            $('#mnumber-error').html(response.errors.mnumber);
                        }
                        if(response.errors.pnumber!=''){
                            $('#pnumber-error').html(response.errors.pnumber);
                        }
                    }
                }
            });
        });
        $('#pharmacy-submit').click(function (e) {
            e.preventDefault();
            var pharmacyname = $('#pharmacyname').val();
            var address1 = $('#address1').val();
            var address2 = $('#address2').val();
            var refillsnumber = $('#refillsnumber').val();
            var tollfree = $('#tollfree').val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'preferred-pharmacy/new',
                dataType: 'json',
                data: { pharmacyname: pharmacyname, address1: address1, address2: address2, refillsnumber: refillsnumber, tollfree: tollfree},
                success: function(response ) {

                    if(response.success){
                        $("#medicationModal").modal('toggle');
                        window.location.href="/metis/preferred-pharmacy";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('#pharmacyname-error,#address1-error,#address2-error,#refillsnumber-error,#presdoctor-error').empty();
                        if(response.errors.pharmacyname != ''){
                            $('#pharmacyname-error').html(response.errors.pharmacyname);
                        }
                        if(response.errors.address1 != ''){
                            $('#address1-error').html(response.errors.address1);

                        }
                        if(response.errors.address2!=''){
                            $('#address2-error').html(response.errors.address2);
                        }

                        if(response.errors.refillsnumber!=''){
                            $('#refillsnumber-error').html(response.errors.refillsnumber);
                        }

                        if(response.errors.tollfree!=''){
                            $('#tollfree-error').html(response.errors.tollfree);
                        }
                    }

                }
            });
        });
        $('#allergy-submit').click(function (e) {
            e.preventDefault();
            var drugname = $('#drugname').val();
            var firstoccur = $('#firstoccur').val();
            var secondoccur = $('#secondoccur').val();
            var reaction = $('#reaction').val();
            var allergytreat = $('#allergytreat').val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'allergies/new',
                dataType: 'json',
                data: { drugname: drugname, firstoccur: firstoccur, secondoccur: secondoccur, reaction: reaction, allergytreat: allergytreat},
                success: function(response ) {

                    if(response.success){
                        $("#allergyModal").modal('toggle');
                        window.location.href="/metis/allergies";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('#drugname-error,#firstoccur-error,#secondoccur-error,#reaction-error,#allergytreat-error').empty();
                        if(response.errors.drugname != ''){
                            $('#drugname-error').html(response.errors.drugname);
                        }
                        if(response.errors.firstoccur != ''){
                            $('#firstoccur-error').html(response.errors.firstoccur);

                        }
                        if(response.errors.secondoccur!=''){
                            $('#secondoccur-error').html(response.errors.secondoccur);
                        }

                        if(response.errors.reaction!=''){
                            $('#reaction-error').html(response.errors.reaction);
                        }

                        if(response.errors.allergytreat!=''){
                            $('#allergytreat-error').html(response.errors.allergytreat);
                        }
                    }

                }
            });
        });

        $('#medication-submit').click(function (e) {
            e.preventDefault();
            var drugname = $('#drugname').val();
            var dosage = $('#dosage').val();
            var medschedule = $('#medschedule').val();
            var medstart = $('#medstart').val();
            var presdoctor = $('#presdoctor').val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'medications/new',
                dataType: 'json',
                data: { drugname: drugname, dosage: dosage, medschedule: medschedule, medstart: medstart, presdoctor: presdoctor},
                success: function(response ) {

                    if(response.success){
                        $("#medicationModal").modal('toggle');
                        window.location.href="/metis/medications";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('#drugname-error,#dosage-error,#medschedule-error,#medstart-error,#presdoctor-error').empty();
                        if(response.errors.drugname != ''){
                            $('#drugname-error').html(response.errors.drugname);
                        }
                        if(response.errors.dosage != ''){
                            $('#dosage-error').html(response.errors.dosage);

                        }
                        if(response.errors.medschedule!=''){
                            $('#medschedule-error').html(response.errors.medschedule);
                        }

                        if(response.errors.medstart!=''){
                            $('#medstart-error').html(response.errors.medstart);
                        }

                        if(response.errors.presdoctor!=''){
                            $('#presdoctor-error').html(response.errors.presdoctor);
                        }
                    }

                }
            });
        });

        $('#event-submit').click(function (e) {
            e.preventDefault();
            var eventtype = $('#eventtype').val();
            var eventfrom = $('#eventfrom').val();
            var eventto = $('#eventto').val();
            var eventoccur = $('#eventoccur').val();
            var eventtreatment = $('#eventtreatment').val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'medical-history/new',
                dataType: 'json',
                data: { eventtype: eventtype, eventfrom: eventfrom, eventto: eventto, eventoccur: eventoccur, eventtreatment: eventtreatment},
                success: function(response ) {

                    if(response.success){
                        $("#medHisModa").modal('toggle');
                        window.location.href="/metis/medical-history";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('#eventtype-error,#eventfrom-error,#eventto-error,#reaction-error,#eventtreatment-error').empty();
                        if(response.errors.eventtype != ''){
                            $('#eventtype-error').html(response.errors.eventtype);
                        }
                        if(response.errors.eventfrom != ''){
                            $('#eventfrom-error').html(response.errors.eventfrom);

                        }
                        if(response.errors.eventto!=''){
                            $('#eventto-error').html(response.errors.eventto);
                        }

                        if(response.errors.eventoccur!=''){
                            $('#eventoccur-error').html(response.errors.eventoccur);
                        }

                        if(response.errors.eventtreatment!=''){
                            $('#eventtreatment-error').html(response.errors.eventtreatment);
                        }
                    }

                }
            });
        });
        $('#insurance-submit').click(function (e) {
            e.preventDefault();
            var insurancename = $('#insurancename').val();
            var groupno = $('#groupno').val();
            var rxbin = $('#rxbin').val();
            var rxpcn = $('#rxpcn').val();
            var rxgroup = $('#rxgroup').val();
            var phonenumber = $('#phonenumber').val();
            var weburl = $('#weburl').val();
            var address1 = $('#address1').val();
            var address2 = $('#address2').val();


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'insurance-information/new',
                dataType: 'json',
                data: { insurancename: insurancename, groupno: groupno, rxbin: rxbin, rxpcn: rxpcn, rxgroup: rxgroup, phonenumber: phonenumber, weburl: weburl, address1: address1, address2: address2},
                success: function(response ) {

                    if(response.success){
                        $("#medHisModa").modal('toggle');
                        window.location.href="/metis/insurance-information";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('.modal-content').addClass( "has-error" );
                        $('#insurancename-error,#groupno-error,#rxbin-error,#rxpcn-error,#rxgroup-error,#phonenumber-error,#weburl-error,#address1-error,#address2-error').empty();
                        if(response.errors.insurancename != ''){
                            $('#insurancename-error').html(response.errors.insurancename);
                        }
                        if(response.errors.groupno != ''){
                            $('#groupno-error').html(response.errors.groupno);

                        }
                        if(response.errors.rxbin!=''){
                            $('#rxbin-error').html(response.errors.rxbin);
                        }

                        if(response.errors.rxpcn!=''){
                            $('#rxpcn-error').html(response.errors.rxpcn);
                        }

                        if(response.errors.rxgroup!=''){
                            $('#rxgroup-error').html(response.errors.rxgroup);
                        }
                        if(response.errors.phonenumber != ''){
                            $('#phonenumber-error').html(response.errors.phonenumber);

                        }
                        if(response.errors.weburl!=''){
                            $('#weburl-error').html(response.errors.weburl);
                        }

                        if(response.errors.address1!=''){
                            $('#address1-error').html(response.errors.address1);
                        }

                        if(response.errors.address2!=''){
                            $('#address2-error').html(response.errors.address2);
                        }
                    }

                }
            });
        });
        $('#visit-submit').click(function (e) {
            e.preventDefault();

            var providerid = $('#providerid').val();
            var visit_date = $('#visitdate').val();
            var visit_time = $('#visittime').val();
            var visit_reason = $('#visitreason').val();
            var visit_located = $('#visitlocated').val();
            var visit_note = $('#visitnote').val();


 
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'visits',
                dataType: 'json',
                data: { providerid: providerid, visitdate: visit_date, visittime: visit_time, visitreason: visit_reason, visitlocated: visit_located, visitnote: visit_note},
                success: function(response ) {

                    if(response.success){
                        $("#myModal12").modal('toggle');
                        window.location.href="/metis/visits";
                        //alert(Object.keys(response.errors).length);

                    }else{
                        $('.modal-content').addClass( "has-error" );
                        $('#providerid-error,#visitdate-error,#visittime-error,#visitreason-error,#visitlocated-error,#visitnote-error').empty();
                        if(response.errors.providerid != ''){
                            $('#providerid-error').html(response.errors.providerid);
                        }
                        if(response.errors.visitdate != ''){
                            $('#visitdate-error').html(response.errors.visitdate);

                        }
                        if(response.errors.visittime!=''){
                            $('#visittime-error').html(response.errors.visittime);
                        }

                        if(response.errors.visitreason!=''){
                            $('#visitreason-error').html(response.errors.visitreason);
                        }

                        if(response.errors.visitlocated!=''){
                            $('#visitlocated-error').html(response.errors.visitlocated);
                        }
                        if(response.errors.visitnote != ''){
                            $('#visitnote-error').html(response.errors.visitnote);

                        }
                    }

                }
            });
        });

        $('#video-request-submit').click(function (e) {
            e.preventDefault();
            var help = $('#help').val();
            if($('#test1').is(':checked'))
             var video_chat = 1;
            else
                var video_chat = 0;

            if($('#test2').is(':checked'))
            var video_call = $('#test2').val();
            else
                var video_call =0;

            if($('#test3').is(':checked'))
                var chat_message = $('#test3').val();
            else
                var chat_message = 0;


            var request_date = $('#sessiondate').val();
            var request_time = $('#sessiontime').val();



            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/metis/advocacy/video-request-code',
                dataType: 'json',
                data: { help: help, video_chat: video_chat, video_call: video_call, chat_message: chat_message, request_date: request_date, request_time: request_time},
                success: function( msg ) {

                    $("#myModal3").modal('toggle');
                    window.location.href="/metis/advocacy/sessions";
                }
            });


        });

        $('.video-resend-code').click(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/metis/advocacy/video-resend-code',
                dataType: 'json',
                success: function( data ) {

                    if(data.success){
                        $('.video-msg').html('<div style="color: green">Confirmation code sent, Kindly check your email.</div>')
                    }else{
                        $('.video-msg').html('<div style="color: red">No requested session found.</div>')
                    }

                }
            });
        });
        $('.video-confirm').click(function (e) {
            e.preventDefault();
            var ccode = $('#ccode').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/metis/advocacy/video-confirm',
                dataType: 'json',
                data: { ccode: ccode},
                success: function( data ) {

                    if(data.success){
                        callButton.onClick();
                        $("#video-chat").modal('toggle');

                    }else{
                        $('.video-msg').html('<div style="color: red">Confirmation code is not valid.</div>')
                    }

                }
            });
        });

	});



/* Registration Steps */

$('.next').click(function(e){

    if(($(this).attr("id")=="register-otp")){

        var email = $('#email').val();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'ajax/register-request-otp',
            dataType: 'json',
            data: {email: email},
            success: function (response) {
               alert(response.errors.email);
            }
        });
    }
    else if(($(this).attr("id")=="confirm-otp")){

        var confirm_code = $('#confirm-code').val();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'ajax/register-confirm-otp',
            dataType: 'json',
            data: {confirm_code: confirm_code},
            success: function (data) {


                if(data.verified){

                    $('#confirm-otp').attr("href","#step5") ;
                    $('#confirm-otp').attr("id","confirm-verified") ;
                    $('#confirm-code').css("border-bottom-color", "#979797");
                    $('#confirm-verified').click();
                    $('#confirm-verified').click();

                }else{
                    $('#confirm-code').css("border-bottom-color", "#d20009");
                    return false;
                }

            }
        });
    }
    else{
        var nextId = $(this).parents('.tab-pane').next().attr("id");
        $('[href="#'+nextId+'"]').tab('show');
        return false;

    }
});
$('#resend_code').click(function (e) {
    e.preventDefault();

    var email = $('#email').val();
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'ajax/resend-otp',
        dataType: 'json',
        data: { email: email},
        success: function( msg ) {

        }
    });
});

$('#save-personal').click(function (e) {
    e.preventDefault();

    var address1 = $('#address1').val();
    var address2 = $('#address2').val();
    var pnumber = $('#pnumber').val();
    var onumber = $('#onumber').val();
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/metis/save-personal-information',
        dataType: 'json',
        data: { address1: address1, address2: address2, pnumber: pnumber, onumber: onumber},
        success: function( ) {
            window.location.href="/metis/personal-information";
        }
    });
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

    //update progress
    var step = $(e.target).data('step');
    var percent = (parseInt(step) / 6) * 100;

    $('.progress_bar_in').css({width: percent + '%'});
    /*$('.progress-bar').text("Step " + step + " of 6");*/

    //e.relatedTarget // previous tab

});


/* End Registration Steps */


/************************colaps***************************/












