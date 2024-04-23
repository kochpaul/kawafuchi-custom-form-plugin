function submit_contact_form() {
   
    // Get form values
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var your_email = $("#your_email").val();
    var your_phone = $("#your_phone").val();
    var irs_notification_day = new Date($("#irs_notification_day").val());
    var irs_response_day = new Date($("#irs_response_day").val());
    var message = $("#message").val();
    var dollar_amount = $("#dollar_amount").val();
    var claim_type = $('input[name="claim_type"]:checked').val();

    // Validate form fields
    // Check if right Date Format
    if (
        irs_notification_day.toString() === 'Invalid Date' || 
        irs_response_day.toString() === 'Invalid Date'
    ) {
        var mess = "Invalid date provided!";
        $("#response_div").html('');
        $("#response_div").html(mess);
        $("#response_div").css("background-color", "red");
        $("#response_div").css("color", "#FFFFFF");
        $("#response_div").css("padding", "20px");
        return false;
    }

    // Check if all field filled out
    if (
        first_name.trim() === '' ||
        last_name.trim() === '' ||
        your_email.trim() === '' ||
        your_phone.trim() === '' ||
        irs_notification_day.toString() === 'Invalid Date' || 
        irs_response_day.toString() === 'Invalid Date' || 
        dollar_amount.trim() === '' ||
        !claim_type 
    ) {
        var mess = "All fields are required!";
        $("#response_div").html('');
        $("#response_div").html(mess);
        $("#response_div").css("background-color", "red");
        $("#response_div").css("color", "#FFFFFF");
        $("#response_div").css("padding", "20px");
        return false;
    }

    // Validate Dollar Amount
    if ((claim_type === "Civil Dollar Amount" && parseInt(dollar_amount) <= 250000) ||
        (claim_type === "Fraud/Criminal" && parseInt(dollar_amount) <= 100000)) {
        var mess = "Dollar amount must be greater than $250,000 for Civil Dollar Amount and $100,000 for Fraud/Criminal.";
        $("#response_div").html('');
        $("#response_div").html(mess);
        $("#response_div").css("background-color", "red");
        $("#response_div").css("color", "#FFFFFF");
        $("#response_div").css("padding", "20px");
        return false;
    }

    // Calculate date differences
    var notificationDateDiff = Math.ceil((new Date() - irs_notification_day) / (1000 * 60 * 60 * 24));
    var responseDateDiff = Math.ceil((irs_response_day - new Date()) / (1000 * 60 * 60 * 24));

    // Validate date differences

    if ( !(notificationDateDiff > 2 && notificationDateDiff < 17)) {
		$("#response_div").html('');

        $("#response_div").html("IRS/State Notification Date must be within 2 weeks.");
        $("#response_div").css("background-color", "red");
        $("#response_div").css("color", "#FFFFFF");
        $("#response_div").css("padding", "20px");
        return false;
    }

    if (responseDateDiff <= 7) {
		$("#response_div").html('');

        $("#response_div").html("IRS/State Response must be over 7 days after Notification.");
        $("#response_div").css("background-color", "red");
        $("#response_div").css("color", "#FFFFFF");
        $("#response_div").css("padding", "20px");
        return false;
    }

    // If all validations pass, proceed with form submission
    var fd = new FormData();
    fd.append('ideaproContactSubmit', '1');
    fd.append('first_name', first_name);
    fd.append('last_name', last_name);
    fd.append('your_email', your_email);
    fd.append('your_phone', your_phone);
    fd.append('irs_notification_day', irs_notification_day.toISOString().slice(0, 10)); // Convert date to ISO string
    fd.append('irs_response_day', irs_response_day.toISOString().slice(0, 10)); // Convert date to ISO string
    fd.append('dollar_amount', dollar_amount);
    fd.append('claim_type', claim_type);
    fd.append('message', message);
    fd.append('audit_question', userAnswers.audit_question);
    fd.append('has_assets_in_hawaii_question', userAnswers.has_assets_in_hawaii_question);
    fd.append('has_assets_in_asia_question', userAnswers.has_assets_in_asia_question);
    fd.append('green_card_question', userAnswers.green_card_question);
    fd.append('information_question', userAnswers.information_question);

    js_submit(fd, submit_contact_form_callback);
}



function submit_contact_form_callback(data)
{
	var jdata = JSON.parse(data);

	if(jdata.success == 1)
	{
		var mess = jdata.message;
		// clear out the response_div
		$("#response_div").html('');

		$("#response_div").html(mess);
		$("#response_div").css("background-color","green");
		$("#response_div").css("color","#FFFFFF");
		$("#response_div").css("padding","20px");
	}

}

function js_submit(fd,callback)
{
	var submitUrl = 'https://kawafuchilaw.com/wp-content/plugins/KawafuchiLawContactForm/process/';
	// var submitUrl = 'https://software-project.local/wp-content/plugins/KawafuchiLawContactForm/process/';

	$.ajax({url: submitUrl,type:'post',data:fd,contentType:false,processData:false,success:function(response){ callback(response); },});

}