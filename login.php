<?php
session_start();

$usersFile = "users.txt";
$message = "";
$messageType = "";

/* =========================
   LOAD USERS
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

$users = getUsers($usersFile);

/* =========================
   HANDLE LOGIN
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {

    $username = str_replace(":", "", trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "All fields are required.";
        $messageType = "error";
    }
    elseif (!isset($users[$username])) {
        $message = "Invalid username or password.";
        $messageType = "error";
    }
    elseif (!password_verify($password, $users[$username]['password'])) {
        $message = "Invalid username or password.";
        $messageType = "error";
    }
    else {
        $_SESSION['user'] = [
            "username" => $username,
            "name" => $users[$username]['name'],
            "email" => $users[$username]['email']
        ];

        header("Location: dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
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
    <h2>Login</h2>

    <?php if ($message): ?>
        <p class="<?= $messageType ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p>No account? <a href="register.php">Register</a></p>
</div>

</body>
</html>
