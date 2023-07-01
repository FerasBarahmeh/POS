<h1 class="title-header"><i class="fa fa-chart-pie" aria-hidden="true"></i>  <?= $title_header ?></h1>

<h4><i class="fa fa-calendar-day"></i>Monthly Statistics</h4>
<!--Start Monthly -->
<div class="figures">
    <canvas id="amountMonthly"></canvas>
    <canvas id="countMonthly"></canvas>
</div>
<!--End Monthly -->

<h4><i class="fa fa-file-signature" aria-hidden="true"></i>Yearly Statistics</h4>
<!--Start Yearly -->
<div class="figures">
    <canvas id="amountYearly"></canvas>
    <canvas id="countYearly"></canvas>
</div>
<!--End Yearly -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
