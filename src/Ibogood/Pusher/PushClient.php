<?php
/**
 * Created by PhpStorm.
 * User: ibogood
 * Date: 2018/12/26 0026
 * Time: 12:34
 */

namespace Ibogood\Pusher;


use Ibogood\Restful\Curl\CurlMulti;

class PushClient
{
    protected $maxConnections = 200; //每次最大连接数
    protected $totalCount  = 10000; //总个数
    protected $repeatCallback = null;
    /**
     * 单个发射句柄.
     *
     * @var \Ibogood\Pusher\ICurlHandle
     */
    protected $curlHandle = null; //CurlHandle
    public function __construct($maxConnections=200,$totalCount=10000)
    {
        $this->maxConnections = $maxConnections;
        $this->totalCount = $totalCount;
    }

    public function generateParams(){

    }
    public function addHandle(ICurlHandle $curlHandle){
        $this->curlHandle = $curlHandle;
    }
    public function run(){
        try {
            $start = microtime(true);
            $maxConnections = 100;
            $maxNum = 1000;

            $curlMulti = new CurlMulti([
                CURLMOPT_MAXCONNECTS => $maxConnections,
            ]);

            $curlHandle = $this->curlHandle;

            //$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET';
//            $url = "https://m-nj.mainaer.com/";
//            $url = "https://www.baidu.com/";

            echo "init...\n";

            for ($i = 0; $i < $maxConnections; $i++){
                $curlMulti->add($curlHandle->getUrl(),$curlHandle->getOptions());
//                $curlMulti->add($url, [
//                    CURLOPT_RETURNTRANSFER => 1,
//                    CURLOPT_SSL_VERIFYPEER => false,
//                    CURLOPT_SSL_VERIFYHOST => false,
//                ]);

            }

            echo "begin exec...\n";
            $curlMulti->exec();
            $curlMulti->waitAll(function($content, $curl)use(&$completedNum, $maxNum, $curlMulti, $maxConnections){
                $completedNum++;
                if ($completedNum < $maxNum - $maxConnections + 1){
                    $curlMulti->add($curl, [
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                    ]);
                }
//                var_dump($content, $curl);
                echo "complete $completedNum: length=" . strlen($content)."\r";
            });

            echo "\n";
            echo "time: " . (microtime(true) - $start) . "\n";
        } catch (\Exception $e){
//            $this->error($e->getMessage());
//            $this->error($e->getTraceAsString());
        }
    }
    public function setRepeat(){

    }
}