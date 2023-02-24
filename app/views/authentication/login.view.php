<style>
    * {
        margin: 0;
        padding: 0;
        outline: none;
    }

    body {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #content {
        width: 800px;
        padding: 50px;
        box-shadow: 0 11px 17px 5px rgb(0 0 0 / 33%);
        border-radius: 50px;
        display: flex;
    }
    .img {
        width: 400px;
    }
    .img img {
        width: 100%;
    }

    #content > h1 {
        text-align: center;
    }

    .input-bar {
        width: 350px;
        height: 60px;
        border: 2px solid #000;
        border-radius: 5px;
        margin: 30px 0;
        opacity: 0.5;
        transition: 200ms;
        font-weight: 600;
        position: relative;
    }

    .input-bar > label {
        position: absolute;
        font-size: 17px;
        text-transform: capitalize;
        left: 5px;
        transition: 200ms;
    }

    .input-bar > input {
        position: absolute;
        width: 100%;
        height: 100%;
        border: none;
        background: none;
        box-sizing: border-box;
        padding: 7px;
        font-size: 18px;
    }

    .input-bar > input:focus ~ label {
        top: -20px;
    }

    input[type=submit] {
        width: 350px;
        border: none;
        padding: 15px;
        color: #fff;
        background-color: #000;
        font-size: 24px;
        border-radius: 0;
        cursor: pointer;
    }

</style>
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
        <h1><?= $welcome_message ?></h1>
        <form action="" method="POST">
            <div class="input-bar">
                <input type="text" name="UserName" id="name" class="input">
                <label for="name"><?= $placeholder_username ?></label>
            </div>
            <div class="input-bar">
                <input type="password" name="Password" id="password" class="input">
                <label for="password"><?= $placeholder_password ?></label>
            </div>
            <div class="input-bar">
                <input type="submit" name="login" value="<?= $value_btn_login ?>" class="input">
            </div>

        </form>

    </div>
</div>