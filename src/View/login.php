<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceTracker - Your Personal Finance Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="d-flex flex-column vh-100">
        <?php include 'header.php' ?>
        <div id="forms-container" class="d-flex flex-column justify-content-center align-items-center mt-0"
            style="flex: 1; padding: 30px">
            <div id="login-container" class="justify-content-center align-items-center"
                style="width: 500px; display: flex;">
                <div class="card shadow " id="login-form-container"
                    style="width: 400px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, 0.2);">
                    <div class="card-body p-3">
                        <h1 class="card-title p-3 mb-0">Login</h1>
                        <form action="/login" method="post" class="container p-3">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" name="username" type="text" class="form-control bg-light rounded-3"
                                    placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" type="password"
                                    class="form-control bg-light rounded-3" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit"
                                    class="submit_button form-control mb-2 bg-dark text-light rounded-3">
                                    Login
                                </button>
                                <p>Don't have an account?
                                    <a href="/signup"><strong id="signUpBtn" class="cursor-pointer">Sign up</strong></a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>