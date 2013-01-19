$(document).ready(function(){
	//gestion taille ecran public
	var height_window =  $(window).height();
	var height_footer = $('#footer_page').height();
	var height_reel = height_window - (height_footer*2);
	$('#wrapper_page').css('min-height',height_reel);
	$('#bloc_list_type_itemstore').css('min-height',height_reel);
	
	//gestion taille ecran admin
	$('#container_admin_dark').css('min-height',height_reel);
	$('#container_info_admin_light').css('min-height',height_reel);
	
	
	
	//gestion des datatable
	
	
	$('.listing_admin').dataTable({
		"sPaginationType": "full_numbers",
			"oLanguage": {
				  "sSearch": "Recherche : ",
				  "oPaginate": {
					  "sFirst": "<i class='icon-fast-backward'></i>",
					  "sNext": "<i class='icon-step-forward'></i>  ",
					  "sPrevious": "<i class='icon-step-backward'></i>  ",
					  "sLast": "<i class='icon-fast-forward'></i> "
				}
			}
	});
	$('#classement_general').dataTable({
		 "sPaginationType": "full_numbers"
	});
	//traitement du formulaire de contact apparition - disparition
	$('#btn_new_msg_forum').click(function (){
		$('#form_crea_topic').slideToggle();
	});
	
	//administration
	
	
	
	//gestion des submenu leftbar
	$('.submenu_link').click(function(){
		alert('re');
	});
	
	//scrolling factory
	$(function() {
		$('."link_nav_factory"').bind('click',function(event){
			var $anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top
				}, 800);
				event.preventDefault();
		});
	});
	
});
