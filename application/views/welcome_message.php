<?php
	

	// echo "test";
	

?>

<div id="map" style="width:50%;height:100%;"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=0cdf332fff818cba293b2ea58cf8d7ca&libraries=services"></script>
<script>

	var addrs = [];

	$.ajax({
		// url: 'http://openAPI.seoul.go.kr:8088/424b627a726c616339396d69555078/json/ListPriceModelStoreService/1/10/001',
		url: '/index.php/map',
		cache: false,                     //사용자캐시를 사용할 것인가.
		dataType: "json",                  //서버로부터 받을 것으로 예상되는 데이터 타입.
		success: function(data){          //ajax요청을 통해 반환되는 데이터 data.
			console.log(data);
			var row = data.ListPriceModelStoreService.row;
			for(var i=0; i<row.length; i++) {
				maxMarker(row[i].SH_ADDR, row[i].SH_NAME);
			}                          
		}
	});

	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = {
			center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
			level: 3 // 지도의 확대 레벨
		};  

	// 지도를 생성합니다    
	var map = new kakao.maps.Map(mapContainer, mapOption); 

	function maxMarker(_addr, _name) {
		// 주소-좌표 변환 객체를 생성합니다
		var geocoder = new kakao.maps.services.Geocoder();

		// 주소로 좌표를 검색합니다
		geocoder.addressSearch(_addr, function(result, status) {

			// 정상적으로 검색이 완료됐으면 
			if (status === kakao.maps.services.Status.OK) {

				var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

				// 결과값으로 받은 위치를 마커로 표시합니다
				var marker = new kakao.maps.Marker({
					map: map,
					position: coords
				});

				// 인포윈도우로 장소에 대한 설명을 표시합니다
				var infowindow = new kakao.maps.InfoWindow({
					content: '<div style="width:150px;text-align:center;padding:6px 0;">' + _name + '</div>'
				});
				infowindow.open(map, marker);

				// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
				map.setCenter(coords);
			} 
		});   
	}

</script>