<?php
    function setPathInHeader(): void
    {
        global $title;
        if (isset($title)) {
            echo  " >> " . $title;
        }
    }
?>
<header class="main between-ele">
    <div class="title">
        <span
                class="menu-switch cursor-pointer inline-block ml10"
                id="menu-switch"
                data-condition-menu="false">
                <i class="fa fa-bars"></i>
        </span>
        <h1 class="title inline-block ml-15 fs-20 fw-bold">
            <?= $text_header_title  ?>
            <?php if (isset($title)): ?>
                <?= ' >> ' . $title ?>
            <?php endif; ?>
        </h1>

    </div>

    <div class="options flex gap-15">

        <div class="icons flex gap-10 cursor-pointer">
            <a href="/language" class="description" description="change language"><i class="fa fa-globe" aria-hidden="true"></i></a>
            <a href="/" class="description" description="Notifications"><i class="fa fa-bell"  aria-hidden="true"></i></a>
            <a href="/" class="description" description="Massages"><i class="fa fa-comment-dots" aria-hidden="true"></i></a>

        </div>

        <div class="drop-down relative" id="drop-down">
            <div class="name cursor-pointer">
                <span>Feras</span>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>

            <div class="container-drop-down-main-header" id="menu">
                <ul class="absolute drop-down-main-header">
                    <li>
                        <i class="fa fa-user inline-block"></i>
                        <span class="content"><?= $text_header_personal_info ?></span>
                    </li>
                    <li>
                        <i class="fa fa-lock"></i>
                        <span class="content"><?= $text_header_setting ?></span>
                    </li>
                    <li>
                        <i class="fa fa-arrow-left"></i>
                        <a href="/authentication/logout" class="content"><?= $text_nav_logout ?></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</header>