<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset class="row">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation  -->
            <input type="text"
                   name="UserName" id="UserName"
                   minlength="4" maxlength="12" required
                   placeholder=" "   autocomplete="off"/>
            <label for="UserName"> <?= $table_UserName ?></label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="password" name="Password"  id="Password" placeholder=" "
                   minlength="7" maxlength="60" required autocomplete="off"/>
            <label for="Password"> <?= $table_Password ?> </label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="password" name="confirm-password"  id="confirm-password" placeholder=" "
                   minlength="7" maxlength="60" required autocomplete="off"/>
            <label for="confirm-password"> <?= $table_confirm_password ?> </label>
        </div>


    </fieldset>

    <fieldset class="row">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="email"
                   name="Email" id="Email"
                   placeholder=" " minlength="10"
                   maxlength="30" required autocomplete="off"/>
            <label for="Email"> <?= $table_Email ?></label>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="email"
                   name="confirm-email" id="confirm-email"
                   placeholder=" " minlength="10"
                   maxlength="30" required autocomplete="off"/>
            <label for="confirm-email"> <?= $table_confirm_email ?></label>
        </div>

    </fieldset>

    <fieldset class="row">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <select name="GroupId" id="GroupId" required autocomplete="off">
                <option class="selected"><?= $table_GroupId ?></option>
                <?php
                    if ($groups) {
                        foreach ($groups as $group) {
                            ?>
                                <option value="<?= $group->GroupId ?>"><?= $group->GroupName ?></option>
                            <?php
                        }

                    }

                ?>
            </select>
        </div>

        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="PhoneNumber"  id="PhoneNumber" placeholder=" "
                   minlength="3" maxlength="15" required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

    </fieldset>


    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="Add" name="add">
    </fieldset>
</form>
