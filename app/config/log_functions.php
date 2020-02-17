<?php

function log_error_into_file($msg, $response_code, string $file = "error_log.log")
{
	error_log("error: " . $response_code . " " . $today = date("F j, Y, g:i a")  . "	$msg \n", 3, "app/errors/$file");
}

function log_activity_into_file($msg, string $file = "error_log.log")
{
	file_put_contents($file, $msg . "\n", FILE_APPEND | LOCK_EX);
}

// https://www.php.net/manual/en/function.file-put-contents