<?php
session_start();

// Simulate automatic login
$_SESSION['loggedin'] = true;

// Function to get user location from IP
function getUserLocation() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $access_key = '74d82695097c9ae636753594abe9b543'; // Sign up for a free API key at ipinfo.io or similar service
    $response = file_get_contents("http://ipinfo.io/{$ip}/json?token={$access_key}");
    return json_decode($response, true);
}

// Get user location
$location = getUserLocation();
$countryCode = $location['country'] ?? '';

// Check if the user is from the US
if ($countryCode === 'US') {
    // Redirect US users to the welcome page
    header('Location: https://www.amazon.com/Simple-Joys-Carters-Short-Sleeve-Bodysuit/dp/B07GY1RRZF');
} else {
    // Redirect non-US users to Amazon
    header('Location: https://www.amazon.com/Simple-Joys-Carters-Short-Sleeve-Bodysuit/dp/B07GY1RRZF');
}

exit();
?>
