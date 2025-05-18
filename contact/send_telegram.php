<?php
header('Content-Type: application/json'); // penting

$botToken = "8081955057:AAH8ohR-Hx7JPe-BeU-bgjMtlCrhZyctDxA";
$chatId = "1281187772";

$name = htmlspecialchars($_POST['name'] ?? '');
$wa = htmlspecialchars($_POST['wa'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

$text = "📩 *Pesan dari Website Kopi Santai*\n\n";
$text .= "*Nama:* $name\n";
$text .= "*No WA:* $wa\n";
$text .= "*Pesan:* \n$message";

$url = "https://api.telegram.org/bot$botToken/sendMessage";

$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result && isset($result['ok']) && $result['ok'] === true) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengirim pesan ke Telegram']);
}
?>
