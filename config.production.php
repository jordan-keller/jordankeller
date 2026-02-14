<?php

// Use Netlify's DEPLOY_PRIME_URL for previews, otherwise use production URL
$baseUrl = getenv('DEPLOY_PRIME_URL') ?: 'https://jordan-keller.com';

return [
    'baseUrl' => $baseUrl,
    'production' => true,
];