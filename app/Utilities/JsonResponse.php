<?php
namespace App\Utilities;

use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

/**
 * JsonResponse
 * Implementation of the JSend specification https://github.com/omniti-labs/jsend
 *
 * @example
 * return (new JsonResponse())->success(array ('content_type'=>'html', 'content'=>'') )->get();
 *     with helper -> return json_response_success(['content'=>'<html attr="val">text</html>']);
 * return (new JsonResponse())->fail(MessageBag|array)->get();
 *     with helper -> return json_response_fail($validator->errors());
 * return (new JsonResponse())->error('Unable to communicate with database.' [, 400])->get();
 *     with helper -> return json_response_error('Server overloaded!' [, 400]);

RESPONSE STRUCTURE DRAFT
-------------------
success response
--------------------
status: (string) "success"
data:
    content_type: (optional|html|json|text)
    content: (string)
--------------------
fail response //Use when the request is rejected due to invalid data or call conditions
--------------------
status: (string) "fail"
data:
    errors
        id: (optional|string) "id of element"
        message: "error description"
        error_code: (optional|int)
--------------------
error response //Use when the request fails due to an error on the server. For example: Unable to communicate with database
--------------------
status: (string) "error"
message: (string) "error description"
 */
class JsonResponse
{
    protected $response;
    protected $jsonResponseVersion=1;
    public $httpStatusCode=200;
    protected $jsonResponse = [];

    public function __construct()
    {
        $this->response = new Response();
        $this->response->header('Content-Type', 'application/json');
        $this->jsonResponse['json_response_version']=$this->jsonResponseVersion;
    }

    public function success($data = null) : Response
    {
        $this->jsonResponse['status']='success';
        $this->jsonResponse['data']=$data;
        $this->response->setContent(json_encode($this->jsonResponse, JSON_UNESCAPED_UNICODE));
        return $this->response;
    }

    public function fail($data) : Response
    {
        $this->jsonResponse['status']='fail';
        if(!empty($data)) {
            if ($data instanceof MessageBag) {

                $this->jsonResponse['data']['errors'] = [];
                foreach ($data->messages() as $elementId => $errorMessagesArr) {
                    array_push($this->jsonResponse['data']['errors'],['id'=>$elementId, 'message'=>$errorMessagesArr]);
                }
            }
            else {
                $this->jsonResponse['data']=$data;
            }
        }

        $this->response->setContent(json_encode($this->jsonResponse, JSON_UNESCAPED_UNICODE));
        return $this->response;
    }

    public function error($message, $httpStatusCode=null) : Response
    {
        if(!empty($httpStatusCode)) {
            $this->httpStatusCode = $httpStatusCode;
        }

        $this->jsonResponse['status']='error';
        $this->jsonResponse['message']=$message;

        $this->response->setContent(json_encode($this->jsonResponse, JSON_UNESCAPED_UNICODE));
        return $this->response;
    }
}