<?php
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('Referrer-Policy: no-referrer');
header('Content-Security-Policy: default-src \'self\'; script-src \'self\'; object-src \'none\';');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');     
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');  
header('Cache-Control: no-store, no-cache, must-revalidate');  
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Location: ../');

exit;