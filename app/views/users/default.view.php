<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/users/add" class="add-user"><?= $text_content_add_user ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_user ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Employees -->
<div class="users responsive-table mt-20" id="employees-table">
    <table class="">
        <thead>
        <tr>
            <th><?= $text_table_name_user ?></th>
            <th><?= $text_table_email_user ?></th>
            <th><?= $text_table_password_user ?></th>
            <th><?= $text_table_subscription_date_user ?></th>
            <th><?= $text_table_last_login_user ?></th>
            <th><?= $text_table_phone_number_user ?></th>
        </tr>
        </thead>

        <tbody>

                <?php
                    if (! empty($users) && isset($users)) {
                        foreach ($users as $user) {
                            ?>
                            <tr class="row-each-employee">
                                <td class="name-user-row"><?= $user->UserName ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->password ?></td>
                                <td><?= $user->subscriptionDate ?></td>
                                <td><?= $user->lastLogin ?></td>
                                <td class="controller-btns">
                                    <a href="employee/edit/<?= $user->id ?>"><i class="fas fa-edit"></i></a>
                                    <a href="employee/delete/<?= $user->id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a href=""><i class="fa fa-bell"  aria-hidden="true"></i></a>
                                </td>

                            </tr>
                            <?php
                        }
                    }

                ?>
        </tbody>
    </table>
</div>
