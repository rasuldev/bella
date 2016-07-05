<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
    
?>

<div class="inner_page clear">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <div class="akcii clear">
        <!--		$arResult["ITEMS"] as $arItem-->
        <div>
            <p>
                <a class="wow bounceInLeft" style="visibility: visible; animation-name: bounceInLeft;" href="#">
                    <img src="<?= $arResult["ITEMS"][0]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow bounceInRight" style="visibility: visible; animation-name: bounceInRight;" href="#">
                    <img src="<?= $arResult["ITEMS"][1]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow bounceIn" style="visibility: visible; animation-name: bounceIn;" href="#">
                    <img src="<?= $arResult["ITEMS"][2]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;" href="#">
                    <img src="<?= $arResult["ITEMS"][3]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;" href="#">
                    <img src="<?= $arResult["ITEMS"][4]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow pulse" style="visibility: visible; animation-name: pulse;" href="#">
                    <img src="<?= $arResult["ITEMS"][5]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>


    </div>
