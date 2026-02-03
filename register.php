<?php
session_start();

$usersFile = "users.txt";
$message = "";
$messageType = "";

/* =========================
   GET USERS
========================= */
function getUsers($file) {
    $users = [];

    if (!file_exists($file)) {
        return $users;
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode(":", $line);

        if (count($parts) === 4) {
            list($name, $email, $username, $password) = $parts;
            $users[$username] = [
                "name" => $name,
                "email" => $email,
                "password" => $password
            ];
        }
    }

    return $users;
}

/* =========================
   PASSWORD VALIDATION
========================= */
function isValidPassword($password) {
    return strlen($password) >= 6 &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password) &&
           preg_match('/[\W]/', $password);
}

/* =========================
   SAVE USER
========================= */
function saveUser($file, $name, $email, $username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    file_put_contents(
        $file,
        "$name:$email:$username:$hashedPassword\n",
        FILE_APPEND | LOCK_EX
    );
}

$users = getUsers($usersFile);

/* =========================
   HANDLE FORM SUBMIT
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {

    $name = str_replace(":", "", trim($_POST['name']));
    $email = str_replace(":", "", trim($_POST['email']));
    $username = str_replace(":", "", trim($_POST['username']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($username) || empty($password)) {
        $message = "All fields are required.";
        $messageType = "error";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        $messageType = "error";
    }
    elseif (!isValidPassword($password)) {
        $message = "Password must be at least 6 characters and include uppercase, lowercase, number, and special character.";
        $messageType = "error";
    }
    elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType = "error";
    }
    elseif (isset($users[$username])) {
        $message = "Username already exists.";
        $messageType = "error";
    }
    else {
        saveUser($usersFile, $name, $email, $username, $password);
        $message = "Registration successful! You can now login.";
        $messageType = "success";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: #fff;
    padding: 30px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}
input, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
}
button {
    background: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}
.error { color: red; }
.success { color: green; }
small { color: #666; }
</style>
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <?php if ($message): ?>
        <p class="<?= $messageType ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>
        <small>Min 6 chars, uppercase, lowercase, number, special</small>

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
