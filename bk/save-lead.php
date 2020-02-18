<?php
require_once('wp-load.php');
session_start();
if (isset($_POST["submitStep1"])) {
	
	//print_r($_POST);
	//exit;

	$errorCount = 0;
	if (!isset($_POST["zipcode"]) || empty($_POST["zipcode"]) || !is_numeric($_POST["zipcode"])) {
		$errorCount++;	
	}
	if (!isset($_POST["city"]) || empty($_POST["city"])) {
		$errorCount++;	
	}
	if (!isset($_POST["state"]) || empty($_POST["state"])) {
		$errorCount++;	
	}
	if ($errorCount > 0) {
		$_SESSION["error_message"] = "Please fill all the fields";
		header("Location: " . site_url());
		exit;
	}
	
	$_SESSION["zip_code"] = $_POST["zipcode"];
	$_SESSION["city"] = $_POST["city"];
	$_SESSION["state"] = $_POST["state"];
	$_SESSION["state_abbreviation"] = $_POST["state_abbreviation"];
	$_SESSION["zip_code"] = $_POST["zipcode"];
	
	$url = site_url() . "/go-solar/";

	if (isset($_POST["isFrom"]) && $_POST["isFrom"] == "aboutus") {
		$url = site_url() . "/referral-program/signup/";
	} elseif (isset($_POST["isFrom"]) && $_POST["isFrom"] == "business") {
		$url = site_url() . "/business-go-solar/";
	}
	header("Location: " . $url);
	exit;
}
if ($_REQUEST["is_from"] == 'branch_search'&& isset($_SESSION["zip_code"]) && $_SESSION["zip_code"] != "" && $_SESSION["city"] != "" && $_SESSION["state"] != "" && $_SESSION["state_abbreviation"] != "") {
	
	if (isset($_SESSION["redirect_url_path"]) && $_SESSION["redirect_url_path"] == "business-go-solar") {
		$url = site_url() . "/business-go-solar/";
	} else {
		$url = site_url() . "/go-solar/";
	}
	
	header("Location: " . $url);
	exit;
	
}

if ((isset($_POST["gosolar"]) && isset($_POST['first_name']) && $_POST['first_name'] != "" && isset($_POST['last_name']) && $_POST['last_name'] != ""
	&& isset($_POST['address']) && $_POST['address'] != ""&& isset($_POST['email_address']) && $_POST['email_address'] != ""&& isset($_POST['phone']) 
	&& $_POST['phone'] != "" && isset($_POST['ownHouse']) && $_POST['ownHouse'] != "" && isset($_POST['roofShade']) && $_POST['roofShade'] != ""
	&& isset($_POST['propertyType']) && $_POST['propertyType'] != "" && isset($_POST['electricUtilityProviderText']) && $_POST['electricUtilityProviderText'] != ""
	 && isset($_POST['electricity_bill']) && $_POST['electricity_bill'] != "")) {
		
		if ($_POST["page_url"] == 'go-solar') {
			$pageURL = site_url() . "/go-solar/";
			$pageTitle = 'Trinity - go solar';
		} else {
			$pageURL = site_url() . "/business-go-solar/";
			$pageTitle = 'Trinity - business go solar';
		}


	$str_post = "firstname=" . urlencode($_POST['first_name'])
	. "&lastname=" . urlencode($_POST['last_name'])
	. "&email=" . urlencode($_POST['email_address'])
	. "&address=" . urlencode($_POST['address'])
	. "&city=" . urlencode($_POST['sel_city'])
	. "&state=" . urlencode($_POST['sel_state'])
	. "&zip=" . urlencode($_POST['sel_zipcode'])
	. "&phone=" . urlencode($_POST['phone'])
	. "&property_ownership__c=" . urlencode($_POST['ownHouse'])
	. "&roof_shading__c=" . urlencode($_POST['roofShade'])
	. "&type_of_home=" . urlencode($_POST['propertyType'])
	. "&utility_provider_gd_supplied__c=" . urlencode($_POST['electricUtilityProviderText'])
	. "&referrer__c=" . urlencode($_POST['contact_who'])
	. "&electric_bill_monthly__c=" . urlencode($_POST['electricity_bill']);
	
	$formGuid = '61f486eb-6046-47f2-85d0-3d20cb9b7c27';

	submitConactsToHubSpot($pageURL,$pageTitle,$str_post,$formGuid);
	$redirectPage = site_url().'/referral-program/thank-you/';
	header("Location: " . $redirectPage);
	exit;

} else {
	header("Location: " . site_url());
}


if ((isset($_POST["businessgosloar"]) && isset($_POST['first_name']) && $_POST['first_name'] != "" && isset($_POST['last_name']) && $_POST['last_name'] != ""
	&& isset($_POST['business_name']) && $_POST['business_name'] != ""&& isset($_POST['position_with_comp']) && $_POST['position_with_comp'] != ""&& isset($_POST['address']) 
	&& $_POST['address'] != "" && isset($_POST['phone']) && $_POST['phone'] != "" && isset($_POST['email_address']) && $_POST['email_address'] != ""
	&& isset($_POST['electricUtilityProviderText']) && $_POST['electricUtilityProviderText'] != "" && isset($_POST['electricity_bill']) && $_POST['electricity_bill'] != "" )) {
		
		if ($_POST["page_url"] == 'go-solar') {
			$pageURL = site_url() . "/go-solar/";
			$pageTitle = 'Trinity - go solar';
		} else {
			$pageURL = site_url() . "/business-go-solar/";
			$pageTitle = 'Trinity - business go solar';
		}


	$str_post = "firstname=" . urlencode($_POST['first_name'])
	. "&lastname=" . urlencode($_POST['last_name'])
	. "&email=" . urlencode($_POST['email_address'])
	. "&business_name=" . urlencode($_POST['business_name'])
	. "&position_within_company=" . urlencode($_POST['position_with_comp'])
	. "&business_address=" . urlencode($_POST['address'])
	. "&city=" . urlencode($_POST['sel_city'])
	. "&state=" . urlencode($_POST['sel_state'])
	. "&zip=" . urlencode($_POST['sel_zipcode'])
	. "&phone=" . urlencode($_POST['phone'])
	. "&utility_provider_gd_supplied__c=" . urlencode($_POST['electricUtilityProviderText'])
	. "&referrer__c=" . urlencode($_POST['contact_who'])
	. "&electric_bill_monthly__c=" . urlencode($_POST['electricity_bill']);
	
	$formGuid = '2118b0a0-f8e2-4dbd-99e8-7064831e5059';

	submitConactsToHubSpot($pageURL,$pageTitle,$str_post,$formGuid);
	$redirectPage = site_url().'/referral-program/thank-you/';
	header("Location: " . $redirectPage);
	exit;

} else {
	header("Location: " . site_url());
}

if ((isset($_POST["signup_form"]) && isset($_POST['first_name']) && $_POST['first_name'] != "" && isset($_POST['last_name']) && $_POST['last_name'] != ""
	&& isset($_POST['email_address']) && $_POST['email_address'] != ""&& isset($_POST['phone']) && $_POST['phone'] != ""&& isset($_POST['friend_first_name']) 
	&& $_POST['friend_first_name'] != "" && isset($_POST['friend_last_name']) && $_POST['friend_last_name'] != "" && isset($_POST['friend_email_address']) && $_POST['friend_email_address'] != ""
	&& isset($_POST['friend_phone']) && $_POST['friend_phone'] != "" )) {
		
	$pageURL = site_url() . "/referral-program/signup/";
	$pageTitle = 'Trinity - Signup';


	$str_post = "firstname=" . urlencode($_POST['first_name'])
	. "&lastname=" . urlencode($_POST['last_name'])
	. "&email=" . urlencode($_POST['email_address'])
	. "&phone=" . urlencode($_POST['phone'])
	. "&friend_first_name=" . urlencode($_POST['friend_first_name'])
	. "&friends_last_name=" . urlencode($_POST['friend_last_name'])
	. "&friends_email=" . urlencode($_POST['friend_email_address'])
	. "&friends_phone_number=" . urlencode($_POST['friend_phone']);
	
	$formGuid = '49d83f99-e251-4b4f-bbc5-29802df40c66';

	submitConactsToHubSpot($pageURL,$pageTitle,$str_post,$formGuid);
	$redirectPage = site_url().'/referral-program/thank-you/';
	header("Location: " . $redirectPage);

} else {
	header("Location: " . site_url());
}

function makeTwilioResponseForDB($twilioResponse) {
	
	global $leadInfoArr;
		
	if ($twilioResponse["status"] == "success") {
		$jsonTwilioResponse = $twilioResponse["twilioResponse"];
		$jsonTwilioResponse = json_decode($jsonTwilioResponse);
		
		if (!empty($jsonTwilioResponse->mobile_country_code)) {
			$leadInfoArr["twilio_mobile_country_code"] = $jsonTwilioResponse->mobile_country_code;
		}
		if (!empty($jsonTwilioResponse->mobile_network_code)) {
			$leadInfoArr["twilio_mobile_network_code"] = $jsonTwilioResponse->mobile_network_code;
		}
		if (!empty($jsonTwilioResponse->name)) {
			$leadInfoArr["twilio_name"] = $jsonTwilioResponse->name;
		}
		if (!empty($jsonTwilioResponse->type)) {
			$leadInfoArr["twilio_type"] = $jsonTwilioResponse->type;
		}
		if (!empty($jsonTwilioResponse->error_code)) {
			$leadInfoArr["twilio_error_code"] = $jsonTwilioResponse->error_code;
		}
	}
}

function makeKickBoxResponseForDB($kickboxResponse) {
	
	global $leadInfoArr;
	$kickboxResponseArr = $kickboxResponse["kickboxResponse"];
	
	if ($kickboxResponse["status"] == "success" || $kickboxResponse["status"] == "notvalid") {
		
		$leadInfoArr["kickbox_result"] = $kickboxResponseArr["result"];
		$leadInfoArr["kickbox_reason"] = $kickboxResponseArr["reason"];
		
		if (!empty($kickboxResponseArr["role"])) {
			$leadInfoArr["kickbox_role"] = $kickboxResponseArr["role"];
		}
		if (!empty($kickboxResponseArr["free"])) {
			$leadInfoArr["kickbox_free"] = $kickboxResponseArr["free"];
		}
		if (!empty($kickboxResponseArr["disposable"])) {
			$leadInfoArr["kickbox_disposable"] = $kickboxResponseArr["disposable"];
		}
		if (!empty($kickboxResponseArr["accept_all"])) {
			$leadInfoArr["kickbox_accept_all"] = $kickboxResponseArr["accept_all"];
		}
		if (!empty($kickboxResponseArr["did_you_mean"])) {
			$leadInfoArr["kickbox_did_you_mean"] = $kickboxResponseArr["did_you_mean"];
		}
		if (!empty($kickboxResponseArr["sendex"])) {
			$leadInfoArr["kickbox_sendex"] = $kickboxResponseArr["sendex"];
		}
		if (!empty($kickboxResponseArr["email"])) {
			$leadInfoArr["kickbox_email"] = $kickboxResponseArr["email"];
		}
		if (!empty($kickboxResponseArr["user"])) {
			$leadInfoArr["kickbox_user"] = $kickboxResponseArr["user"];
		}
		if (!empty($kickboxResponseArr["domain"])) {
			$leadInfoArr["kickbox_domain"] = $kickboxResponseArr["domain"];
		}
		if (!empty($kickboxResponseArr["success"])) {
			$leadInfoArr["kickbox_success"] = $kickboxResponseArr["success"];
		}
		if (!empty($kickboxResponseArr["message"])) {
			$leadInfoArr["kickbox_message"] = $kickboxResponseArr["message"];
		}
	} elseif ($kickboxResponse["status"] == "error") {
		$leadInfoArr["kickbox_result"] = $kickboxResponseArr;
	}
}

function submitConactsToHubSpot($pageURL,$pageTitle,$str_post,$formGuid)
{
	//Process a new form submission in HubSpot in order to create a new Contact.
	if (isset($_COOKIE['hubspotutk'])) {
		$hubspotutk = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
	} else {
		$hubspotutk = '';	
	}
	
	$ip_addr = $_SERVER['REMOTE_ADDR']; //IP address too.
	$hs_context = array(
	'hutk' => $hubspotutk,
	'ipAddress' => $ip_addr,
	'pageUrl' => $pageURL,
	'pageTitle' => $pageTitle
	);
	$hs_context_json = json_encode($hs_context);
	$portalId = '410398';
	
	$str_post.= "&hs_context=" . urlencode($hs_context_json);
	
	$endpoint = "https://forms.hubspot.com/uploads/form/v2/{$portalId}/{$formGuid}";
	$ch = @curl_init();
	@curl_setopt($ch, CURLOPT_POST, true);
	@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
	@curl_setopt($ch, CURLOPT_URL, $endpoint);
	@curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
	@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = @curl_exec($ch); //Log the response from HubSpot as needed.
	$error = curl_error($ch);
	@curl_close($ch);
	//echo "Response : "; print_r( $response ); echo "<br/>";
	//echo "Error : "; print_r( $error );
	//exit;
}

?>