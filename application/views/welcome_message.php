<?php
	
	$url = 'http://openAPI.seoul.go.kr:8088/424b627a726c616339396d69555078/xml/ListPriceModelStoreService/1/5/'; /*URL*/
	$data =file_get_contents($url);
	$xml = simplexml_load_string($data);
	echo $xml->row[0]->SH_NAME[0];

?>