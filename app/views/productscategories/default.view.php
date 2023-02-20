<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/productscategories/add" class="add-user"><?= $text_content_add_category ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_category ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

    <!-- Show Privileges -->
    <div class="container-table responsive-table mt-20" id="employees-table">
        <table class="">
            <thead>
                <tr>
                    <th><?= $text_table_name_category ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>

            <tbody>

                <?php
                    if (! empty($categories)) {
                        foreach ($categories as $category) {
                            ?>
                                <tr class="row-each-employee">
                                    <td class="name-user-row"><?= $category->Name ?></td>
                                    <td class="controller-btns">
                                        <a href="/productscategories/edit/<?= $category->CategoryId ?>">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a class="hidden"  href="/productscategories/delete/<?= $category->CategoryId ?>" id="delete"></a>

                                        <?php
                                            $this->popup(
                                                "you wont delete category",
                                                '!', $typeStyle="danger",
                                                $typeAction="link",
                                                $id="delete-category");
                                        ?>
                                        <span class="pop-on-click danger-style cursor-pointer"><i class="fa fa-trash" aria-hidden="true"></i></span>

                                    </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
