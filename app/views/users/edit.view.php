<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">

    <fieldset class="rows-inputs">
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <select name="GroupId" id="GroupId" required autocomplete="off">
                <?php
                    if ($groups) {
                        foreach ($groups as $group) {
                            ?>
                                <option value="<?= $group->GroupId ?>" <?= $this->isStored("GroupId", $group->GroupId, $user) ?> ><?= $group->GroupName ?></option>
                            <?php
                        }
                    }

                ?>
            </select>
            <label for="GroupId" class="floor float "> <?= $table_GroupName ?> </label>
        </div>

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="PhoneNumber"  id="PhoneNumber"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("PhoneNumber", $user) ?>"
                   placeholder=" " minlength="3" maxlength="15"
                   required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs submit-btn-container">
        <input type="submit" class="stander-btn" value="Edit" name="edit">
    </fieldset>
</form>
