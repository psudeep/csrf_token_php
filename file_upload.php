<?php
/* for php 5.6 curl_file_create($file) 
   for php 5.5 @file is used
   This http://dummyurl.com/aws_api/upload is Node JS API where S3 file upload is explained in my anoher repo
*/   

function AWSUpload($filename, $file){
	$username = "USERNAME";
	$password = "PASSWORD";
	$url = "http://dummyurl.com/aws_api/upload";
	$cfile = new CURLFile($filename,'image/png','file_name');
	$postfields = array(
	    'file_name' => $filename,
	    'file' => curl_file_create($file) 
	    //...
	);
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	$headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	//Ignore SSL certificate verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	//echo $ch;die;
	$server_output = curl_exec ($ch);

	curl_close ($ch);
	return $server_output;
}

?>
