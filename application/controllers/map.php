<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	public function index()
	{
        $MAP_LIST_LENGTH = 7;
        $url = 'http://openAPI.seoul.go.kr:8088/424b627a726c616339396d69555078/json/ListPriceModelStoreService/1/'.$MAP_LIST_LENGTH.'/001'; /*URL*/
        $data =file_get_contents($url);

        $json_object = json_decode( $data, false );
        $json_data = json_encode($json_object, JSON_UNESCAPED_UNICODE);
        echo $json_data;
    }
}
