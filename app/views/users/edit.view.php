<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">

    <fieldset class="row">
        <div class="field">
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
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="PhoneNumber"  id="PhoneNumber"
                   value="<?= $this->getStorePost("PhoneNumber", $user) ?>"
                   placeholder=" " minlength="3" maxlength="15"
                   required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

    </fieldset>


    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Edit" name="edit">
    </fieldset>
</form>
