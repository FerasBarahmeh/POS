<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="rows-inputs">
        <div class="row-input">
            <input type="text"
                   name="privilege_title" id="PrivilegeTitle" minlength="3"
                   class="up-label-focus"
                   value="<?= $privilege->PrivilegeTitle ?>"
                   maxlength="30" required autocomplete="off"/>
            <label for=""  class=""> <?= $text_title_privilege; ?> </label>
        </div>

        <div class="row-input">
            <input type="text" name="privilege"  id="PrivilegeTitle"
                   class="up-label-focus"
                   minlength="3" maxlength="30"
                   value="<?= $privilege->Privilege ?>"
                   required autocomplete="off"/>
            <label for="" class=""> <?= $text_privilege ?> </label>
        </div>

    </fieldset>
    <fieldset class="rows-inputs submit-btn-container">
        <input type="submit" class="stander-btn" value="<?= $text_choose_save ?>" name="save">
    </fieldset>
</form>