<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="multipart/form-data">
    <fieldset class="rows-inputs">
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="Name" id="Name"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Name", $product) ?>"
                   minlength="3"
                   maxlength="30" required autocomplete="off"/>
            <label for="Name"> <?= $table_Name; ?> </label>
        </div>

        <div class="row-input">
            <input type="number"
                   name="Quantity" id="Quantity"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Quantity", $product) ?>"
                   min="1" step="1"
                   required autocomplete="off"/>
            <label for="Quantity"> <?= $table_Quantity; ?> </label>
        </div>

        <div class="row-input">
            <input type="number"
                   name="BuyPrice" id="BuyPrice"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("BuyPrice", $product) ?>"
                   max="10000000.999"
                   required autocomplete="off"/>
            <label for="BuyPrice"> <?= $table_BuyPrice; ?> </label>
        </div>

        <div class="row-input">

            <input type="number"
                   name="SellPrice" id="SellPrice"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("SellPrice", $product) ?>"

                   required autocomplete="off"/>
            <label for="SellPrice"> <?= $table_SellPrice; ?> </label>
        </div>

    </fieldset>

    <fieldset class="rows-inputs">

        <div class="row-input">
            <input type="text"
                   name="BarCode" id="BarCode"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("BarCode", $product) ?>"
                   maxlength="20"  autocomplete="off"/>
            <label for="BarCode"> <?= $table_BarCode; ?> </label>
        </div>
        <div class="row-input">

            <select name="CategoryId" id="CategoryId" class="up-label-focus" required autocomplete="off">
                <?php
                if ($categories) {
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?= $category->CategoryId ?>" <?= $this->isStored("CategoryId", $category->CategoryId, $product) ?>  ><?= $category->Name ?></option>
                        <?php
                    }

                }

                ?>
            </select>
            <label for="BarCode" class="floor"> <?= $table_CategoryId; ?> </label>

        </div>

        <div class="row-input">
            <select name="Unit" id="Unit" class="up-label-focus" required autocomplete="off">
                <option value=""><?= $table_Unit ?></option>
                <?php
                foreach ($units as $name => $value) {
                    $n = "unit_" . ucfirst($name);
                    ?>
                        <option value="<?= $value ?>" <?= $this->isStored("Unit", $value, $product) ?>  ><?= $$n ?></option>
                    <?php
                }
                ?>
            </select>
            <label for="Unit" class="floor"> <?= $table_Unit; ?> </label>

        </div>

        <div class="row-input">
            <input type="number"
                   name="Tax" id="Tax"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Tax", $product) ?>"
                   max="5" step="0.1" min="0"
                   autocomplete="off"/>
            <label for="Tax" class="floor"> <?= $table_Tax; ?> </label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs">
        <div class="row-input">
            <input type="file" name="Image" class="up-label-focus" value="<?= $this->getStorePost("Image", $product) ?>" id="Image" placeholder=" " accept="image/*"/>
            <label for="Image" class="float floor"> <?= $table_Image ?> </label>
        </div>


        <div class="row-input">

            <select name="Status" id="Status" class="up-label-focus" required autocomplete="off">
                <?php
                    $getNameStatus = array_search($product->Status, $status);
                ?>
                <option value="<?= $status[$getNameStatus] ?>"><?= $getNameStatus ?></option>
                <?php
                foreach ($status as $nameStatus => $valueStatus) {
                    ?> <option value="<?= $valueStatus ?>"><?= $nameStatus ?></option> <?php
                }
                ?>
            </select>
            <label for="Status" class="floor"> <?= $table_Status; ?> </label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs submit-btn-container">
        <div class="row-input">
            <textarea name="Description" id="Description" class="up-label-focus"><?= $product->Description ?></textarea>
            <label for="Description" class="float floor  left-3-per"><?= $table_Description ?></label>
        </div>
    </fieldset>

    <fieldset class="rows-inputs submit-btn-container">
        <input type="submit" class="stander-btn" value="<?= $text_edit_btn ?>" name="edit">
    </fieldset>
</form>