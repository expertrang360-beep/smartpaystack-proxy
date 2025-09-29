<?php
// SmartPaystack Proxy

$paystackSecret = ""; // Paste your Paystack secret key here later

$token = "SMARTPAYSTACK_TOKEN_2025_XYZ987654321";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

if (!isset($_POST['token']) || $_POST['token'] !== $token) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid token']);
    exit;
}

$url = "https://api.paystack.co/transaction/initialize";
$data = $_POST['data'] ?? [];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $paystackSecret",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>

