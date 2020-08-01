<?php

function random_code() {

    return rand(1111, 9999);
}


function getTimeStamp() {

    return substr(base_convert(time(), 10, 36) . md5(microtime()), 0, 16);

}

function d($array) {

    if (is_object($array)) {
        
        $array = $array->toArray();
    }

	echo "<pre>";
	print_r($array);die;
	
}

function dateFormat($date) {

    if (!empty($date)) {

        $result = date("d M, Y", strtotime($date));
        return $result ;
    }
}

function dataready($data) {
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

function send_sms($to, $message){   

    $url = "https://api.plivo.com/v1/Account/MAMMRHYMNLNZA5NTY5M2/Message/";

    $data = array(

        "src" => '919424981251',
        "dst" => $to,
        "text" => $message,
    );

    apply_curl($method = "POST", $data, $url);
}

function get_local_time($format, $datetime) {

    $timezone = Session::get('timezone');
    $timezone = isset($timezone) ? $timezone : "Asia/Kolkata";
    $datetime = new DateTime($datetime);
    $datetime->setTimezone(new DateTimeZone($timezone));
    $local_datetime = $datetime->format($format);

    return $local_datetime;
}

function get_area_code() {
    
    $url = 'http://ipinfo.io/'.Request::ip();
    $getCountryInfo =  json_decode(file_get_contents("$url"));
    $countryCode    = isset($getCountryInfo->country) ? $getCountryInfo->country : "IN";
    $result = 1;

    if($countryCode != ""){

        $getAreaCode = json_decode(file_get_contents('https://restcountries.eu/rest/v1/alpha?codes='.$countryCode));

        if(isset($getAreaCode[0]->callingCodes[0])){

            $result = $getAreaCode[0]->callingCodes[0];
        }
    }

    return $result;
}

function apply_curl($method = "POST", $data, $url, $token = ""){          
    
    $curl = curl_init();

    if ($method == "GET") {
        
        if ($data != "") {
            
            $url = $url."?".http_build_query($data);
        }

        $fields = array(
            
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers                       
                "Content-Type: application/json",
                "Accept-Language: en_US"
            ),
        );

    }elseif ($method == "POST") {
        
        $username = "AYQCE_COzWRgQmBoB0E9g9_RrXq3DB3-gUeJJ8lQjFNglF-PAkJdYzurhtDoBZW91WjKhptzqU0H2mTe";
        $password = "EPJXzqNnpN9yWJLgHR7d3IFhQeOj5RfqDQKVVursUxdueN3KkGl9Y0LCrGJa4Cl3HHRcl3A1mvyV6Aan";

        $fields = array(
        
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers                       
                "Content-Type: application/json",                
                //"Accept-Language: en_US",
                "Authorization: Bearer $token"
            ),            
        );                 
    }
    
    curl_setopt_array($curl, $fields);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        
       echo "cURL Error #:" . $err;
    
    }else{

        return json_decode($response);
    }
}