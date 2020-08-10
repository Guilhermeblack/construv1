<?php 

	$point = curl_init('immobilesms.hopto.org/recebe_sms.php?user=lucas&numero=1699730707&msg=ola+jovem2');
	//curl_setopt($point, CURLOPT_RETURNTRANSFER, true); 
	$result = curl_exec($point);
	curl_close($point);
	//var_dump($result);
 ?>