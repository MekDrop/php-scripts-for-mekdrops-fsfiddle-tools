<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

$url = isset($_SERVER['HTTP_FETCH_URL'])?$_SERVER['HTTP_FETCH_URL']:null;

if ($url) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        $mt = explode(';', $info['content_type']);
        $ret = 'data:' . $mt[0] . ';base64,' . base64_encode($data);

        echo $ret;
}
