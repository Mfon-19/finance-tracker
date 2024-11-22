<?php
session_start();

// redirect user to login if session is not set
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles.css">
</head>
<body class="bg-light">
    <main class="d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-wallet me-2"></i>
                    FinanceTracker
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">
                                <i class="fas fa-chart-line me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reports">
                                <i class="fas fa-chart-bar me-1"></i> Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">
                                <i class="fas fa-sign-out-alt me-1"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-4">
            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12 text-center welcome-section">
                    <h1 class="display-4 fade-in">Welcome back, <?php echo $user['first_name']; ?>!</h1>
                    <p class="lead slide-up">Let's manage your finances together</p>
                </div>
            </div>

            <!-- Current Balance Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm hover-card">
                        <div class="card-body text-center">
                            <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Current Balance</h5>
                            <h1 class="counter display-4" data-target="<?php echo number_format($balance, 2, '.', ''); ?>">$0</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Transaction Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Add Transaction</h5>
                            <form id="transactionForm" action="/add-transaction" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" name="type" required>
                                            <option value="income">Income</option>
                                            <option value="expense">Expense</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Amount</label>
                                        <input type="number" step="0.01" class="form-control" name="amount" placeholder="Enter amount" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" name="category" required>
                                            <option value="">Select category</option>
                                            <option value="salary">Salary</option>
                                            <option value="food">Food</option>
                                            <option value="transport">Transport</option>
                                            <option value="utilities">Utilities</option>
                                            <option value="entertainment">Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" placeholder="Enter description">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Transaction</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions and Goals Section -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Recent Transactions</h5>
                                <a href="/reports" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="transaction-list">
                            <?php foreach ($transactions as $transaction): ?>
                            <div class="transaction-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas <?php echo $transaction['transaction_type'] == 'expense' ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success'; ?>"></i>
                                    <span><?php echo ucwords($transaction['category']); ?></span>
                                </div>
                                <span class="<?php echo $transaction['transaction_type'] == 'expense' ? 'text-danger' : 'text-success'; ?>">
                                    $<?php echo $transaction['amount']; ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm" id="goalsContainer">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Savings Goals</h5>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalModal">
                                    Add Goal
                                </button>
                            </div>
                            <?php foreach ($goals as $goal): ?>
                                <div class="d-flex flex-row goal-item mb-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <span><?php echo $goal['goal_name']; ?></span>
                                            <span>$<?php echo $goal['current_amount']; ?> / $<?php echo $goal['target_amount']; ?></span>
                                        </div>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                role="progressbar" 
                                                style="<?php ?>width: <?php echo ($goal['current_amount'] / $goal['target_amount']) * 100; ?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="ms-3 goal" id="editGoalBtn" data-bs-toggle="modal" data-bs-target="#editGoalModal" data-goal-name="<?php echo $goal['goal_name'] ?>" data-goal-current-amount="<?php echo $goal['current_amount'] ?>" data-goal-target-amount="<?php echo $goal['target_amount'] ?>" data-goal-id="<?php echo $goal['goal_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Goal Modal -->
        <div class="modal fade" id="editGoalModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Money Towards Goal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="goalForm" action="/edit-goal" method="POST">
                            <input type="hidden" name="goal-id" id="goalIdContainer">
                            <div class="mb-3">
                                <label class="form-label">Goal Name</label>
                                <input type="hidden" name="goal-name" id="goalNameContainer">
                                <h3 id="editGoalName"></h3>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount To Go</label>
                                <h3 id="editGoalCurrentAmount"></h3>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Account Balance</label>
                                <h3 id="currentAmount">$</h3>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount To Add</label>
                                <input type="number" class="form-control" name="amount" step="0.01" max="<?php echo number_format($balance, 2, '.', ''); ?>" id="amountToAdd" required>
                            </div>
                            <button type="submit" style="display:none" id="submitEditGoalButton"></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick={submitEditGoal()} id="editModalSubmitBtn">Save Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Goal Modal -->
        <div class="modal fade" id="addGoalModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Goal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="goalForm" action="/add-goal" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Goal Name</label>
                                <input type="text" class="form-control" name="goalName" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Target Amount</label>
                                <input type="number" class="form-control" name="targetAmount" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Target Date</label>
                                <input type="date" class="form-control" name="targetDate" required>
                            </div>
                            <button type="submit" style="display:none" id="submitGoalButton"></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick={submitGoal()}>Save Goal</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const goalsContainer = document.getElementById('goalsContainer');
        goalsContainer.addEventListener('click', (e) => {
            // Find the closest button with class 'goal' (handles clicking on SVG or path elements)
            const goalButton = e.target.closest('.goal');
            if (!goalButton) return;

            const editGoalName = document.getElementById('editGoalName');
            const editGoalCurrentAmount = document.getElementById('editGoalCurrentAmount');
            const goalIdContainer = document.getElementById('goalIdContainer');
            const goalNameContainer = document.getElementById('goalNameContainer');

            const goalName = goalButton.getAttribute('data-goal-name');
            const goalAmountToGo = Number(goalButton.getAttribute('data-goal-target-amount')) - 
                                  Number(goalButton.getAttribute('data-goal-current-amount'));
            const goalId = Number(goalButton.getAttribute('data-goal-id'));
            const currentAmount = document.getElementById('currentAmount');

            editGoalName.innerText = goalName;
            editGoalCurrentAmount.innerText = `$${goalAmountToGo.toFixed(2)}`;
            goalIdContainer.value = goalId;
            goalNameContainer.value = goalName;
            currentAmount.innerText = "$<?php echo number_format($balance, 2, '.', ''); ?>";
        });


        const editModalSubmitBtn = document.getElementById('editModalSubmitBtn');
        const amountToAdd = document.getElementById('amountToAdd');
        amountToAdd.addEventListener('input', () => {
            const balance = parseFloat(currentAmount.innerText.replace('$', ''));
            const amount = parseFloat(amountToAdd.value);
            
            if (amount > <?php echo $balance ?> || amount <= 0) {
                editModalSubmitBtn.disabled = true;
            } else {
                editModalSubmitBtn.disabled = false;
            }
        });

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseFloat(counter.getAttribute('data-target'));
            const duration = 1000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = '$' + current.toFixed(2);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = '$' + target.toFixed(2);
                }
            };

            updateCounter();
        });

        // Initialize Charts
        // const spendingCtx = document.getElementById('spendingChart').getContext('2d');
        // const categoryCtx = document.getElementById('categoryChart').getContext('2d');

        // new Chart(spendingCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        //         datasets: [{
        //             label: 'Income',
        //             data: [4500, 5000, 4800, 5200, 5000, 5500],
        //             borderColor: 'rgba(40, 167, 69, 0.8)',
        //             fill: false
        //         }, {
        //             label: 'Expenses',
        //             data: [3000, 3200, 2800, 3400, 3100, 3300],
        //             borderColor: 'rgba(220, 53, 69, 0.8)',
        //             fill: false
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false
        //     }
        // });

        // new Chart(categoryCtx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: ['Housing', 'Food', 'Transport', 'Entertainment', 'Others'],
        //         datasets: [{
        //             data: [35, 25, 15, 15, 10],
        //             backgroundColor: [
        //                 '#007bff',
        //                 '#28a745',
        //                 '#ffc107',
        //                 '#dc3545',
        //                 '#6c757d'
        //             ]
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false
        //     }
        // });

        // Update the transaction form handling
        // document.getElementById('transactionForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const transaction = {
        //         type: this.querySelector('select[name="type"]').value,
        //         amount: parseFloat(this.querySelector('input[name="amount"]').value),
        //         category: this.querySelector('select[name="category"]').value,
        //         date: this.querySelector('input[name="date"]').value,
        //         description: this.querySelector('input[name="description"]').value,
        //         timestamp: new Date().getTime()
        //     };

        //     // Update balance
        //     const balanceElement = document.querySelector('.counter');
        //     const currentBalance = parseFloat(balanceElement.getAttribute('data-target'));
        //     const newBalance = transaction.type === 'income' 
        //         ? currentBalance + transaction.amount 
        //         : currentBalance - transaction.amount;
            
        //     // Update the data-target attribute and animate the counter
        //     balanceElement.setAttribute('data-target', newBalance);
        //     animateCounter(balanceElement, currentBalance, newBalance);

        //     // Add transaction to recent transactions list
        //     const transactionList = document.querySelector('.transaction-list');
        //     const transactionDiv = document.createElement('div');
        //     transactionDiv.className = 'transaction-item d-flex justify-content-between align-items-center transaction-success';
            
        //     const icon = transaction.type === 'income' ? 'plus-circle text-success' : 'minus-circle text-danger';
        //     const amountClass = transaction.type === 'income' ? 'text-success' : 'text-danger';
        //     const amountPrefix = transaction.type === 'income' ? '+' : '-';

        //     transactionDiv.innerHTML = `
        //         <div>
        //             <i class="fas fa-${icon}"></i>
        //             <span>${transaction.description || transaction.category}</span>
        //         </div>
        //         <span class="${amountClass}">${amountPrefix}$${transaction.amount.toFixed(2)}</span>
        //     `;

        //     // Add new transaction at the top of the list
        //     transactionList.insertBefore(transactionDiv, transactionList.firstChild);

        //     // Remove oldest transaction if more than 5 are shown
        //     if (transactionList.children.length > 5) {
        //         transactionList.removeChild(transactionList.lastChild);
        //     }

        //     // Reset form
        //     this.reset();

        //     // Show notification
        //     showNotification(`Transaction ${transaction.type} added successfully!`, 'success');
        // });

        // Helper function for counter animation
        // function animateCounter(element, start, end) {
        //     showNotification(`Transaction ${transaction.type} added successfully!`, 'success');
        //     const duration = 1000;
        //     const steps = 60;
        //     const increment = (end - start) / steps;
        //     let current = start;
        //     let step = 0;

        //     const animation = setInterval(() => {
        //         step++;
        //         current += increment;
        //         element.textContent = '$' + Math.abs(current).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

        //         if (step >= steps) {
        //             clearInterval(animation);
        //             element.textContent = '$' + Math.abs(end).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        //         }
        //     }, duration / steps);
        // }

        // Form handling for goals
        // document.getElementById('goalForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const goal = {
        //         name: this.querySelector('input[name="goalName"]').value,
        //         targetAmount: parseFloat(this.querySelector('input[name="targetAmount"]').value),
        //         currentAmount: 0,
        //         date: this.querySelector('input[name="targetDate"]').value,
        //         timestamp: new Date().getTime()
        //     };

        //     // Save to localStorage
        //     // let goals = JSON.parse(localStorage.getItem('goals') || '[]');
        //     // goals.push(goal);
        //     // localStorage.setItem('goals', JSON.stringify(goals));

        //     // Create new goal element
        //     // const goalDiv = document.createElement('div');
        //     // goalDiv.className = 'goal-item mb-3';
        //     // goalDiv.innerHTML = `
        //     //     <div class="d-flex justify-content-between">
        //     //         <span>${goal.name}</span>
        //     //         <span>$${goal.currentAmount.toFixed(2)} / $${goal.targetAmount.toFixed(2)}</span>
        //     //     </div>
        //     //     <div class="progress">
        //     //         <div class="progress-bar progress-bar-striped progress-bar-animated" 
        //     //              role="progressbar" 
        //     //              style="width: 0%">
        //     //         </div>
        //     //     </div>
        //     // `;

        //     // // Add to goals list
        //     // document.querySelector('.card-body .goal-item').parentNode.appendChild(goalDiv);

        //     // // Close modal
        //     // const modal = bootstrap.Modal.getInstance(document.getElementById('addGoalModal'));
        //     // modal.hide();

        //     // // Reset form
        //     // this.reset();

        //     // // Show notification
        //     // showNotification('New goal added successfully!', 'success');
        // });

        // Helper functions
        function updateBalance(type, amount) {
            const balanceElement = document.querySelector('.counter');
            const currentBalance = parseFloat(balanceElement.getAttribute('data-target'));
            const newBalance = type === 'income' ? currentBalance + amount : currentBalance - amount;
            
            balanceElement.setAttribute('data-target', newBalance);
            animateCounter(balanceElement, currentBalance, newBalance);
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} notification`;
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function submitGoal() {
            const goalButton = document.getElementById('submitGoalButton');
            goalButton.click();
        }

        function submitEditGoal() {
            const editGoalBtn = document.getElementById('submitEditGoalButton');
            editGoalBtn.click();
        }

        // Initialize tooltips
        // const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        // tooltipTriggerList.map(function (tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl);
        // });
    </script>
</body>
</html> 