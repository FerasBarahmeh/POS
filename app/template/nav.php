<nav class="main_navigation p-20 hide-mobile" id="main_navigation">
    <div class="employee_info">
        <div class="profile_picture">
            <img src="<?= IMG ?>avatar.png" class="s-img" alt="User Profile Picture">
        </div>
        <span class="name block mt-5 fs-20">Feras Barahmeh</span>
        <span class="privilege block mt-5 fs-15">Admin Application</span>
    </div>

    <div class="search-session mtb-15 w-fu relative">
        <i class="fas fa-search search-icon"></i>
        <input type="search" class="w-fu" id="search-session" placeholder="<?= $text_nav_search_session ?>" />
    </div>

    <ul class="app_navigation mt-15 txt-l" id="app_navigation">
        <li class="cursor-pointer main-li">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <a href="/"><span class="inline-block ml-5"><?= $text_nav_general_setting  ?></span></a>
        </li>

        <li class="cursor-pointer main-li sort-col grand-li">

            <button class="between-ele w-fu">
                <span class="inline-block ml-5"><i class="fas fa-exchange-alt"></i><?= $text_nav_transactions ?></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_transactions_purchases ?></a><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_transactions_sales ?></a> <i class="fas fa-comment-dollar"></i></li>
            </ul>
        </li>

        <li class="cursor-pointer main-li">
            <i class="fa fa-chart-pie" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_reports ?></span></a>
        </li>

        <li class="cursor-pointer main-li sort-col grand-li">
            <button class="between-ele w-fu">
                <span class="inline-block ml-5"><i class="fa fa-store" aria-hidden="true"></i><?= $text_nav_store ?></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_product_category ?></a><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_products ?></a> <i class="fas fa-comment-dollar"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li sort-col grand-li">

            <button class="between-ele w-fu">
                <span class="inline-block ml-5"><i class="fa fa-wallet" aria-hidden="true"></i><?= $text_nav_expenses ?></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_expenses_categories ?></a><i class="fa fa-tags" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_daily_expenses ?></a> <i class="fa fa-credit-card" aria-hidden="true"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li sort-col grand-li">

            <button class="between-ele w-fu">
                <span class="inline-block ml-5"><i class="fa fa-users" aria-hidden="true"></i><?= $text_nav_users ?></span>
                <i class="fa fa-angle-double-down angle "></i>
            </button>

            <ul class="sub-menu w-fu mtb-10 un-visible">
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_users_list ?></a><i class="fa fa-list" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_users_groups ?></a> <i class="fas fa-users" aria-hidden="true"></i></li>
                <li class="li-level-2 between-ele"><a href="/" class="sub-link"><?= $text_nav_users_privileges ?></a> <i class="fas fa-user-secret" aria-hidden="true"></i></li>
            </ul>
        </li>


        <li class="cursor-pointer main-li">
            <i class="fa fa-solid fa-users" aria-hidden="true"></i>
            <a href="/clients"><span class="inline-block ml-5"><?= $text_nav_clients ?></span></a>
        </li>

        <li class="cursor-pointer main-li">
            <i class="fa fa-solid fa-parachute-box" aria-hidden="true"></i>
            <a href="/suppliers"><span class="inline-block ml-5"><?= $text_nav_suppliers ?></span></a>
        </li>


        <li class="cursor-pointer main-li">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_Notifications ?></span></a>
        </li>


    </ul>
</nav>
    <div class="action-view pt-20 pl-20 pr-20" id="action-view">