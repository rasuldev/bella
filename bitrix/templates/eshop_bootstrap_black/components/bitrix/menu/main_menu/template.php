<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<nav class="menu_home_page">
	<ul class="clear">
		<?php
			foreach($arResult as $arItem)
			{
				$selected = ($arItem["SELECTED"])?' class="active"':'';
				echo '<li><a '.$selected.' href="'.$arItem["LINK"].'">'.$arItem["TEXT"].'</a></li>';
			}
		?>
	</ul>
</nav>