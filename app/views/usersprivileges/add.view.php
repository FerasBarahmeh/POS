<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="row pb-10">
        <div class="field">
            <input type="text" name="privilege_title" id="PrivilegeTitle" maxlength="30" required />
            <label for="privilege_title"> <?= $text_title_privilege; ?> </label>
        </div>

        <div class="field">
            <input type="text" name="privilege"  id="PrivilegeTitle" maxlength="30" required/>
            <label for=""> <?= $text_privilege ?> </label>
        </div>

    </fieldset>
    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Add" name="add">
    </fieldset>
</form>