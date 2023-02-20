<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="multipart/form-data">
    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="Name" id="Name"
                   value="<?= $this->getStorePost("Name") ?>"
                   placeholder=" " minlength="3"
                   maxlength="30" required autocomplete="off"/>
            <label for="Name"> <?= $table_Name; ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="number"
                   name="Quantity" id="Quantity"
                   value="<?= $this->getStorePost("Quantity") ?>"
                   placeholder=" " min="1" step="1"
                   required autocomplete="off"/>
            <label for="Quantity"> <?= $table_Quantity; ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="number"
                   name="BuyPrice" id="BuyPrice"
                   value="<?= $this->getStorePost("BuyPrice") ?>"
                   placeholder=" " max="10000000.999"
                   required autocomplete="off"/>
            <label for="BuyPrice"> <?= $table_BuyPrice; ?> </label>
        </div>

    </fieldset>

    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="number"
                   name="SellPrice" id="SellPrice"
                   value="<?= $this->getStorePost("SellPrice") ?>"
                   placeholder=" "
                   required autocomplete="off"/>
            <label for="SellPrice"> <?= $table_SellPrice; ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="BarCode" id="BarCode"
                   value="<?= $this->getStorePost("BarCode") ?>"
                   placeholder=" " maxlength="20"  autocomplete="off"/>
            <label for="BarCode"> <?= $table_BarCode; ?> </label>
        </div>

        <div class="field">

            <!-- Must Set space in placeholder to apply label animation -->
            <select name="CategoryId" id="CategoryId" required autocomplete="off">
                <option value=""><?= $table_message_category_description ?></option>
                <?php
                if ($categories) {
                    foreach ($categories as $categorie) {
                        ?>
                        <option value="<?= $categorie->CategoryId ?>" ><?= $categorie->Name ?></option>
                        <?php
                    }

                }

                ?>
            </select>
            <label for="BarCode" class="flay"> <?= $table_CategoryId; ?> </label>

        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <select name="Unit" id="Unit" required autocomplete="off">
                <option value=""><?= $table_Unit ?></option>
                <?php
                    foreach ($units as $name => $value) {
                        $n = "unit_" . ucfirst($name);
                        ?>
                            <option value="<?= $value ?>" ><?= $$n ?></option>
                        <?php
                    }
                ?>
            </select>
            <label for="Unit" class="flay"> <?= $table_Unit; ?> </label>

        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="number"
                   name="Tax" id="Tax"
                   value="<?= $this->getStorePost("Tax") ?>"
                   placeholder=" " max="5" step="0.1" min="0"
                   autocomplete="off"/>
            <label for="Tax"> <?= $table_Tax; ?> </label>
        </div>

    </fieldset>


    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="file" name="Image" value="<?= $this->getStorePost("Image") ?>" id="Image" placeholder=" " accept="image/*"/>
            <label for="Image"> <?= $table_Image ?> </label>
        </div>
    </fieldset>

    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="<?= $text_add_btn ?>" name="add">
    </fieldset>
</form>