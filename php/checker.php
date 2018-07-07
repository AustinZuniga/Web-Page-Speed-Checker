<?php
// Earl Austin A. Zuniga
// BSCS 4A BICOL UNIVERSITY

// php script to get response time and speed in kb/s

class checker{
	function check_speed($include){
		if (file_exists($include)) {
		    $starttime = microtime(); // returns time
		    
			ob_start();
			include($include);
			readfile($cachepage); // read cache
			$page_response = microtime() - $starttime; // page response time
			$speed = round((ob_get_length() / $page_response) / 1024, 3); //KB/s
			$filesize = filesize($include);
			$memory = (memory_get_usage()/1048576);

			$buffer = ob_get_clean(); // store buffer in variable
			$buffer = ''; // empty buffer
			ob_end_clean(); // clean

			// the data
			echo '{
				"response" : "'.$page_response.'",
				"speed" : "'.$speed.'",
				"filesize" : "'.$filesize.'",
				"filename" : "'.$include.'",
				"memory" : "'.$memory.'"

			}';

		}
		else {
			// if file does not exist
		    echo 0;
		}

	}


	function get_html($link_file){
		$html = file_get_contents($link_file);

		$dom = new DOMDocument;
		 
		@$dom->loadHTML($html);

		 
		echo '<h2> Breaking Down your Web Page Code: </h2>
		<h4> Page Request that slows down your Web page: <br> </h4>
		<div style="margin-left:30px;"><b>Script Request: </b> </div>';

		$links = $dom->getElementsByTagName('script');
		foreach ($links as $link){
		    echo '<div style="color:red; margin-left: 50px;">'.$link->getAttribute('src').'</div>';
		}

		$links = $dom->getElementsByTagName('link');
		echo '<div style="margin-left:30px;"><b>CSS Request:</b></div>';
		foreach ($links as $link){
		    echo '<div style="color:red; margin-left: 50px;">'.$link->getAttribute('href'). '</div>';
		}
		
		$links = $dom->getElementsByTagName('img');
		echo '<div  style="margin-left:30px;"><b>Image Request:</b></div><br>';

		foreach ($links as $link){
		    echo '<div style="color:red; margin-left: 50px;">'.$link->getAttribute('src').'</div><br>';
		}	

	}
}



$checker = new checker;


// checking speed
if(isset($_POST['file'])){
	$checker->check_speed($_POST['file']);
}

// breaking down html codes
elseif (isset($_POST['files'])) {
	$checker->get_html($_POST['files']);
}






?>