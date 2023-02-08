<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="row pb-10">
        <div class="field ">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="GroupName" id="PrivilegeTitle"
                   placeholder=" " required autocomplete="off"/>
            <label for="GroupName"> <?= $text_name_group; ?> </label>
        </div>
    </fieldset>

    <!-- Check Box Privileges -->
    <fieldset class="privileges-to-groups flex sort-col mtb-20 plr-15">
        <label class="label-privilege-add-group mb-15"><?= $text_choose_privileges_group ?></label>

        <?php
            if (! empty($privileges)) {
                foreach ($privileges as $privilege) {
                    ?>
                    <div class="field">
                        <input type="checkbox" id="privilege-<?= $privilege->PrivilegeId ?>" name="privileges[]" value="<?= $privilege->PrivilegeId ?>" class="cursor-pointer">
                        <label for="privilege-<?= $privilege->PrivilegeId ?>"><?= $privilege->PrivilegeTitle ?></label>
                    </div>
                    <?php
                }
            }
        ?>

    </fieldset>

    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Add" name="add">
    </fieldset>
</form>