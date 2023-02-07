<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/usersprivileges/add" class="add-user"><?= $text_content_add_privilege ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_privilege ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Employees -->
<div class="users responsive-table mt-20" id="employees-table">
    <table class="">
        <thead>
        <tr>
            <th><?= $text_table_name_privilege ?></th>
            <th><?= $text_table_privilege ?></th>
            <th><?= $text_table_control ?></th>
        </tr>
        </thead>

        <tbody>

                <?php
                    if (! empty($privileges) && isset($privileges)) {
                        foreach ($privileges as $privilege) {
                            ?>
                            <tr class="row-each-employee">
                                <td class="name-user-row"><?= $privilege->PrivilegeTitle ?></td>
                                <td class="name-user-row"><?= $privilege->Privilege ?></td>
                                <td class="controller-btns">
                                    <a href="/usersprivileges/edit/<?= $privilege->PrivilegeId ?>">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a href="/usersprivileges/delete/<?= $privilege->PrivilegeId ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <a href="/"><i class="fa fa-bell"  aria-hidden="true"></i></a>
                                </td>

                            </tr>
                            <?php
                        }
                    }

                ?>
        </tbody>
    </table>
</div>
