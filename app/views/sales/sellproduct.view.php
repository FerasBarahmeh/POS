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
                           type-request="name"
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
                           type-request="email"
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
                           type-request="id"
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

    <!-- Products -->
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

        <section class="footer-partisan-section" product>
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i><?= $text_product_info ?></h5>

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
                    <input type="text" name="QuantityChoose" id="QuantityChoose"  class="show-info txt-cn"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />
                </div>

                <div class="input w-25-prs">
                    <label for="Tax" class="float tm10 l26"> <?= $text_Tax ?></label>
                    <input type="text" name="Tax" id="Tax"  class="show-info txt-cn"
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
                    <input type="text" name="SellPrice" id="SellPrice" class="show-info txt-cn"
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
                <button class="btn btn-footer">Add To cart</button>
                <button class="btn btn-footer">show Details product</button>

            </fieldset>

        </section>


    </section>
</div>

<?= $this->flashMessage()  ?>
