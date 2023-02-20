<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/usersgroups/add" class="add-user"><?= $text_content_add_group ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_group ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Employees -->
<div class="container-table responsive-table mt-20" id="employees-table">
    <table class="">
        <thead>
        <tr>
            <th><?= $text_table_name_group ?></th>
            <th><?= $text_table_control ?></th>
        </tr>
        </thead>

        <tbody>

                <?php
                    if (! empty($groups)) {
                        foreach ($groups as $group) {
                            ?>
                            <tr class="row-each-employee">
                                <td class="name-user-row"><?= $group->GroupName ?></td>
                                <td class="controller-btns">
                                    <a href="usersgroups/edit/<?= $group->GroupId ?>"><i class="fas fa-edit"></i></a>
                                    <a href="usersgroups/delete/<?= $group->GroupId ?>"  class="hidden" id="delete"></a>
                                    <?php $this->popup("you wont delete Group",'!', $typeStyle="danger", $typeAction="link", $id="delete-group"); ?>
                                    <span class="pop-on-click danger-style link delete-group  cursor-pointer"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </td>

                            </tr>
                            <?php
                        }
                    }

                ?>
        </tbody>
    </table>
</div>
