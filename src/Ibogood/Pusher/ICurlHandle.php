<?php
namespace Ibogood\Pusher;
interface ICurlHandle{
    public function run($index);
    public function getUrl();
    public function getOptions();
    public function getCallback();
}