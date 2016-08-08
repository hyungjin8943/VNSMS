<html>
<?php

$ch = curl_init("http://rss.news.yahoo.com/rss/oddlyenough");
$fp = fopen("example_homepage.html", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

$xml = simplexml_load_file('example_homepage.html');
print "<ul>\n";
foreach ($xml->channel->item as $item){
  print "<li>$item->title</li>\n";
}
print "</ul>";

?>
</html>
