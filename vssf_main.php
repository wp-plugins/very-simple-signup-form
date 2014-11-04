<?php

// Start session for captcha validation
session_start();
$_SESSION['vssf-rand'] = isset($_SESSION['vssf-rand']) ? $_SESSION['vssf-rand'] : rand(100, 999);

// The shortcode
function vssf_shortcode($atts) {
	extract(shortcode_atts(array(
		"email_to" 			=> get_bloginfo('admin_email'),
		"label_name" 			=> __('Name', 'signupform') ,
		"label_email" 			=> __('Email', 'signupform') ,
		"label_phonenumber" 		=> __('Phone', 'signupform') ,
		"label_sum"	 		=> __('Fill in number', 'signupform') ,
		"label_submit" 			=> __('Signup', 'signupform') ,
		"error_empty" 			=> __("Please fill in all the required fields", "signupform"),
		"error_form_name" 		=> __('Please enter at least 3 characters', 'signupform') ,
		"error_form_phonenumber" 	=> __('Please enter at least 3 characters', 'signupform') ,
		"error_form_sum" 		=> __("Please fill in the correct number", "signupform"),
		"error_email" 			=> __("Please enter a valid email", "signupform"),
		"success" 				=> __("Thanks for your signup! I will contact you as soon as I can.", "signupform"),
	), $atts));

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
			
		$error = false;
		$required_fields = array("form_name", "email", "form_phonenumber");
		$security_fields = array("form_firstname", "form_lastname");
		$sum_fields = array("form_sum");

		foreach ($required_fields as $required_field) {
			$value = stripslashes(trim($post_data[$required_field]));
		
		// Displaying error message if validation failed for each input field
			if(((($required_field == "form_name") || ($required_field == "form_phonenumber")) && strlen($value)<3) || empty($value)) {
				$error_class[$required_field] = "error";
				$error_msg[$required_field] = ${"error_".$required_field};
				$error = true;
				$result = $error_empty;
			}
			$form_data[$required_field] = $value;
		}

		foreach ($sum_fields as $sum_field) {
			$value = stripslashes(trim($post_data[$sum_field]));

		// Displaying error message if validation failed for each input field
			if ($_POST['form_sum'] != $_SESSION['vssf-rand']) {
				$error_class[$sum_field] = "error";
				$error_msg[$sum_field] = ${"error_".$sum_field};
				$error = true;
				$result = $error_empty;
			}
			$form_data[$sum_field] = $value;
		}

		foreach ($security_fields as $security_field) {
			$value = stripslashes(trim($post_data[$security_field]));

		// Not sending message if validation failed for each input field
			if ((($security_field == "form_firstname") || ($security_field == "form_lastname")) && strlen($value)>0) {
				$error_class[$security_field] = "error";
				$error = true;
			}
			$form_data[$security_field] = $value;
		}

		// Sending message to admin
		if ($error == false) {
			$email_subject = "[" . get_bloginfo('name') . "] " . $form_data['form_name'];
			$email_message = $form_data['form_name'] . "\n\n" . $form_data['email'] . "\n\n" . $form_data['form_phonenumber'] . "\n\nIP: " . vssf_get_the_ip();
			$headers  = "From: ".$form_data['form_name']." <".$form_data['email'].">\n";
			$headers .= "Content-Type: text/plain; charset=UTF-8\n";
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			wp_mail($email_to, $email_subject, $email_message, $headers);
			$result = $success;
			$sent = true;
		}
	}

	// Message 
	if($result != "") {
		$info .= '<div class="vssf_info">'.$result.'</div>';
	}

	// The signup form with error messages

	$email_form = '<form class="vssf" id="vssf" method="post" action="">
		<div>
			<label for="vssf_name">'.$label_name.': <span class="error '.((isset($error_class['form_name']))?"":" hide").'" >'.$error_form_name.'</span></label>
			<input type="text" name="form_name" id="vssf_name" class="'.$error_class['form_name'].'" maxlength="50" value="'.$form_data['form_name'].'" />
		</div>
		<div>
			<label for="vssf_email">'.$label_email.': <span class="error '.((isset($error_class['email']))?"":" hide").'" >'.$error_email.'</span></label>
			<input type="text" name="email" id="vssf_email" class="'.$error_class['email'].'" maxlength="50" value="'.$form_data['email'].'" />
		</div>
		<div>
			<label for="vssf_phonenumber">'.$label_phonenumber.': <span class="error '.((isset($error_class['form_phonenumber']))?"":" hide").'" >'.$error_form_phonenumber.'</span></label>
			<input type="text" name="form_phonenumber" id="vssf_phonenumber" class="'.$error_class['form_phonenumber'].'" maxlength="20" value="'.$form_data['form_phonenumber'].'" />
		</div>
		<div>
			<label for="vssf_sum">'.$label_sum.' '. $_SESSION['vssf-rand'].': <span class="error '.((isset($error_class['form_sum']))?"":" hide").'" >'.$error_form_sum.'</span></label>
			<input type="text" name="form_sum" id="vssf_sum" class="'.$error_class['form_sum'].'" maxlength="20" value="'.$form_data['form_sum'].'" />
		</div>
		<div>
			<input type="text" name="form_firstname" id="vssf_firstname" class="'.$error_class['form_firstname'].'" maxlength="20" value="'.$form_data['form_firstname'].'" />
		</div>

		<div>
			<input type="text" name="form_lastname" id="vssf_lastname" class="'.$error_class['form_lastname'].'" maxlength="20" value="'.$form_data['form_lastname'].'" />
		</div>
		<div>
			<input type="submit" value="'.$label_submit.'" name="signup_send" class="vssf_send" id="vssf_send" />
		</div>
	</form>';
	
	// Send message and erase captcha session or display form with error messages
	if($sent == true) {
		unset($_SESSION['vssf-rand']);
		return $info;
	} else {
		return $info.$email_form;
	}
} 

add_shortcode('signup', 'vssf_shortcode');

?>