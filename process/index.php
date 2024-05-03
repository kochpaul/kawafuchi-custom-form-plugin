<?php 
    $path = preg_replace('/wp-content.*$/','',__DIR__);
    require_once($path."wp-load.php");

    if(isset($_POST['ideaproContactSubmit']) && $_POST['ideaproContactSubmit'] == "1")
    {
        /* get the information from the post submit */
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $your_phone = sanitize_text_field($_POST['your_phone']);
        $your_email = sanitize_email($_POST['your_email']);
        $irs_notification_day = $_POST['irs_notification_day'];
        $irs_response_day = $_POST['irs_response_day'];
        $dollar_amount = $_POST['dollar_amount'];
        $claim_type = $_POST['claim_type'];
        $userMessage = sanitize_textarea_field($_POST['message']);
        $has_assets_in_hawaii_question = $_POST['has_assets_in_hawaii_question']; 
		$has_assets_in_asia_question = $_POST['has_assets_in_asia_question']; 
		$green_card_question = $_POST['green_card_question']; 
		$audit_question = $_POST['audit_question']; 
		$information_question = $_POST['information_question']; 
                
        // email / phone address
        $to = 'kkawafuchi@aol.com, 8086888986@tmomail.net';

        $subject = 'New Request from '.$first_name.' '.$last_name;
        $message = '';

        $message .= "The following request is currently pending:\r\n\r\n";
        $message .= "Date and Time: ".date("Y-m-d H:i:s")."\r\n";
        $message .= "First Name: ".$first_name."\r\n";
        $message .= "Last Name: ".$last_name."\r\n";
        $message .= "Email: ".$your_email."\r\n";
        $message .= "Phone: ".$your_phone."\r\n";
        $message .= "IRS Notification Day: ".$irs_notification_day."\r\n"; 
        $message .= "IRS Response Day: ".$irs_response_day."\r\n"; 
        $message .= "Dollar Amount: ".$dollar_amount."\r\n";
        $message .= "Claim Type: ".$claim_type."\r\n\r\n";
        
		// Question form flow
		$message .= "Questions:";
		$message .= "Has assets or activity in Hawaii? " . ($has_assets_in_hawaii_question === "true" ? "Yes" : "No") ." \r\n" . $has_assets_in_asia_question;
		$message .= "Has assets or activity in Asia? " . ($has_assets_in_asia_question  === "true" ? "Yes" : "No") ." \r\n";
		$message .= "Is green card holder, US citizen, or has Investments in the US? " . ($green_card_question === "true" ? "Yes" : "No") ." \r\n"; 
		$message .= "Is in audit? " . ($audit_question === "true" ? "Yes" : "No")." \r\n";
		$message .= "Is looking for information? " . ($information_question === "true" ? "Yes" : "No")." \r\n\r\n";
		
		$message .= "User Message: "."\r\n".$userMessage."\r\n";

        // Mail an Admin senden	
        wp_mail($to,$subject,$message);

		// error_log($message);

        /* return something for the user */
        $return = [];
        $return['success'] = 1;
        $return['message'] = 'Thank you for submitting your information! <br/> Should there be a delay in addressing your legal inquiries, I recommend seeking assistance from another attorney to ensure your needs are promptly met.';

        echo json_encode($return);
    }
?>
