<nav class="main_navigation p-20 hide-mobile" id="main_navigation">
    <div class="header-nav">
        <div class="profile_picture">
            <img src="<?= IMG ?>avatar.png" class="s-img" alt="User Profile Picture">
        </div>
        <span class="name block mt-5 fs-20"><i class="fist-name"><?= $this->session->user->extraUserInfo->FirstName ?></i> <i class="last-name"><?= $this->session->user->extraUserInfo->LastName ?></i></span>
        <span class="privilege block mt-5 fs-15"><?= $this->session->user->GroupName ?></span>
    </div>

    <div class="search-session mtb-15 w-fu relative">
        <i class="fas fa-search search-icon"></i>
        <input type="search" class="w-fu" id="search-session" placeholder="<?= $text_nav_search_session ?>" />
    </div>

    <ul class="app_navigation mt-15 txt-l" id="app_navigation">
        <li class="cursor-pointer main-li <?= $this->compareURL('/') === true ? 'selected' : '' ?>">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <a href="/"><span class="inline-block"><?= $text_nav_general_setting  ?></span></a>
        </li>

        <li class="cursor-pointer main-li sort-col grand-li <?= $this->compareURL('/sales') === true ? 'selected' : '' ?> ">

            <button class="between-ele w-fu">
                <span class="inline-block"><a href="/sales"><i class="fa fa-chart-area"></i><?= $text_nav_sales ?></a></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/sales/sellproduct" class="sub-link"><?= $text_nav_sell_product ?></a><i class="fa fa-tag"></i></li>
            </ul>
        </li>

        <li class="cursor-pointer main-li sort-col grand-li <?= $this->compareURL('/transactions') === true ? 'selected' : '' ?> ">

            <button class="between-ele w-fu">
                <span class="inline-block"><a href="/transactions"><i class="fas fa-exchange-alt"></i><?= $text_nav_transactions ?></a></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/transactionspurchases" class="sub-link"><?= $text_nav_transactions_purchases ?></a><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/transactionssales" class="sub-link"><?= $text_nav_transactions_sales ?></a> <i class="fas fa-comment-dollar"></i></li>
            </ul>
        </li>

        <li class="cursor-pointer main-li <?= $this->compareURL('/reports') === true ? 'selected' : '' ?>">
            <i class="fa fa-chart-pie" aria-hidden="true"></i>
            <a href="/reports"><span class="inline-block"><?= $text_nav_reports ?></span></a>
        </li>

        <li class="cursor-pointer main-li sort-col grand-li <?= $this->compareURL('/store') === true ? 'selected' : '' ?>">
            <button class="between-ele w-fu">
                <span class="inline-block"><a href="/store"><i class="fa fa-store" aria-hidden="true"></i><?= $text_nav_store ?></a></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/productscategories" class="sub-link"><?= $text_nav_product_category ?></a><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/products" class="sub-link"><?= $text_nav_products ?></a> <i class="fas fa-comment-dollar"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li sort-col grand-li <?= $this->compareURL('/expenses') === true ? 'selected' : '' ?>">

            <button class="between-ele w-fu">
                <span class="inline-block"><a href="/expenses"><i class="fa fa-wallet" aria-hidden="true"></i><?= $text_nav_expenses ?></a></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/expenses/categories" class="sub-link"><?= $text_nav_expenses_categories ?></a><i class="fa fa-tags" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/expenses/daily-expanses" class="sub-link"><?= $text_nav_daily_expenses ?></a> <i class="fa fa-credit-card" aria-hidden="true"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li sort-col grand-li <?= $this->compareURL('/users/') === true ? 'selected' : '' ?>">

            <button class="between-ele w-fu">
                <span class="inline-block"><a href="/users/"><i class="fa fa-users" aria-hidden="true"></i><?= $text_nav_users ?></a></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/users/" class="sub-link"><?= $text_nav_users_list ?></a><i class="fa fa-list" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/usersgroups" class="sub-link"><?= $text_nav_users_groups ?></a> <i class="fas fa-users" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/usersprivileges" class="sub-link"><?= $text_nav_users_privileges ?></a> <i class="fas fa-user-secret" aria-hidden="true"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li <?= $this->compareURL('/clients') === true ? 'selected' : '' ?>">
            <i class="fa fa-solid fa-users" aria-hidden="true"></i>
            <a href="/clients"><span class="inline-block"><?= $text_nav_clients ?></span></a>
        </li>

        <li class="cursor-pointer main-li <?= $this->compareURL('/suppliers') === true ? 'selected' : '' ?>">
            <i class="fa fa-solid fa-parachute-box" aria-hidden="true"></i>
            <a href="/suppliers"><span class="inline-block"><?= $text_nav_suppliers ?></span></a>
        </li>


        <li class="cursor-pointer main-li  <?= $this->compareURL('/notifications') === true ? 'selected' : '' ?>">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <a href="/notifications"><span class="inline-block"><?= $text_nav_Notifications ?></span></a>
        </li>


    </ul>
</nav>
    <div class="action-view pt-20 pl-20 pr-20" id="action-view">

        <?php
            $messages = $this->message->getMessage();
            if (! empty($messages)) {
                foreach ($messages as $message) {
                    ?> <p class="message <?= $message[1] ?>"><?= $message[0] ?></p> <?php
                }
            }
        ?>