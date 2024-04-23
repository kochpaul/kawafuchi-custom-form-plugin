<?php

/**
 * Plugin Name: KawafuchiLawContactForm
 * Description: This plugin provides an interactive contact form including form validation and sanding via text and email.
 **/


function ideapro_contact_form()
{

    $content = '';

    // 1. question: Do you have assets/ activity in Hawaii?
    $content = '<div class="whole_container">';
    $content .= '<div class="question" id="has_assets_in_hawaii_question">';
    $content .= '<h3 class="ques_text">Do you have employees in Hawaii?</h3>';
    $content .= '<button ontouchstart="showQuestion(\'audit_question\', true, \'has_assets_in_hawaii_question\')" onclick="showQuestion(\'audit_question\', true, \'has_assets_in_hawaii_question\')" class="y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'has_assets_in_asia_question\', false, \'has_assets_in_hawaii_question\')"class = "y_n_Button">No</button>';
    $content .= '</div>';

    // 2. question: Do you have assets/ activity in Asia?
    $content .= '<div class="question" id="has_assets_in_asia_question" style="display: none;">';
    $content .= '<h3 class="ques_text">Do you have assets or activity in Asia?</h3>';
    $content .= '<button onclick="showQuestion(\'green_card_question\', true, \'has_assets_in_asia_question\')"class = "y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'no_help_region\', false, \'has_assets_in_asia_question\')"class = "y_n_Button">No</button>';
    $content .= '</div>';

    // 3. question: Are you a green card holder, US citizen, or have Investments in the US?
    $content .= '<div class="question" id="green_card_question" style="display: none;">';
    $content .= '<h3 class="ques_text">Are you a green card holder, US citizen, or have Investments in the US?</h3>';
    $content .= '<button onclick="showQuestion(\'audit_question\', true, \'green_card_question\')"class = "y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'no_help_green_card\', false, \'green_card_question\')"class = "y_n_Button">No</button>';
    $content .= '</div>';

    // 4. question: Are You In An Ongoing Audit?
    $content .= '<div class="question" id="audit_question" style="display: none;">';
    $content .= '<h3 class="ques_text">Are You In An Ongoing Audit?</h3>';
    $content .= '<button onclick="showQuestion(\'contact_form\', true, \'audit_question\')"class = "y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'information_question\', false, \'audit_question\')"class = "y_n_Button">No</button>';
    $content .= '</div>';

    // 5. question: Are You Looking For Information?
    $content .= '<div class="question" id="information_question" style="display: none;">';
    $content .= '<h3 class="ques_text">Are You Looking For Information?</h3>';
    $content .= '<button onclick="showQuestion(\'contact_form_with_questions\', true, \'information_question\')"class = "y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'contact_form\', false, \'information_question\')"class = "y_n_Button">No</button>';
    $content .= '</div>';


    // FAQ Link 
    $content .= '<div id="faq_link" style="display: none;">';
    $content .= '<h4>You can find Information at our <a href=\'faq-page-url\'>FAQ-Page</a></h4>';
    $content .= '</div>';

    // Contact form 
    $content .= '<div id="contact_form" style="display: none;">';

    // First name
    $content .= '<div class="group">';
    $content .= '<div class="group-element">';
    $content .= '<label for="first_name">First Name</label>';
    $content .= '<input type="text" name="first_name" id="first_name" placeholder="Enter your first name"/>';
    $content .= '</div>';

    // Last name
    $content .= '<div class="group-element">';
    $content .= '<label for="last_name">Last Name</label>';
    $content .= '<input type="text" name="last_name" id="last_name" placeholder="Enter your last name" />';
    $content .= '</div>';
    $content .= '</div>';

    // Phone number 
    $content .= '<div class="group">';
    $content .= '<div class="group-element">';
    $content .= '<label for="your_phone">Your Phone</label>';
    $content .= '<input type="tel" name="your_phone" id="your_phone" placeholder="Enter your phone number" />';
    $content .= '</div>';

    // Email address
    $content .= '<div class="group-element">';
    $content .= '<label for="your_email">Your E-Mail</label>';
    $content .= '<input type="email" name="your_email" id="your_email" placeholder="Enter your email address" />';
    $content .= '</div>';
    $content .= '</div>';

    // Claim Type & Amount
    $content .= '<label>Audit Type:</label>';
    $content .= '<div class ="radio_container">';
    $content .= '<div class ="radio_item">';


    // Civil option
    $content .= '<input type="radio" id="civil" name="claim_type" value="Civil Dollar Amount">';
    $content .= '<input type="radio" id="fraud" name="claim_type" value="Fraud/Criminal">';
    $content .= '</div>';

    // Fraud/ Criminal option
    $content .= '<div class ="radio_item">';
    $content .= '<label for="civil">Civil Dollar Amount</label>';
    $content .= '<label for="fraud">Fraud/Criminal</label>';
    $content .= '</div>';
    $content .= '</div>';

    // Dollar amount
    $content .= '<label for="dollar_amount">Tax liability:</label>';
    $content .= '<input type="number" name="dollar_amount" id="dollar_amount" placeholder="Enter dollar amount">';

    // Notification date
    $content .= '<label for="irs_notification_day">IRS or State Tax Notification Date</label>';
    $content .= '<input type="date" name="irs_notification_day" id="irs_notification_day" placeholder="Select notification day" />';

    // Response date
    $content .= '<label for="irs_response_day">Date to Respond to IRS or State</label>';
    $content .= '<input type="date" name="irs_response_day" id="irs_response_day" placeholder="Select response day" />';

    // Message
    $content .= '<label for="message">Message (max 500 characters)</label>';
    $content .= '<textarea name="message" id="message" maxlength="500" style="height: 100px; resize: none;" placeholder="Enter your message (max 500 characters)"></textarea>';

    // Submit button
    $content .= '<input type="submit" name="contact_form_submit" id="contact_form_submit" onclick="submit_contact_form()" value="SUBMIT">';

    $content .= '<div id="response_div"></div>';

    $content .= '</div>';


    // Can't help 
    $content .= '<h3 id="no_help_region" style="display: none;">Thank you for your inquiry. <br> Unfortunately, your request has been declined as there are no assets or activity in both Hawaii and Asia. Thank you for your understanding.</h3>';
    $content .= '<h3 id="no_help_green_card" style="display: none;">Thank you for your inquiry. <br> Unfortunately, it seems we may not be able to assist you at this time, as it appears you do not hold a green card, U.S. citizenship, or have investments in the U.S. Thank you for considering our services.</h3>';

    $content .= '</div>';

    // Styles
    $content .= '<style>';
    $content .= ':root {
        --primary-color: #1E2E45;
        --secondary-color: #9A9162;
        --text-color: white;
        --fourth-color: black;
        --hover-color: #8B7C2B;

    }';
    $content .= '.whole_container {width: 800px}';
    $content .= '@media (max-width: 1000px) {.whole_container {width: 500px}}';
    $content .= '@media (max-width: 600px) {.whole_container {width: 100%}}';

    $content .= '.ques_text {
        font-family: Arial, sans-serif;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;
        color: var(--text-color);
        }';
    $content .= '.question {
        background-color: var(--primary-color);
        border-radius: 15px;
        border: 2px solid black;
        padding: 30px;
        max-width: 100%;
        text-align: center;
        }';
    $content .= '.y_n_Button {
        background-color: var(--secondary-color);
        border: 1px solid black;
        color: var(--fourth-color);
        border-radius: 5px;
        padding: 15px 30px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        margin: 0 10px;
        font-family: Arial, sans-serif;
        font-size: 17px;
	    font-weight: bold;
    }';
    $content .= '.y_n_Button:hover {
        background-color: var(--hover-color);
        }';
    $content .= '#sorry{
        font-family: Arial, sans-serif;
        font-size: 30px;
	    font-weight: bold;
        color: var(--fourth-color);
        text-align: center;
    }';
    $content .= '#faq_link h4{
        font-family: Arial, sans-serif;
        font-size: 25px;
        color: var(--fourth-color);
    }';
    $content .= '#faq_link a{
            color:#9A9162;
    }';
    $content .= '#faq_link a:hover{
        color: var(--hover-color);
    }';
    $content .= '#contact_form{
        font-family: Arial, sans-serif;
    }';

    $content .= '.radio_container {
        display: grid;
        grid-template-columns: auto auto; 
        grid-gap: 5px;
        max-width: 200px;

    }';

    $content .= '.radio_item { 
        display: flex;
        flex-direction: column;
    }';

    $content .= '.radio_item label {
        margin-bottom: 5px;
    }';

    $content .= '.radio_item input {
        margin-top: 5px;
    }';

    $content .= '#message{
        border: 2px solid black;
    }';
    $content .= '#contact_form_submit{
        font-family: Arial, sans-serif;
        color: white;
        background-color:var(--fourth-color);
        }';
    $content .= 'label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 17px; color: var(--fourth-color);}';
    $content .= 'input, select, textarea { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; border: 2px solid black; background-color: white; ;}';
    $content .= '.group { display: flex; gap: 20px}';
    $content .= '.group-element { display: flex; flex-direction: column; width: 100%; color: var(--fourth-color);}';
    $content .= '@media (prefers-color-scheme: light) {
    //     :root {
    //         --primary-color: #1E2E45;
    //         --secondary-color: #9A9162;
    //         --text-color: black;
    //         --fourth-color: white;
    //     }
    // }';

    $content .= '@media (prefers-color-scheme: dark) {
        :root {
            --primary-color: white;
            --secondary-color: #1E2E45;
            --text-color: black;
            --fourth-color: white;
            --hover-color: #152236;

        }
        #contact_form_submit{
            background-color:#9A9162;
            border-color: white;
            }
        #faq_link a:hover{
            color: #b8b074;
        }

    }';
    $content .= '</style>';

    // Add jquery
    $content .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

    // JavaScript to show/hide form based on button clicks
    $content .= '<script>';
    $content .= 'var userAnswers1 = {';
    $content .= 'has_assets_in_hawaii_question: false,';
    $content .= 'has_assets_in_asia_question: false,';
    $content .= 'green_card_question: false,';
    $content .= 'audit_question: false,';
    $content .= 'information_question: false';
    $content .= '};';

    $content .= 'var userAnswers = {};';

    $content .= 'function showQuestion(questionID, answer, initialQuestionID) {';
    $content .= 'userAnswers[initialQuestionID] = answer;';
    $content .= '    $(".question").hide();';
    $content .= '    if(questionID === "contact_form_with_questions") {';
    $content .= '       $("#faq_link").show();';
    $content .= '       $("#contact_form").show();';
    $content .= '       } else {';

    $content .= '    $("#" + questionID).show();};';
    $content .= 'console.log(userAnswers);';

    $content .= '};';
    $content .= 'if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {';
    $content .= '    document.documentElement.setAttribute("data-theme", "dark");';
    $content .= '} else {';
    $content .= '    document.documentElement.setAttribute("data-theme", "light");';
    $content .= '}';
    $content .= '</script>';

    return $content;
}
add_shortcode('KawafuchiLawContactForm', 'ideapro_contact_form');


function form_add_javascript()
{
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kawafuchilaw.com/wp-content/plugins/KawafuchiLawContactForm/js/scripts.js"></script>
    <!-- <script src="https://software-project.local/wp-content/plugins/KawafuchiLawContactForm/js/scripts.js"></script> -->

    <?php
}
add_action('wp_footer', 'form_add_javascript');

?>