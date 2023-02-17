<?php

use APP\Helpers\Structures\Structures;

?>
<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/clients/add" class="add-client"><?= $text_content_add_client ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-client"></label><input type="search" id="find-client"  placeholder="<?= $text_content_search_client ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

<!-- Show Employees -->
<div class="container-table responsive-table mt-20" id="employees-table">
    <table class="">
        <thead>
        <tr>
            <th><?= $text_table_name_client ?></th>
            <th><?= $text_table_email_client ?></th>
            <th><?= $text_table_phone_number_client ?></th>
            <th><?= $text_table_address_client ?></th>
            <th><?= $text_table_control ?></th>
        </tr>
        </thead>

        <tbody>

                <?php
                    if (! empty($clients)) {
                        foreach ($clients as $client) {
                            ?>
                                <tr class="row-each-employee">
                                    <td class="name-client-row"><?= $client->Name ?></td>
                                    <td><?= $client->Email ?></td>
                                    <td><?= $client->PhoneNumber ?></td>
                                    <td><?= $client->Address ?></td>

                                    <td class="controller-btns">
                                        <a href="/clients/edit/<?= $client->ClientId ?>"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                        <a class="hidden" href="/clients/delete/<?= $client->ClientId ?>" id="delete"></a>
                                        <?php Structures::popup(
                                            "you wont delete client",
                                            '!', $typeStyle="danger",
                                            $typeAction="link",
                                            $id="delete-client"); ?>
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
