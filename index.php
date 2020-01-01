<?php
$title = "Приложения на андроид: игры, программы, фильмы, музыка, книги, пресса";
$kw = "андроид, приложения, мобильные";
$descr = "Каталог приложений для мобильных телефонов под управлением бесплатной операцинной системы андроид";
$htmlt = "";

$allgenres = array('Головоломки', 'Бизнес', 'Виджеты', 'Живые обои', 'Здоровье и фитнес', 'Инструменты', 'Книги и справочники', 'Комиксы', 'Медицина', 'Музыка и аудио', 'Мультимедиа и видео', 'Новости и журналы', 'Образование', 'Персонализация', 'Погода', 'Покупки', 'Путешествия', 'Работа', 'Развлечения', 'Разное', 'Связь', 'Социальные', 'Спорт', 'Стиль жизни', 'Транспорт', 'Финансы', 'Фотография', 'Аркады', 'Викторины', 'Гонки', 'Другое', 'Казино', 'Карточные', 'Музыка', 'Настольные игры', 'Обучающие', 'Пазлы', 'Приключения', 'Ролевые', 'Симуляторы', 'Словесные игры', 'Спортивные игры', 'Стратегии', 'Экшен');

function ochistkaznakov($text)
{
//return str_replace ("*","",str_replace ("+","",str_replace ("#","",$text)));
$trans = array("+" => "", "*" => "", "#" => "", '\"' => "", "\'" => "", "." => "");
return strtr($text, $trans);
}


?>

<?php
//$link = @mysql_connect("216.227.216.46","chinp0_user","hLQOEXf2YUvCG58751lm") or die("Could not connect: " . mysql_error());
/*$db = mysql_connect("localhost","root","asdf45g");
mysql_select_db("tphrases" ,$db);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");*/
// Данные для mysql сервера
//echo $_SERVER['REQUEST_URI'];
//$db = mysql_connect("localhost","root","asdf45g");
//mysql_select_db("tphrases", $db);
//$db = mysql_connect("216.227.216.46","chinp0","icAcJeH3EayDpH")or die('connect to database failed');


$db = mysql_connect("localhost","stopandroidu","XtJqUAUy")or die('connect to database failed');
mysql_select_db("stopandroid", $db);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
//echo "SELECT COUNT(id) FROM apps".(isset($_GET['cat'])?" WHERE genre=".mysql_real_escape_string($_GET['cat'])."":"");

$totalit = $posts = 0;
if(isset($_GET['cat'])){
$result = mysql_query("SELECT COUNT(id) FROM apps WHERE genre='".mysql_real_escape_string($_GET['cat'])."'");
$totalit = $posts = mysql_result($result,0,0);
}else{
$result = mysql_query("SELECT COUNT(id) FROM apps");
$totalit = $posts = 1021217;
}


//$totalit = $posts = mysql_result($result,0,0);

$rnd = rand(0,intval($totalit));
$randomResult = mysql_query('SELECT id, translit, genre FROM apps WHERE id>'.$rnd.' LIMIT 1');
while ( $postrowRandom[] = mysql_fetch_array($randomResult));
$urlRand = "http://".$_SERVER['SERVER_NAME']."/".$postrowRandom[0]['translit']."-".$postrowRandom[0]['genre']."-".$postrowRandom[0]['id'].".html";


if($_SERVER['REQUEST_URI']=='/' or isset($_GET['page'])){

$num = 35;
// Извлекаем из URL текущую страницу
$page = intval($_GET['page']);
$page = stripslashes($page);
$page = mysql_real_escape_string($page);
settype($page,'integer');

// Определяем общее число сообщений в базе данных

// Находим общее число страниц
$total = intval(($posts - 1) / $num) + 1;
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная к какого номера
// следует выводить сообщения
$start = $page * $num - $num;
// Выбираем $num сообщений начиная с номера $start
//$result = mysql_query("SELECT * FROM phrases LIMIT $start, $num");
//echo "SELECT * FROM apps WHERE id>$start AND id<($start+$num)".(isset($_GET['cat'])?" AND genre='".mysql_real_escape_string($_GET['cat'])."'":"");
//$result = mysql_query("SELECT * FROM apps WHERE id>$start AND id<($start+$num)".(isset($_GET['cat'])?" AND genre='".mysql_real_escape_string($_GET['cat'])."'":""));

if(isset($_GET['cat'])){
    $result = mysql_query("SELECT * FROM apps JOIN (SELECT id FROM apps WHERE genre='".mysql_real_escape_string($_GET['cat'])."' ORDER BY id LIMIT ".$start.", ".$num.") as b ON b.id = apps.id");
}else{
    //$result = mysql_query("SELECT * FROM apps JOIN (SELECT id FROM apps ORDER BY id LIMIT ".$start.", ".$num.") as b ON b.id = apps.id");
    $result = mysql_query("SELECT * FROM apps WHERE id>$start AND id<($start+$num)");
}

// В цикле переносим результаты запроса в массив $postrow
while ( $postrow[] = mysql_fetch_array($result))

?>
<?php
if ($_SERVER[REQUEST_URI]!="/")
{
$title .= " страница ".$page;
$kw .= " страница ".$page;
$descr .= " страница ".$page;
}

for($i = 0; $i < $num; $i++)
{
    if(!isset($postrow[$i]['appName']))continue;
/*$first = mb_substr(ochistkaznakov($postrow[$i]['kw']),0,1, 'UTF-8');//первая буква
$last = mb_substr(ochistkaznakov($postrow[$i]['kw']),1);//все кроме первой буквы
$first = mb_strtoupper($first, 'UTF-8');
$last = mb_strtolower($last, 'UTF-8');
$incfLet = $first.$last;*/


/*$jsonimages = $postrow[$i]['jsonimages'];
$obj = (array)json_decode($jsonimages);
$mindex = 0;

      foreach($obj as $key=>$value){                                                          //mb_strtoupper($postrow[0]['kw'], 'utf-8')
      $htmlt.= "<div class='item'><a href='http://pictures11.ru/".$postrow[$i]['translitkw'].".html'><img alt='".mb_strtoupper($postrow[$i]['kw'], 'utf-8')."' title='".mb_strtoupper($postrow[$i]['kw'], 'utf-8')."' class='img1' onerror='vote(this, ".$postrow[$i]['id'].",".$mindex.");' src='".$value->url."' /><br />".$postrow[$i]['kw']."</a></div>";
        //echo ($value->url."<br />");
        break;
        $mindex++;
    }*/
$htmlt .= '<li class="media">
                                <a class="pull-left" href="#" onclick="return false;">
                                    <img class="media-object" src="'.$postrow[$i]['prevScreen'].'" width="100">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$postrow[$i]['translit'].'-'.$postrow[$i]['genre'].'-'.$postrow[$i]['id'].'.html">'.$postrow[$i]['appName'].'</a></h4>
                                    <b>Закачек:</b> '.$postrow[$i]['numDownloads'].'<br />
                                    <b>Требования к Андроид:</b> '.$postrow[$i]['operatingSystems'].'<br />
                                    <b>Размер: </b> '.$postrow[$i]['fileSize'].'
                                </div>
                            </li>';
}



/*$db = mysql_connect("localhost","root","")or die('connect to database failed');
mysql_select_db("yandexfotki", $db);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

$result = mysql_query("SELECT * FROM indextable_copy");
echo "<div id='container'>";

while ($row=mysql_fetch_array($result)) {
    //echo "Клиент ".$row['id']." любит Яблоки.<BR>";
    //echo "Его Email: ".$row['kw'];
    //echo "<BR>";
    //echo $row['kw']."<hr />";
    $jsonimages = $row['jsonimages'];
    $obj = (array)json_decode($jsonimages);
    $mindex = 0;
    foreach($obj as $key=>$value){
      echo "<div class='item'><img class='img1' onerror='vote(this, ".$row['id'].",".$mindex.");' src='".$value->url."' /><br />".$row['kw']."</div>";
        //echo ($value->url."<br />");
        break;
        $mindex++;
    }
      //echo "<li class='catitem'><img class='img1' src='".$row2['thumb']."' />".mb_ucfirst($row['jsonimages'])."</li>";
  }

  */
?>
<?php
// Проверяем нужны ли стрелки назад
$p_first = "Первая";
$p_previous = "Предыдущая";
$p_next = "Следующая";
$p_last = "Последняя";

if ($page != 1) $pervpage = '<li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page=1'.(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'.$p_first.'</a></li>
                               <li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page - 1) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'.$p_previous.'</a></li> ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' <li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page + 1) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'.$p_next.'</a></li>
                                   <li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page=' .$total.(isset($_GET['cat'])?"&cat=".$_GET['cat']."":""). '>'.$p_last.'</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page - 2) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page - 1) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'. ($page - 1) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page + 2) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href= http://'.$_SERVER['SERVER_NAME'].'/?page='. ($page + 1) .(isset($_GET['cat'])?"&cat=".$_GET['cat']."":"").'>'. ($page + 1) .'</a></li>';

// Вывод меню
$menu = '<ul class="pagination">'.$pervpage.$page2left.$page1left.'<li class="active" class="page"><a href="http://'.$_SERVER['SERVER_NAME'].'/?page='.$page.'"><b>'.$page.'</b></a></li>'.$page1right.$page2right.$nextpage.'</ul>';
}else if(array_pop(explode(".", $_SERVER['REQUEST_URI']))=='html'){

$query2 = substr(substr($_SERVER['REQUEST_URI'],0,-5), 1);
//echo $_SERVER['REQUEST_URI'];
//preg_match_all('/[0-9]+-(.*?)\.html/s', $_SERVER['REQUEST_URI'], $matches);
//$pid = $matches[1][0];

//$pgenre = $matches[2][0];
$mix = explode("-", $_SERVER['REQUEST_URI']);
$pgenre = $mix[count($mix)-2];

$mix2 = explode(".", $mix[count($mix)-1]);
//print_r($mix2[0]);
$pid = $mix2[0];

//echo $pgenre.":".$pid;

$result = mysql_query("SELECT * FROM apps WHERE id='".mysql_real_escape_string($pid)."'");
while ( $postrow[] = mysql_fetch_array($result));
function my_ucfirst($string, $e ='utf-8') {
        if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
            $string = mb_strtolower($string, $e);
            $upper = mb_strtoupper($string, $e);
            preg_match('#(.)#us', $upper, $matches);
            $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e);
        } else {
            $string = ucfirst($string);
        }
        return $string;
    }

$title = ochistkaznakov($postrow[0]['appName']." скачать и установить для android");

$title =  my_ucfirst($title);

$kw = ochistkaznakov($postrow[0]['appName']);

$kw = my_ucfirst($kw);

$descr = ochistkaznakov($postrow[0]['appName']);

$descr = my_ucfirst($descr);




/*$jsonimages = $postrow[0]['jsonimages'];
$obj = (array)json_decode($jsonimages);
$mindex = 0;

      foreach($obj as $key=>$value){
      $htmlt.= "<div id='pp".$mindex."' class='item'><div id='i".$mindex."' title='".$postrow[0]['kw'].': '.$value->pt.' '.$value->s."'><img title='".mb_strtoupper($postrow[0]['kw'], 'utf-8')."' alt='".$postrow[0]['kw'].': '.$value->t."' class='img1 fancybox' onerror='vote(this, ".$postrow[0]['id'].",".$mindex.");' src='".$value->url."' /></div>
      <br />Разрешение: <span style='color: #388E3C'>".$value->ow."x".$value->oh."</span><br />Размер: ".$value->os."<br />Файл: ".$value->filename."<br />Тип: ".$value->type."<br />
      </div>";
        //echo ($value->url."<br />");

        $mindex++;
    }
*/
$carouselindicators = "";
$carouselinner = "";
$arr_screenshots = json_decode($postrow[0]['screenshots']);
if(count($arr_screenshots)>0){
for($i=0;$i<count($arr_screenshots); $i++){
    $carouselindicators .= '<li data-target="#carousel1" data-slide-to="'.$i.'"></li>';
    $carouselinner .= '<div class="item'.(($i==0)? " active": "").'">
                                    <img src="'.$arr_screenshots[$i].'" title="'.$postrow[0]['appName'].'" alt="'.$postrow[0]['appName'].'" />
                                </div>';
}
}else{
   $carouselindicators .= '<li data-target="#carousel1" data-slide-to="0"></li>';
   $carouselinner .= '<div class="item active">
                                    <img src="empty.jpg" alt="'.$postrow[0]['appName'].'" />
   </div>';
}

$arrbarnumbers = json_decode(htmlspecialchars_decode($postrow[0]['barNumber']));
if(count($arrbarnumbers)>0){
$barnumbers = "";
for($i=count($arrbarnumbers);$i>0; $i--){
  $barnumbers .= $i." ".$arrbarnumbers[abs($i-count($arrbarnumbers))]."<br />";
}
}else{$barnumbers = "";}


$arrwhatnew = json_decode(htmlspecialchars_decode($postrow[0]['whatNew']));
if(count($arrwhatnew)>0){
$whatnew .= "<ul>";
foreach($arrwhatnew as $wn){
    $whatnew .= "<li>".nofollow($wn)."</li>";
}
$whatnew .= "</ul>";
}else{$whatnew = "";}


$htmlcomments = htmlspecialchars_decode($postrow[0]['comments']);
preg_match_all('/u003cspan class="review-title"u003e(.*?)u003c\/spanu003e(.*?)"/s', $htmlcomments, $matches);
if(count($matches[1])>0){
$comments .= "<ul>";
for($k=0;$k<count($matches[1]);$k++){
    $comments .= "<li><b>".trim($matches[1][$k])."</b> ".trim($matches[2][$k])."</li>";
}
$comments .= "</ul>";
}else{$comments = "";}
//<a rel="nofollow" target="_blank" class="btn btn-success" href="https://play.google.com/store/apps/details?id='.$postrow[0]['sitePage'].'">Скачать и установить</a>
$htmlt.= '<li class="media" style="list-style-type: none;">
                            <a class="pull-left" href="#" onclick="return false;">
                                <img alt="'.$postrow[0]['appName'].'" title="'.$postrow[0]['appName'].'" class="media-object" src="'.$postrow[0]['prevScreen'].'" width="100">
                            </a>
                            <div class="media-body">
                                <h1 class="media-heading">'.$postrow[0]['appName'].' для Android</h1>
                                <b>Разработчик:</b> '.$postrow[0]['developer'].'
                                <br />
                                <b>Возраст:</b> '.$postrow[0]['contentRating'].'
                                <br />
                                <b>Категория:</b> <a href="http://'.$_SERVER['SERVER_NAME'].'/?page=1&cat='.$postrow[0]['genre'].'">'.$allgenres[$postrow[0]['genre']].'</a>
                                <br />
                                <button onclick="download(\''.$postrow[0]['sitePage'].'\')" type="button" class="btn btn-success">Скачать и установить</button>
                                <hr />
                            </div>
                        </li>
                        <div id="carousel1" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                '.$carouselindicators.'
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                '.$carouselinner.'
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel1" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                            <a class="right carousel-control" href="#carousel1" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                        </div>
                        <h4>Дополнительная информация</h4>
                        <b>Цена:</b> '.(($postrow[0]['installOrBuy']=="Установить")? "Бесплатно": "Платно").'
                        <br />
                        <b>Проверено:</b> '.(($postrow[0]['editorChoice']=="1")? "Да": "Нет").'
                        <br />

                        <b>Надежный разрабочик:</b> '.(($postrow[0]['bestDeveloper']=="1")? "Да": "Нет").'
                        <br />
                        <b>Рейтинг:</b> '.$postrow[0]['score'].'
                        <br />
                        <b>Голосов:</b> '.$postrow[0]['totalRatings'].'
                        <br />
                        <!-- total ratings -->
                        '.$barnumbers.'
                        <b>Размер файла:</b> '.$postrow[0]['fileSize'].'
                        <br />
                        <b>Установок:</b> '.$postrow[0]['numDownloads'].'
                        <br />
                        <b>Версия приложения:</b> '.$postrow[0]['softwareVersion'].'
                        <br />
                        <b>Операционная система Андроид:</b> '.$postrow[0]['operatingSystems'].'
                        <br />
                        <b>Имя пакета</b> '.$postrow[0]['sitePage'].'
                        <br />
                        <b>Дата пуликации:</b> '.$postrow[0]['datePublished'].'
                        <br />
                        <h4>Описание приложения '.$postrow[0]['appName'].'</h4>
                        '.nofollow(htmlspecialchars_decode($postrow[0]['description'])).'
                        <h4>Изменения в новой версии '.$postrow[0]['appName'].'?</h4>
                        '.$whatnew.'
                        <h4>Отзывы об Android приложении '.$postrow[0]['appName'].'</h4>
                        '.$comments.'
                        '.
                        '<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<script type="text/javascript">
  VK.init({apiId: 5189652, onlyWidgets: true});
</script>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
</script>'
                        ;





}







function nofollow($html, $skip = null) {
    return preg_replace_callback(
        "#(<a[^>]+?)>#is", function ($mach) use ($skip) {
            return (
                !($skip && strpos($mach[1], $skip) !== false) &&
                strpos($mach[1], 'rel=') === false
            ) ? $mach[1] . ' rel="nofollow">' : $mach[0];
        },
        $html
    );
}
function translitIt($str)
{   //ГОСТ 7.79-2000
    $tr = array(
                "Є"=> "YE",
            "І"=> "I",
            "Ѓ"=> "G",
            "і"=> "i",
            "№"=> "",
            "є"=> "ye",
            "ѓ"=> "g",
            "А"=> "A",
            "Б"=> "B",
            "В"=> "V",
            "Г"=> "G",
            "Д"=> "D",
            "Е"=> "E",
            "Ё"=> "YO",
            "Ж"=> "ZH",
            "З"=> "Z",
            "И"=> "I",
            "Й"=> "J",
            "К"=> "K",
            "Л"=> "L",
            "М"=> "M",
            "Н"=> "N",
            "О"=> "O",
            "П"=> "P",
            "Р"=> "R",
            "С"=> "S",
            "Т"=> "T",
            "У"=> "U",
            "Ф"=> "F",
            "Х"=> "X",
            "Ц"=> "C",
            "Ч"=> "CH",
            "Ш"=> "SH",
            "Щ"=> "SHH",
            "Ъ"=> "",
            "Ы"=> "Y",
            "Ь"=> "",
            "Э"=> "E",
            "Ю"=> "YU",
            "Я"=> "YA",
            "а"=> "a",
            "б"=> "b",
            "в"=> "v",
            "г"=> "g",
            "д"=> "d",
            "е"=> "e",
            "ё"=> "yo",
            "ж"=> "zh",
            "з"=> "z",
            "и"=> "i",
            "й"=> "j",
            "к"=> "k",
            "л"=> "l",
            "м"=> "m",
            "н"=> "n",
            "о"=> "o",
            "п"=> "p",
            "р"=> "r",
            "с"=> "s",
            "т"=> "t",
            "у"=> "u",
            "ф"=> "f",
            "х"=> "x",
            "ц"=> "c",
            "ч"=> "ch",
            "ш"=> "sh",
            "щ"=> "shh",
            "ъ"=> "",
            "ы"=> "y",
            "ь"=> "",
            "э"=> "e",
            "ю"=> "yu",
            "я"=> "ya",
            "«"=> "",
            "»"=> "",
            "—"=> "-",
            " — "=> "-",
            " - "=> "-",
            " "=> "-",
            "..."=> "",
            ".."=> "",
            ":"=> "",
            "\""=> "",
            ","=> "",
            "!"=> "",
            ";"=> "",
            "%"=> "",
            "?"=> "",
            "*"=> "",
            "("=> "",
            ")"=> "",
            "\\"=> "",
            "/"=> "",
            "="=> "",
            "'"=> "",
            "&"=> "",
            "^"=> "",
            "$"=> "",
            "#"=> "",
            "@"=> "",
            "~"=> "",
            "`"=> "",
            " "=> "-",
            "."=> "",
            "+"=> "",
    );
    return strtolower(strtr($str,$tr));
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php

function cutString($string, $maxlen) {
    $len = (mb_strlen($string) > $maxlen)
        ? mb_strripos(mb_substr($string, 0, $maxlen), ' ')
        : $maxlen
    ;
    $cutStr = mb_substr($string, 0, $len);
    return (mb_strlen($string) > $maxlen)
        ? '' . $cutStr . ' ...'
        : '' . $cutStr . ''
    ;
}


$title2 = cutString($title,240);
$kw2 = "";
$descr2 = "";
?>
        <title><?php echo $title2; ?></title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php
if(isset($_GET['page']))
{
echo '<meta name="robots" content="noindex,follow" />';
}
?>
    </head>
    <body>
        <div class="container pg-empty-placeholder">
            <nav class="navbar navbar-default" role="navigation"> 
                <div class="container-fluid"> 
                    <div class="navbar-header"> 
                        <a class="navbar-brand" href="/">
                            <img src="logo.png" />
                        </a>                         
                    </div>                     
                    <ul class="nav navbar-nav">
                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a> 
                            <ul class="dropdown-menu">
                            <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=0">Головоломки</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=1">Бизнес</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=4">Здоровье и фитнес</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=5">Инструменты</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=6">Книги и справочники</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=7">Комиксы</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=8">Медицина</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=9">Музыка и аудио</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=10">Мультимедиа и видео</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=11">Новости и журналы</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=12">Образование</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=13">Персонализация</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=14">Погода</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=15">Покупки</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=16">Путешествия</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=17">Работа</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=18">Развлечения</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=19">Разное</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=20">Связь</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=21">Социальные</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=22">Спорт</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=23">Стиль жизни</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=24">Транспорт</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=25">Финансы</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=26">Фотография</a>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Игры</li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=27">Аркады</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=28">Викторины</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=29">Гонки</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=31">Казино</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=32">Карточные</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=33">Музыка</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=34">Настольные игры</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=35">Обучающие</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=37">Приключения</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=38">Ролевые</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=39">Симуляторы</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=40">Словесные игры</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=41">Спортивные игры</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=42">Стратегии</a>
                                </li>
                                <li>
                                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?page=1&cat=43">Экшен</a>
                                </li>
                            </ul>                             
                        </li>
                        <li>
                            <a href="#" onclick="randompage('<?php echo $urlRand; ?>'); return false;">RANDOM</a>
                        </li>
                        <li>
                            <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/faq">FAQ</a>
                        </li>
                        <li>
                            <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/about">О проекте</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search"> 
                        <div class="form-group"> 
                            <input id="searchbox" type="text" class="form-control" placeholder="">
                        </div>                         
                        <button onclick="startsearch(); return false;" type="button" class="btn btn-default">Поиск</button>
                    </form>
                </div>                 
            </nav>
            <div class="container">
                <div class="row"> 
                    <div class="col-md-6 col-md-push-3" id="content">
                        <?php echo $menu; ?>
                        <?php echo $htmlt; ?>
                        <?php echo $menu; ?>
                        <?php
                        if($_SERVER[REQUEST_URI]=="/faq"){
                            echo "<h1>УСТАНОВКА ПРИЛОЖЕНИЙ ИЗ ВЕБ-ВЕРСИИ GOOGLE PLAY</h1>
                            Для того чтобы установить приложение, нужно авторизоваться на сайте маркета учетной записи Google, с которой вы авторизованы на своем android-смартфоне, после чего найти нужное приложение на сайте, нажать установить, подождать когда сайт определит все устройства данной учетной записи, выбрать нужное (если их несколько), нажать Install. После этого на смартфоне автоматически начнется скачивание файла и его установка. Это не экономит ваш трафик, а просто делает поиск приложений более удобным. При данном способе установки также рекомендуется подключать смартфон к WiFi или безлимитному тарифу на мобильный интернет.
                            ";
                        }elseif($_SERVER[REQUEST_URI]=="/about"){
                            echo "<h1>О проекте</h1>
                            <p>Операционная система, или платформа Android, как ее принято называть, еще достаточно молода, но уже активно набирает популярность. На сегодняшний день большое количество телефонов, смартфонов и планшетов оснащаются ОС Андроид. У платформы есть множество неоспоримых преимуществ и поэтому общественный интерес к Android с каждым днем только увеличивается.</p>
                            <p>Сайт <b><a href='http://".$_SERVER['SERVER_NAME']."'>".$_SERVER['SERVER_NAME']."</a></b> представляет из себя большой <b>онлайн-каталог приложений Android</b>. Здесь вы можете найти программы для андроид на любой вкус, весь софт для андроид для Вашего удобства структурирован по категориям, имеет описание и скриншоты, к тому же мы никогда не храним файлы на сторонних файлообменниках - все программы Android хранятся на сайте play.google.com.</p>
                            <p>Специально для Вас создали раздел статьи про Android. В этом разделе мы собрали для Вас самые интересные и востребованные статьи, касающиеся операционной системы Android. Здесь вы узнаете, как получить root права, переместить приложения на SD карту, мы научим вас устанавливать приложения из .apk и многое другое!</p>
                            <p>Каждый день появляется множество приложений для Android и мы поможем вам быть в курсе самых горячих новинок. На нашем сайте вы можете найти <b>андроид программы на русском</b>. Большой популярностью пользуется офис для андроид, виджеты, графические оболочки - украсят ваш телефон и придадут ему оригинальность, а игры для андроид - не позволят скучать. Каталог программ для андроид <b><a href='http://".$_SERVER['SERVER_NAME']."'>".$_SERVER['SERVER_NAME']."</a></b> - это полноценная замена Андроид Маркет, присоединяйтесь!</p>
                            ";
                        }
                        ?>
                    </div>
                    <div class="col-md-3 col-md-pull-6">
                        <ul class="media-list">
                        <?php
                        for($i=0;$i<5;$i++){
        $rnd = rand(0,intval($totalit));
        $res5 = mysql_query("SELECT id, translit, developer, genre, appName, prevScreen FROM apps WHERE id=".$rnd);

while($row5 = mysql_fetch_array($res5))
{
//echo "Номер: ".$row5['id']."<br>\n";
echo '<li class="media">
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <img src="'.$row5['prevScreen'].'" title="'.$row5['appName'].'" alt="'.$row5['appName'].'" width="100" height="100">
                                        <div class="caption">
                                            <h3>'.$row5['appName'].'</h3>
                                            <p> <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$row5['translit'].'-'.$row5['genre'].'-'.$row5['id'].'.html" class="btn btn-default" role="button">Подробнее</a></p>
                                        </div>
                                    </div>
                                </div>
                            </li>';

}
}
                        ?>

                        </ul>                         
                    </div>
                    <div class="col-md-3">
                        <ul class="media-list"> 
                            <?php
                        for($i=0;$i<5;$i++){
        $rnd = rand(0,intval($totalit));
        $res5 = mysql_query("SELECT id, translit, developer, genre, appName, prevScreen FROM apps WHERE id=".$rnd);

while($row5 = mysql_fetch_array($res5))
{
//echo "Номер: ".$row5['id']."<br>\n";
echo '<li class="media">
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <img src="'.$row5['prevScreen'].'" title="'.$row5['appName'].'" alt="'.$row5['appName'].'" width="100" height="100">
                                        <div class="caption">
                                            <h3>'.$row5['appName'].'</h3>
                                            <p> <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$row5['translit'].'-'.$row5['genre'].'-'.$row5['id'].'.html" class="btn btn-default" role="button">Подробнее</a></p>
                                        </div>
                                    </div>
                                </div>
                            </li>';

}
}
                        ?>
                        </ul>                         
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>2015 г. Все права защищены. Каталог Андроид приложений.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
        <script>
        function randompage(url){
            document.location.href = url;
        }

        function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}


function startsearch(){
	var req = getXmlHttp();
	var searchbox = document.getElementById('searchbox');
    var content = document.getElementById('content');

	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			if(req.status == 200) {
                content.innerHTML = req.responseText;
			}
		}
	}
	req.open('GET', 'search.php?q='+encodeURIComponent(searchbox.value), true);
	req.send(null);
}

function download(app){
    var req = getXmlHttp();

	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			if(req.status == 200) {        //alert(req.responseText);
                document.location.href = "http://stopandroid.ru/redirect.php?url="+req.responseText;
                console.log(req.responseText);
                //window.location.replace("http://stopandroid.ru/redirect.php?url="+req.responseText);
                //console.log("http://stopandroid.ru/redirect.php?url="+req.responseText);
			}
		}
	}
	req.open('GET', 'download.php?app='+encodeURIComponent(app), true);
	req.send(null);
}

function base64_decode( data ) {

    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i=0, enc='';

    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));

        bits = h1<<18 | h2<<12 | h3<<6 | h4;

        o1 = bits>>16 & 0xff;
        o2 = bits>>8 & 0xff;
        o3 = bits & 0xff;

        if (h3 == 64)      enc += String.fromCharCode(o1);
        else if (h4 == 64) enc += String.fromCharCode(o1, o2);
        else               enc += String.fromCharCode(o1, o2, o3);
    } while (i < data.length);

    return unescape(enc);
}
        </script>
        <!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->

    </body>
</html>
