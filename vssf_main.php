<?php

// Start session for captcha validation
if (!isset ($_SESSION)) session_start(); 
$_SESSION['vssf-rand'] = isset($_SESSION['vssf-rand']) ? $_SESSION['vssf-rand'] : rand(100, 999);

// The shortcode
function vssf_shortcode($vssf_atts) {
	$vssf_atts = shortcode_atts( array( 
		"email_to" 			=> get_bloginfo('admin_email'),
		"form_subject_admin" 		=> __('New Signup', 'signupform'),
		"form_subject_submitter" 	=> __('Your Signup', 'signupform'),
		"label_name" 			=> __('Name', 'signupform'),
		"label_email" 			=> __('Email', 'signupform'),
		"label_phonenumber" 		=> __('Phone', 'signupform'),
		"label_sum"	 		=> __('Fill in number', 'signupform'),
		"label_submit" 			=> __('Signup', 'signupform'),
		"error_empty" 			=> __('Please fill in all the required fields', 'signupform'),
		"error_form_name" 		=> __('Please enter at least 2 characters', 'signupform'),
		"error_form_phonenumber" 	=> __('Please enter at least 2 characters', 'signupform'),
		"error_form_sum" 		=> __('Please fill in the correct number', 'signupform'),
		"error_email" 			=> __('Please enter a valid email', 'signupform'),
		"success" 				=> __('Thank you for your signup! You will receive a response as soon as possible.', 'signupform'),
	), $vssf_atts);

	// Set some variables 
	$form_data = array(
		'form_name' => '',
		'email' => '',
		'form_phonenumber' => '',
		'form_sum' => '',
		'form_firstname' => '',
		'form_lastname' => '',
	);
	$error = false;
	$sent = false;
	$info = '';
	$required_fields = array("form_name", "email", "form_phonenumber");
	$security_fields = array("form_firstname", "form_lastname");
	$sum_fields = array("form_sum");

	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['signup_send']) ) {
	
		// Get posted data and sanitize them
		$post_data = array(
			'form_name' 		=> sanitize_text_field($_POST['form_name']),
			'email' 			=> sanitize_email($_POST['email']),
			'form_phonenumber' 	=> sanitize_text_field($_POST['form_phonenumber']),
			'form_sum'		 	=> sanitize_text_field($_POST['form_sum']),
			'form_firstname' 	=> sanitize_text_field($_POST['form_firstname']),
			'form_lastname' 	=> sanitize_text_field($_POST['form_lastname'])
		);

		foreach ($required_fields as $required_field) {
			$value = $post_data[$required_field];
		
			// Displaying error message if validation failed for each input field
			if (((($required_field == "form_name") || ($required_field == "form_phonenumber")) && strlen($value)<2) || empty($value)) {
				$error_class[$required_field] = "error";
				$error = true;
				$result = $vssf_atts['error_empty'];
			}
			$form_data[$required_field] = $value;
		}

		foreach ($sum_fields as $sum_field) {
			$value = $post_data[$sum_field];

			// Displaying error message if validation failed for each input field
			if ($_POST['form_sum'] != $_SESSION['vssf-rand']) { 
				$error_class[$sum_field] = "error";
				$error = true;
				$result = $vssf_atts['error_empty'];
			}
			$form_data[$sum_field] = $value;
		}

		foreach ($security_fields as $security_field) {
			$value = $post_data[$security_field];

			// Not sending message if validation failed for each input field
			if ((($security_field == "form_firstname") || ($security_field == "form_lastname")) && strlen($value)>0) {
				$error_class[$security_field] = "error";
				$error = true;
			}
			$form_data[$security_field] = $value;
		}

		// Sending message to admin
		if ($error == false) {
			$email_subject_admin = "[".get_bloginfo('name')."] " . $vssf_atts['form_subject_admin'];
			$email_subject_submitter = "[".get_bloginfo('name')."] " . $vssf_atts['form_subject_submitter'];
			$email_message_admin = $form_data['form_name'] . "\n\n" . $form_data['email'] . "\n\n" . $form_data['form_phonenumber'] . "\n\nIP: " . vssf_get_the_ip();
			$email_message_submitter = $vssf_atts['success'] . "\n\n" . $form_data['form_name'] . "\n\n" . $form_data['email'] . "\n\n" . $form_data['form_phonenumber'] . "\n\nIP: " . vssf_get_the_ip();
			$headers  = "From: ".$form_data['form_name']." <".$form_data['email'].">\n";
			$headers .= "Reply-To: ".$form_data['form_name']." <".$form_data['email'].">\n";
			$headers .= "Content-Type: text/plain; charset=UTF-8\n";
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			wp_mail($vssf_atts['email_to'], $email_subject_admin, $email_message_admin, $headers);
			wp_mail($form_data['email'], $email_subject_submitter, $email_message_submitter, $headers);
			$result = $vssf_atts['success'];
			$sent = true;
		}
	}

	// Display message but only if needed 
	if(!empty($result)) {
		$info = '<p class="vssf_info">'.$result.'</p>';
	}

	// The contact form with error messages
	$email_form = '<form class="vssf" id="vssf" method="post" action="">
		
		<p><label for="vssf_name">'.$vssf_atts['label_name'].': <span class="'.((isset($error_class['form_name'])) ? "error" : "hide").'" >'.$vssf_atts['error_form_name'].'</span></label></p>
		<p><input type="text" name="form_name" id="vssf_name" class="'.((isset($error_class['form_name'])) ? "error" : "").'" maxlength="50" value="'.$form_data['form_name'].'" /></p>
		
		<p><label for="vssf_email">'.$vssf_atts['label_email'].': <span class="'.((isset($error_class['email'])) ? "error" : "hide").'" >'.$vssf_atts['error_email'].'</span></label></p>
		<p><input type="text" name="email" id="vssf_email" class="'.((isset($error_class['email'])) ? "error" : "").'" maxlength="50" value="'.$form_data['email'].'" /></p>
		
		<p><label for="vssf_phonenumber">'.$vssf_atts['label_phonenumber'].': <span class="'.((isset($error_class['form_phonenumber'])) ? "error" : "hide").'" >'.$vssf_atts['error_form_phonenumber'].'</span></label></p>
		<p><input type="text" name="form_phonenumber" id="vssf_phonenumber" class="'.((isset($error_class['form_phonenumber'])) ? "error" : "").'" maxlength="20" value="'.$form_data['form_phonenumber'].'" /></p>
		
		<p><label for="vssf_sum">'.$vssf_atts['label_sum'].' '. $_SESSION['vssf-rand'].': <span class="'.((isset($error_class['form_sum'])) ? "error" : "hide").'" >'.$vssf_atts['error_form_sum'].'</span></label></p>
		<p><input type="text" name="form_sum" id="vssf_sum" class="'.((isset($error_class['form_sum'])) ? "error" : "").'" maxlength="50" value="'.$form_data['form_sum'].'" /></p>
		
		<p><input type="text" name="form_firstname" id="vssf_firstname" class="'.((isset($error_class['form_firstname'])) ? "error" : "").'" maxlength="50" value="'.$form_data['form_firstname'].'" /></p>
		
		<p><input type="text" name="form_lastname" id="vssf_lastname" class="'.((isset($error_class['form_lastname'])) ? "error" : "").'" maxlength="50" value="'.$form_data['form_lastname'].'" /></p>
		
		<p><input type="submit" value="'.$vssf_atts['label_submit'].'" name="signup_send" class="vssf_send" id="vssf_send" /></p>
		
	</form>';
	
	// Send message and unset captcha variabele or display form with error message
	if(isset($sent) && $sent == true) {
		unset($_SESSION['vssf-rand']);
		return $info;
	} else {
		return $info . $email_form;
	}
} 

add_shortcode('signup', 'vssf_shortcode');

?>