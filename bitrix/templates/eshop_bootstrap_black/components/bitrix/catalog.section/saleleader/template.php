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
<div class="popular_tovar clear">
	<h2>популярные товары</h2>
	<ul class="bxslider clear">
<? foreach ($arResult['ITEMS'] as $key => $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);


	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
	$iBlockSection = GetIBlockSection($arItem['IBLOCK_SECTION_ID']);

	$productTitle = (
	isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
	isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
	?>
	<li><aside class="prod">
		<figure>
			<!--<a class="img_prod" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><img src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $imgTitle; ?>"/></a>-->
			<?if($arItem['PREVIEW_PICTURE']['SRC'] != "") {?>
			<a class="img_prod" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><img src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $imgTitle; ?>"/></a>
			<?} else {?>
			<a class="img_prod" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><img src="\bitrix\templates\eshop_bootstrap_black\components\bitrix\catalog.section\saleleader\images\no_photo.png" alt="<? echo $imgTitle; ?>" style="display: inline-block"></a>
			<?}?>
			<p class="hover_prod">
<!--				<a id="--><?// echo $arItemIDs['BUY_LINK']; ?><!--" href="javascript:void(0)" rel="nofollow"><i class="ico_cart"></i></a>-->
				<a id="<? echo $arItemIDs['BUY_LINK']; ?>" href="/?action=ADD2BASKET&amp;id=<?=$arItem['ID']?>" rel="nofollow"><i class="ico_cart"></i></a>
			</p>
			<p class="skidki_prod">
				<?if ($arItem['PROPERTIES']['SALELEADER']['VALUE_XML_ID'] == "YYY") {
					echo "<i class=\"sprite_1\"></i>";
				}?>
				<?if ($arItem['PROPERTIES']['NEWPRODUCT']['VALUE_XML_ID'] == "Y") {
					echo "<i class=\"sprite_2\"></i>";
				}?>
				<?if ($arItem['PROPERTIES']['SPECIALOFFER']['VALUE_XML_ID'] == "YES") {
					echo "<i class=\"sprite_3\"></i>";
				}?>
			</p><!--skidki_prod-->
			<?$APPLICATION->IncludeComponent(
				"bitrix:iblock.vote",
				"footer_stars",
				array(
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "2",
					"ELEMENT_ID" => $arItem["ID"],
					"MAX_VOTE" => "5",
					"VOTE_NAMES" => array(
						0 => "1",
						1 => "2",
						2 => "3",
						3 => "4",
						4 => "5",
						5 => "",
					),
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"COMPONENT_TEMPLATE" => "footer_stars",
					"ELEMENT_CODE" => $_REQUEST["CODE"],
					"SET_STATUS_404" => "N",
					"MESSAGE_404" => "",
					"DISPLAY_AS_RATING" => "rating",
					"SHOW_RATING" => "N"
				),
				$component
			);?>
		</figure>
		<p class="cat_prod"><a href="<?=$iBlockSection['SECTION_PAGE_URL']?>"><?=$iBlockSection['NAME']?></a></p>
		<p class="name_prod"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$productTitle?></a></p>
		<p class="price_prod">
			<?
			if (!empty($minPrice))
			{
				if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
				{
					echo GetMessage(
						'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
						array(
							'#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
							'#MEASURE#' => GetMessage(
								'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
								array(
									'#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
									'#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
								)
							)
						)
					);
				}
				else
				{
					echo '<span class="now_price">'.$minPrice['PRINT_DISCOUNT_VALUE'].'</span>';
				}
				if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE'])
				{
					?> <span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span><?
				}
			}
			unset($minPrice);
			?>
		</p>
	</aside></li><?}?>
	</ul>
</div>

