<?php
// Earl Austin A. Zuniga
// BSCS 4A BICOL UNIVERSITY

// php script to get response time and speed in kb/s



// file path
$include = $_POST['file'];


if (file_exists($include)) {
    $starttime = microtime(); // returns time
    
	ob_start();
	include($include);
	readfile($cachepage); // read cache
	$page_response = microtime() - $starttime; // page response time
	$speed = round((ob_get_length() / $page_response) / 1024, 3); //KB/s
	$filesize = filesize($include);

	$buffer = ob_get_clean(); // store buffer in variable
	$buffer = ''; // empty buffer
	ob_end_clean(); // clean

	// the data
	echo '{
		"response" : "'.$page_response.'",
		"speed" : "'.$speed.'",
		"filesize" : "'.$filesize.'",
		"filename" : "'.$include.'"

	}';

}
else {
	// if file does not exist
    echo 0;
}






?>