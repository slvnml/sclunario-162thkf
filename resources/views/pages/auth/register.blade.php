<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/auth.css'])
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Register</h1>
        <form action="/register" method="POST">
            @csrf
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-input" required>
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-input" required>
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-input" required>
            <button type="submit" class="cta-button">Register</button>
        </form>
    </div>
</body>
</html>