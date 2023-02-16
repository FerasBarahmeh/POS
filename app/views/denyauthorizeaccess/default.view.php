<style>
    .text-wrapper {
        background-color: #eee;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .title-deny {
        font-size: 5em;
        font-weight: 700;
        color: #EE4B5E;
    }

    .subtitle {
        font-size: 40px;
        font-weight: 700;
        color: #1FA9D6;
    }
    .isi {
        font-size: 18px;
        text-align: center;
        margin:30px;
        padding:20px;
        color: black;
    }
    div.buttons {
        margin: 30px;
        font-weight: 700;
        border: 2px solid #EE4B5E;
        text-decoration: none;
        padding: 15px;
        text-transform: uppercase;
        color: #EE4B5E;
        border-radius: 26px;
        transition: all 0.2s ease-in-out;
        display: inline-block;

    div.buttons:hover {
        background-color: #EE4B5E;
        color: white;
        transition: all 0.2s ease-in-out;
    }
    }
    }

</style>
<div class="text-wrapper">
    <div class="title-deny" data-content="404">
        403 - <?= $text_access_denied_title ?>
    </div>

    <div class="subtitle">
        <?=  $text_deny_authorize_access ?>
    </div>
    <div class="isi">
        <?= $text_deny_authorize_access_description ?>
    </div>

    <div class="buttons">
        <a class="button" href="/"><?= $text_deny_authorize_access_back_home ?></a>
    </div>
</div>