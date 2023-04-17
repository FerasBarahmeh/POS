<h1 class="title-header"><?= $title_header ?></h1>

<div class="sales-container">

    <section class="partisan">
        <h5 class="section-title"><i class="fa fa-table"></i> <?= $text_client ?> </h5>
        <section class="input-search-fields-container header-partisan-section">
            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="name" class="title float">name client</label>
                    <input type="text"
                           id="name"
                           class="find-client-input search"
                           type-request="name"
                           autocomplete="off"/>

                </div>
                <ul class="list-identifier" fetchClientBy="Name">
                    <?php
                        foreach ($clients as $client) {
                            ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->Name ?></li> <?php
                        }
                    ?>
                </ul>
            </div>

            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="email" class="title float">email client</label>
                    <input type="email"
                           id="email"
                           class="find-client-input search"
                           type-request="email"
                           autocomplete="off"/>
                </div>
                 <ul class="list-identifier" fetchClientBy="email">
                     <?php
                     foreach ($clients as $client) {
                         ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->Email ?></li> <?php
                     }
                     ?>
                 </ul>
            </div>

            <div class="container-search-section component-input-js">
                <div class="input">
                    <label for="id" class="title">ID client</label>
                    <input type="number"
                           id="id"
                           class="find-client-input search"
                           type-request="id"
                           autocomplete="off"/>
                </div>
                <ul class="list-identifier" fetchClientBy="id">
                    <?php
                    foreach ($clients as $client) {
                        ?> <li ClientId="<?= $client->ClientId ?>"><?= $client->ClientId ?></li> <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="img-flag-section">
                <img src="<?= IMG ?>search-client.png" alt="" class="t--70 hide-mobile">
            </div>
        </section>

        <section class="footer-partisan-section" client>
            <h5 class="mb-10"><i class="fa fa-database mr-10"></i><?= $text_client_info ?></h5>

            <fieldset class="row-foot-partisan-section">
                <div class="input w-50-prs">
                    <label for="Name" class="float tm10 l26"> <?= $text_Name ?></label>
                    <input type="text" name="Name" id="Name"  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>

                <div class="input w-50-prs">
                    <label for="Email" class="float tm10 l26"> <?= $text_Email ?></label>
                    <input type="text" name="email" id="Email" class="show-info txt-cn"
                           minlength="4" maxlength="50" required
                           autocomplete="off"  />
                </div>

            </fieldset>
            <fieldset class="row-foot-partisan-section">
                <div class="input w-25-prs">
                    <label for="PhoneNumber" class="float tm10 l26"> <?= $text_PhoneNumber ?></label>
                    <input type="text" name="PhoneNumber" id="PhoneNumber"  class="show-info txt-cn"
                           minlength="2" maxlength="30" required autocomplete="off"  />
                </div>

                <div class="input w-75-prs">
                    <label for="address" class="float tm10 l26"> <?= $text_Address ?></label>
                    <input type="text" name="address" id="Address" class="show-info txt-cn"
                           minlength="15" maxlength="15" required
                           autocomplete="off"  />
                </div>

            </fieldset>
        </section>


    </section>
</div>

<?= $this->flashMessage()  ?>
