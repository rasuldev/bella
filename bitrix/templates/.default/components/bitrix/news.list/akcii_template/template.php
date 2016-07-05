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
$akcii_res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
while ($arItem = $akcii_res->GetNext()) {
    $product = CIBlockElement::GetByID($arItem["PROPERTY_AKCII_ELEMENT_VALUE"]);
    if ($arProduct = $product->Fetch()) {
        $section = CIBlockSection::GetByID($arProduct["IBLOCK_SECTION_ID"]);
      if ($arSection = $section->Fetch()) {
          $arElement[$arItem["ID"]]["SECTION_CODE"] = $arSection["CODE"];
          $arElement[$arItem["ID"]]["NAME_CODE"] = $arProduct["CODE"];
      }
    }
}

var_dump($arElement);
?>

<div class="inner_page clear">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <div class="akcii clear">
        <!--		$arResult["ITEMS"] as $arItem-->
        <div>
            <p>
                <a class="wow bounceInLeft" style="visibility: visible; animation-name: bounceInLeft;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][0]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][0]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][0]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow bounceInRight" style="visibility: visible; animation-name: bounceInRight;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][1]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][1]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][1]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow bounceIn" style="visibility: visible; animation-name: bounceIn;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][2]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][2]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][2]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][3]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][3]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][3]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>

            <p>
                <a class="wow flipInY" style="visibility: visible; animation-name: flipInY;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][4]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][4]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][4]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>

        <div>
            <p>
                <a class="wow pulse" style="visibility: visible; animation-name: pulse;"
                   href="catalog/<?=$arElement[$arResult["ITEMS"][5]["ID"]]["SECTION_CODE"].'/'.$arElement[$arResult["ITEMS"][5]["ID"]]["NAME_CODE"]?>/">
                    <img src="<?= $arResult["ITEMS"][5]["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                </a>
            </p>
        </div>


    </div>
</div>
