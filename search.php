<?php
if(mb_strlen($_GET['q'],'UTF-8')<3){ return "";}
$db = mysql_connect("localhost","root","")or die('connect to database failed');

mysql_select_db("mobileapps", $db);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

/*
     $result = mysql_query("SELECT COUNT(id) FROM apps");
$totalit = $posts = mysql_result($result,0,0);

 for($i=0;$i<25;$i++){
        $rnd = rand(0,intval($totalit));
        $res5 = mysql_query("SELECT id, translit, developer, genre, appName, prevScreen FROM apps WHERE id=".$rnd);

while($row5 = mysql_fetch_array($res5))
{
echo '<li class="media">
                                <a class="pull-left" href="#" onclick="return false;">
                                    <img class="media-object" src="'.$row5['prevScreen'].'" width="100">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$row5['translit'].'-'.$row5['genre'].'-'.$row5['id'].'.html">'.$row5['appName'].'</a></h4>
                                    <b>Закачек:</b> '.$row5['numDownloads'].'<br />
                                    <b>Требования к Андроид:</b> '.$row5['operatingSystems'].'<br />
                                    <b>Размер: </b> '.$row5['fileSize'].'
                                </div>
                            </li>';

}
}
*/                                      //echo "https://play.google.com/store/search?q=".urlencode($_GET['q'])."&c=apps&docType=1"; die;
preg_match_all('/"\/store\/apps\/details\?id=(?<app>.*?)("|&)/us', file_get_contents("https://play.google.com/store/search?q=".urlencode($_GET['q'])."&c=apps&docType=1"), $matches);
$apps = array();
foreach($matches[1] as $app){
    $apps[] = $app;
    }

$count = 0;
$apps =array_unique($apps);
foreach($apps as $app){
    if($count>=10) break;
    $res5 = mysql_query("SELECT * FROM apps WHERE sitePage='".$app."'");

while($row5 = mysql_fetch_array($res5))
{
echo '<li class="media">
                                <a class="pull-left" href="#" onclick="return false;">
                                    <img class="media-object" src="'.$row5['prevScreen'].'" width="100">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$row5['translit'].'-'.$row5['genre'].'-'.$row5['id'].'.html">'.$row5['appName'].'</a></h4>
                                    <b>Закачек:</b> '.$row5['numDownloads'].'<br />
                                    <b>Требования к Андроид:</b> '.$row5['operatingSystems'].'<br />
                                    <b>Размер: </b> '.$row5['fileSize'].'
                                </div>
                            </li>';

}

    $count++;
}




mysql_close($db);

?>