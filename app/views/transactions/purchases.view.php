<h1 class="title-header"><i class="fa fa-briefcase"></i><?= $title_header ?></h1>

<section class="transactions-container">
    <section class="options">
        <div class="filters">
            <div class="filter">
                <label for="type-filter"><i class="fa fa-filter"></i><?= $text_filter_by_transaction_Type ?></label>

                <div class="types" id="type-filter">
                    <button class="select-input" id="select-type-btn">
                        <div class="angles">
                            <div class="angle active"><i class="fa fa-angle-down"></i></div>
                            <div class="angle"><i class="fa fa-angle-up"></i></div>
                        </div>
                        <span></span>
                    </button>
                    <ul class="">
                        <li></li>
                        <li><?= $text_sales ?></li>
                        <li><?= $text_purchases ?></li>
                    </ul>
                </div>

                <button class="show-all stander-btn" id="type-filter-btn"><?= $text_show_all ?></button>
            </div>

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
                    <th><?= $text_id_invoice ?></th>
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
                if ($transactionsPurchases) {
                    $i = 0;
                    foreach ($transactionsPurchases as $transactionsPurchase) {
                        $i++;
                        ?>
                        <tr class="">
                            <td><?= $i ?></td>
                            <td><?= $transactionsPurchase->InvoiceId ?></td>
                            <!--                                        <td>--><?php //= $transactionsTypes[$transactionsPurchase->TypeInvoice] ?><!--</td>-->
                            <td><?= $transactionsPurchase->TypeInvoice ?></td>
                            <td><?= (float)$transactionsPurchase->PaymentAmount + (float) $transactionsPurchase->PaymentLiteral ?></td>
                            <td><?= $transactionsPurchase->Created ?></td>
                            <td><?= $transactionsPurchase->NumberProducts ?></td>
                            <td><?= $transactionsPurchase->Discount ?></td>
                            <td><?= $transactionsPurchase->DiscountType  == null ? $text_no_disc : $transactionsPurchase->DiscountType ?></td>
                            <td><?= $transactionsPurchase->Name ?></td>
                            <td><?= $paymentsStatus[$transactionsPurchase->PaymentStatus] ?></td>
                            <td>
                                <div class="icons">
                                    <span class="description dir-r top-5" description="show"><i class="fa fa-print"></i></span>

                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <!--            <div class="bar-pagination">-->
            <!--                <div class="statistics">-->
            <!--                    <div class="number-slide">-->
            <!--                        <label for="">number Rerecord in slide</label>-->
            <!--                        <select name="" id="">-->
            <!--                            <option value="">4</option>-->
            <!--                            <option value="">2</option>-->
            <!--                            <option value="">6</option>-->
            <!--                            <option value="">8</option>-->
            <!--                            <option value="">10</option>-->
            <!--                        </select>-->
            <!--                    </div>-->
            <!--                    <div class="counter"><div class="count">5</div><span>from</span><div class="from">100</div></div>-->
            <!--                </div>-->
            <!---->
            <!--                <div class="buttons">-->
            <!--                    <button class="next">Previous</button>-->
            <!--                    <ul>-->
            <!--                        <li>1</li>-->
            <!--                        <li>2</li>-->
            <!--                        <li>3</li>-->
            <!--                        <li>4</li>-->
            <!--                    </ul>-->
            <!--                    <button class="previous active">Next</button>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

    </section>
</section>
