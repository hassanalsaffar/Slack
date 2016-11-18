<?php 

	require_once("");

	if( $_POST['token'] == '###TOKEN###' )
	{
		
		//initial respond with HTTP 200 OK, so slack doesn't send 'timeout was reached' error!
		print('{ "response_type" : "in_channel" }');
		header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		header("Content-Type: application/json");
		header('Content-Length: '.ob_get_length());
		ob_end_flush();
		ob_flush();
		flush();
		
		//Get Slack Request Command
		$command = $_POST['command'];
		$serial = $_POST['text'];
		$response_url = $_POST['response_url'];
		$channel = $_POST['channel_name'];
		$username = $_POST['user_name'];

		//----------------------------------      DEBUG     ---------------------------------
		$myfile = fopen(".warrantyCheck.debug", "a");
		
		fwrite($myfile, date("Y-m-d H:i:s") . " | ");
		fwrite($myfile, $username . " | ");
		fwrite($myfile, $command . " ");
		fwrite($myfile, $serial . " | ");
		fwrite($myfile, $channel . " | ");
		fwrite($myfile, $response_url . "\n");
		fclose($myfile);
		//----------------------------------      DEBUG     ---------------------------------		

		//----------------------------------  DO STUFF HERE ---------------------------------
		// ?
		//-----------------------------------------------------------------------------------

		#Set Timestamp of Results
		$ts = time();

		#Set Attachment
		if ($age == 46.85)
		{
			$attachments = array(	[	'color' => $color,
							'text' => $text,
							'mrkdwn_in' => ["text"],
							'footer' => "By Hassan A.",
        	                        	        'ts'=> $ts
						]);
		}
		else
		{
			$attachments = array(	[	'color' => $color,
							'text' => $text,
							'mrkdwn_in' => ["text"]
						],
						[  	'fallback' => 'Howdy from Hassan!',
				        		'color' => '#D3D3D3',
							'author_name' => "",
							'thumb_url' => $image,
						        'fields'   => array(
							            [
							                'title' => 'Title #1',
							                'value' => "Test",
							                'short' => true
						        	    ],
							            [
							                'title' => 'Title #2',
							                'value' => "Test",
							                'short' => false
							            ]), 
							'footer' => $manufacturer ." API",
	                        'footer_icon' => $footerIcon,
        	                'ts'=> $ts
						]);
		}

		#Set Slack Response 
		header('Content-Type: application/json');
		$response = json_encode(array( 'response_type' => 'in_channel', 
					       'attachments' => $attachments,
					       'response_url' => $response_url));
		
		//Send Response to Slack
		$curl = "curl -s -m 5 --data-urlencode 'payload=" . $response . "' '" . $response_url . "'";
		shell_exec($curl);
	}
	else
	{
		echo json_encode(array( 'response_type' => 'in_channel', 
					'text' => "Invalid token!"));
	}

?>
