<?php
$bppush_androidAppId = get_option('bppush_androidAppId');
$bppush_apiSecret = get_option('bppush_apiSecret');
define('API_ACCESS_KEY',$bppush_androidAppId); //'da45320f'
define('API_ACCESS_SECRET',$bppush_apiSecret); //'88c4487152fcff3641a87bf23a64548885b2a8fe19734550'

if($_GET['notification_status']){
	bp_ionic_status($messageId);
}

function bp_ionic_notify_pushbots($tokens,$message,$platform=0,$args=array()){
	// Push The notification with parameters
	require_once('PushBots.class.php');
	$platformCode = 0;
	if(strtolower($platform)=='android'){
		$platformCode = 1;
	}
	
	$pb = new PushBots();
	// Application ID
	$appID = API_ACCESS_KEY;
	// Application Secret
	$appSecret = API_ACCESS_SECRET;
	$pb->App($appID, $appSecret);
	 
	// Notification Settings
	if(!$message){$message="Notification Message";}
	$message = stripcslashes($message);
	//$pb->Alert($message);
	//$pb->Platform($platformCode);
	//$pb->Sound("ping.aiff");
	//$pb->Badge("+1");
	$payloadData = array("largeIcon" => "http://www.ask-oracle.com/wp-content/uploads/2015/12/icon.png", "goto" => "");
	if($args && $args['gotourl']){
		$payloadData['goto'] = $args['gotourl'];
	}
	//$pb->Payload($payloadData);
	
	
	/*if($args && $args['username']){
		$pb->Alias($args['username']);
	}*/
	
	//$pb->Alert($message);
	//$pb->Platform(array("0","1"));
	//$pb->Badge("+2");

	// Update Alias 
	/**
	 * set Alias Data
	 * @param	integer	$platform 0=> iOS or 1=> Android.
	 * @param	String	$token Device Registration ID.
	 * @param	String	$alias New Alias.
	 */
	//$pb->AliasData($platform, $tokens, $message);
	// set Alias on the server
	//$pb->setAlias();

	// Push to Single Device
	// Notification Settings
	$pb->AlertOne($message);
	$pb->PlatformOne($platformCode);
	$pb->TokenOne($tokens);
	$pb->PayloadOne($payloadData);
	
	// Push it !
	//$pb->Push();
	
	//Push to Single Device
	$pb->PushOne();
}

function bp_ionic_notify($tokens,$message){
	$notification_arr = array();
	$notification_arr['tokens'] = $tokens;
	$notification_arr['notification']['alert'] = $message;

	$payload = array(
				"key1"=>"value",
				"key2"=>"value"
			);
	$iosArr = array(
				"badge"=>1,
				"sound"=>"ping.aiff",
				"expiry"=> 1423238641,
				"priority"=> 10,
				"contentAvailable"=> true,
				"payload"=> $payload,
			);

	$androidArr = array(
				"collapseKey"=>"foo",
				"delayWhileIdle"=>true,
				"timeToLive"=>300,
				"payload"=>$payload
			);

	$notification_arr['notification']['ios'] = $iosArr;
	$notification_arr['notification']['android'] = $androidArr;
	$notification = json_encode($notification_arr);

	$encodedSecret = base64_encode(API_ACCESS_SECRET . ':');
	$headers = array
	(
		'X-Ionic-Application-Id: ' . API_ACCESS_KEY,
		'Authorization: Basic '.$encodedSecret,
		'Content-Type: application/json'
	);

	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://push.ionic.io/api/v1/push' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1);
	curl_setopt( $ch,CURLOPT_POSTFIELDS, $notification );
	$result = curl_exec($ch );
	curl_close( $ch );

//	echo json_encode($result);
//	header('Content-Type: application/json; charset=UTF-8', true);
//	exit;
}

function bp_ionic_status($messageId){
	$encodedSecret = base64_encode(API_ACCESS_SECRET . ':');
	$headers = array
	(
		'X-Ionic-Application-Id: ' . API_ACCESS_KEY,
		'Authorization: Basic '.$encodedSecret,
		'Content-Type: application/json'
	);

	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://push.ionic.io/api/v1/status/'.$messageId );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	$result = curl_exec($ch );
	curl_close( $ch );
//	echo json_encode($result);
//	header('Content-Type: application/json; charset=UTF-8', true);
//	exit;
}
