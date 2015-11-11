jQuery(document).ready(function() {
   jQuery('#first-name').on('focusout', function(event){
     var first_name = jQuery('#first-name');
     first_name.removeClass('important');
     if( first_name.val() === '' ){
       first_name.addClass('required').removeClass('valid');
     } else {
       first_name.removeClass('required').addClass('valid');
     }
   });
   
   jQuery('#company').on('focusout', function(event){
     var company = jQuery('#company');
     company.removeClass('important');
     if( company.val() === '' ){
       company.addClass('required').removeClass('valid');
     } else {
       company.removeClass('required').addClass('valid');
     }
   });

   jQuery('#country').on('focusout', function(event){
     var country = jQuery('#country');
     country.removeClass('important');
     if( country.val() === '' ){
       country.addClass('required').removeClass('valid');
     } else {
       country.removeClass('required').addClass('valid');
     }
   });

   jQuery('#interested').on('focusout', function(event){
     var interested = jQuery('#interested');
     interested.removeClass('important');
     if( interested.val() === '' ){
       interested.addClass('required').removeClass('valid');
     } else {
       interested.removeClass('required').addClass('valid');
     }
   });

   jQuery('#last-name').on('focusout', function(event){
     var last_name = jQuery('#last-name');
     last_name.removeClass('important');
     if( last_name.val() === '' ){
       last_name.addClass('required').removeClass('valid');
     } else {
       last_name.removeClass('required').addClass('valid');
     }
   });
   jQuery('#phone1').on('focusout', function(event){
     var phone1 = jQuery('#phone1');
     phone1.removeClass('important');
     if( phone1.val() === '' ){
       phone1.addClass('required').removeClass('valid');
     } else {
       phone1.removeClass('required').addClass('valid');
     }
   });
   jQuery('#phone2').on('focusout', function(event){
     var phone2 = jQuery('#phone2');
    phone2.removeClass('important');
     if( phone2.val() === ''){
       phone2.addClass('required').removeClass('valid');
     } else {
       phone2.removeClass('required').addClass('valid');
     }
   });
   jQuery('#zip_code').on('focusout', function(event){
     var zip_code = jQuery('#zip_code');
    zip_code.removeClass('important');
     if( zip_code.val() === ''){
       zip_code.addClass('required').removeClass('valid');
     } else {
       zip_code.removeClass('required').addClass('valid');
     }
   });
    
   jQuery('#email').on('focusout', function(event){
     var email = jQuery('#email');
     var vEmail = email.val();
     email.removeClass('important');
     var cEmail = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;
     if( vEmail === '' || !cEmail.test(vEmail) ){
       email.addClass('required').removeClass('valid');
     } else {
       email.removeClass('required').addClass('valid');
     }
   });
   
   jQuery("#submit-contact").click( function(e) {
     e.preventDefault();
     jQuery("#message").show();
     var required = jQuery("#form-contact").find(".required").length ;
     var valid = jQuery("#form-contact").find(".valid") ;
     var empty = jQuery("#form-contact").find(".important") ;
     var post_data = jQuery('#form-contact').serialize();
     var form_action = '/wp-admin/admin-ajax.php'; 
     var form_method = "POST";
     
     if( required == 0 && empty.length == 0){
       $.ajax({
         type: form_method,
         url: form_action,
         cache: false,
         data: post_data,
         success: function(response) {
           jQuery("#message").html(response);
          $('#form-contact').trigger("reset");
           jQuery("#message-upload").html("");
          valid.each(function(){
            jQuery(this).removeClass('valid').addClass("important");
          });
          $('html, body').animate({scrollTop:(jQuery("#message").offset().top - 200)}, 1000);
     	  jQuery("#message").fadeOut(7000);
         }
       });
     }else{
        empty.each(function(){
          jQuery(this).addClass('required');
        });
        jQuery("#message").html('<span class="alert alert-danger">Please fill out the required field.</span>');
     	$('html, body').animate({scrollTop:(jQuery("#message").offset().top - 200)}, 1000);
     	jQuery("#message").fadeOut(7000);
     } 

   });
  

 });
