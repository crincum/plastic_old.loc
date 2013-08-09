<?
$badurl="http://2prohozhdenie.ru/2.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:', 'Content-Type: text/xml', 'Content-Length: 0'));
curl_setopt($ch , CURLOPT_USERAGENT , "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_URL, $badurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$out = curl_exec($ch);
curl_close($ch);
echo $out;
?>