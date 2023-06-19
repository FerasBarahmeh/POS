<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="rows-inputs">
        <div class="row-input">
            <input type="text" value="<?= $group->GroupName ?>"
                   class="up-label-focus"
                   name="GroupName" id="PrivilegeTitle"
                   required autocomplete="off"/>
            <label for="GroupName"> <?= $text_name_group; ?> </label>
        </div>
    </fieldset>

    <!-- Check Box Privileges -->
    <fieldset class="privileges-to-groups flex sort-col mtb-20 plr-15">
        <label class="label-privilege-add-group mb-15"><?= $text_choose_privileges_group ?></label>

        <?php
            foreach ($privileges as $privilege) {

                ?>

                    <div class="field">
                        <input type="checkbox" id="privilege-<?= $privilege->privilegeId ?>" name="privileges[]"
                            <?= in_array($privilege->PrivilegeId, $groupPrivilege) ? "checked" : '' ?>
                               value="<?= $privilege->PrivilegeId ?>" class="cursor-pointer">
                        <label for="privilege-<?= $privilege->PrivilegeId ?>"><?= $privilege->PrivilegeTitle ?></label>
                    </div>
                <?php
            }
        ?>

    </fieldset>

    <fieldset class="row submit-btn-container">
        <input type="submit" class="stander-btn" value="<?= $text_choose_save ?>" name="edit">
    </fieldset>
</form>