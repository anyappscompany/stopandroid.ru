<?php
//echo  base64_decode($_GET['url'])."<hr>";
$headers = @get_headers(base64_decode($_GET['url']), 1);
//print_r($headers);die;

$parts = parse_url(base64_decode($_GET['url']));
parse_str($parts['query'], $query);

if($headers['Content-Type'][1]=="application/vnd.android.package-archive"){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$query['fn'].'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $headers['Content-Length']);
    readfile(base64_decode($_GET['url']));
    exit;
}else{
    header('Location: https://play.google.com/store/apps/details?id='.$query['p']);
    exit;
}
/*try{

header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$query['fn']);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    //header('Content-Length: ' . filesize(base64_decode($_GET['url'])));
    ob_clean();
    flush();
    readfile(base64_decode($_GET['url']));
    exit;
}catch(Exception $e){
    //
}*/
?>