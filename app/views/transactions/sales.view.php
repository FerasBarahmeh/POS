<h1 class="title-header"><i class="fa fa-briefcase"></i><?= $title_header ?></h1>

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
