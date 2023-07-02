<h1 class="title-header"><i class="fa fa-chart-area" aria-hidden="true"></i>  <?= $title_header ?></h1>
<div class="statistics-period">

    <div class="note">
        <p class="card-title"><?= $count_sales_transaction_today ?></p>
        <p class="small-desc between-ele">
            <?= $countSaleTransactionToday ? $countSaleTransactionToday : 0 ?>
        </p>
    </div>
    <div class="note">
        <p class="card-title"><?= $count_purchases_today ?></p>
        <p class="small-desc between-ele">
            <?= $countPurchasesTransactionToday ? $countPurchasesTransactionToday : 0 ?>
        </p>
    </div>
    <div class="note">
        <p class="card-title"><?= $revenue_today ?></p>
        <p class="small-desc between-ele">
            <?= $revenueToday ? $revenueToday : 0 ?> <?= $currency ?>
        </p>
    </div>
    <div class="note">
        <p class="card-title"><?= $total_transaction_today ?></p>
        <p class="small-desc between-ele">
            <?= $transactionsToday ? $transactionsToday : 0 ?>
        </p>
    </div>
</div>