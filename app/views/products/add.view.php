<h1 class="title-header"><?= $title_header ?></h1>

<div class="container-form">
    <form class="stander-form" method="POST" enctype="multipart/form-data">
        <fieldset class="rows-inputs">
            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="text"
                       name="Name" id="Name"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("Name") ?>"
                       placeholder=" " minlength="3"
                       maxlength="30" required autocomplete="off"/>
                <label for="Name"> <?= $table_Name; ?> </label>
            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="number"
                       name="Quantity" id="Quantity"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("Quantity") ?>"
                       placeholder=" " min="1" step="1"
                       required autocomplete="off"/>
                <label for="Quantity"> <?= $table_Quantity; ?> </label>
            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="number"
                       name="BuyPrice" id="BuyPrice"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("BuyPrice") ?>"
                       placeholder=" " max="10000000.999"
                       required autocomplete="off"/>
                <label for="BuyPrice"> <?= $table_BuyPrice; ?> </label>
            </div>
        </fieldset>

        <fieldset class="rows-inputs">
            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="number"
                       name="SellPrice" id="SellPrice"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("SellPrice") ?>"
                       placeholder=" "
                       required autocomplete="off"/>
                <label for="SellPrice"> <?= $table_SellPrice; ?> </label>
            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="text"
                       name="BarCode" id="BarCode"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("BarCode") ?>"
                       placeholder=" " maxlength="20"  autocomplete="off"/>
                <label for="BarCode"> <?= $table_BarCode; ?> </label>
            </div>

            <div class="row-input">

                <!-- Must Set space in placeholder to apply label animation -->
                <select name="CategoryId" id="CategoryId" class="" required autocomplete="off">
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
                <label for="BarCode" class="float floor"> <?= $table_CategoryId; ?> </label>

            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <select name="Unit" id="Unit" required autocomplete="off">
                    <option value=""><?= $table_Unit ?></option>
                    <?php
                    foreach ($units as $name => $value) {
                        ?>
                        <option value="<?= $value ?>" ><?= ${$this->getNameByNumber("unit", $value, $units)} ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="Unit" class="float floor"> <?= $table_Unit; ?> </label>

            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="number"
                       name="Tax" id="Tax"
                       class="up-label-focus"
                       value="<?= $this->getStorePost("Tax") ?>"
                       placeholder=" " max="5" step="0.1" min="0"
                       autocomplete="off"/>
                <label for="Tax"> <?= $table_Tax; ?> </label>
            </div>

        </fieldset>


        <fieldset class="rows-inputs">
            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->
                <input type="file" name="Image" value="<?= $this->getStorePost("Image") ?>" id="Image" placeholder=" " accept="image/*"/>
                <label for="Image" class="float floor left-3-per"> <?= $table_Image ?> </label>
            </div>

            <div class="row-input">
                <!-- Must Set space in placeholder to apply label animation -->

                <select name="Status" id="Status" class="" required autocomplete="off">
                    <?php
                        foreach ($status as $nameStatus => $valueStatus) {
                            if ($valueStatus != 0) {
                                ?> <option value="<?= $valueStatus ?>"><?= $nameStatus ?></option> <?php
                            }
                        }
                    ?>
                </select>
                <label for="Status" class="float floor left-3-per"> <?= $table_Status; ?> </label>
            </div>

        </fieldset>


        <fieldset class="rows-inputs">
            <div class="row-input">
                <textarea name="Description" id="Description" ></textarea>
                <label for="Description" class="float floor  left-3-per">Add Description</label>
            </div>
        </fieldset>

        <fieldset class="row submit-btn-container">
            <button class="stander-btn"><input type="submit" class="stander-btn" value="<?= $text_add_btn ?>" name="add"> <i class="fa fa-plus"></i></button>
        </fieldset>
    </form>
</div>