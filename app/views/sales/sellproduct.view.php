<h1 class="title-header"><?= $title_header ?></h1>
<div class="container">

    <section class="row" id="client-section">
        <h5 class="section-title"><i class="fa fa-table"></i> <?= $text_client ?> </h5>


        <fieldset class="header-field row-fieldset between-ele flex">
            <div class="flex gap-10">
                <div class="input-container" id="input-container">
                    <div class="container-input-search">
                        <input type="search" id="Name" name="Name" class="search-input border" action="getInfoClientAjax" autocomplete="off"/>
                        <label for="Name" class="label-input"><?= $text_search_name_client ?></label>
                        <button class="fetch-btn"><?= $text_fetch_button ?></button>
                    </div>
                    <ul class="search-ul">
                        <?php
                        foreach ($clients as $client) {
                            ?> <li class="active" primaryKey="<?= $client->ClientId ?>"><?= $client->Name ?></li> <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="input-container">
                    <div class="container-input-search">
                        <input type="search" id="Email" name="Email" class="search-input border"  action="getInfoClientAjax" autocomplete="off"/>
                        <label for="Email" class="label-input"><?= $text_search_email_client ?></label>
                        <button class="fetch-btn"><?= $text_fetch_button ?></button>
                    </div>

                    <ul class="search-ul">
                        <?php
                        foreach ($clients as $client) {
                            ?> <li class="active" primaryKey="<?= $client->ClientId ?>"><?= $client->Email ?></li> <?php
                        }
                        ?>
                    </ul>

                </div>

            </div>
            <div class="img input-container">
                <img src="<?= IMG ?>search-client.png" alt="">
            </div>

        </fieldset>

        <fieldset class="content-row sort-col">
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i>Client information</h5>

            <div class="inputs flex mt-15 mb-20">
                <div class="field relative">
                    <input type="text" name="Name" id="Name"  class="they-fill"
                           value="<?= $this->getStorePost("Name") ?>"
                           minlength="2" maxlength="30" required autocomplete="off"  />

                    <label for="Name" > <?= $text_Name ?></label>
                    <span class="info-icon description" description="<?= $text_info_statistic_client ?>" id="info-icon"><i class="fa fa-info"></i></span>
                </div>
                <div class="field relative">
                    <input type="text" name="Email" id="Email" class="they-fill"
                           value="<?= $this->getStorePost("Email") ?>"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />

                    <label for="Email" > <?= $text_Email ?></label>
                </div>

            </div>

            <div class="inputs flex mt-15 mb-20">
                <div class="field relative">
                    <input type="text" name="PhoneNumber" id="PhoneNumber"  class="they-fill"
                           value="<?= $this->getStorePost("PhoneNumber") ?>"
                           minlength="4" maxlength="15" required autocomplete="off"  />

                    <label for="PhoneNumber" > <?= $text_PhoneNumber ?></label>
                </div>
                <div class="field relative">
                    <input type="text" name="Address" id="Address" class="they-fill"
                           value="<?= $this->getStorePost("Address") ?>"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />

                    <label for="Address" > <?= $text_Address ?></label>
                </div>

            </div>
        </fieldset>

    </section>



    <!-- start product -->
    <section class="row" id="client-section">
        <h5 class="section-title"><i class="fa fa-tag"></i> Product </h5>


        <fieldset class="header-field row-fieldset between-ele flex">
            <div class="flex gap-10">
                <div class="input-container" id="input-container">
                    <div class="container-input-search">
                        <input type="search" id="Name" name="Name" action="getInfoProductAjax" class="search-input-product border" autocomplete="off"/>
                        <label for="NameProduct" class="label-input">Name Product</label>
                        <button class="fetch-btn"><?= $text_fetch_button ?></button>
                    </div>
                    <ul class="search-ul">
                        <?php
                            foreach ($products as $product) {
                                ?> <li class="active" primaryKey="<?= $product->ProductId ?>"><?= $product->Name ?></li> <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="show-products-categories-button" id="show-products-categories-button">
                <button class="slide" id="show-slide">View products in this product category Categories Follow these products</button>

            </div>

            <div class="img input-container">
                <img src="<?= IMG ?>searchProduct.jpeg" alt="" id="img-product">
            </div>

        </fieldset>



        <fieldset class="content-row sort-col">
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i>Details Involves </h5>

            <div class="inputs flex mt-15 mb-20">
                <div class="field relative">
                    <input type="text" name="Name" id="Name"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("NameProduct") ?>"
                           minlength="2" maxlength="30" required autocomplete="off"  />

                    <label for="NameProduct" > <?= $text_Name ?></label>
                    <span class="info-icon description" description="<?= $text_info_statistic_client ?>" id="info-icon"><i class="fa fa-info"></i></span>
                </div>

                <div class="field relative">
                    <input type="text" name="BuyPrice" id="BuyPrice"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("BuyPrice") ?>"
                           minlength="2" maxlength="30" required autocomplete="off"  />

                    <label for="BuyPrice" > <?= $text_BuyPrice ?></label>
                </div>

                <div class="field relative">
                    <input type="number" name="QuantityChoose" id="QuantityChoose"  class="they-fill-product"
                           value="<?= $this->getStorePost("QuantityChoose") ?>" step="1"
                           required autocomplete="off"  />

                    <label for="QuantityChoose" > <?= $text_QuantityChoose ?></label>
                </div>

                <div class="field relative">
                    <input type="number" name="Quantity" id="Quantity"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("Quantity") ?>" step="1"
                           required autocomplete="off"  />

                    <label for="Quantity" > <?= $text_Quantity ?></label>
                </div>

                <div class="field relative">
                    <input type="text" name="BarCode" id="BarCode"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("BarCode") ?>"
                           minlength="2" maxlength="20" required autocomplete="off"  />

                    <label for="BarCode" > <?= $text_BarCode ?></label>
                </div>
            </div>

            <div class="inputs flex mt-15 mb-20">
                <div class="field relative">
                    <input type="text" name="Unit" id="Unit"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("Unit") ?>"
                           minlength="2" maxlength="30" required autocomplete="off"  />

                    <label for="Unit" > <?= $text_Unit ?></label>
                </div>

                <div class="field relative">
                    <input type="text" name="SellPrice" id="SellPrice"  class="they-fill-product un-clickable"
                           value="<?= $this->getStorePost("SellPrice") ?>"
                           minlength="2" maxlength="30" required autocomplete="off"  />

                    <label for="SellPrice" > <?= $text_SellPrice ?></label>
                </div>

                <div class="field relative">
                    <input type="number" name="Tax" id="Tax"  class="they-fill-product"
                           value="<?= $this->getStorePost("SellPrice") ?>" step="0.01"
                           min="0" max="100.99" required autocomplete="off"  />

                    <label for="Tax" > <?= $text_Tax ?></label>
                </div>


            </div>


        </fieldset>

    <button>Add To Slaes</button>
    </section>

</div>

<?= $this->flashMessage()  ?>

<div class="statistics-window" id="statistics-popup">
    <div class="container-statistics-popup">
        <div class="body-statistics">
            <!-- TODO: Add last information client -->
        </div>
    </div>
</div>

<div class="container-table-popup" id="container-table-popup">
    <div class="table container-table">
    <button id="remove-container-table-popup">&times;</button>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Play Station 4</td>
                    <td>Image Pic</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>