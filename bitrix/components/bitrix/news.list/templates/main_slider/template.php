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
<div id="slider" class="clear">
	<div class="slider">
		<ul class="slides">
			<?if($arParams["DISPLAY_TOP_PAGER"]):?>
				<?=$arResult["NAV_STRING"]?><br />
			<?endif;?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
			<li class="slide">
				<img src=<?echo CFile::GetPath($arItem['PROPERTIES']['BG_IMAGE']['VALUE'])?> alt=""/>
				<div>
					<h4><?echo $arItem['PROPERTIES']['TITLE']['VALUE'];?></h4>
					<p><?echo $arItem['PROPERTIES']['TEXT']['VALUE'];?></p>
				</div>
			</li>
			<?endforeach;?>
		</ul>
	</div>
</div>

<div class="news-list">

</div>
