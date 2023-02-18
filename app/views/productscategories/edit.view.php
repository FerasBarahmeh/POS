<h1 class="title-header"><?= $title_header ?></h1>

<form class="add-form" method="POST" enctype="multipart/form-data">
    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="text"
                   name="Name" id="Name"
                   value="<?= $this->getStorePost("Name", $category) ?>"
                   placeholder=" " minlength="3"
                   maxlength="30" required autocomplete="off"/>
            <label for="Name"> <?= $text_Name; ?> </label>
        </div>

    </fieldset>

    <fieldset class="row pb-10">
        <div class="field">
            <!-- Must Set space in placeholder to apply label animation -->
            <input type="file" name="Image" value="<?= $this->getStorePost("Image", $category) ?>" id="Image" placeholder=" " accept="image/*"/>
            <label for="Image"> <?= $text_Image ?> </label>
        </div>
    </fieldset>

    <fieldset class="row pb-10">
        <div class="field">
            <img src="/uploads/images/<?=  $category->Image ?>" alt="<?= $category->Name ?> Image">
        </div>
    </fieldset>


    <fieldset class="row submit-btn-container">
        <input type="submit" class="submit-btn" value="<?= $text_edit_btn ?>" name="edit">
    </fieldset>
</form>