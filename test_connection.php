<?php
/**
 * Script untuk test koneksi database
 * Jalankan: php test_connection.php
 */

echo "=== TEST KONEKSI DATABASE ===\n\n";

// Test 1: Koneksi Database
echo "1. Testing database connection...\n";
$conn = new mysqli("localhost", "root", "", "agency");

if ($conn->connect_error) {
    echo "   ❌ GAGAL: " . $conn->connect_error . "\n";
    exit(1);
} else {
    echo "   ✅ BERHASIL: Koneksi database OK\n\n";
}

// Test 2: Cek tabel users
echo "2. Checking table 'users'...\n";
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "   ✅ BERHASIL: Tabel users ada\n\n";
} else {
    echo "   ❌ GAGAL: Tabel users tidak ditemukan\n";
    echo "   → Jalankan: mysql -u root -p agency < database_setup.sql\n\n";
}

// Test 3: Cek tabel stores
echo "3. Checking table 'stores'...\n";
$result = $conn->query("SHOW TABLES LIKE 'stores'");
if ($result->num_rows > 0) {
    echo "   ✅ BERHASIL: Tabel stores ada\n\n";
} else {
    echo "   ❌ GAGAL: Tabel stores tidak ditemukan\n\n";
}

// Test 4: Cek tabel products
echo "4. Checking table 'products'...\n";
$result = $conn->query("SHOW TABLES LIKE 'products'");
if ($result->num_rows > 0) {
    echo "   ✅ BERHASIL: Tabel products ada\n\n";
} else {
    echo "   ❌ GAGAL: Tabel products tidak ditemukan\n\n";
}

// Test 5: Cek tabel reviews
echo "5. Checking table 'reviews'...\n";
$result = $conn->query("SHOW TABLES LIKE 'reviews'");
if ($result->num_rows > 0) {
    echo "   ✅ BERHASIL: Tabel reviews ada\n\n";
} else {
    echo "   ❌ GAGAL: Tabel reviews tidak ditemukan\n\n";
}

// Test 6: Cek user admin
echo "6. Checking admin user...\n";
$result = $conn->query("SELECT * FROM users WHERE username = 'admin'");
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "   ✅ BERHASIL: User admin ditemukan\n";
    echo "      Username: " . $user['username'] . "\n";
    echo "      Email: " . $user['email'] . "\n";
    echo "      Role: " . $user['role'] . "\n\n";
} else {
    echo "   ❌ GAGAL: User admin tidak ditemukan\n\n";
}

// Test 7: Cek user pembeli
echo "7. Checking pembeli user...\n";
$result = $conn->query("SELECT * FROM users WHERE username = 'pembeli1'");
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "   ✅ BERHASIL: User pembeli1 ditemukan\n";
    echo "      Username: " . $user['username'] . "\n";
    echo "      Email: " . $user['email'] . "\n";
    echo "      Role: " . $user['role'] . "\n\n";
} else {
    echo "   ❌ GAGAL: User pembeli1 tidak ditemukan\n\n";
}

// Test 8: Test password verification
echo "8. Testing password verification...\n";
$result = $conn->query("SELECT password FROM users WHERE username = 'admin'");
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify('admin123', $user['password'])) {
        echo "   ✅ BERHASIL: Password admin123 valid\n\n";
    } else {
        echo "   ❌ GAGAL: Password admin123 tidak valid\n";
        echo "   → Jalankan: php generate_password.php\n";
        echo "   → Kemudian update password di database\n\n";
    }
}

echo "=== TEST SELESAI ===\n";
echo "\nJika semua test ✅, Anda bisa login dengan:\n";
echo "Admin    → username: admin, password: admin123\n";
echo "Pembeli  → username: pembeli1, password: pembeli123\n";

$conn->close();
?>
