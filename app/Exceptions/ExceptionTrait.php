<?php

namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response; 


trait ExceptionTrait
{
	public function apiException($request, $e)
	{
		if ($this->isModel($e)){
            // return response() -> json("Model Not Found", 404);
            return $this->ModelResponse($e);
        }

	        if ($this->isHttp($e)){
	            return $this->HttpResponse($e);
	        }

        		return parent::render($request, $exception);
	}

	public function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}

	public function isHttp($e)
	{
		return $e instanceof NotFoundHttpException;
	}

	public function ModelResponse($e)
	{
		return response()->json([
        	'errors' => 'Product Not Found'
        ], Response::HTTP_NOT_FOUND);
	}

	public function HttpResponse($e)
	{
		return response()->json([
        	'errors' => 'Route Not Found'
        ], Response::HTTP_NOT_FOUND);
	}
}



