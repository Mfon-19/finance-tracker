<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Reports - FinanceTracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">FinanceTracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reports">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-4 text-center">Financial Reports</h1>
                <p class="lead text-center">Analyze your financial data</p>
            </div>
        </div>

        <!-- Time Period Selector -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option value="month">This Month</option>
                                    <option value="quarter">This Quarter</option>
                                    <option value="year">This Year</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="Start Date">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="End Date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Total Income</h6>
                        <h3 class="text-success">$5,500</h3>
                        <p class="mb-0 text-success"><i class="fas fa-arrow-up"></i> 12% vs last period</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Total Expenses</h6>
                        <h3 class="text-danger">$3,300</h3>
                        <p class="mb-0 text-danger"><i class="fas fa-arrow-up"></i> 5% vs last period</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Net Savings</h6>
                        <h3 class="text-primary">$2,200</h3>
                        <p class="mb-0 text-primary"><i class="fas fa-arrow-up"></i> 8% vs last period</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Income vs Expenses Trend</h5>
                        <div class="chart-container">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Expense Breakdown</h5>
                        <div class="chart-container-small">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Analysis -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Top Spending Categories</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>% of Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Housing</td>
                                        <td>$1,200</td>
                                        <td>36%</td>
                                    </tr>
                                    <!-- Add more rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Goals Progress</h5>
                        <div class="goals-progress">
                            <!-- Keep your existing goals progress items -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">All Transactions</h5>
                        <div class="table-responsive">
                            <table class="table" id="transactionsTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Savings Goals Progress</h5>
                        <div id="goalsContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update script section at bottom -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Common chart options
            Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial';
            Chart.defaults.font.size = 13;
            
            // Trend Chart
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Income',
                        data: [4500, 5000, 5500, 5200, 5700, 5500],
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2
                    }, {
                        label: 'Expenses',
                        data: [3000, 3200, 3100, 3400, 3300, 3300],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: $${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => '$' + value
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });

            // Expense Breakdown Chart
            const expenseCtx = document.getElementById('expenseChart').getContext('2d');
            new Chart(expenseCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Housing', 'Food', 'Transport', 'Utilities', 'Others'],
                    datasets: [{
                        data: [1200, 800, 600, 400, 300],
                        backgroundColor: [
                            'rgba(13, 110, 253, 0.8)',
                            'rgba(102, 16, 242, 0.8)',
                            'rgba(111, 66, 193, 0.8)',
                            'rgba(214, 51, 132, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(1);
                                    return `${context.label}: $${context.raw} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });

            // Load and display all transactions
            const transactions = JSON.parse(localStorage.getItem('transactions') || '[]');
            const tbody = document.querySelector('#transactionsTable tbody');
            
            transactions.sort((a, b) => new Date(b.date) - new Date(a.date)).forEach(transaction => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${new Date(transaction.date).toLocaleDateString()}</td>
                    <td><span class="badge bg-${transaction.type === 'income' ? 'success' : 'danger'}">${transaction.type}</span></td>
                    <td>${transaction.category}</td>
                    <td>${transaction.description || '-'}</td>
                    <td class="text-${transaction.type === 'income' ? 'success' : 'danger'}">
                        ${transaction.type === 'income' ? '+' : '-'}$${transaction.amount.toFixed(2)}
                    </td>
                `;
                tbody.appendChild(tr);
            });

            // Load and display all goals
            const goals = JSON.parse(localStorage.getItem('goals') || '[]');
            const goalsContainer = document.getElementById('goalsContainer');
            
            goals.forEach(goal => {
                const progress = (goal.currentAmount / goal.targetAmount) * 100;
                const goalDiv = document.createElement('div');
                goalDiv.className = 'mb-4';
                goalDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">${goal.name}</h6>
                        <span class="text-muted">Target Date: ${new Date(goal.date).toLocaleDateString()}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Progress: $${goal.currentAmount.toFixed(2)} / $${goal.targetAmount.toFixed(2)}</span>
                        <span>${progress.toFixed(1)}%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: ${progress}%">
                        </div>
                    </div>
                `;
                goalsContainer.appendChild(goalDiv);
            });
        });
    </script>
</body>
</html> 