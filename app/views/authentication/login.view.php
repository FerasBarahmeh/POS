<div id="content">
    <div class="img">
        <img src="<?= IMG ?>login.jpg" alt="Login Picture">
    </div>

    <div class="content">
        <?php
        $messages = $this->message->getMessage();
        if (! empty($messages)) {
            foreach ($messages as $message) {
                ?> <p class="message <?= $message[1] ?>"><?= $message[0] ?></p> <?php
            }
        }
        ?>
        <h1 class="welcome-message"><?= $welcome_message ?></h1>
        <form action="" method="POST">
            <div class="input-bar">
                <input type="text" name="UserName" id="name" class="input-login">
                <label for="name"><?= $placeholder_username ?></label>
            </div>
            <div class="input-bar">
                <input type="password" name="Password" id="password" class="input-login">
                <label for="password"><?= $placeholder_password ?></label>
            </div>

            <input type="submit" name="login" value="<?= $value_btn_login ?>" class="stander-btn">

        </form>

    </div>
</div>