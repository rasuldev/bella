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

$arSelect = array("ID", "PROPERTY_akcii_element", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID" => 6);
$akcii_res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, array(), $arSelect);
while ($arItem = $akcii_res->GetNext()) {
    $product = CIBlockElement::GetByID($arItem["PROPERTY_AKCII_ELEMENT_VALUE"]);
    if ($arProduct = $product->Fetch()) {
        $section = CIBlockSection::GetByID($arProduct["IBLOCK_SECTION_ID"]);
      if ($arSection = $section->Fetch()) {
          $arElement[$arItem["ID"]]["URL"] = "http://".$_SERVER["SERVER_NAME"]."/catalog/".$arSection["CODE"]."/".$arProduct["CODE"];
      }
    }
}
?>

    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <div class="akcii clear">
        <div>
            <p>
                <a class="wow bounceInLeft" style="visibility: visible; animation-name: bounceInLeft;"
                   href="<?=$arElement[$arResult["ITEMS"][0]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][0]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow bounceInRight" style="visibility: visible; animation-name: bounceInRight;"
                   href="<?=$arElement[$arResult["ITEMS"][1]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][1]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow bounceIn" style="visibility: visible; animation-name: bounceIn;"
                   href="<?=$arElement[$arResult["ITEMS"][2]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][2]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;"
                   href="<?=$arElement[$arResult["ITEMS"][3]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][3]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;"
                   href="<?=$arElement[$arResult["ITEMS"][4]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][4]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow pulse" style="visibility: visible; animation-name: pulse;"
                   href="<?=$arElement[$arResult["ITEMS"][5]["ID"]]["URL"]?>">
                    <img src="<?= $arResult["ITEMS"][5]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>


    </div>
