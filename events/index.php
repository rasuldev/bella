<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Акции");
?>
<div id="main_container">

    <div class="inner_page clear">
        <div class="row">
            <div class="col-lg-12" id="navigation">
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "-"
                    ),
                    false,
                    Array('HIDE_ICONS' => 'Y')
                );?>
            </div>
        </div>
        <h1 class="bx-title dbg_title" id="pagetitle"><?=$APPLICATION->ShowTitle(false);?></h1>

        <div class="akcii clear">

            <div>
                <p><a class="wow bounceInLeft" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban1.jpg" alt=""/></a></p>
                <p><a class="wow bounceInRight" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban2.jpg" alt=""/></a></p>
            </div>
            <div>
                <p><a class="wow bounceIn" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban3.jpg" alt=""/></a></p>
            </div>
            <div>
                <p><a class="wow flipInY" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban4.jpg" alt=""/></a></p>
                <p><a class="wow flipInY" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban5.jpg" alt=""/></a></p>
            </div>
            <div>
                <p><a class="wow pulse" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ban6.jpg" alt=""/></a></p>
            </div>

        </div><!--akcii-->

    </div><!--inner_page-->


</div> <!--#content_main-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>