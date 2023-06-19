<h1 class="title-header"><?= $title_header ?></h1>

<form class="stander-form" method="POST" enctype="multipart/form-data">
    <fieldset class="rows-inputs pb-10">
        <div class="row-input">
            <input type="text"
                   name="Name" id="Name"
                   class="up-label-focus"
                   value="<?= $this->getStorePost("Name", $category) ?>"
                   minlength="3"
                   maxlength="30" required autocomplete="off"/>
            <label for="Name" class="float floor  left-3-per"> <?= $text_Name; ?> </label>
        </div>

        <div class="row-input">
            <input type="file" name="Image" class="up-label-focus" value="<?= $this->getStorePost("Image", $category) ?>" id="Image" accept="image/*"/>
            <label for="Image" class="float floor  left-3-per"> <?= $text_Image ?> </label>
        </div>
    </fieldset>

    <fieldset class="rows-inputs pb-10">
        <div class="">
            <img src="/uploads/images/<?=  $category->Image ?>" alt="<?= $category->Name ?> Image">
        </div>
    </fieldset>


    <fieldset class="rows-inputs submit-btn-container">
        <input type="submit" class="stander-btn" value="<?= $text_edit_btn ?>" name="edit">
    </fieldset>
</form>