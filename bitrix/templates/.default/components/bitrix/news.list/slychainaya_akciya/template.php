<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<!--
akcii_skidka
akcii_element
-->
<?
foreach ($arResult["ITEMS"] as $item)
    $arId[] = $item["ID"];

$rand_val = array_rand($arId, 1);
$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"] = $arResult["ITEMS"][$rand_val];

$productId = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DISPLAY_PROPERTIES"]["akcii_element"]["VALUE"];
?>

<?
$pictureSRC = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DETAIL_PICTURE"]["SRC"];

$skidkaValue = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DISPLAY_PROPERTIES"]["akcii_skidka"]["VALUE"];

$path = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DISPLAY_PROPERTIES"]["akcii_element"]["LINK_ELEMENT_VALUE"][$productId]["DETAIL_PAGE_URL"];
if(substr($path, -1)) $path = substr($path, 0, -1);

?>
<a href="<?=$path?>">
    <img src="<?=$pictureSRC?>" alt="">
    <p>
        <?=$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["PREVIEW_TEXT"]?><br/>
        <span><?=$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DETAIL_TEXT"]?></span>
    </p>
    <div class="skidka">скидка <?=$skidkaValue?>%</div>
</a>