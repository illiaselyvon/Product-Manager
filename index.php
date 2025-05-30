
<?php include 'header.php';

    require_once  'Database.php';
    $db = new Database();
?>

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
  
    
                    </tr>
                </thead>
                <tbody>
                    <!-- Вставь здесь содержимое строк заказов из оригинального HTML -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
