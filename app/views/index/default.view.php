<h1 class="title-header"><i class="fa fa-chart-pie" aria-hidden="true"></i>  <?= $title_header ?></h1>
<section class="content mtb-20">
    <section class="general-statistics">
        <header class="statistics">
            <div class="window">
                <div class="data">
                    <div class="number"><a href="/suppliers"><?= $countSuppliers ?></a></div>
                    <div class="field"><?= $suppliers ?></div>
                </div>
                <div class="icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
            </div>

            <div class="window">
                <div class="data">
                    <div class="number"><a href="/clients"><?= $countClients ?></a></div>
                    <div class="field"><?= $clients ?></div>
                </div>
                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
            </div>

            <div class="window">
                <div class="data">
                    <div class="number"><a href="/transactions"><?= count($transactions) ?></a></div>
                    <div class="field"><?= $text_transactions ?></div>
                </div>
                <div class="icon"><i class="fa fa-file-invoice" aria-hidden="true"></i></div>
            </div>


            <div class="window">
                <div class="data">
                    <div class="number"><a href="/productscategories/"><?= $countCategories ?></a></div>
                    <div class="field"><?= $categories ?></div>
                </div>
                <div class="icon"><i class="fa fa-tags" aria-hidden="true"></i></div>
            </div>

            <div class="window">
                <div class="data">
                    <div class="number"><a href="/usersgroups"><?= $countGroups ?></a></div>
                    <div class="field"><?= $groups ?></div>
                </div>
                <div class="icon"><i class="fa fa-layer-group" aria-hidden="true"></i></div>
            </div>

        </header>
        <h3><i class="fa fa-file-invoice" aria-hidden="true"></i><?= $last_sales_invoice ?> </h3>

        <section class="last-invoices responsive-table">
            <table class="">
                <thead>
                <tr>
                    <th><?= $text_id ?></th>
                    <th><?= $text_price . ' <p class="bold-font inline-block">' . $currency . '</p>' ?></th>
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
                if ($lastSalesInvoices) {
                    foreach ($lastSalesInvoices as $lastSalesInvoice) {
                        ?>
                        <tr invoice-id="<?= $lastSalesInvoice->InvoiceId ?>" type-invoice="<?= $lastSalesInvoice->TypeInvoice ?>">
                            <td><?= $lastSalesInvoice->InvoiceId ?></td>
                            <td><?= (float)$lastSalesInvoice->PaymentAmount + (float) $lastSalesInvoice->PaymentLiteral ?></td>
                            <td><?= $lastSalesInvoice->Created ?></td>
                            <td><?= $lastSalesInvoice->NumberProducts ?></td>
                            <td><?= $lastSalesInvoice->Discount ?></td>
                            <td><?= $lastSalesInvoice->DiscountType  == null ? $text_no_disc : $lastSalesInvoice->DiscountType ?></td>
                            <td><?= $lastSalesInvoice->Name ?></td>
                            <td><?= $paymentsStatus[$lastSalesInvoice->PaymentStatus] ?></td>
                            <td>
                                <div class="icons">

                                    <button class="dir-r top-5 download-btn">
                                        <a href="/transactions/pdf/<?= $lastSalesInvoice->InvoiceId ?>/<?= $lastSalesInvoice->TypeInvoice ?>/D"><?= $text_download ?></a>
                                    </button>
                                    <button class="dir-r top-5 show-btn">
                                        <a href="/transactions/pdf/<?= $lastSalesInvoice->InvoiceId ?>/<?= $lastSalesInvoice->TypeInvoice ?>/S"><?= $text_show ?></a>
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

        <h3><i class="fa fa-list" aria-hidden="true"></i><?= $last_purchases_invoice ?> </h3>

        <section class="last-invoices responsive-table">
            <table class="">
                <thead>
                <tr>
                    <th><?= $text_id ?></th>
                    <th><?= $text_price . ' <p class="bold-font inline-block">' . $currency . '</p>' ?></th>
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
                if ($lastPurchasesInvoices) {
                    foreach ($lastPurchasesInvoices as $lastPurchasesInvoice) {
                        ?>
                        <tr invoice-id="<?= $lastPurchasesInvoice->InvoiceId ?>" type-invoice="<?= $lastPurchasesInvoice->TypeInvoice ?>">
                            <td><?= $lastPurchasesInvoice->InvoiceId ?></td>
                            <td><?= (float)$lastPurchasesInvoice->PaymentAmount + (float) $lastPurchasesInvoice->PaymentLiteral ?></td>
                            <td><?= $lastPurchasesInvoice->Created ?></td>
                            <td><?= $lastPurchasesInvoice->NumberProducts ?></td>
                            <td><?= $lastPurchasesInvoice->Discount ?></td>
                            <td><?= $lastPurchasesInvoice->DiscountType  == null ? $text_no_disc : $lastPurchasesInvoice->DiscountType ?></td>
                            <td><?= $lastPurchasesInvoice->Name ?></td>
                            <td><?= $paymentsStatus[$lastPurchasesInvoice->PaymentStatus] ?></td>
                            <td>
                                <div class="icons">

                                    <button class="dir-r top-5 download-btn">
                                        <a href="/transactions/pdf/<?= $lastPurchasesInvoice->InvoiceId ?>/<?= $lastPurchasesInvoice->TypeInvoice ?>/D"><?= $text_download ?></a>
                                    </button>
                                    <button class="dir-r top-5 show-btn">
                                        <a href="/transactions/pdf/<?= $lastPurchasesInvoice->InvoiceId ?>/<?= $lastPurchasesInvoice->TypeInvoice ?>/S"><?= $text_show ?></a>
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


        <h3><i class="fa fa-folder" aria-hidden="true"></i><?= $manage_invoice ?></h3>
        <section class="manage-invoice">
            <section class="transactions-container">

                <section class="transactions">
                    <div class="responsive-table" id="transactions">
                        <table class="pagination-table upper" id="transactions-table">
                            <thead>
                            <tr>
                                <th><?= $text_id ?></th>
                                <th><?= $text_type ?></th>
                                <th><?= $text_price . ' <p class="bold-font inline-block">' . $currency . '</p>' ?></th>
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
                            if ($transactions) {
                                foreach ($transactions as $transaction) {
                                    ?>
                                    <tr invoice-id="<?= $transaction->InvoiceId ?>" type-invoice="<?= $transaction->TypeInvoice ?>">
                                        <td><?= $transaction->InvoiceId ?></td>
                                        <td><?= $transaction->TypeInvoice ?></td>
                                        <td><?= (float)$transaction->PaymentAmount + (float) $transaction->PaymentLiteral ?></td>
                                        <td><?= $transaction->Created ?></td>
                                        <td><?= $transaction->NumberProducts ?></td>
                                        <td><?= $transaction->Discount ?></td>
                                        <td><?= $transaction->DiscountType  == null ? $text_no_disc : $transaction->DiscountType ?></td>
                                        <td><?= $transaction->Name ?></td>
                                        <td><?= $paymentsStatus[$transaction->PaymentStatus] ?></td>
                                        <td>
                                            <div class="icons">

                                                <button class="dir-r top-5 download-btn">
                                                    <a href="/transactions/pdf/<?= $transaction->InvoiceId ?>/<?= $transaction->TypeInvoice ?>/D"><?= $text_download ?></a>
                                                </button>
                                                <button class="dir-r top-5 show-btn">
                                                    <a href="/transactions/pdf/<?= $transaction->InvoiceId ?>/<?= $transaction->TypeInvoice ?>/S"><?= $text_show ?></a>
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
            </section>
        </section>
    </section>

    <section class="left-nav flex sort-col gap-10">
        <section class="left-nav-section">
            <h2 class="title"><i class="fa fa-calendar-check" aria-hidden="true"></i><?= $dilay_statistic ?></h2>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $countSalesToday ?></div>
                    <div class="field"><?= $number_of_sales_today ?></div>
                </div>
                <div class="smile"><i class="fa fa-shopping-cart"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $countPurchasesToday ?></div>
                    <div class="field"><?= $number_of_purchases_today ?></div>
                </div>
                <div class="smile"><i class="fa fa-tags"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $revenueToday == '' ? 0 : $revenueToday ?></div>
                    <div class="field"><?= $today_income ?></div>
                </div>
                <div class="smile"><i class="fa fa-plus" aria-hidden="true"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $outcome == '' ? 0 : $outcome  ?></div>
                    <div class="field"><?= $today_outcome ?></div>
                </div>
                <div class="smile"><i class="fa fa-minus" aria-hidden="true"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $financialReceivablesToday == '' ? 0 : $financialReceivablesToday ?></div>
                    <div class="field"><?= $today_financial_receivables ?></div>
                </div>
                <div class="smile"><i class="fa fa-dollar-sign" aria-hidden="true"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $transactionsToday ?></div>
                    <div class="field"><?= $dilay_transaction_count ?></div>
                </div>
                <div class="smile"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
            </div>


        </section>

        <section class="left-nav-section">
            <h2 class="title"><i class="fa fa-dollar-sign" aria-hidden="true"></i> <?= $price_statistics ?></h2>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $salesAmount ?></div>
                    <div class="field"><?= $sales_amount ?></div>
                </div>
                <div class="smile"><i class="fa fa-shopping-cart"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $purchasesAmount ?></div>
                    <div class="field"><?= $purchases_amount ?></div>
                </div>
                <div class="smile"><i class="fa fa-tags"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $salesLoans ?></div>
                    <div class="field"><?= $sales_loans_amount ?></div>
                </div>
                <div class="smile"><i class="fa fa-dollar-sign" aria-hidden="true"></i></div>
            </div>

            <div class="block">
                <div class="data">
                    <div class="number"><?= $purchasesLoans ?></div>
                    <div class="field"><?= $purchases_loans_amount ?></div>
                </div>
                <div class="smile"><i class="fa fa-dollar-sign" aria-hidden="true"></i></div>
            </div>

        </section>
    </section>
</section>