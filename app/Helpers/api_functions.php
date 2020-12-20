<?php

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\Constants;
use App\Helpers\ApiConstants;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

/** Return error api response */
function problemResponse(string $message = null, int $status_code = null, Request $request = null, Exception $trace = null)
{
    $code = ($status_code != null) ? $status_code : '';
    $traceMsg = empty($trace) ?  null  : $trace->getMessage();
    $traceTrace = empty($trace) ?  null  : $trace->getTrace();

	$body = [
		'msg' => $message,
		'code' => $code,
		'success' => false,
		'error_debug' => $traceMsg,
		'error_trace' => $traceTrace,
	];
	empty($trace) ? null : logger()->error($trace);

	return response()->json($body)->setStatusCode($code);
}


/** Return error api response */
function inputErrorResponse(string $message = null, int $status_code = null, Request $request = null, ValidationException $trace = null)
{
    $code = ($status_code != null) ? $status_code : '';
    $traceMsg = empty($trace) ?  null  : $trace->getMessage();
    $traceTrace = empty($trace) ?  null  : $trace->getTrace();

	$body = [
		'msg' => $message,
		'code' => $code,
		'success' => false,
		'errors' => empty($trace) ?  null  : $trace->errors(),
	];

	return response()->json($body)->setStatusCode($code);
}

/** Return valid api response */
function validResponse(string $message = null, $data = null, $request = null)
{
	if(is_null($data) || empty($data))
	{
		$data = null;
	}
	$body = [
		'msg' => $message,
		'data' => $data,
        'success' => true,
		'code' => ApiConstants::GOOD_REQ_CODE,

	];

	// if (!is_null($request)) {
	// 	save_log($request, $body);
	// }

	return response()->json($body);
}

// function save_log(Request $request, $response)
// {
// 	return ApiLog::create([
// 		'url' => $request->fullUrl(),
// 		'method' => $request->method(),
// 		'data_param' => json_encode($request->except(Constants::ignoreApiKeysLog())),
// 		'response' => json_encode($response),
// 	]);
// }

    /**Returns formatted money value
     * @param float amount
     * @param int places
     * @param string symbol
     */
    function format_money($amount , $places = 2, $symbol = '$'){
        return $symbol.''.number_format((float)$amount ,$places);
    }


     /**Returns formatted date value
     * @param string date
     * @param string format
     */
    function format_date($date , $format = 'Y-m-d'){
        return date($format , strtotime($date));
    }


	function collect_pagination($transformer , LengthAwarePaginator $pagination)
    {
        $all_pg_data = $pagination->toArray();
        $data = collect($pagination->getCollection())->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
        unset($all_pg_data['links']); // remove links
        unset($all_pg_data['data']); // remove old data mapping

        $buildResponse['pagination_meta'] = $all_pg_data;
        $buildResponse['pagination_meta']["can_load_more"] = $all_pg_data["to"] < $all_pg_data["total"];
        $buildResponse['data'] = $data;
        return $buildResponse;
    }