<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="rows-inputs">
        <div class="row-input ">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="GroupName" id="PrivilegeTitle"
                   class="up-label-focus"
                   placeholder=" " required autocomplete="off"/>
            <label for="GroupName"> <?= $text_name_group; ?> </label>
        </div>
    </fieldset>

    <!-- Check Box Privileges -->
    <fieldset class="set-group-user">
        <label class="label-privilege-add-group mb-15"><?= $text_choose_privileges_group ?></label>

        <?php
            if (! empty($privileges)) {
                foreach ($privileges as $privilege) {
                    ?>
                    <div class="">
                        <input type="checkbox" id="privilege-<?= $privilege->PrivilegeId ?>" name="privileges[]" value="<?= $privilege->PrivilegeId ?>" class="cursor-pointer">
                        <label for="privilege-<?= $privilege->PrivilegeId ?>"><?= $privilege->PrivilegeTitle ?></label>
                    </div>
                    <?php
                }
            }
        ?>

    </fieldset>

    <fieldset class="row submit-btn-container">
        <input type="submit" class="stander-btn" value="Add" name="add">
    </fieldset>
</form>