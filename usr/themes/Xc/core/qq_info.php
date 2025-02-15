<?php
header('Content-Type: application/json; charset=utf-8');

$QQ = $_POST["qq"];
$defaultAvatar = 'https://q1.qlogo.cn/g?b=qq&nk=' . $QQ . '&s=100'; // 默认头像地址

if (!empty($QQ) && preg_match('/^\d{5,10}$/', $QQ)) {
    // 根据用户输入的QQ号替换API链接中的固定值
    $apiUrl = 'https://api.qqsuu.cn/api/dm-qqnc?qq=' . urlencode($QQ);

    // 初始化cURL
    $curl = curl_init();
    // 设置cURL选项
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // 发送请求并获取响应
    $response = curl_exec($curl);
    // 关闭cURL
    curl_close($curl);

    // 解析API响应
    $apiResponse = json_decode($response, true);

    if ($apiResponse && isset($apiResponse['code']) && $apiResponse['code'] === 0) {
        $nickname = $apiResponse['nick'];
        $result = array('name' => $nickname, 'avatar' => $defaultAvatar, 'success' => true); // 添加成功的标志信息
    } else {
        $result = array('name' => '', 'avatar' => $defaultAvatar, 'success' => false); // 获取昵称失败或验证不通过时返回默认值或错误消息
    }
}

$jsonResult = json_encode($result, JSON_UNESCAPED_UNICODE);

if ($jsonResult === false) {
    $jsonResult = json_encode($result);
}

echo $jsonResult;

