<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESP32 Login</title>
    </head>
    <style>
        /* Reset dasar */
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
    }

    body {
    background: #f5f6fa;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    }

    /* Container utama: dua kolom */
    .container {
    width: 90%;
    max-width: 1100px;
    background: #fff;
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    /* Panel kiri */
    .left-panel {
    flex: 1;
    background: #d6e4ff;          /* biru muda */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    }

    .logo-box {
    text-align: center;
    }

    .logo-box img {
    max-width: 260px;
    width: 100%;
    }

    .logo-box h3 {
    color: #2a4ba7;
    margin-top: 20px;
    font-weight: 600;
    letter-spacing: 1px;
    }

    .logo-box h1 {
    color: #1c2f73;
    margin-top: 8px;
    font-size: 2rem;
    font-weight: 700;
    }

    /* Panel kanan */
    .right-panel {
    flex: 1;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    }

    .login-box {
    width: 100%;
    max-width: 320px;
    }

    .login-box h2 {
    font-size: 2rem;
    color: #3c4c8c;
    margin-bottom: 25px;
    }

    .login-box input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 18px;
    border: none;
    border-radius: 8px;
    background: #e9f0ff;
    font-size: 1rem;
    outline: none;
    transition: box-shadow 0.2s;
    }

    .login-box input:focus {
    box-shadow: 0 0 0 2px #5b8cff;
    }

    .buttons {
    display: flex;
    gap: 15px;
    }

    .btn {
    display: inline-block;
    text-decoration: none;
    text-align: center;
    padding: 12px 25px;
    border-radius: 30px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    }

    .btn.blue {
    background: #007bff;
    }

    .btn.blue:hover {
    background: #0066d6;
    }

    .btn.green {
    background: #28a745;
    }

    .btn.green:hover {
    background: #1f8a38;
    }

    /* Responsif */
    @media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .left-panel, .right-panel {
        width: 100%;
    }
    .logo-box img {
        max-width: 180px;
    }
    }

    </style>
    <body>
    <div class="container">
        <!-- Bagian Kiri -->
        <div class="left-panel">
        <div class="logo-box">
            <img src="img/esp.webp" alt="Logo ESP">
            <h3>SYSTEM MONITORING</h3>
            <h1>ESP32</h1>
        </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="right-panel">
        <div class="login-box">
            <h2>Log in</h2>
            <form action="#" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="buttons">
                <a href="index" class="btn blue">LOGIN</a>
                <a href="index" class="btn green">DASHBOARD PUBLIC</a>
            </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>
