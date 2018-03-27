<?php

namespace App\Traits;

/**
 * 输出
 * Trait ResponseAble
 * @package App\Traits
 */
trait ResponseAble
{
    /**
     * 成功返回JSON
     * @param string|array|object $response 返回值
     * @param string $message 信息
     * @return array|mixed
     */
    protected function success($response = '', $message = '')
    {
        $response = [
            'status' => true,
            'message' => $message,
            'code' => 0,
            'data' => $response ? $response : new \stdClass(),
        ];

        if (isDevelopment()) {
            $response['query'] = \Debugbar::getData()['queries'];
        }

        return response($response, 200);
    }

    /**
     * 失败返回JSON
     * @param string $message 错误信息
     * @param int $code 错误代码
     * @param int $httpCode http状态码
     * @return array|mixed
     */
    protected function error($message = '', $code = -1, $httpCode = 200)
    {
        $response = [
            'status' => false,
            'message' => $message,
            'code' => $code,
            'data' => new \stdClass(),
        ];

        if (isDevelopment()) {
            $response['query'] = \Debugbar::getData()['queries'];
        }

        return response($response, $httpCode);
    }
}