<h1 class="title-header"><?= $title_header ?></h1>

<section class="header-container">

    <div class="content">
        <div class="img-user"><img src="<?=  IMG ?>avatar.png" alt=""></div>
        <div class="name-details">
            <div class="full-name">
                <span class="title"><?= $text_name ?></span>
                <span class="value"><?= $user->extraUserInfo->FirstName . ' ' . $user->extraUserInfo->LastName ?></span>
            </div>
            <div class="user-name">
                <span class="title"><?= $text_user_name ?></span>
                <span class="value"><?= $user->UserName ?></span>
            </div>
        </div>
    </div>

    <section class="navs-content">
        <div class="side">
            <ul>
                <li class="active" section-setting id="general-setting">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <div class="text"><?= $text_general_setting ?></div>
                </li>

                <li section-setting id="account">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="text"><?= $text_account ?></div>
                </li>

<!--                <li section-setting id="notification">-->
<!--                    <i class="fa fa-bell" aria-hidden="true"></i>-->
<!--                    <div class="text">Notification</div>-->
<!--                </li>-->
            </ul>
        </div>

        <section class="section active" table="" for="general-setting">
            <h4><?= $text_basic_info ?></h4>
            <div class="parts">
                <div class="part">
                    <div class="fields">
                        <!-- Start  Field -->
                        <div class="field" field name_field="FirstName">
                            <p class="error-message"></p>
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_first_name ?></div>
                                    <div class="value"><?= $user->extraUserInfo->FirstName ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_first_name ?></div>
                                    <div class="value"><label for=""><input type="text"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>

                            </div>
                        </div>
                        <!-- End  Field -->

                        <!-- Start  Field -->
                        <div class="field" field name_field="LastName">
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_last_name ?></div>
                                    <div class="value"><?= $user->extraUserInfo->LastName ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_last_name ?></div>
                                    <div class="value"><label for=""><input type="text"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>

                            </div>
                        </div>
                        <!-- End  Field -->


                        <!-- Start  Field -->
                        <div class="field" field name_field="PhoneNumber">
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_phone_number ?></div>
                                    <div class="value"><?= $user->PhoneNumber ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_phone_number ?></div>
                                    <div class="value"><label for=""><input type="text"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>

                            </div>
                        </div>
                        <!-- End  Field -->



                        <!-- Start  Field -->
                        <div class="field" field name_field="Address">
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_address ?></div>
                                    <div class="value"><?= $user->extraUserInfo->Address ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_address ?></div>
                                    <div class="value"><label for=""><input type="text"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>

                            </div>
                        </div>
                        <!-- End  Field -->


                        <!-- Start  Field -->
                        <div class="field" field name_field="BOD">
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_bod ?></div>
                                    <div class="value"><?= $user->extraUserInfo->BOD ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_bod ?></div>
                                    <div class="value"><label for=""><input type="date"  placeholder="day:month:year"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>
                            </div>
                        </div>
                        <!-- End  Field -->

                    </div>
                </div>
            </div>
        </section>
        <section class="section" for="account">
            
            <h4><?= $text_account ?></h4>
            <div class="parts">
                <div class="part">
                    <div class="fields">

                        <!-- Start  Field -->
                        <div class="field"  >
                            <div class="main-layer">
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_lang ?></div>
                                    <div class=""><?= $user->Language ?></div>
                                </div>
                                <button class=""><a href="/language"><?= $text_change ?></a></button>
                            </div>

                        </div>
                        <!-- End  Field -->


                        <!-- Start  Field -->
                        <div class="field" field name_field="Currency">
                            <div class="main-layer" main-layer>
                                <div class="flex gap-10">
                                    <div class="title"><?= $text_currency ?></div>
                                    <div class="value"><?= $user->Currency ?></div>
                                </div>
                                <button class="btn-show-edit-section"><?= $text_edit ?></button>
                            </div>
                            <div class="secondary-layer" secondary-layer>
                                <div class="cont-fie-ed">
                                    <div class="title"><?= $text_currency ?></div>
                                    <div class="value"><label for=""><input type="text"></label></div>
                                </div>
                                <div class="options">
                                    <button class="save"><?= $text_save ?></button>
                                    <button class="cansel" undo-btn><?= $text_cancel ?></button>
                                </div>

                            </div>
                        </div>
                        <!-- End  Field -->


                    </div>
                </div>
            </div>
        </section>

    </section>

</section>