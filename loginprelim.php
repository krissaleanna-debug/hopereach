<?php
// login.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SDG 1.4 Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f9e6e6;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background-color: #fff;
        border: 2px solid #b71c1c;
        border-radius: 10px;
        padding: 30px;
        width: 350px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    .login-card h3 {
        color: #b71c1c;
        margin-bottom: 20px;
    }

    .btn-danger {
        background-color: #b71c1c;
        border-color: #b71c1c;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
        border-color: #d32f2f;
    }
</style>
</head>
<body>

<div class="login-card">
    <h3>SDG 1.4 Admin Login</h3>
    <form id="login-form">
        <div class="mb-3 text-start">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" required>
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">Login</button>
    </form>
</div>

<script>
    const loginForm = document.getElementById('login-form');
    loginForm.addEventListener('submit', function(e){
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Fake login credentials
        if(username === 'admin' && password === 'hope123'){
            localStorage.setItem('loggedIn', 'true');
            window.location.href = 'dashboard.php';
        } else {
            alert('Invalid username or password!');
        }
    });
</script>

</body>
</html>
