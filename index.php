<?php
session_start();

// Simulate automatic login
$_SESSION['loggedin'] = true;

// Function to get user location from IP
function getUserLocation() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $access_key = '74d82695097c9ae636753594abe9b543'; // API key from ipinfo.io

    // Fetch the response from the IP info service
    $url = "http://ipinfo.io/{$ip}/json?token={$access_key}";
    $response = @file_get_contents($url); // Suppress warnings with @

    if ($response === FALSE) {
        // Log the error
        error_log("Error fetching location data from IP info service.");
        return []; // Return empty array if there is an error
    }

    // Decode the JSON response
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // Log the error
        error_log("Error decoding JSON response: " . json_last_error_msg());
        return []; // Return empty array if JSON decoding fails
    }

    return $data;
}

// Get user location
$location = getUserLocation();
$countryCode = $location['country'] ?? '';

// Set the URL for redirection
$url = 'https://www.amazon.com/Simple-Joys-Carters-Short-Sleeve-Bodysuit/dp/B07GY1RRZF';

// Redirect based on location
if ($countryCode === 'US') {
    // Redirect US users to the specified Amazon page
    header("Location: $url");
} else {
    // Redirect non-US users to the same Amazon page
    header("Location: $url");
}

exit();
?>
