<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceTracker - Your Personal Finance Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <div class="d-flex flex-column vh-100">
        <?php include 'header.php' ?>
        <div id="forms-container" class="d-flex flex-column justify-content-center align-items-center mt-0" style="flex: 1; padding: 30px">
            <div id="signup-container" class="d-flexjustify-content-center align-items-center" style="width: 500px;">
                <div class="card shadow w-full" style="border-radius: 8px; border: 1px solid rgba(0, 0, 0, 0.2)">
                    <div class="card-body p-3">
                        <h2 class="card-title p-3 mb-0">Sign Up</h2>
                        <form method="post" action="/signup" id="signupForm" class="container p-3">
                            <div class="mb-3">
                                <div class="d-flex">
                                    <div>
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input id="firstName" name="firstName" type="text" class="form-control bg-light"
                                            placeholder="First Name" style="border-radius: 10px; width: 90%" required>
                                    </div>
                                    <div class="ms-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input id="lastName" name="lastName" type="text" class="form-control bg-light"
                                            placeholder="Last Name" style="border-radius: 10px; width: 100%" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control bg-light"
                                    placeholder="Email" style="border-radius: 10px" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input id="phone" name="phone" type="tel" class="form-control bg-light"
                                    placeholder="Phone Number" style="border-radius: 10px" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control bg-light"
                                    placeholder="Username" style="border-radius: 10px" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control bg-light"
                                    placeholder="Password" style="border-radius: 10px" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="male" required>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="female" required>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="other"
                                            value="other" required>
                                        <label class="form-check-label" for="other">
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="submit_button form-control mb-2 bg-dark text-light"
                                    style="border-radius: 10px">
                                    Submit
                                </button>
                                <p>Already have an account? 
                                    <a href="/login">
                                        <strong id="signInBtn">Sign in</strong>
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>