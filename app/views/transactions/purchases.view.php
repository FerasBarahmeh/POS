<h1 class="title-header"><i class="fa fa-cash-register" aria-hidden="true"></i><?= $title_header ?></h1>

<section class="transactions-container">
    <section class="options">
        <div class="filters">
            <div class="filter">
                <form action="" METHOD="POST">
                    <label for="filter_column"><i class="fa fa-filter"></i><?= $text_filter_by_transaction_Type ?></label>
                    <input type="search" name="filter_value" id="filter_column" placeholder="<?= $text_filter_by_transaction_Type_placeholder ?>"/>
                    <button class="search-btn stander-btn" type="submit" name="filter_by_column" id="type-filter-btn"><?= $text_show_all ?></button>
                </form>
            </div>
            <div class="filter">
                <form action="" METHOD="POST">
                    <label for="from"><i class="fa fa-filter"></i><?= $text_filter_by_range ?></label>
                    <input type="search" name="from" id="from" placeholder="<?= $text_filter_by_range_start_placeholder ?>"/>
                    <label for="to"><?= $text_to ?></label><input type="search" name="to" id="to" placeholder="<?= $text_filter_by_range_end_placeholder ?>"/>
                    <button class="search-btn stander-btn" type="submit" name="filter-between" id="type-filter-btn"><?= $text_show_all ?></button>
                </form>
            </div>
        </div>

        <div class="print-buttons">
            <button>
                <form action="" method="POST"><input type="submit"  name="resit" value="<?= $text_resit ?>"></form>
            </button>
        </div>
    </section>

    <section class="transactions">
        <div class="container-table responsive-table mt-20" id="transactions">
            <table class="pagination-table" id="transactions-table">
                <thead>
                <tr>
                    <th><?= $text_id ?></th>
                    <th><?= $text_id_invoice ?></th>
                    <th><?= $text_price ?></th>
                    <th><?= $text_time ?></th>
                    <th><?= $text_num_product ?></th>
                    <th><?= $text_discount ?></th>
                    <th><?= $text_discount_type ?></th>
                    <th><?= $text_name_transactor ?></th>
                    <th><?= $text_payment_status ?></th>
                    <th><?= $text_note ?></th>
                    <th><?= $text_options ?></th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($transactionsPurchases) {
                    $i = 0;
                    foreach ($transactionsPurchases as $transactionsPurchase) {
                        $i++;
                        ?>
                        <tr class="">
                            <td><?= $i ?></td>
                            <td><?= $transactionsPurchase->InvoiceId ?></td>
                            <td><?= (float)$transactionsPurchase->PaymentAmount + (float) $transactionsPurchase->PaymentLiteral ?></td>
                            <td><?= $transactionsPurchase->Created ?></td>
                            <td><?= $transactionsPurchase->NumberProducts ?></td>
                            <td><?= $transactionsPurchase->Discount ?></td>
                            <td><?= $transactionsPurchase->DiscountType  == null ? $text_no_disc : $transactionsPurchase->DiscountType ?></td>
                            <td><?= $transactionsPurchase->Name ?></td>
                            <td><?= $paymentsStatus[$transactionsPurchase->PaymentStatus] ?></td>
                            <td><?= $transactionsPurchase->Note ? $transactionsPurchase->Note : $text_no_note ?></td>
                            <td>
                                <div class="icons">
                                    <button class="dir-r top-5 download-btn">
                                        <a href="/transactions/pdf/<?= $transactionsPurchase->InvoiceId ?>/<?= $transactionsPurchase->TypeInvoice ?>/D"><?= $text_download ?></a>
                                    </button>
                                    <button class="dir-r top-5 show-btn">
                                        <a href="/transactions/pdf/<?= $transactionsPurchase->InvoiceId ?>/<?= $transactionsPurchase->TypeInvoice ?>/S"><?= $text_show ?></a>
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
