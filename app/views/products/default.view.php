<?php // TODO: set Image product (Not Name) ?>
<h1 class="title-header"><?= $title_header ?></h1>

<div class="header-option flex mt-10">
    <a href="/products/add" class="stander-btn"><?= $text_content_add_product ?> <i class="fa fa-plus ml-10"></i></a>
    <div class="search">
        <label for="find-user"></label><input type="search" id="find-user"  placeholder="<?= $text_content_search_product ?>">
        <i class="fa fa-search lens"></i>
    </div>
</div>

    <!-- Show Privileges -->
    <div class="container-table responsive-table mt-20" id="">
        <table class="pagination-table upper">
            <thead>
                <tr>
                    <th><?= $text_table_name_product ?></th>
                    <th><?= $text_table_category ?></th>
                    <th><?= $text_table_quantity ?></th>
                    <th><?= $text_table_unit ?></th>
                    <th><?= $text_table_buy_price ?></th>
                    <th><?= $text_table_sell_price ?></th>
                    <th><?= $text_table_profit ?></th>
                    <th><?= $text_table_total_price ?></th>
                    <th><?= $text_table_barcode ?></th>
                    <th><?= $text_table_status ?></th>
                    <th><?= $text_table_tax ?></th>
                    <th><?= $text_table_description ?></th>
                    <th><?= $text_table_image ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>

            <tbody>

                <?php
                    if (! empty($products)) {
                        foreach ($products as $product) {
                            ?>
                                <tr>
                                    <td ><?= $product->Name ?></td>
                                    <td ><?= $product->CategoryName ?></td>
                                    <td ><?= $product->Quantity ?></td>
                                    <td ><?= ${$this->getNameByNumber("unit", $product->Unit, $units)} ?></td>
                                    <td ><?= $product->BuyPrice ?></td>
                                    <td ><?= $product->SellPrice ?></td>
                                    <td ><?= ($product->Quantity * $product->SellPrice) - ($product->Quantity * $product->BuyPrice) ?> $</td>
                                    <td ><?= ($product->Quantity * $product->BuyPrice) ?> $</td>
                                    <td ><?= $product->BarCode ?></td>
                                    <td ><?= ${$this->getNameByNumber("status", $product->Status, $status)} ?></td>
                                    <td ><?= $product->Tax ?></td>
                                    <td ><?= $product->Description ?></td>
                                    <td ><img src="<?= UPLOAD_FOLDER_IMAGE . $product->Image ?>"  class="img-table" alt="image product" ></td>
                                    <td class="controller-btns">
                                        <a href="/products/edit/<?= $product->ProductId ?>">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a class="hidden"  href="/products/delete/<?= $product->ProductId ?>" id="delete"></a>

                                        <?php
                                            $this->popup(
                                                $this->language->feedKey("message_delete_hint", [$product->Name]),
                                                '!', $typeStyle="danger",
                                                $typeAction="link",
                                                $id="delete-product");
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
