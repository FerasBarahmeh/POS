<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="application/x-www-form-urlencoded">

    <fieldset class="rows-inputs">

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation  -->
            <input type="text" name="FirstName" id="FirstName"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("FirstName") ?>"
                   minlength="4" maxlength="12" required
                   placeholder=" "   autocomplete="off"  />

            <label for="FirstName"> <?= $table_FirstName ?></label>
        </div>
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation  -->
            <input type="text" name="LastName" id="LastName"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("LastName") ?>"
                   minlength="4" maxlength="12" required
                   placeholder=" "   autocomplete="off"  />

            <label for="LastName"> <?= $table_LastName ?></label>
        </div>

    </fieldset>




    <fieldset class="rows-inputs">
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation  -->
            <input type="text" name="UserName" id="UserName"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("UserName") ?>"
                   minlength="4" maxlength="12" required
                   placeholder=" "   autocomplete="off"  />

            <label for="UserName"> <?= $table_UserName ?></label>
        </div>

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="password" name="Password"  id="Password"
                   class="up-label-focus"
                    value="<?= $this->getStorePost("Password") ?>"
                   placeholder=" " minlength="7" maxlength="60"
                   required autocomplete="off"/>
            <label for="Password"> <?= $table_Password ?> </label>
        </div>

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="password" name="confirm_password"  id="confirm_password"
                   class="up-label-focus"
                    value="<?= $this->getStorePost("confirm_password") ?>"
                   placeholder=" " minlength="7" maxlength="60"
                   required autocomplete="off"/>

            <label for="confirm_password"> <?=  $table_confirm_password ?> </label>
        </div>

    </fieldset>

    <fieldset class="rows-inputs">
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="email"  name="Email" id="Email"
                   class="up-label-focus"
                    value="<?= $this->getStorePost("Email") ?>"
                   placeholder=" " minlength="10" maxlength="30"
                   required autocomplete="off"/>

            <label for="Email"> <?= $table_Email ?></label>
        </div>

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="email" name="confirm_email" id="confirm_email"
                   class="up-label-focus"
                    value="<?= $this->getStorePost("confirm_email") ?>"
                   placeholder=" " minlength="10" maxlength="30"
                   required autocomplete="off"/>

            <label for="confirm_email"> <?= $table_confirm_email ?></label>
        </div>

    </fieldset>

    <fieldset class="rows-inputs">
        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
           <select name="GroupId" id="GroupId" required autocomplete="off">
                <option class="selected" value="<?= $this->getStorePost("GroupId") ?>"><?= $table_GroupId ?></option>
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
            <label for="GroupId" class="float floor left-3-per"></label>
        </div>

        <div class="row-input">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text" name="PhoneNumber"  id="PhoneNumber"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("PhoneNumber") ?>"
                   placeholder=" " minlength="3" maxlength="15"
                   required autocomplete="off"/>
            <label for="PhoneNumber"> <?= $table_PhoneNumber ?> </label>
        </div>

    </fieldset>


    <fieldset class="rows-inputs submit-btn-container">
        <button class="stander-btn flex f-sp-between"><input type="submit" class="stander-btn" value="Add" name="add"><i class="fa fa-plus"></i></button>
    </fieldset>
</form>
