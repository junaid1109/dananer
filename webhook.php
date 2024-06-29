<?php

$secret_token = "junaidbhattiToken1109";

// Verify the request
$headers = getallheaders();

if (!isset($headers['X-Hub-Signature'])) {
    http_response_code(400);
    exit("Invalid request: Signature missing");
}

// Read the raw POST data
$post_data = file_get_contents('php://input');

if (!$post_data) {
    http_response_code(400);
    exit("Invalid request: No payload data");
}

// Verify the signature
$expected_signature = 'sha1=' . hash_hmac('sha1', $post_data, $secret_token);
$received_signature = $headers['X-Hub-Signature'];

if (!hash_equals($expected_signature, $received_signature)) {
    http_response_code(403);
    exit("Invalid signature");
}

// Decode the JSON payload
$payload = json_decode($post_data, true);

if (!$payload) {
    http_response_code(400);
    exit("Invalid payload data");
}

// Execute git pull to fetch the latest changes from the repository
$output = shell_exec('git pull');
echo $output;
