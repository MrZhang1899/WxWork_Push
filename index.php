<?php
//判断变量是否存在
if (isset($_GET['type'])) {
    $file = $_GET['type'];
    include('./' . $file . '.php');
}

//此处配置你的信息
$corpid = "";
$secret = "";
$agentid = 1000002;

//获取access_token
$url = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpid . '&corpsecret=' . $secret;
$token = https_request($url);
$access_token = $token['access_token'];

//配置消息通知参数
if (isset($_GET['msg'])) {
    $content = $_GET['msg'];
}

// 文本格式
$data = [
    'touser' => '@all',
    'msgtype' => 'text',
    'agentid' => $agentid,
    'text' => [
        'content' => $content
    ]
];
$messageUrl = 'https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=' . $access_token;
$message = https_request($messageUrl, 'post', $data);
echo json_encode($message);

// CURL
function https_request($url, $format = 'get', $data = null)
{
    $headerArray = array("Content-type:application/json;", "Accept:application/json");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if ($format == 'post') {
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data) {
            $data  = json_encode($data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    $data = json_decode(curl_exec($curl), true);
    // $data=curl_exec($curl);
    curl_close($curl);
    return $data;
}
