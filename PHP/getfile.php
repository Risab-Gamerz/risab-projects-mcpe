
<?php
// Your Linkvertise authentication token
$token = "0b5916bb1bce8ab33e8d2b0712b42a75ef3ee40d2bc181b4f8d3092ddda5c124";

// The Mediafire link to redirect to after validation
$mediafireLink = "https://www.mediafire.com/file/abc123/file.zip";

// Get the hash from the URL
$hash = $_GET['hash'] ?? null;

if (!$hash) {
    die("Access denied. Missing hash.");
}

// Prepare API call to Linkvertise
$url = "https://publisher.linkvertise.com/api/v1/anti_bypassing?token=$token&hash=$hash";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Check the response and act accordingly
if (trim($response) === "true") {
    // Valid hash: redirect to Mediafire
    header("Location: $mediafireLink");
    exit();
} else {
    // Invalid or expired hash
    die("Access denied. Invalid or expired link.");
}
?>
