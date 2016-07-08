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
											<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote", 
	"footer_stars", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $arFields["ID"],
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
<?

?>
	<a href="javascript:void(0);" class="but_top"><i class="ico_top"></i></a>
	<div id="modal_window">
		<a href="javascript:void(0);" class="close_win"></a>
		<div class="window_open">
			<h4>Авторизация</h4>
			<div class="form_block">
				<form id="form_auth">
					<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "my_template1", array("SHOW_ERRORS" => "Y"));?>
				</form>
				<form id="registr_form" method="post" action="" name="regform" enctype="multipart/form-data">
					<?$APPLICATION->IncludeComponent("bitrix:main.register","my_reg_template",Array(
									"AUTH" => "Y",
									"REQUIRED_FIELDS" => array(
											'EMAIL',
											'PASSWORD',
											'CONFIRM_PASSWORD'),
									"SET_TITLE" => "Y",
									"SHOW_FIELDS" => array(
											'EMAIL',
											'PASSWORD',
											'CONFIRM_PASSWORD'),
									"SUCCESS_PAGE" => "/personal/",
									"USER_PROPERTY" => array(),
									"USER_PROPERTY_NAME" => "",
									"USE_BACKURL" => "Y"
							)
					);?>
	<script>
	var email_input = document.getElementsByClassName("email_field_param")[0];
	var login_input = document.getElementsByClassName('login_field_param')[0];
	login_input.parentElement.parentElement.setAttribute("style", "display:none");
	email_input.oninput = function() {
		login_input.setAttribute("value", email_input.value);
	};
	</script>
				</form>
				<form id="form_forg_p">
					<?$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", "my_flat", array("SHOW_ERRORS" => "Y"));?>
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