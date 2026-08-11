<?php
// checkout.php

// Log PayFast response
file_put_contents(
    'payfast_log.txt',
    print_r($_POST, true),
    FILE_APPEND
);

// OPTIONAL: Verify transaction here

// Redirect user
if (isset($_POST['RESPONSE_CODE']) && $_POST['RESPONSE_CODE'] === '000') {
    header("Location: /pay-fast/success");
} else {
    header("Location: /pay-fast/failure");
}
exit;
