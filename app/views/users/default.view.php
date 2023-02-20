<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/users/add" class="add-user"><?= $text_content_add_user ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_user ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Employees -->
<div class="container-table responsive-table mt-20" id="employees-table">
    <table class="">
        <thead>
        <tr>
            <th><?= $text_table_name_user ?></th>
            <th><?= $text_table_email_user ?></th>
            <th><?= $text_table_password_user ?></th>
            <th><?= $text_table_subscription_date_user ?></th>
            <th><?= $text_table_last_login_user ?></th>
            <th><?= $text_table_phone_number_user ?></th>
            <th><?= $text_table_group_name ?></th>
            <th><?= $text_table_status ?></th>
            <th><?= $text_table_control ?></th>
        </tr>
        </thead>

        <tbody>

                <?php
                    if (! empty($users) && isset($users)) {
                        foreach ($users as $user) {
                            ?>
                                <tr class="row-each-employee">
                                    <td class="name-user-row"><?= $user->UserName ?></td>
                                    <td><?= $user->Email ?></td>
                                    <td class="long-content"><?= $user->Password ?></td>
                                    <td><?= $user->SubscriptionDate ?></td>
                                    <td><?= $user->LastLogin ?></td>
                                    <td><?= $user->PhoneNumber ?></td>
                                    <td><?= $user->GroupName ?></td>
                                    <td><?= $user->Status ?></td>
                                    <td class="controller-btns">
                                        <a href="/users/edit/<?= $user->UserId ?>"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                        <a class="hidden" href="/users/delete/<?= $user->UserId ?>" id="delete"></a>
                                        <?php $this->popup(
                                            "you wont delete User",
                                            '!', $typeStyle="danger",
                                            $typeAction="link",
                                            $id="delete-user"); ?>
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
