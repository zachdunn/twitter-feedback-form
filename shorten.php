<?php
	/*
		Based on code from David Walsh
		http://davidwalsh.name/bitly-php
	*/
	
	////Assign URL of page to shorten. You can substitute with the_permalink() template tag if using Wordpress.
	$full_url = "http://buildinternet.com";
	
	/* make a URL small */
	function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
	{
		//create the URL
		$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;

		//get the url
		//could also use cURL here
		$response = file_get_contents($bitly);

		//parse depending on desired format
		if(strtolower($format) == 'json')
		{
			$json = @json_decode($response,true);
			return $json['results'][$url]['shortUrl'];
		}
		else //xml
		{
			$xml = simplexml_load_string($response);
			return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
		}
	}

	/* usage (Insert your own information where noted)*/
	$short = make_bitly_url($full_url,'BITLY LOGIN','BITLY API KEY','json');
	
	//Comment this next line in (and the last two out) to test.
	//$short = "http://bit.ly/ahBz7u"
	
	//Our short url is now stored in the $short variable
?>