<?php 
// dump POST body
$entityBody = file_get_contents('php://input');

$log_file = dirname(__FILE__) . '/dumpost.log';

http_response_code(204); // HTTP 204 No Content




file_put_contents($log_file, $entityBody, FILE_APPEND | LOCK_EX);
