<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceTracker - Your Personal Finance Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        /* Features Section */
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #007bff;
        }

        .feature-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        /* Call to Action */
        .cta-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 80px 0;
        }

        /* Testimonials */
        .testimonial-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Footer */
        .footer {
            background: #343a40;
            color: white;
            padding: 50px 0;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Add these styles to match index.html */
        body {
            padding-top: 76px; /* To account for fixed navbar */
        }

        /* Footer Styles */
        .footer {
            background: #343a40;
            color: white;
            padding: 50px 0;
            margin-top: 50px;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-wallet me-2"></i>
                FinanceTracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.html"> <i class="fas fa-chart-bar me-1"></i> Reports </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="fas fa-envelope me-1"></i> Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 mb-4 fade-in">Take Control of Your Finances</h1>
            <p class="lead mb-4">Track expenses, set budgets, and achieve your financial goals with FinanceTracker</p>
            <a href="dashboard.html" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#features" class="btn btn-outline-light btn-lg">Learn More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose FinanceTracker?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-pie feature-icon"></i>
                            <h4>Easy Expense Tracking</h4>
                            <p>Track your expenses effortlessly with our intuitive interface and automated categorization.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bullseye feature-icon"></i>
                            <h4>Smart Budgeting</h4>
                            <p>Set and manage budgets with intelligent insights and real-time tracking.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-lock feature-icon"></i>
                            <h4>Secure & Private</h4>
                            <p>Your financial data is protected with bank-level security and encryption.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Start Your Financial Journey?</h2>
            <p class="lead mb-4">Join thousands of users who have already taken control of their finances</p>
            <a href="dashboard.html" class="btn btn-light btn-lg">Start Now - It's Free!</a>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="User" class="testimonial-img mb-3">
                        <h5>Sarah Johnson</h5>
                        <p>"FinanceTracker helped me save for my dream vacation. The budgeting tools are amazing!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" class="testimonial-img mb-3">
                        <h5>Michael Chen</h5>
                        <p>"The best finance tracking app I've ever used. Simple, intuitive, and powerful."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User" class="testimonial-img mb-3">
                        <h5>Emily Davis</h5>
                        <p>"Finally got my spending under control thanks to FinanceTracker's insights!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>About FinanceTracker</h5>
                    <p>Your trusted partner in personal finance management. We help you make smarter financial decisions.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 