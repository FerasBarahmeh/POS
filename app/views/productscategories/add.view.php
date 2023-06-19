<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="multipart/form-data">
    <fieldset class="rows-inputs">
        <div class="row-input">
            <input type="text"
                   name="Name" id="Name"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Name") ?>"
                   placeholder=" " minlength="3"
                   maxlength="30" required autocomplete="off"/>
            <label for="Name"> <?= $text_Name; ?> </label>
        </div>

        <div class="row-input">
            <input type="file" name="Image" class="up-label-focus" value="<?= $this->getStorePost("Image") ?>" id="Image" placeholder=" " accept="image/*"/>
            <label for="Image" class="float floor  left-3-per"> <?= $text_Image ?> </label>
        </div>

    </fieldset>
    <fieldset class="rows-inputs submit-btn-container">
        <input type="submit" class="stander-btn" value="Add" name="add">
    </fieldset>
</form>