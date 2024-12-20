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
    <?php include 'header.php'; ?>

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
                        <form method="GET" action="">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-select" name="filter" id="filter">
                                        <option value="month" <?php echo isset($_GET['filter']) && $_GET['filter'] === 'month' ? 'selected' : ''; ?>>This Month</option>
                                        <option value="quarter" <?php echo isset($_GET['filter']) && $_GET['filter'] === 'quarter' ? 'selected' : ''; ?>>This Quarter</option>
                                        <option value="year" <?php echo isset($_GET['filter']) && $_GET['filter'] === 'year' ? 'selected' : ''; ?>>This Year</option>
                                        <option value="custom" <?php echo isset($_GET['filter']) && $_GET['filter'] === 'custom' ? 'selected' : ''; ?>>Custom Range</option>
                                    </select>
                                </div>
                                <div class="col-md-4 date-input" style="display: none;">
                                    <input type="date" class="form-control" name="start_date" id="start_date" 
                                           value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                                </div>
                                <div class="col-md-4 date-input" style="display: none;">
                                    <input type="date" class="form-control" name="end_date" id="end_date" 
                                           value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Errors -->
        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($errorMsg); ?>
            </div>
        <?php endif; ?>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Total Income</h6>
                        <h3 class="text-success">$<?php echo $income['total_income']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Total Expenses</h6>
                        <h3 class="text-danger">$<?php echo $expenses['total_expenses']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Net Savings</h6>
                        <h3 class="text-primary">$<?php echo $income['total_income'] - $expenses['total_expenses']; ?></h3>
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
        <div class="row mb-3">
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
                                    <?php foreach($topCategories as $category): ?>
                                    <tr>
                                        <td><?php echo $category['category']; ?></td>
                                        <td>$<?php echo $category['total_amount']; ?></td>
                                        <td>
                                            <?php 
                                              $catAmt = $category['total_amount']; 
                                              echo (number_format(($catAmt / $expenses['total_expenses']), 2, '.', '')) * 100; 
                                            ?>%
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
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
                            <?php foreach ($goals as $goal): ?>
                                <div class="goal-item mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span><?php echo $goal['goal_name']; ?></span>
                                        <span>$<?php echo $goal['current_amount']; ?> / $<?php echo $goal['target_amount']; ?></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar"
                                            style="width: <?php echo ($goal['current_amount'] / $goal['target_amount']) * 100; ?>%">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row transactions-container">
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">All Transactions</h5>
                        <div class="table-responsive">
                            <?php if (empty($transactions)): ?>
                                <p class="text-center text-muted">No transactions available for the selected period.</p>
                            <?php else: ?>
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
                                    <tbody>
                                        <?php foreach($transactions as $transaction): ?>
                                        <tr>
                                            <td><?php echo $transaction['transaction_date']; ?></td>
                                            <td><span class="badge bg-<?php echo $transaction['transaction_type'] === 'income' ? 'success' : 'danger'; ?>">
                                                <?php echo $transaction['transaction_type']; ?></span></td>
                                            <td><?php echo ucwords($transaction['category']); ?></td>
                                            <td><?php echo $transaction['description'] ? $transaction['description'] : '-'; ?></td>
                                            <td class="text-<?php echo $transaction['transaction_type'] === 'income' ? 'success' : 'danger'; ?>">
                                                <?php echo $transaction['transaction_type'] === 'income' ? '+' : '-'; ?>$<?php echo $transaction['amount']; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update script section at bottom -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        <?php 
            // Reset the result pointer to the beginning
            $transactions->data_seek(0);
            
            $transactionRows = is_array($transactions) ? $transactions : $transactions->fetch_all(MYSQLI_ASSOC);
            $monthlyData = [];
            $expensesLabels = [];
            foreach ($transactionRows as $row) {
                $month = date('M Y', strtotime($row['transaction_date']));
                if (!isset($monthlyData[$month])) {
                    $monthlyData[$month] = ['income' => 0, 'expense' => 0];
                }
                if ($row['transaction_type'] === 'income') {
                    $monthlyData[$month]['income'] += $row['amount'];
                } else {
                    $monthlyData[$month]['expense'] += $row['amount'];
                    if (!in_array($row['category'], $expensesLabels)) {
                        $expensesLabels[] = $row['category'];
                    }
                }
            }

            // Prepare the arrays for the chart
            $months = array_keys($monthlyData);
            $incomeAmounts = array_column($monthlyData, 'income');
            $expensesAmounts = array_column($monthlyData, 'expense');
        ?>
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
                    labels: <?php echo json_encode($months); ?>,
                    datasets: [{
                        label: 'Income',
                        data: <?php echo json_encode($incomeAmounts); ?>, 
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2,
                        spanGaps: true  // This will create a continuous line even with missing data
                    }, {
                        label: 'Expenses',
                        data: <?php echo json_encode($expensesAmounts); ?>,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2,
                        spanGaps: true  // This will create a continuous line even with missing data
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
                                    const value = context.raw || 0;  // Use 0 if value is null/undefined
                                    return `${context.dataset.label}: $${value.toLocaleString()}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => '$' + value.toLocaleString()
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
                    labels: <?php echo json_encode($expensesLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($expensesAmounts); ?>,
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
        });

        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filter');
            const dateInputs = document.querySelectorAll('.date-input');
            
            function toggleDateInputs() {
                const isCustom = filterSelect.value === 'custom';
                dateInputs.forEach(input => {
                    input.style.display = isCustom ? 'block' : 'none';
                    const dateInput = input.querySelector('input');
                    if (dateInput) {
                        dateInput.required = isCustom;
                    }
                });
            }

            // Initial state
            toggleDateInputs();

            // Listen for changes
            filterSelect.addEventListener('change', toggleDateInputs);

            // If custom is selected on page load, show the date inputs
            if (filterSelect.value === 'custom') {
                toggleDateInputs();
            }
        });
    </script>
</body>
</html>