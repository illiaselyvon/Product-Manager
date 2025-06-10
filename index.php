<?php
session_start();

require_once __DIR__ . '/config/Database.php';
$db = new Database();

$success = $_SESSION['registration_success'] ?? '';
unset($_SESSION['registration_success']);

include __DIR__ . '/root/includes/header.php';
?>

<?php if ($success): ?>
    <div class="alert alert-success mt-4" style="color: #66ff99; font-weight: bold;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col">
        <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
    </div>
</div>

<!-- row -->
<div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <div class="tm-bg-primary-dark tm-block">
            <h2 class="tm-block-title">Latest Hits</h2>
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <div class="tm-bg-primary-dark tm-block">
            <h2 class="tm-block-title">Performance</h2>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller">
            <h2 class="tm-block-title">Storage Information</h2>
            <div id="pieChartContainer">
                <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
            </div>                        
        </div>
    </div>
</div>

<?php include __DIR__ . '/root/includes/footer.php'; ?>
