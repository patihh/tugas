<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $_SESSION['user'] = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            echo "Registrasi berhasil! Silakan <a href='login.html'>login</a>.";
        
        } elseif (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (isset($_SESSION['user'])) {
                $storedUser = $_SESSION['user'];
                if ($storedUser['email'] == $email && $storedUser['password'] == $password) {
                    echo "Login berhasil! Selamat datang, " . htmlspecialchars($storedUser['name']) . ".";
                } else {
                    echo "Login gagal! Email atau password salah.";
                }
            } else {
                echo "Tidak ada pengguna terdaftar. Silakan <a href='register.html'>daftar</a> terlebih dahulu.";
            }
        }
    }
?>