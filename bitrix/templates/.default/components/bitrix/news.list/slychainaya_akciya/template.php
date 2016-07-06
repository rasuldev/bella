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
?>


<a href="#">
    <img src="<?=$arResult["ITEMS"][$rand_val]["DETAIL_PICTURE"]["SRC"]?>" alt="">
    <p>
        <?=$arResult["ITEMS"][$rand_val]["PREVIEW_TEXT"]?><br/>
        <span><?=$arResult["ITEMS"][$rand_val]["DETAIL_TEXT"]?></span>
    </p>
    <div class="skidka">скидка <?=$arResult["ITEMS"][$rand_val]["DISPLAY_PROPERTIES"]["akcii_skidka"]["VALUE"]?>%</div>
</a>