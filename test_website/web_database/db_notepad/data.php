<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $file = fopen('user.txt', 'a');
            if (!$file) {
                die("Tidak bisa membuka file user.txt.");
            }
            fwrite($file, $name . ',' . $email . ',' . $password . "\n");
            fclose($file);

            echo "Registrasi berhasil! Silakan <a href='login.html'>login</a>.";

        } elseif (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $file = fopen('user.txt', 'r');
            if (!$file) {
                die("Tidak bisa membuka file user.txt.");
            }
            
            $loginSuccess = false;

            while (($line = fgets($file)) !== false) {
                list($name, $storedEmail, $storedPassword) = explode(',', trim($line));
                if ($storedEmail == $email) {
                    if ($storedPassword == $password) {
                        echo "Login berhasil! Selamat datang, " . htmlspecialchars($name) . ".";
                        $loginSuccess = true;
                        break;
                    }
                }
            }

            fclose($file);

            if (!$loginSuccess) {
                echo "Login gagal! Email atau password salah.";
            }
        } else {
            echo "Input tidak valid.";
        }
    } else {
        echo "Metode request tidak valid.";
    }
?>
