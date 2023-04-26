<h1 class="title-header"><?= $title_header ?></h1>

<div class="sales-container">

    <!-- client -->
    <section class="partisan">
        <h5 class="section-title"><i class="fa fa-table"></i> <?= $text_client ?> </h5>
        <section class="input-search-fields-container header-partisan-section">
            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="name" class="title float">name client</label>
                    <input type="text"
                           id="name"
                           class="find-client-input search"
                           autocomplete="off"/>

                </div>
                <ul class="list-identifier" fetchClientBy="Name">
                    <?php
                        foreach ($clients as $client) {
                            ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->Name ?></li> <?php
                        }
                    ?>
                </ul>
            </div>

            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="email" class="title float">email client</label>
                    <input type="email"
                           id="email"
                           class="find-client-input search"
                           autocomplete="off"/>
                </div>
                 <ul class="list-identifier" fetchClientBy="email">
                     <?php
                     foreach ($clients as $client) {
                         ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->Email ?></li> <?php
                     }
                     ?>
                 </ul>
            </div>

            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="id" class="title">ID client</label>
                    <input type="number"
                           id="id"
                           class="find-client-input search"
                           autocomplete="off"/>
                </div>
                <ul class="list-identifier" fetchClientBy="id">
                    <?php
                    foreach ($clients as $client) {
                        ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->ClientId ?></li> <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="img-flag-section">
                <img src="<?= IMG ?>search-client.png" alt="" class="t--70 hide-mobile">
            </div>
        </section>

        <section class="footer-partisan-section" client>
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i><?= $text_client_info ?></h5>

            <fieldset class="row-foot-partisan-section">
                <div class="input w-50-prs">
                    <label for="Name" class="float tm10 l26"> <?= $text_Name ?></label>
                    <input type="text" name="Name" id="Name" disabled="disabled" class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>

                <div class="input w-50-prs">
                    <label for="Email" class="float tm10 l26"> <?= $text_Email ?></label>
                    <input type="text" name="email" id="Email" disabled="disabled" class="show-info txt-cn"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />
                </div>

            </fieldset>
            <fieldset class="row-foot-partisan-section">
                <div class="input w-25-prs">
                    <label for="PhoneNumber" class="float tm10 l26"> <?= $text_PhoneNumber ?></label>
                    <input type="text" name="PhoneNumber" id="PhoneNumber" disabled="disabled"  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>

                <div class="input w-75-prs">
                    <label for="address" class="float tm10 l26"> <?= $text_Address ?></label>
                    <input type="text" name="address" id="Address" disabled="disabled" class="show-info txt-cn"
                           minlength="15" maxlength="15" required
                           autocomplete="off"  />
                </div>

            </fieldset>
        </section>


    </section>

    <!-- Start Products -->
    <section class="partisan mt-20">
        <h5 class="section-title"><i class="fa fa-sitemap"></i> <?= $text_nav_products ?> </h5>
        <section class="input-search-fields-container header-partisan-section revers-r">
            <div class="container-search-section component-input-js max-w-40-per">
                <div class="input">
                    <label for="Name" class="title float">name product</label>
                    <input type="text"
                           id="Name"
                           class="find-client-input search"
                           autocomplete="off"/>

                </div>

                <ul class="list-identifier" fetchProductBy="Name">
                    <?php
                        foreach ($products as $product) {
                            ?> <li ProductID="<?= $product->ProductId ?>"><?= $product->Name ?></li> <?php
                        }
                    ?>
                </ul>
            </div>

        </section>

        <section class="footer-partisan-section relative" product>
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i><?= $text_product_info ?></h5>

            <div class="tools-bar">
                <button class="tools-bar-btn" id="tools-bar-btn">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="relative">
                    <li class="description dir-r" description="<?= $text_clear_inputs ?>" id="clear-inputs"><i class="fa fa-trash"></i></li>
                    <li class="description dir-r" description="<?= $text_details_products ?>"><i class="fa fa-home"></i></li>
                </ul>
            </div>


            <fieldset class="row-foot-partisan-section">
                <div class="input w-50-prs">
                    <label for="Name" class="float tm10 l26"> <?= $text_Name ?></label>
                    <input type="text" name="Name-Product" id="Name" disabled="disabled" class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>

                <div class="input w-25-prs">
                    <label for="Quantity" class="float tm10 l26"> <?= $text_Quantity ?></label>
                    <input type="text" name="Quantity" id="Quantity" disabled="disabled" class="show-info txt-cn"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />
                </div>

                <div class="input w-25-prs">
                    <label for="QuantityChoose" class="float tm10 l26"> <?= $text_QuantityChoose ?></label>
                    <input type="text" name="QuantityChoose" id="QuantityChoose" un-disabled class="show-info txt-cn"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />
                </div>

                <div class="input w-25-prs">
                    <label for="Tax" class="float tm10 l26"> <?= $text_Tax ?></label>
                    <input type="text" name="Tax" id="Tax" un-disabled  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>
            </fieldset>

            <fieldset class="row-foot-partisan-section">



                <div class="input w-25-prs">
                    <label for="BarCode" class="float tm10 l26"> <?= $text_BarCode ?></label>
                    <input type="text" name="BarCode" id="BarCode" disabled="disabled" class="show-info txt-cn"
                           minlength="15" maxlength="15" required
                           autocomplete="off"  />
                </div>
                <div class="input w-25-prs">
                    <label for="Unit" class="float tm10 l26"> <?= $text_Unit ?></label>
                    <input type="text" name="Unit" id="Unit" disabled="disabled"  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>
                <div class="input w-25-prs">
                    <label for="SellPrice" class="float tm10 l26"> <?= $text_SellPrice ?></label>
                    <input type="text" name="SellPrice" id="SellPrice" un-disabled class="show-info txt-cn"
                           minlength="15" maxlength="15" required
                           autocomplete="off"  />
                </div>
                <div class="input w-25-prs">
                    <label for="BuyPrice" class="float tm10 l26"> <?= $text_BuyPrice ?></label>
                    <input type="text" name="BuyPrice" id="BuyPrice" disabled="disabled"  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>


            </fieldset>



            <fieldset class="row-foot-partisan-section">
                <button class="btn btn-footer add-cart-btn disabled" id="add-to-cart-sales" disabled><i class="fa fa-shopping-cart mr-10"></i><?= $button_add_to_cart ?></button>
            </fieldset>

        </section>


    </section>
    <!-- End Cater -->

    <!-- Start Cater -->
    <section class="partisan mt-20">
        <h5 class="mb-10 section-title"><i class="fa fa-shopping-cart mr-10"></i><?= $text_cart ?></h5>

        <!-- Start Table Products in Cart -->
        <section class="responsive-table flex sort-col">
            <table id="cart-sales" class="pagination-table">
                <thead>
                    <tr>
                        <th>Name Product</th>
                        <th>Quantity</th>
                        <th>Barcode</th>
                        <th>Unit</th>
                        <th>Sell Price</th>
                        <th>Tax</th>
                        <th>control</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
        <!-- End Table Products in Cart -->



    </section>
    <!-- End Cater -->

    <!-- Start invoice details -->
    <section class="partisan mt-20 invoice" invoice>
        <h5 class="mb-10 section-title"><i class="fa fa-shopping-cart mr-10"></i><?= $text_invoice ?></h5>
        <div class="content">
            <section class="main-data">
                <!-- Box 1 -->
                <div class="box amount-info">
                    <div class="info">
                        <h6 class="title">Total Received</h6>
                        <span class="amount"><span class="dollar">$</span> <span class="price">84,354 <span class="fraction">.58</span></span></span>
                    </div>
                    <div class="status-payment">
                        <div class="pending status-type">
                            <div class="type">
                                <div class="title"><span class="dot"></span> <p>Pending</p></div>
                                <span class="value"><span class="">$</span> 450 <span class="fraction">.59</span></span>
                            </div>
                        </div>

                        <div class="draft status-type">
                            <div class="type">
                                <div class="title"><span class="dot"></span> <p>Draft</p></div>
                                <span class="value"><span class="">$</span> 00 <span class="fraction">.00</span></span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Box 2 -->
                <div class="box note">
                    <div class="header">
                        <h6>Public Not</h6>
                        <div class="tools">
                            <button class="edit"><i class="fa fa-edit"></i></button>
                            <button class="copy"><i class="fa fa-copy"></i></button>
                        </div>
                    </div>
                    <div class="content-note">
                        <label for=""></label><textarea placeholder="Write Note For This Invoice" name="" id=""></textarea>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="box create-new-invoice">
                    <h6>Create New Invoices</h6>
                    <div class="between-ele mtb-10 num-inv">
                        <span class="num">Number Invoice <span class="symbol">#</span> <span class="value">AL3545</span></span>
                        <button> <span class="mr-5">Copy</span> <i class="fa fa-copy"></i></button>
                    </div>
                    <div class="date-inv">
                        <div class="inputs">
                            <div class="input">
                                <label for="issued-on">issued on</label>
                                <?php
                                    $dt = new DateTime();
                                ?>
                                <input type="date" id="issued-on" value="<?= $dt->format('Y-m-d')?>">
                            </div>
                            <div class="input">
                                <label for="issued-on">Duo on</label>
                                <input type="date" id="issued-on" value="<?= $dt->format('Y-m-d')?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box 4 -->
                <div class="box flex f-sp-between">
                    <div class="created-by" id="created-by">
                            <div class="">
                                <i class="fa fa-pen-nib mr-10"></i>
                                Created By
                                <span class="name-employee ml-5" id="name-employee">
                                    <?= $this->session->user->extraUserInfo->FirstName ?> <?= $this->session->user->extraUserInfo->LastName ?>
                                </span>
                            </div>
                    </div>

                    <button class="btn btn-footer create-invoice disabled" id="create-invoice" disabled=""><i class="fa fa-check"></i> Create Invoice</button>
                </div>
            </section>

            <section class="invoice">
                <h5>Invoice</h5>
                <div class="info-client">
                    <span class="name-client">Name Client</span>
                    <span class="address">Client Address</span>
                </div>
                <div class="snippet-products" id="snippet-products">
                    <table>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Tax</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="total-amount">
                    <span>Total Amount</span>

                    <span><span class="symbol-dollar">$</span>  <span id="total-price">0.000</span></span>
                </div>

                <div class="payment-type payment">
                    <div class="types">
                        <label for="TypePayment">Choose Type Payment</label>
                        <select name="TypePayment" id="TypePayment" class="type-payment">
                            <?php

                                foreach ($paymentTypes as $key => $value) {
                                    ?> <option value="<?= $value ?>"><?= $key ?></option> <?php
                                }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="payment-status payment">
                    <div class="types">
                        <label for="statusInvoice">Choose Status Invoice</label>

                        <select name="statusInvoice" id="statusInvoice" class="type-payment">
                            <?php

                                foreach ($paymentStatus as $key => $val) {
                                    ?> <option value="<?= $val ?>" <?= $this->setSpecificAttribute($val, $intPaymentStatus, "selected") ?> ><?= $key ?></option> <?php
                                }
                            ?>
                        </select>

                    </div>
                </div>

                <!-- Start Discount -->
                <section class="discount">
                    <h3 class="between-ele">
                        <span>Special Offer !</span>
                        <span class="cursor-pointer description dir-r" id="cansel-offer" description="remove offer"><i class="fa fa-trash"></i></span>
                    </h3>

                    <div class="input-group">
                        <div class="input-discount">
                            <label for="discount">Enter Discount:</label>
                            <input type="text" id="discount" name="discount" class="form-control" placeholder="0.00">
                        </div>
                        <div class="input-group-append">
                            <?php
                                foreach ($discountTypes as $name => $value) {
                                    ?>
                                        <div class="input-group-text flex">
                                            <input type="checkbox" id="<?= $name ?>" name="discount-type" value="<?= $value ?>">
                                            <label for="<?= $name ?>"><?= $name ?></label>
                                        </div>
                                    <?php
                                }
                            ?>

                        </div>
                    </div>

                    <button class="btn btn-footer btn-apply disabled" id="apply-discount" disabled=""><i class="fa fa-check"></i> Apply Discount</button>
                </section>

                <!-- End Discount -->
            </section>
        </div>
    </section>
    <!-- End invoice details -->

</div>

<?= $this->flashMessage()  ?>
