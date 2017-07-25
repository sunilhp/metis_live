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
	  });
	  
/************************colaps***************************/












