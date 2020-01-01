<?php
$app = $_GET['app'];
$html = file_get_contents("https://apkpure.com/store/apps/details?id=".$_GET['app']);

preg_match_all("/<a rel=\"nofollow\" class=\"(ga da|ga)\" ga=\"(.*?)\" title=\"(.*?)\" href=\"https:\/\/download.apkpure.com(.*?)\">Download APK/s", $html, $matches);
echo base64_encode(str_replace("_apkpure.com", "", "https://download.apkpure.com".$matches[4][0]));

?>
