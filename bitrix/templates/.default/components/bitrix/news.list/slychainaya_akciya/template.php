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
$pictureSRC = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["PREVIEW_PICTURE"]["SRC"];

$skidkaValue = $arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DISPLAY_PROPERTIES"]["akcii_skidka"]["VALUE"];

$path = 'http://'.$_SERVER["SERVER_NAME"].'/catalog/element/'.$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DISPLAY_PROPERTIES"]["akcii_element"]["LINK_ELEMENT_VALUE"][$productId]["CODE"];
?>
<a href="<?=$path?>">
    <img src="<?=$pictureSRC?>" alt="" style="min-height: 330px;">
    <?
        if(!empty($arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["PREVIEW_TEXT"]))
        {?>
            <p>
                <?=$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["PREVIEW_TEXT"]?><br/>
                <span><?=$arResult["ITEMS"]["SELECTED_RANDOM_ITEM"]["DETAIL_TEXT"]?></span>
            </p>
        <?}
    ?>
    <?
        if(!empty($skidkaValue))
        {?>
            <div class="skidka">скидка <?=$skidkaValue?>%</div>
        <?}
    ?>

</a>