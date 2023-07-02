<h1 class="title-header"><i class="fa fa-chart-area" aria-hidden="true"></i>  <?= $title_header ?></h1>

<!--Start Monthly -->
<div class="figures">
    <canvas id="amountYearly"></canvas>
    <canvas id="countYearly"></canvas>
</div>
<!--End Monthly -->
<section class="section">
    <div class="sales-monthly">
        <h4>Sales In This Month</h4>
        <section class="last-invoices responsive-table">
            <table class="">
                <thead>
                <tr>
                    <th><?= $text_id ?></th>
                    <th><?= $text_price  ?></th>
                    <th><?= $text_time ?></th>
                    <th><?= $text_num_product ?></th>
                    <th><?= $text_discount ?></th>
                    <th><?= $text_discount_type ?></th>
                    <th><?= $text_name_transactor ?></th>
                    <th><?= $text_payment_status ?></th>
                    <th><?= $text_options ?></th>
                </tr>
                </thead>

                <tbody>
                <?php

                if ($invoicesLastMonth) {
                    foreach ($invoicesLastMonth as $invoiceLastMonth) {
                        ?>
                        <tr invoice-id="<?= $invoiceLastMonth->InvoiceId ?>" type-invoice="<?= $invoiceLastMonth->TypeInvoice ?>">
                            <td><?= $invoiceLastMonth->InvoiceId ?></td>
                            <td><?= (float)$invoiceLastMonth->PaymentAmount + (float) $invoiceLastMonth->PaymentLiteral ?></td>
                            <td><?= $invoiceLastMonth->Created ?></td>
                            <td><?= $invoiceLastMonth->NumberProducts ?></td>
                            <td><?= $invoiceLastMonth->Discount ?></td>
                            <td><?= $invoiceLastMonth->DiscountType  == null ? $text_no_disc : $invoiceLastMonth->DiscountType ?></td>
                            <td><?= $invoiceLastMonth->Name ?></td>
                            <td><?= $paymentsStatus[$invoiceLastMonth->PaymentStatus] ?></td>
                            <td>
                                <div class="icons">

                                    <button class="dir-r top-5 download-btn">
                                        <a href="/transactions/pdf/<?= $invoiceLastMonth->InvoiceId ?>/<?= $invoiceLastMonth->TypeInvoice ?>/D"><?= $text_download ?></a>
                                    </button>
                                    <button class="dir-r top-5 show-btn">
                                        <a href="/transactions/pdf/<?= $invoiceLastMonth->InvoiceId ?>/<?= $invoiceLastMonth->TypeInvoice ?>/S"><?= $text_show ?></a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
    <h4><?= $short_statistics ?></h4>
    <div class="statistics-period">
        <div class="note">
            <p class="card-title"><?= $selling_last_year ?></p>
            <p class="small-desc between-ele">
                <?= $destSellingProductLastMonth ? $destSellingProductLastMonth->Name : '' ?>
                <span><?= $destSellingProductLastMonth ? $destSellingProductLastMonth->repeated : '0' ?> <?= $pieces ?></span>
            </p>
            <p class="distribution">
                <?= $destSellingProductLastMonth ? $destSellingProductLastMonth->Description : ''?>
            </p>
        </div>

        <div class="note">
            <p class="card-title"><?= $selling_previous_year ?></p>
            <p class="small-desc between-ele">
                <?= $destSellingProductPreviousMonth ? $destSellingProductPreviousMonth->Name : '' ?>
                <span><?= $destSellingProductPreviousMonth ? $destSellingProductPreviousMonth->repeated : '0' ?> <?= $pieces ?></span>
            </p>
            <p class="distribution">
                <?= $destSellingProductPreviousMonth ? $destSellingProductPreviousMonth->Description : '' ?>
            </p>
        </div>

    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>