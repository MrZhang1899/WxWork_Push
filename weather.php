<?php
//Querylist v3
require './Querylist/phpQuery.php';
require './Querylist/QueryList.php';

use QL\QueryList;

if ($_GET['loc']) {
    $location = $_GET['loc'];
} else {
    $location = 'tianhequ';//默认显示区域
}
//爬取网站
$url = 'https://www.tianqi.com/' . $location;
//规则设置
$rules = [
    // 位置
    'location' => ['.name>h2', 'text'],
    // 当前日期
    // 'date' => ['.week', 'text'],
    // 温度
    'temperature' => ['.now', 'text'],
    // 细节
    'detail' => ['.shidu', 'text'],
    // 温度图片
    // 'img' => ['.weather_info>dt>img', 'src'],
    // 日出时间
    'start_end' => ['.kongqi>span', 'text'],
    // 空气质量
    'kongqi' => ['.kongqi>h5:eq(0)', 'text'],
    // 状态
    'status' => ['.weather>span', 'text'],
];
//内容抓取
$data = QueryList::Query($url, $rules)->data;
$data  = $data[0];
$data['date'] = date("Y-m-d");

//排版文字
$content = $data['location'] . " - " . $data['temperature'] . "\n" . " " . "\n" . $data['status'] . "\n" . " " . "\n" . $data['start_end'] . "\n" . " " . "\n" . $data['kongqi'] . "\n" . " " . "\n" . $data['detail'] . "\n" . " " . "\n" . $data['date'];
