<h1 class="title-header"><i class="fa fa-briefcase"></i><?= $title_header ?></h1>

<section class="transactions-container">
    <section class="options">
        <div class="filters">
            <div class="filter" filter-between-vals>
                <label for="date-filter"><i class="fa fa-filter"></i> <?= $text_filter_by_date ?></label>
                <div class="from-to">
                    <div class="date-input">
                        <label for="from"></label>
                        <input type="date" id="from" class="custom-date-input" input-from value="2024-06-14">
                        <i class="fa fa-calendar"></i>
                    </div>

                    <div class="date-input">
                        <label for="to"></label>
                        <input type="date" id="to" class="custom-date-input" input-to value="2024-08-16">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>

                <button class="load stander-btn" apply-btn><?= $text_load ?></button>
            </div>
        </div>
        
        <div class="print-buttons">
            <button><?= $text_print_report ?></button>
            <button><?= $text_print_filtered ?></button>
        </div>
    </section>
    
    <section class="transactions">
        <div class="container-table responsive-table mt-20" id="transactions">
            <table class="pagination-table" id="transactions-table">
                <thead>
                    <tr>
                        <th><?= $text_id ?></th>
                        <th><?= $text_type ?></th>
                        <th><?= $text_price ?></th>
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
                        if ($transactionsSales) {
                            foreach ($transactionsSales as $transactionsSale) {
                                ?>
                                    <tr class="">
                                        <td><?= $transactionsSale->InvoiceId ?></td>
                                        <td><?= $transactionsSale->TypeInvoice ?></td>
                                        <td><?= (float)$transactionsSale->PaymentAmount + (float) $transactionsSale->PaymentLiteral ?></td>
                                        <td><?= $transactionsSale->Created ?></td>
                                        <td><?= $transactionsSale->NumberProducts ?></td>
                                        <td><?= $transactionsSale->Discount ?></td>
                                        <td><?= $transactionsSale->DiscountType  == null ? $text_no_disc : $transactionsSale->DiscountType ?></td>
                                        <td><?= $transactionsSale->Name ?></td>
                                        <td><?= $paymentsStatus[$transactionsSale->PaymentStatus] ?></td>
                                        <td>
                                            <div class="icons">
                                                <button class="dir-r top-5 download-btn">
                                                    <a href="/transactions/pdf/<?= $transactionsSale->InvoiceId ?>/<?= $transactionsSale->TypeInvoice ?>/D"><?= $text_download ?></a>
                                                </button>
                                                <button class="dir-r top-5 show-btn">
                                                    <a href="/transactions/pdf/<?= $transactionsSale->InvoiceId ?>/<?= $transactionsSale->TypeInvoice ?>/S"><?= $text_show ?></a>
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
