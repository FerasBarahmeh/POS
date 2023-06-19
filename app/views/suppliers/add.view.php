<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">

    <fieldset class="rows-inputs">

        <div class="row-input">
            <input type="text" name="Name" id="Name"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Name") ?>"
                   minlength="2" maxlength="30" required
                   autocomplete="off"  />

            <label for="Name"> <?= $table_Name ?></label>
        </div>

        <div class="row-input">
            <input type="email"  name="Email" id="Email"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Email") ?>"
                   minlength="10" maxlength="40"
                   required autocomplete="off"/>

            <label for="Email"> <?= $table_Email ?></label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs">

        <div class="row-input">
            <input type="text" name="PhoneNumber"  id="PhoneNumber"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("PhoneNumber") ?>"
                   minlength="3" maxlength="15"
                   required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

        <div class="row-input">
            <input type="text" name="Address"  id="Address"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Address") ?>"
                   minlength="3" maxlength="50"
                   required autocomplete="off"/>
            <label for="Address"> <?= $table_Address ?> </label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs submit-btn-container">
        <button class="stander-btn"><input type="submit" class="stander-btn" value="Add" name="add"><i class="fa fa-plus"></i></button>
    </fieldset>
</form>
