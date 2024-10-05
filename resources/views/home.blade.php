@extends('layouts.app')

@section('content')
<x-header title="Selamat Datang, {{ Auth::user()->name }}!" showCreate="false" link="" />
<button class="btn btn-primary btn-sm" style="margin-left: 25px;" onclick="showAddIncomeModal()">Add Income</button>
<style>
.welcome-text {
    position: relative;
    margin-bottom: 20px;
}

.welcome-text button {
    margin-top: 10px;
    font-size: 12px;
}
</style>

<div class="row m-2">
    <div class="col-md-3">
        <div class="card dashboard card-border-bottom rounded-sm bg-white mb-3 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="card-title mb-1" id="total-incom">
                        Rp {{ number_format($totalIncome) }}
                    </h4>
                </div>
                <div class="mt-3">
                    <i class="fa fa-long-arrow-up text-success"></i>
                    <span class="ml-2">Total Income</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard card-border-bottom bg-white mb-3 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="card-title mb-1" id="total-expense">0</h4>
                </div>
                <div class="mt-3">
                    <i class="fa fa-long-arrow-down text-danger"></i>
                    <span class="ml-2">Total Expense</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard card-border-bottom bg-white mb-3 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="card-title mb-1" id="total-balance">0</h4>
                </div>
                <div class="mt-3">
                    <i class="fa fa-bank text-primary"></i>
                    <span class="ml-2">Total Balance</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard card-border-bottom bg-white mb-3 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="card-title mb-1" id="cash-on-hand">0</h4>
                </div>
                <div class="mt-3">
                    <i class="fa fa-money text-secondary"></i>
                    <span class="ml-2">Invest</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row m-2">
    <!-- Card Kiri: Monthly Summary -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa fa-adjust text-primary mr-2"></i>
                    <strong>Monthly Summary</strong>
                </div>
                <select id="summary-type" class="form-control w-auto d-inline-block">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="current-balances"></canvas>
            </div>
        </div>
    </div>

    <!-- Card Kanan: Alokasi Keuangan -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white">
                <i class="fa fa-adjust text-primary mr-2"></i>
                <strong>Alokasi Keuangan</strong>
            </div>
            <div class="card-body">
                <!-- Progress Bar for Primary -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-home text-success mr-2"></i>
                        <span>Primary</span>
                    </div>
                    <span id="primary-amount">Rp 0 (0%)</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div id="primary-progress" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Progress Bar for Secondary -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user text-info mr-2"></i>
                        <span>Secondary</span>
                    </div>
                    <span id="secondary-amount">Rp 0 (0%)</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div id="secondary-progress" class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Progress Bar for Investment -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-briefcase text-warning mr-2"></i>
                        <span>Investment</span>
                    </div>
                    <span id="investment-amount">Rp 0 (0%)</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div id="investment-progress" class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Progress Bar for Debt -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-credit-card text-danger mr-2"></i>
                        <span>Debt</span>
                    </div>
                    <span id="debt-amount">Rp 0 (0%)</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div id="debt-progress" class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Income Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addIncomeModalLabel">Add Income</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addIncomeForm">
          <div class="form-group">
            <label for="incomeTitle">Title</label>
            <input type="text" class="form-control" id="incomeTitle" required>
          </div>
          <div class="form-group">
            <label for="incomeAmount">Amount</label>
            <input type="number" class="form-control" id="incomeAmount" required>
          </div>
          <div class="form-group">
            <label for="incomeDate">Date</label>
            <input type="date" class="form-control" id="incomeDate" required>
          </div>
          <div class="form-group">
            <label for="incomeCategory">Category</label>
            <select class="form-control" id="incomeCategory" required>
              <option value="">Select a category</option>
              <option value="debt">Debt</option>
              <option value="primary">Primary</option>
              <option value="secondary">Secondary</option>
              <option value="investment">Investment</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitIncome()">Save Income</button>
      </div>
    </div>
  </div>
</div>
<footer class="footer mt-2" style="position: relative; bottom: 0; left: 0; width: 100%; padding: 10px 0; background-color: #f8f9fa;">
    <div class="w-100" style="text-align: center;">
        <small>Designed &amp; Developed by Finest Team</small>
    </div>
</footer>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Swal.fire({
      position: "top-center",
      icon: "question",
      title: "Sudah sehatkah pengelolaan keuangan Anda?",
      showCloseButton: true,
      showConfirmButton: false,
    });

    function showAddIncomeModal() {
      $('#addIncomeModal').modal('show');
    }

    

    function submitIncome() {
    const title = $('#incomeTitle').val();
    const amount = parseFloat($('#incomeAmount').val());
    const date = $('#incomeDate').val();
    const category = $('#incomeCategory').val();

    if (!title || isNaN(amount) || !date || !category) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill all fields correctly',
        });
        return;
    }

    $.ajax({
        url: '/api/income',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            title: title,
            amount: amount,
            date: date,
            category: category
        },
        success: function(response) {
            console.log('Server response:', response);
            $('#addIncomeModal').modal('hide');
            $('#addIncomeForm')[0].reset();
            
            // Update total income immediately
            if (response.totalIncome !== undefined) {
                updateTotalIncomeDisplay(response.totalIncome);
            } else {
                // If totalIncome is not in the response, fetch it separately
                fetchAndUpdateTotalIncome();
            }
            
            Swal.fire({
                icon: 'success',
                title: 'Income added successfully!',
                showConfirmButton: false,
                timer: 1500
            });
            
            // Refresh financial allocation
            fetchAndUpdateFinancialAllocation();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while saving the income.',
            });
        }
    });
}


function refreshAllData() {
    fetchAndUpdateTotalIncome();
    fetchAndUpdateFinancialAllocation();
}

function fetchAndUpdateTotalIncome() {
    $.ajax({
        url: '/api/income/total',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Received total income data:', data);
            if (data.totalIncome !== undefined) {
                updateTotalIncomeDisplay(data.totalIncome);
            } else {
                console.error('Invalid response from server:', data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching total income:', status, error);
        }
    });
}

function updateTotalIncomeDisplay(totalIncome) {
    $('#total-incom').text('Rp ' + accounting.formatMoney(totalIncome, "", 0, ".", ","));
}

function refreshAllData() {
    fetchAndUpdateTotalIncome();
    fetchAndUpdateFinancialAllocation();
    // Add any other data refresh functions here
}

    function fetchAndUpdateFinancialAllocation() {
        $.ajax({
            url: '/api/financial-allocation',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Received data:', data);
                updateFinancialAllocationDisplay(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching financial allocation:');
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

    function updateFinancialAllocationDisplay(data) {
        const totalAmount = data.total;
        
        updateCategory('primary', data.primary.amount, data.primary.percentage, totalAmount);
        updateCategory('secondary', data.secondary.amount, data.secondary.percentage, totalAmount);
        updateCategory('investment', data.investment.amount, data.investment.percentage, totalAmount);
        updateCategory('debt', data.debt.amount, data.debt.percentage, totalAmount);

        // Update chart
        updateAllocationChart(data);
    }

    function updateCategory(category, amount, percentage, totalAmount) {
        $(`#${category}-amount`).text(`Rp ${accounting.formatMoney(amount, "", 2, ".", ",")} (${percentage}%)`);
        $(`#${category}-progress`).css('width', `${percentage}%`).attr('aria-valuenow', percentage);
    }

    function updateAllocationChart(data) {
        const ctx = document.getElementById('allocation-chart').getContext('2d');
        
        // Destroy existing chart if it exists
        if (window.allocationChart) {
            window.allocationChart.destroy();
        }

        window.allocationChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Primary', 'Secondary', 'Investment', 'Debt'],
                datasets: [{
                    data: [
                        data.primary.percentage,
                        data.secondary.percentage,
                        data.investment.percentage,
                        data.debt.percentage
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(255, 99, 132, 0.8)'
    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Financial Allocation'
                    }
                }
            }
        });
    }

    function refreshAllData() {
        fetchAndUpdateTotalIncome();
        fetchAndUpdateFinancialAllocation();
    }

    // Fungsi untuk memulai auto-refresh
    function startAutoRefresh() {
        setInterval(refreshAllData, 30000); // Refresh setiap 30 detik
    }

    $(document).ready(function() {
    refreshAllData();
});
</script>
@endsection