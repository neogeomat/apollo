<?php

$apiKey = '26cbae1cefe73849ce4835e7398454c1-us12'; // Your MailChimp API Key
$listId = 'ceff6e6efb'; // Your MailChimp List ID
$double_optin=false;
$send_welcome=false;
$email_type = 'html';
$email = $_POST['subscribe-email'];
$datacenter = explode( '-', $apiKey );
$submit_url = "http://" . $datacenter[1] . ".api.mailchimp.com/1.3/?method=listSubscribe";

if( isset( $email ) AND $email != '' ) {

    $data = array(
        'email_address'=>$email,
		'text'=>$name,
        'apikey'=>$apiKey,
        'id' => $listId,
        'double_optin' => $double_optin,
        'send_welcome' => $send_welcome,
        'email_type' => $email_type
    );

    $payload = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $submit_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));

    $result = curl_exec($ch);
    curl_close ($ch);
    $data = json_decode($result);

    if ( isset( $data->error ) AND $data->error != '' ){
        echo $data->error;
    } else {
        echo 'Thank you! You have been <strong>successfully</strong> subscribed to our Email List.';
    }

}

?>