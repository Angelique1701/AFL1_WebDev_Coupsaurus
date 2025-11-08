<?php
// Script untuk generate password hash
// Jalankan sekali untuk mendapatkan hash password

echo "Password Hashes:\n\n";

$passwords = [
    'admin123' => password_hash('admin123', PASSWORD_DEFAULT),
    'pembeli123' => password_hash('pembeli123', PASSWORD_DEFAULT)
];

foreach ($passwords as $plain => $hash) {
    echo "Password: $plain\n";
    echo "Hash: $hash\n\n";
}

echo "\n--- SQL untuk update password ---\n\n";
echo "UPDATE users SET password = '" . $passwords['admin123'] . "' WHERE username = 'admin';\n";
echo "UPDATE users SET password = '" . $passwords['pembeli123'] . "' WHERE username = 'pembeli1';\n";
?>
