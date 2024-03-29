<?php

/**
 * Plugin Name: custom_contact_form
 * Description: This plugin provides an interactive contact form including form validation and sanding via text and email.
 **/


function ideapro_contact_form()
{

    $content = '';

    // 1. question: Do you have assets/ activity in Hawaii?
    $content .= '<div class="question" id="has_assets_in_hawaii_question">';
    $content .= '<h3 class="ques_text">Do you have assets or activity in Hawaii?</h3>';
    $content .= '<button onclick="showQuestion(\'audit_question\', true, \'has_assets_in_hawaii_question\')" class = "y_n_Button">Yes</button>'; // Hier wurde showQuestion korrigiert
    $content .= '<button onclick="showQuestion(\'has_assets_in_asia_question\', false, \'has_assets_in_hawaii_question\')"class = "y_n_Button">No</button>'; // Hier wurde showQuestion korrigiert
    $content .= '</div>';

    // 2. question: Do you have assets/ activity in Asia?
    $content .= '<div class="question" id="has_assets_in_asia_question" style="display: none;">';
    $content .= '<h3 class="ques_text">Do you have assets or activity in Asia?</h3>';
    $content .= '<button onclick="showQuestion(\'green_card_question\', true, \'has_assets_in_asia_question\')"class = "y_n_Button">Yes</button>'; // Hier wurde showQuestion korrigiert
    $content .= '<button onclick="showQuestion(\'sorry\', false, \'has_assets_in_asia_question\')"class = "y_n_Button">No</button>'; // Hier wurde showQuestion korrigiert
    $content .= '</div>';

    // 3. question: Are you a green card holder, US citizen, or have Investments in the US?
    $content .= '<div class="question" id="green_card_question" style="display: none;">'; // Die Klasse "question" wurde hinzugefügt
    $content .= '<h3 class="ques_text">Are you a green card holder, US citizen, or have Investments in the US?</h3>';
    $content .= '<button onclick="showQuestion(\'audit_question\', true, \'green_card_question\')"class = "y_n_Button">Yes</button>';
    $content .= '<button onclick="showQuestion(\'sorry\', false, \'green_card_question\')"class = "y_n_Button">No</button>'; // Hier wurde showQuestion korrigiert
    $content .= '</div>';

    // 4. question: Are You In An Ongoing Audit?
    $content .= '<div class="question" id="audit_question" style="display: none;">'; // Die Klasse "question" wurde hinzugefügt
    $content .= '<h3 class="ques_text">Are You In An Ongoing Audit?</h3>';
    $content .= '<button onclick="showQuestion(\'contact_form\', true, \'audit_question\')"class = "y_n_Button">Yes</button>'; // Hier wurde showQuestion korrigiert
    $content .= '<button onclick="showQuestion(\'information_question\', false, \'audit_question\')"class = "y_n_Button">No</button>'; // Hier wurde showQuestion korrigiert
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

    // contact form 
    $content .= '<div id="contact_form" style="display: none;">';

    $content .= '<div class="group">';
    $content .= '<div class="group-element">';
    $content .= '<label for="first_name">First Name</label>';
    $content .= '<input type="text" name="first_name" id="first_name" placeholder="Enter your first name"/>';
    $content .= '</div>';

    $content .= '<div class="group-element">';
    $content .= '<label for="last_name">Last Name</label>';
    $content .= '<input type="text" name="last_name" id="last_name" placeholder="Enter your last name" />';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="group">';
    $content .= '<div class="group-element">';
    $content .= '<label for="your_phone">Your Phone</label>';
    $content .= '<input type="tel" name="your_phone" id="your_phone" placeholder="Enter your phone number" />';
    $content .= '</div>';

    $content .= '<div class="group-element">';
    $content .= '<label for="your_email">Your E-Mail</label>';
    $content .= '<input type="email" name="your_email" id="your_email" placeholder="Enter your email address" />';
    $content .= '</div>';
    $content .= '</div>';

    // Claim Type & Amount
    $content .= '<label>Audit Type:</label>';
    $content .= '<div class ="radio_container">';
    $content .= '<div class ="radio_item">';
    $content .= '<label for="civil">Civil Dollar Amount</label>';
    $content .= '<input type="radio" id="civil" name="claim_type" value="Civil Dollar Amount">';
    $content .= '</div>';
    $content .= '<div class ="radio_item">';
    $content .= '<label for="fraud">Fraud/Criminal</label>';
    $content .= '<input type="radio" id="fraud" name="claim_type" value="Fraud/Criminal">';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<label for="dollar_amount">Tax liability:</label>';
    $content .= '<input type="number" name="dollar_amount" id="dollar_amount" placeholder="Enter dollar amount">';

    $content .= '<label for="irs_notification_day">IRS Notification Day</label>';
    $content .= '<input type="date" name="irs_notification_day" id="irs_notification_day" placeholder="Select notification day" />';

    $content .= '<label for="irs_response_day">IRS Response Day</label>';
    $content .= '<input type="date" name="irs_response_day" id="irs_response_day" placeholder="Select response day" />';

    $content .= '<label for="message">Message (max 500 characters)</label>';
    $content .= '<textarea name="message" id="message" maxlength="500" style="height: 100px; resize: none;" placeholder="Enter your message (max 500 characters)"></textarea>';

    $content .= '<input type="submit" name="contact_form_submit" id="contact_form_submit" onclick="submit_contact_form()" value="SUBMIT">';

    $content .= '<div id="response_div"></div>';

    $content .= '</div>';


    // Can't help 
    $content .= '<h3 id="sorry" style="display: none;">Sorry, we can\'t help you!</h3>';

    // Styles
    $content .= '<style>';
    $content .= '.ques_text {
        font-family: Arial, sans-serif;
        font-size: 30px;
	    font-weight: bold;
        // color: #C0C0C0;
        color: white;
        margin-bottom: 20px;
        }';
    $content .= '.question {
        background-color: #1E2E45;
        border-radius: 15px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);        padding: 30px;
        margin: 10px auto;
        padding: 30px;
        max-width: 600px;
        text-align: center;
        }';
    $content .= '.y_n_Button {
        background-color: #9A9162;
        border: 1px solid black;
        color: #black;
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
        background-color: #8B7C2B;
        color: black;
        }';
    $content .= '#sorry{
        font-family: Arial, sans-serif;
        font-size: 30px;
	    font-weight: bold;
        color: black;
        text-align: center;
    }';
    $content .= '#faq_link h4{
        font-family: Arial, sans-serif;
        font-size: 25px;
        color: black;
    }';
    $content .= '#faq_link a{
        color: #9A9162;
    }';
    $content .= '#faq_link a:hover{
        color: #8B7C2B;
        font-size: 27px;
    }';
    $content .= '#contact_form{
        font-family: Arial, sans-serif;
    }';
    $content .= '.radio_container{
        display: flex;
        flex-direction: column;
        margin-bottom 5px;
        }';
    $content .= '.radio_item{display: flex;
    align-items: center;
    margin-bottom: 5px;
    }';
    $content .= '#message{
        border: 2px solid black;
    }';
    $content .= '#contact_form_submit{
        font-family: Arial, sans-serif;
        color: white;
        background-color:#1E2E45;
        }';
    $content .= '';
    $content .= 'label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 17px;}';
    $content .= 'input, select, textarea { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; border: 2px solid black; background-color: transparent; }';
    $content .= '.group { display: flex; gap: 20px}';
    $content .= '.group-element { display: flex, flex-direction: column width: 100%;}';
    $content .= '</style>';

    // Add jquery
    $content .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

    // JavaScript to show/hide form based on button clicks
    $content .= '<script>';
    $content .= 'var userAnswers = {';
    $content .= 'has_assets_in_hawaii_question: null,';
    $content .= 'has_assets_in_asia_question: null,';
    $content .= 'green_card_question: null,';
    $content .= 'audit_question: null,';
    $content .= 'information_question: null';
    $content .= '};';

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

    $content .= '</script>';

    return $content;
}
add_shortcode('custom_contact_form', 'ideapro_contact_form');


function ideapro_add_javascript()
{
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://kkawafuchi.wpcomstaging.com/wp-content/plugins/custom_contact_form/js/scripts.js"></script> -->
    <script src="https://software-project.local/wp-content/plugins/custom_contact_form/js/scripts.js"></script>
<?php
}
add_action('wp_footer', 'ideapro_add_javascript');

?>