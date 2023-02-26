<h1 class="title-header"><?= $title_header ?></h1>
<div class="container">

    <div class="row">
        <h5 class="section-title"><i class="fa fa-table"></i> <?= $text_client ?> </h5>


        <fieldset class="header-field row-fieldset  flex">
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
        </fieldset>
    </div>

</div>

<?= $this->flashMessage()  ?>