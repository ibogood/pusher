<?php

namespace Test;
require_once '../autoload.php';
use Ibogood\Pusher\CurlHandle;
use Ibogood\Pusher\PushClient;

class Index
{
    public function test()
    {
        $list = [];
        for ($i = 0; $i < 100; $i++) {
            $list[] = 'i:' . $i;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET';
        $curlHandle = new CurlHandle($url, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ], function ($index) use ($list) {
            return ['value' => $list[$index]];
        });
        $request = new PushClient(10, 1000);
        $request->addHandle($curlHandle);
        $request->exec();
    }
}

$index = new Index();
$index->test();

