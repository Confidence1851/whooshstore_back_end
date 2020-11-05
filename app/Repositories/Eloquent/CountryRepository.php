<?php

namespace App\Repositories\Eloquent;
use App\Models\Country;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }


    public function all(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://restcountries.eu/rest/v2/all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
             CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_HTTPHEADER => array(
            // 	// Set Here Your Requesred Headers

            // ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            $returnData = $result;
            return $returnData ;
        }
    }
}
