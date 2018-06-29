
<?php

$include = $_POST['file'];


if (file_exists($include)) {
    $starttime = microtime(); // default returns time as string
    
	ob_start(include($include)); // start output buffer

	readfile($cachepage); // at some point read cache index file
	$page_response = microtime() - $starttime; // page response time
	$speed = round((ob_get_length() / $page_response) / 1024, 3); //KB/s
	
	ob_end_clean();


	echo '{
		"response" : "'.$page_response.'",
		"speed" : "'.$speed.'"

	}';

}
else {
    echo 0;
}






?>