<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/usersprivileges/add" class="stander-btn"><?= $text_content_add_privilege ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search"   placeholder="<?= $text_content_search_privilege ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Privileges -->
<div class="container-table responsive-table mt-20" id="employees-table">
    <table class="pagination-table">
        <thead>
        <tr>
            <th><?= $text_table_name_privilege ?></th>
            <th><?= $text_table_privilege ?></th>
            <th><?= $text_table_control ?></th>
        </tr>
        </thead>

        <tbody>
            <?php
                if (! empty($privileges)) {
                    foreach ($privileges as $privilege) {
                        ?>
                            <tr class="">
                                <td class=""><?= $privilege->PrivilegeTitle ?></td>
                                <td class=""><?= $privilege->Privilege ?></td>
                                <td class="controller-btns">
                                    <a href="/usersprivileges/edit/<?= $privilege->PrivilegeId ?>">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a class="hidden"  href="/usersprivileges/delete/<?= $privilege->PrivilegeId ?>" id="delete"></a>
                                    <?php $this->popup(
                                        "you wont delete privilege",
                                        '!', $typeStyle="danger",
                                        $typeAction="link",
                                        $id="delete-privilege"); ?>
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