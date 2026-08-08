<?php
header('Content-Type: application/json');

$message = $_POST['message'] ?? '';

if (!$message) {
    echo json_encode(['response' => 'Please say something!']);
    exit;
}

$apiKey = 'YOUR_OPENAI_API_KEY'; // Add your key here
$url = 'https://api.openai.com/v1/chat/completions';

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'system', 'content' => 'You are an iPhone sales assistant. Help customers choose iPhones based on their needs, promoting our products.'],
        ['role' => 'user', 'content' => $message]
    ]
];

$options = [
    'http' => [
        'header' => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
        'method' => 'POST',
        'content' => json_encode($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === false) {
    echo json_encode(['response' => 'Sorry, I couldn\'t process that.']);
} else {
    $response = json_decode($result, true);
    $botMessage = $response['choices'][0]['message']['content'] ?? 'Sorry, something went wrong.';
    echo json_encode(['response' => $botMessage]);
}
?>