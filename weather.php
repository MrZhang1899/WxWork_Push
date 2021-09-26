<?php
require './Querylist/phpQuery.php';
require './Querylist/QueryList.php';

use QL\QueryList;

if ($_GET['loc']) {
    $location = $_GET['loc'];
} else {
    $location = 'tianhequ'; //默认显示区域
}

$url = 'http://m.tianqi.com/' . $location.'/';


$rules = [
    // 位置
    'location' => ['.hhx_newAllDayTit', 'text'],
    // 更新时间
    'date' => ['#nowHour', 'text'],
    // 温度
    'temp' => ['.now', 'text'],
    // 湿度
    'shidu' => ['.b2', 'text'],
    // 今日温度
    'today' => ['.temp', 'text'],
    // 风向
    'wind' => ['.b3', 'text'],
    // 空气质量
    'kongqi' => ['.b1', 'text'],
];

$data = QueryList::Query($url, $rules,'', 'utf-8', 'utf-8')->data;

$data  = $data[0];

// 分割位置
$loc = explode("24",$data['location']);
$data['location']=$loc[0];
$data['location'] = str_replace(PHP_EOL, '', $data['location']);
// 分割今日温度
$loc = explode("°C",$data['today']);
$data['today']=$loc[1];
$data['today'] = str_replace(PHP_EOL, '', $data['today']);
//排版文字
$content = $data['location'] . " - " . $data['temp'] . "\n" . " " . "\n更新时间 " . $data['date'] . "\n" . " " . "\n" . $data['today'] . "°C\n" . " " . "\n" . $data['shidu'] . "\n" . " " . "\n" . $data['wind'] . "\n" . " " . "\n空气质量" . $data['kongqi'];

// echo "<pre>";
// print_r($content);
// die();

function geturldata($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $content = curl_exec($ch);
    return $content;
}
