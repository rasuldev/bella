<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class="auth_block clear">

	<!-- Пользователь -->
	<p class="h_auth">
		<i class="ico_user"></i>

		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (strlen($name) > 20)
				$name = substr($name, 0, 17).'...';
			?>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>"><?=htmlspecialcharsbx($name)?></a>
			&nbsp;
			<a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
		<?else:?>
			<!-- <a id="auth" href="#">Вход</a> / <a id="registr" href="#">Регистрация</a> -->
			<a id="auth" href="#"><?=GetMessage('TSB1_LOGIN')?></a>
			&nbsp;
			<a id="registr" href="#"><?=GetMessage('TSB1_REGISTER')?></a>
		<?endif?>
	</p>

	<!-- Корзина -->
	<p class="h_cart">
		<a href="<?= $arParams['PATH_TO_BASKET'] ?>" alt="В вашей корзине <?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?>">
			<i class="ico_cart"></i>
			<span><?=$arResult['NUM_PRODUCTS']?></span>
		</a>
	</p>
</div><!--auth_block-->