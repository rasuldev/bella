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

$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
CJSCore::Init(array("ajax"));

//Let's determine what value to display: rating or average ?
if($arParams["DISPLAY_AS_RATING"] == "vote_avg")
{
	if($arResult["PROPERTIES"]["vote_count"]["VALUE"])
		$DISPLAY_VALUE = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"]/$arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
	else
		$DISPLAY_VALUE = 0;
}
else
{
	$DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];
}
$voteContainerId = 'vote_'.$arResult["ID"];
$canVote = !$arResult["VOTED"] && $arParams["READ_ONLY"]!=="Y";
?>
<p class="<?=$canVote ? "stars_prod" : "stars_vote_disabled" ?>" id="<?echo $voteContainerId?>">
	<?
	$onclick = "JCFlatVote.do_vote(this, '".$voteContainerId."', ".$arResult["AJAX_PARAMS"].");";
	foreach ($arResult["VOTE_NAMES"] as $i => $name)
	{
		if ($DISPLAY_VALUE && round($DISPLAY_VALUE) > $i)
		{
			$className = "ico_star reit";
		}
		else
		{
			$className = "ico_star";
		}

		$itemContainerId = $voteContainerId.'_'.$i;

		?><i
			class="<?echo $className?>"
			id="<?echo $itemContainerId?>"
			title="<?echo $name?>"
			<?if ($canVote):?>
				onclick="<?echo htmlspecialcharsbx($onclick);?>"
			<?endif;?>
		></i><?
	}
	?>
	<?if ($arResult["PROPERTIES"]["vote_count"]["VALUE"] != null)
		echo '<span id="', $arJSParams["ratingId"], '" class="bx_stars_rating_votes">(', $arResult["PROPERTIES"]["vote_count"]["VALUE"], ')</span>';?>
	<!--<span id="<?=$arJSParams["ratingId"]?>" class="bx_stars_rating_votes">(<?echo $arResult["PROPERTIES"]["vote_count"]["VALUE"]?>)</span>-->
	<?
	if ($arParams["SHOW_RATING"] == "Y"):?>
		(<?echo $DISPLAY_VALUE?>)
	<?endif;
?>
</p>