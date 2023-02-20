<?php

namespace APP\Helpers\Structures;

trait Structures
{
    /**
     * This method to set Popup box in page depends on shortcut framework
     *
     * Description.
     *
     * @param string $contentMassage tack massage you will set in popup box
     * @param string $expressSymbol Set Symbol express to massage popup box
     * @param string $typeStyle This variable to control Theme
     * add class from shortcut framework if The action danger (Imported action add danger class)
     * if Action come after action Success add class success or done
     * @param string|null $typeAction This variable to determent type action after click ok button in popup
     * if link this is mean will click to link to do action
     * @param string|null $id The element to apply action on him (Must Be Hidden) and add 'pop-on-click' class to another
     * element Must Set After type action direct
     * @return void This method To Set Popup Box Structure.
     * @since 1.0.0
     * @access Public
     *
     */
    public static function popup(string $contentMassage="Are You Sure" ,  string  $expressSymbol = '!', string $typeStyle="danger", string $typeAction=null, string $id=null): void
    {
        ?>
        <div class="card <?= $typeStyle ?> <?= $typeAction ?> <?= $id ?>">
            <div class="symbol flex ">
                <span class="express-symbol  <?= $typeStyle ?>"><?= $expressSymbol ?></span>
            </div>
            <p class="content <?= $typeStyle ?>"><?= $contentMassage ?></p>
            <div class="discus center-ele">
                <span class="delete" id="reject-popup">No</span>
                <span class="ok" id="accepted-popup">OK</span>
            </div>
        </div>
        <?php
    }
}