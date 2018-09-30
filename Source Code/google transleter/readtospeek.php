<?php

	// The text to be read, url-encoded
	$_GET["text"]="This";
	$text_to_read = urlencode($_GET["text"]);

	// Your API key here
	$apikey = '3f8c4fa02e694c344ceb620c65c605d3';

	// The language to use
	$language = 'en_us';

	// The voice to use
	$voice= 'Male01';

	// API URL of text-to-speech enabler
	$api_url = 'https://tts.readspeaker.com/a/speak';

	// Compose API call url
	$url = $api_url . '?key='.$apikey.'&lang='.$language.'&voice='.$voice.'&text='.$text_to_read;
	

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$audio_data = curl_exec($ch);

	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($status != ""){echo $status;}
	if ($status == 200 && ! curl_errno($ch)) {
		// Everything is fine and data is returned
		curl_close($ch);
		header('HTTP/1.1 200 OK');
		header('Content-Type: audio/mpeg');
		echo $audio_data;
	} else {
		// Cannot translate text to speech because of text-to-speech API error
		error_log(__FILE__ . ': API error while text-to-speech. error code=' . $status);
		curl_close($ch);
	}

?>