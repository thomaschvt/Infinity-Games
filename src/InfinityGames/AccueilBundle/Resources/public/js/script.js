$(document).ready(function(){
	
	//gestion des background link_nav
	$(".content_link_nav").mouseenter(function(){
		$(this).css('background',"url('css/img/bg_link_nav_rollover.png')");
	});
	
	$(".content_link_nav").mouseleave(function(){
		$(this).css('background',"url('')");
	});
	
	//gestion des background btn connexion
	/*
	$("#btn_connexion").mouseenter(function(){
		$(this).css('background',"url('css/img/btn_gris.png')");
	});
	$("#btn_connexion").mouseleave(function(){
		$(this).css('background',"url('css/img/btn_gris_hover.png')");
	});*/
	
	//gestion des background btn inscription
	/*$("#btn_inscrip").mouseenter(function(){
		$(this).css('background',"url('css/img/btn_orange.png')");
	});
	$("#btn_inscrip").mouseleave(function(){
		$(this).css('background',"url('css/img/btn_orange_hover.png')");
	});*/
	
	//gestion des background link_tools developpement
	$(".btn_tools").mouseenter(function(){
		$(this).css('background',"url('css/img/bg_link_tools.png')");
		$(this).css('color','#fff');
	});
	$(".btn_tools").mouseleave(function(){
		$(this).css('background',"url('')");
	});
	
	//gestion btn_download index
  /*
	$("#btn_download_tools").mouseenter(function(){
		$(this).css('background',"url('css/img/btn_orange_fat.png')");
	});
	$("#btn_download_tools").mouseleave(function(){
		$(this).css('background',"url('css/img/btn_orange_fat_hover.png')");
	});*/
	
//gestion des box connexion - inscription/////////////////////////////////////////////////////////////////////////////////
	//light box connexion header
	$('a.login-window').click(function() {
		
    //Getting the variable's value from a link 
	var loginBox = $(this).attr('href');
	
	//Fade in the Popup
	$(loginBox).fadeIn(300);
	
	//Set the center alignment padding + border see css style
	var popMargTop = ($(loginBox).height() + 24) / 2; 
	var popMargLeft = ($(loginBox).width() + 24) / 2; 
	
	$(loginBox).css({ 
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});
	
	// Add the mask to body
	$('body').append('<div id="mask"></div>');
	$('#mask').fadeIn(300);
	
	return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	$('#mask , .login-popup').fadeOut(300 , function() {
	$('#mask').remove();  
	}); 
	return false;
	});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//gestion affichage form avatar profil
	$('#modif_avatar').click(function(){
		$("#wrapper_form_avatar").fadeToggle("fast", "linear");

	});
//gestion ouverture message page profil
	$('.message_profil').click(function(){
		//on change l'image en msg lu si necessaire -->rajouter une maj en bdd
		var msgCible = $(this).attr('id');
		var imgCible = $("#"+msgCible+" .img_statut_msg").attr('id');
		
			$("#"+imgCible).attr({
				src: "css/img/mail_open.png"
			});
	
		//on recupere la cible et la taille actuelle et auto
		var obj = $(this),
	    curHeight = obj.height(),
	    autoHeight = obj.css('height', 'auto').height();
		//on verifie si le bloc est deplié ou pas
		//si non on deplie
		if(curHeight == 50){
			obj.height(curHeight).animate({
					height: autoHeight
				}, 750);
		//si oui on replie
		}else{
			obj.height(curHeight).animate({
				height: '50'
			}, 750);
		}
	});
//affichage bloc new message
	$("#btn_new_msg").click(function(){
		$("#wrapper_form_new").slideDown();
	});
	$("#btn_close_new_msg").click(function(){
		$("#wrapper_form_new").slideUp();
	});
//fermeture scriptjquery
});
