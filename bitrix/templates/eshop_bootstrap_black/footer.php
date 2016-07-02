<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!$needSidebar):?>
<div class="sidebar col-md-3 col-sm-4">
	<?
	/*
	$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "sidebar",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_MODE" => "html",
		),
		false,
		Array('HIDE_ICONS' => 'Y')
	);
	*/?>
</div><!--// sidebar -->
<?endif?>

<footer>
		<div class="footer_top">
			<section class="clear">
				<aside>
					<h4>О нас</h4>
					<p class="f_text">
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud.
						<br /><a href="#">Читать далее »</a>
					</p>

					<h3>E-Mail рассылка:</h3>
					<!--
					<form action="#">
						<p class="clear emal_podpiska">
							<input type="text" placeholder="E-Mail адрес"/>
							<input type="submit" value=""/>
							<i class="ico_msg"></i>
						</p>
					</form>
					-->
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/sender.php",
							"AREA_FILE_RECURSIVE" => "N",
							"EDIT_MODE" => "html",
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);
					?>
				</aside>
				<aside>
					<h4>Новинки</h4>
					<ul>
						<?php
						    $res = CIBlockElement::GetList(
								array("SORT"=>"ASC"),
								array('IBLOCK_TYPE' => 'catalog'),
								false,
								array('nTopCount' => 3)
							);
						    while($ob = $res->GetNextElement())
						    {
						        $arFields = $ob->GetFields();
						        $img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
						        $price = CPrice::GetBasePrice($arFields['ID']);
						        ?>
						        <li>
						        	<div class="new_prod clear">
						        		<a href="#"><img src="<?=$img['SRC']?>" alt=""/></a>
						        		<div>
						        			<p class="name_tov"><a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a></p>
						        			<p class="name_price">
						        				<?php /*<span class="old_price">18 000 ₷</span>*/?>
						        				<span class="new_price"><?=$price['PRICE']?> ₷</span>
						        			</p>
						        			<p class="stars_prod">
						        				<i class="ico_star"></i>
						        				<i class="ico_star"></i>
						        				<i class="ico_star"></i>
						        				<i class="ico_star"></i>
						        				<i class="ico_star"></i>
						        			</p>
						        		</div>
						        	</div><!--new_prod-->
						        </li>
						        <?php
						    }
						?>
					</ul>
				</aside>
				<aside>
					<h4>Контакты</h4>
					<ul>
						<li><i class="ico_map"></i>Москва Куркино Соловьиная роща 9</li>
						<li><i class="ico_tel"></i><a href="tel:">495 540 52 52</a></li>
						<li><i class="ico_plane"></i><a href="mailto:">info@bellashop.ru</a></li>
						<li>
							<p class="soc">
								<a href=""><i class="ico_fb"></i></a>
								<a href=""><i class="ico_vk"></i></a>
								<a href=""><i class="ico_ok"></i></a>
							</p>
						</li>
					</ul>
				</aside>
			</section>
		</div> <!--footer_top-->
		<div class="footer_bot">
			<p class="copy">&copy; 2016 <a href="#">BellaShop</a></p>
		</div> <!--footer_bot-->
	</footer> <!-- footer -->

	<a href="javascript:void(0);" class="but_top"><i class="ico_top"></i></a>
	<div id="modal_window">
		<a href="javascript:void(0);" class="close_win"></a>
		<div class="window_open">
			<h4>Авторизация</h4>
			<div class="form_block">
				<form id="form_auth">
					<?$APPLICATION->IncludeComponent("mytemplate:system.auth.authorize", "flat", array());?>
				</form>
				<form id="registr_form" action="#">
					<p><input min="3" type="text" placeholder="Ваше Имя..." required/><i class="ico_user"></i></p>
					<p><input type="email" placeholder="Ваш E-mail..." required/><i class="ico_msg"></i></p>
					<p><input type="password" placeholder="Введите Пароль..." required/><i class="ico_key"></i></p>
					<p><input type="password" placeholder="Повторите Пароль..." required/><i class="ico_key"></i></p>
					<div>
						<input type="submit" value="Зарегистрироваться"/><br />
						<a id="auth_form_show" href="javascript:void(0)">Вход</a>
					</div>
				</form>
				<form id="form_forg_p">
					<?$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", "my_flat", array());?>
				</form>
				<!--form_block-->
			</div><!--form_block-->
		</div><!--window_open-->
	</div><!--modal_window-->

</div> <!-- wrap -->
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.12.0.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/js/jquery.glide.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.bxslider.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.colorbox.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/js.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/wow.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/app.js"></script>
<script>
	new WOW().init();
</script>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/animate.css"/>

</body>
</html>