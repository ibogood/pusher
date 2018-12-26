<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/26 0026
 * Time: 12:43
 */

namespace Ibogood\Pusher;


class CurlHandle implements ICurlHandle
{
    protected $url;
    protected $options;
    protected $callback;
    public function __construct($url,$options,$callback){
        $this->url = $url;
        $this->options = $options;
        $this->callback = $callback;
    }
    public function run($index){
        return ($this->callback)($index);
    }
    public function getUrl(){
        return $this->url;
    }
    public function getOptions(){
        return $this->options;
    }
    public function getCallback(){
        return $this->callback;
    }
}