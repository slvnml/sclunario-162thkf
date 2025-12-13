<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/auth.css'])
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Login</h1>
        <form action="/login" method="POST">
            @csrf
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-input" required>
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-input" required>
            <button type="submit" class="cta-button">Login</button>
        </form>
    </div>
</body>
</html>