<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;

abstract class ApiController extends BaseController
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
    	return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
    	$this->statusCode = $statusCode;
    	return $this;
    }
    public function respondNotFound($message = 'Not Found!')
    {
    	return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondForbidden($message = 'Forbidden!')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    public function respondUnauthorized($message = 'Unauthorized!')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
    	return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respond($data, $headers = [])
    {
    	return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
    	return $this->respond([
    		'error' => [
    			'message' => $message,
    			'status_code' => $this->getStatusCode()
    		]
    	]);
    }

    public function respondSuccess($message)
    {
        return $this->respond([
                'success' => [
                    'message' => $message,
                    'status_code' => $this->getStatusCode()
                ],
                'code' => $this->getStatusCode()
            ]);
    }

    /**
     * New repond for api v7*
     */
    public function respondValidationError($errors) {
        return $this->respond([
            'status_code' => $this->getStatusCode(),
            'message' => 'The given data was invalid.',
            'success' => false,
            'errors' => $errors
        ]);
    }

    //4** errors
    public function respondMessage($message, $success = true) {
        return $this->respond([
            'status_code' => $this->getStatusCode(),
            'message' => $message,
            'success' => (boolean) $success
    	]);
    }

    /**
     * New response object 
     */
    public function respondData($data, $headers = [])
    {
        $data = $data;
        $data['code'] = $this->getStatusCode();
        
    	return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondErrMsg($message, $headers = []) {
        $data = [
            'error' => ['message' => $message], 
            'code' => $this->getStatusCode()
        ];

        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondMsg($message, $headers = []) {
        $data = [
            'success' => ['message' => $message], 
            'code' => $this->getStatusCode()
        ];

        return response()->json($data, $this->getStatusCode(), $headers);
    }
}
