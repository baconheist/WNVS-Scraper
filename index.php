<?php
	$dir = '/var/www/';
	$url = ''; //absolute URL is required
	$files1 = scandir($dir);
	//print_r($files1);

	$xml = new SimpleXMLElement('<rss version="2.0"></rss>');

	$channel = $xml->addChild('channel');

	$channel->addChild('title', 'Steve and Chris\' Wednesday Night Variety Show');
	$channel->addChild('link', $url);
	$channel->addChild('description', 'Steve and Chris\' Wednesday Night Variety Show on Valley FM 89.5');


	$pattern = '/^.*\.(mp3)$/i';
	foreach ($files1 as $value) 
	{
		if (preg_match($pattern, $value, $matches, PREG_OFFSET_CAPTURE))
		{


			$newItem = $channel->addChild('item');
			$newItem->addChild('title', $value.' online');
			$newItem->addChild('guid', $value);
			$newItem->addChild('link', $url.$value);
			$newItem->addChild('description', $justname = substr($value, 0, -4).' is now online!');
			$newItem->addChild('pubDate', date(DATE_RFC822, filemtime($dir.$value)));

		}
	}
	header('Content-Type: application/rss+xml');
	echo $xml->asXML();

?>

