<?php
declare(strict_types=1);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . (getenv('APP_URL') ?: '*'));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']); exit;
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];

$name    = trim($data['name']    ?? '');
$email   = trim($data['email']   ?? '');
$company = trim($data['company'] ?? '');
$service = trim($data['service'] ?? '');
$message = trim($data['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Name, email and message are required.']); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Invalid email address.']); exit;
}
if (strlen($message) > 2000) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Message too long.']); exit;
}

$to      = getenv('CONTACT_EMAIL') ?: 'marshall@marshalltechco.com';
$subject = "New Enquiry from {$name} — Marshall TechCo";

$body  = "Name:    {$name}\r\n";
$body .= "Email:   {$email}\r\n";
$body .= $company ? "Company: {$company}\r\n" : '';
$body .= $service ? "Service: {$service}\r\n" : '';
$body .= "\r\nMessage:\r\n{$message}\r\n";

$headers  = "From: noreply@marshalltechco.com\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['success' => true, 'message' => "Thanks {$name}! We'll be in touch within 1 business day."]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Mail delivery failed. Please email us directly.']);
}
