<?php


namespace Ibogood\Restful\Curl;

use Ibogood\Restful\Request;
use Ibogood\Restful\RestClient;

class CurlRestClient extends RestClient
{
    /**
     * @param string $method GET|POST|PUT|DELETE...
     * @param string $uri
     * @param array  $data
     * @param array  $options
     * @return Request
     */
    protected function createRequest($method, $uri, $data, $options)
    {
        if ($options[self::OPT_ASYNC]){
            $request = new AsyncCurlRequest($method, $uri, $data, $options);
        } else {
            $request = new CurlRequest($method, $uri, $data, $options);
        }

        return $request;
    }
}