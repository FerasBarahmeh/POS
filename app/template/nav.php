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
        <li class="cursor-pointer">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <a href="/"><span class="inline-block ml-5"><?= $text_nav_general_setting  ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-users" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_users ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-store" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_store ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_product_category ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-solid fa-users" aria-hidden="true"></i>
            <a href="/clients"><span class="inline-block ml-5"><?= $text_nav_clients ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-solid fa-parachute-box" aria-hidden="true"></i>
            <a href="/suppliers"><span class="inline-block ml-5"><?= $text_nav_suppliers ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-wallet" aria-hidden="true"></i>
            <a href="/expenses"><span class="inline-block ml-5"><?= $text_nav_expenses ?></span></a>
        </li>


        <li class="cursor-pointer">
            <i class="fa fa-receipt"  aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_expenses_categories ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-credit-card" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_daily_expenses ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fas fa-exchange-alt"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_transactions ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-money-check" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_transactions_purchases ?></span></a>
        </li>


        <li class="cursor-pointer">
            <i class="fas fa-handshake" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_transactions_sales ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-chart-pie" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_reports ?></span></a>
        </li>

        <li class="cursor-pointer">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <a href="/users"><span class="inline-block ml-5"><?= $text_nav_Notifications ?></span></a>
        </li>


    </ul>
</nav>
    <div class="action-view pt-20 pl-20 pr-20" id="action-view">