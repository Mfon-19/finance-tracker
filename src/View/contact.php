<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <main class="d-flex flex-column">
        <?php include 'header.php'?>
        <div>
            <section class="hero">
                <div class="container">
                    <h1 class="display-4 mb-4 fade-in">Lets Talk</h1>
                </div>
            </section>
            <div class="d-flex flex-row">
                <div class="d-flex container p-3 ms-5 align-items-center justify-content-center" style="width: 40%">
                    <p style="line-height: 3rem; font-size: 20px">
                        At <span class="lead">Finance Tracker</span>, we are committed to helping you take control of your financial journey with 
                        ease and confidence. If you have any questions, suggestions, or need assistance, our support team is here 
                        to ensure that your experience is seamless and enjoyable.
                    </p>
                </div>
                <div class="border ms-5" style="width: 1px; height: 400px; margin-top: 5rem;"></div>
                <div class="d-flex justify-content-center align-items-center" style="width: 60%">
                    <div class="w-100" style="max-width: 600px;">
                        <div class=" p-3">
                            <form class="container p-3" method="post" action="/post-contact">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input id="name" type="text" name="full_name" class="form-control bg-light" placeholder="Your Name" style="border-radius: 10px" required />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email" placeholder="Your Email" class="form-control bg-light" style="border-radius: 10px" required />
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input id="phone" type="tel" name="phone_number" class="form-control bg-light" style="border-radius: 10px" placeholder="Your Phone Number" required />
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" name="message" class="form-control bg-light" style="border-radius: 10px" placeholder="Write your message here....." rows="4" required></textarea>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="submit_button form-control mb-2 bg-dark text-light" style="border-radius: 10px" id="submitBtn">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5>About FinanceTracker</h5>
                        <p>Your trusted partner in personal finance management. We help you make smarter financial
                            decisions.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Home</a></li>
                            <li><a href="dashboard.html" class="text-white">Dashboard</a></li>
                            <li><a href="#features" class="text-white">Features</a></li>
                            <li><a href="#contact" class="text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Connect With Us</h5>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="bg-light">
                <div class="text-center">
                    <p>&copy; 2024 FinanceTracker. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </main>
</body>
</html>