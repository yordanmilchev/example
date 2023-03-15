<?php

if (!function_exists('json_response_success')) {
        
    /**
     * json_response_success
     * @example return json_response_success(['content'=>'<html attr="val">text</html>']);
     * @return Response
     */
    function json_response_success($data = null)
    {
        return (new \App\Utilities\JsonResponse())->success($data);
    }
}

if (!function_exists('json_response_fail')) {
    
    /**
     * json_response_fail
     * @example return json_response_fail($validator->errors());
     * @return Response
     */
    function json_response_fail($data = null)
    {
        return (new \App\Utilities\JsonResponse())->fail($data);
    }
}

if (!function_exists('json_response_error')) {
    
    /**
     * json_response_error
     * @example return json_response_error('Server overloaded!' [, 400]);
     * @return Response
     */
    function json_response_error($message, $httpStatusCode=null)
    {
        return (new \App\Utilities\JsonResponse())->error($message, $httpStatusCode=null);
    }
}