<?php
// Mailer Function

add_filter('wp_mail_from', 'doEmailFilter');
add_filter('wp_mail_from_name', 'doEmailNameFilter');

function doEmailFilter(){
	return 'careers@secureitsource.com';
}

function doEmailNameFilter(){
	return 'secureITsource Administrator';
}

add_filter( 'wp_mail_content_type', 'my_mail_content_type' );
function my_mail_content_type( $content_type ) {
	return 'text/html';
}

add_filter( 'wp_mail_charset', 'change_mail_charset' );
function change_mail_charset( $charset ) {
	return 'iso-8859-1';
}

//Function mailing
function form_email() {
	if(! empty($_POST['verify'])){
		if ( !wp_verify_nonce( $_POST['verify'], 'contact' ) ) die ( 'Security check' );
		
		$type = $_POST['type'];
		$fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];
		$email = $_POST['email'];
		$file_attach = isset($_POST['file_attach']) ? array(ABSPATH . 'wp-content/uploads/'. date("Y/m") ."/". $_POST['file_attach']):"";
		$postdt = array( 
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'company' => $_POST['company'],
			'email' => $_POST['email'],
			'country' => $_POST['country'],
			'interested' => $_POST['interested'],
			'comment' => $_POST['comment'],
			'phone1' => $_POST['phone1'],
			'phone2' => $_POST['phone2'],
			'city' => $_POST['city'],
			'state' => $_POST['state'],
			'zip_code' => $_POST['zip_code']
		);
		
		if($type == 'careers'){
			$admin_mail = of_get_option('email_career'); 
			$subject = of_get_option('subject_career');
			$get_theme = of_get_option('email_template_career');
		}else{
			$admin_mail = of_get_option('email_contact'); 
			$subject = of_get_option('subject_contact'); 
			$get_theme = of_get_option('email_template_contact'); 
		}
		
		preg_match_all("/\[(.*?)\]/", $get_theme, $matches);
		for($i = 0; $i < count($matches[1]); $i++){
			$get_theme = str_replace($matches[0][$i], $postdt[$matches[1][$i]], $get_theme);
		}
		
		$headers .= 'From: ' . $fullname . ' <smtpsetting@secureitsource.com>';
		$headers .= 'Bcc: ' . $admin_mail;
		$headers .= 'Bcc: ' . $fullname . ' <' . $mail . '>';
		$headers .= 'Content-type: text/html; charset=iso-8859-1';
		
		$message = '';
		$message .= '<html><body>';
		$message .= $get_theme;
		$message .='</body></html>';
		 
		if(wp_mail($admin_mail, $subject, $message , $headers , $file_attach)){
			echo '<span class="alert alert-success">Thank you for leaving a message.</span>';
			wp_die(); 
		}else{
			echo '<span class="alert alert-danger">Please try again.</span>';
			wp_die(); 
		}
	}
}
add_action('wp_ajax_form_email', 'form_email');
add_action('wp_ajax_nopriv_form_email', 'form_email');

function secure_upload_file(){
	if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		  $uploadedfile = $_FILES['file'];
		  $upload_overrides = array( 'test_form' => false );
		  $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		  if ( isset($movefile['url']) ) {
		  	$x = explode("/", $movefile['url']);
		  	$file_name = end($x);
		  	$msg = '<span class="alert alert-success">Success upload.</span><input type="hidden" name="file_attach" value="'.$file_name.'">';
		  } else {
		    $msg = '<span class="alert alert-danger">Please try again.</span>';
		  }
	echo $msg;
	wp_die();
}

add_action('wp_ajax_secure_upload_file', 'secure_upload_file');
add_action('wp_ajax_nopriv_secure_upload_file', 'secure_upload_file');
