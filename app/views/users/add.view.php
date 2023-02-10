<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="username" id="username"
                   placeholder=" " minlength="3"
                   maxlength="12" required autocomplete="off"/>
            <label for="username"> <?= $table_user_name ?></label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="password"  id="password" placeholder=" "
                   minlength="7" maxlength="60" required autocomplete="off"/>
            <label for="password"> <?= $table_password ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="confirm-password"  id="confirm-password" placeholder=" "
                   minlength="7" maxlength="60" required autocomplete="off"/>
            <label for="confirm-password"> <?= $table_confirm_password ?> </label>
        </div>


    </fieldset>

    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="email" id="email"
                   placeholder=" " minlength="10"
                   maxlength="30" required autocomplete="off"/>
            <label for="email"> <?= $table_email ?></label>
        </div>

    </fieldset>

    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <select name="GroupId" id="GroupId" required autocomplete="off">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="phoneNumber"  id="phoneNumber" placeholder=" "
                   minlength="3" maxlength="15" required autocomplete="off"/>
            <label for="phoneNumber"> <?= $table_phone_number ?> </label>
        </div>

    </fieldset>


    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Add" name="add">
    </fieldset>
</form>
