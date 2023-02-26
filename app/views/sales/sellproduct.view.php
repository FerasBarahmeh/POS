<h1 class="title-header"><?= $title_header ?></h1>
<div class="container">

    <div class="row">
        <h5 class="section-title"><i class="fa fa-table"></i> <?= $text_client ?> </h5>


        <fieldset class="header-field row-fieldset between-ele flex">
            <div class="flex gap-10">
                <div class="input-container" id="input-container">
                    <div class="container-input-search">
                        <input type="search" id="Name" name="Name" class="search-input border" autocomplete="off"/>
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
                        <input type="search" id="Email" name="Email" class="search-input border"  value="" autocomplete="off"/>
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

    </div>

</div>

<?= $this->flashMessage()  ?>