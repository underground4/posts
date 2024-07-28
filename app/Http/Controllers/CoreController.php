<?php

namespace App\Http\Controllers;

abstract class CoreController extends Controller
{
    /**
     * Routing setup
     * @return mixed
     */
    abstract static public function routers();

    protected $headers = [
        'charset' => 'utf-8',
        'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept, Redirect',
    ];

    public function getGuardName()
    {
        return 'api';
    }

    /**
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    protected function responseError(\Exception $e)
    {
        if (env('APP_DEBUG')) {
            throw $e;
        }
        $code = $e->getCode();
        if (!$code) {
            $code = 400;
        }
        return response()->json($this->responsePrepare(['message' => $e->getMessage()], $code), $code, $this->headers);
    }

    /**
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseSuccess($data, $code = 200)
    {
        return response()->json($this->responsePrepare($data, $code), $code, $this->headers, JSON_INVALID_UTF8_IGNORE);
    }

    /**
     * @param $data
     * @param int $code
     * @return array
     */
    protected function responsePrepare($data, $code)
    {
        if ($data instanceof \Exception) {
            $data = $data->getMessage();
        }

        $response = [
            'status' => $code,
            'response' => $data,
        ];

        return $response;
    }
}
