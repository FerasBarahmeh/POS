<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">

    <fieldset class="row">

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation  -->
            <input type="text" name="Name" id="Name"
                   value="<?= $this->getStorePost("Name") ?>"
                   minlength="2" maxlength="30" required
                   placeholder=" "  autocomplete="off"  />

            <label for="Name"> <?= $table_Name ?></label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="email"  name="Email" id="Email"
                   value="<?= $this->getStorePost("Email") ?>"
                   placeholder=" " minlength="10" maxlength="40"
                   required autocomplete="off"/>

            <label for="Email"> <?= $table_Email ?></label>
        </div>

    </fieldset>


    <fieldset class="row">

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="PhoneNumber"  id="PhoneNumber"
                   value="<?= $this->getStorePost("PhoneNumber") ?>"
                   placeholder=" " minlength="3" maxlength="15"
                   required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="Address"  id="Address"
                   value="<?= $this->getStorePost("Address") ?>"
                   placeholder=" " minlength="3" maxlength="50"
                   required autocomplete="off"/>
            <label for="Address"> <?= $table_Address ?> </label>
        </div>

    </fieldset>


    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Add" name="add">
    </fieldset>
</form>
