<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use ValidatesRequests;


    /**
     * this response is for fetch data that have result only
     *
     * @param array $data
     * @param String $message
     * @param bool $status
     * @return JsonResponse
     */

    protected function successResponse($data = [], $message = "", $status = true)
    {
        $array = [
            "status" => $status,
            "code" => Response::HTTP_OK,
            "message" => $message,
            "data" => $data,
        ];
        return response()->json($array, Response::HTTP_OK);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function createResponse($data)
    {
        $array = [
            "status" => true,
            "code" => Response::HTTP_CREATED,
            "data" => $data,
        ];
        return response()->json($array, Response::HTTP_CREATED);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */

    protected function failResponse($code = Response::HTTP_INTERNAL_SERVER_ERROR, $message = 'Something went wrong,please try again later')
    {
        $array = [
            "code" => $code,
            "message" => $message,
        ];
        return response()->json($array, $code);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */

    protected function notFoundResponse($message = "No Data Found")
    {
        $array = [
            "status" => false,
            "code" => Response::HTTP_NOT_FOUND,
            "message" => $message,
        ];
        return response()->json($array, Response::HTTP_NOT_FOUND);
    }

    /**
     * This function is using with delete and update methods
     * @return JsonResponse
     */
    protected function noContentResponse()
    {
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

}