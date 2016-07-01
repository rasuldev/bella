<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<div class="inner_page_menu clear">
<div>
    <nav>
        <ul class="clear">
        	<?php
        	foreach ($arResult['SECTIONS'] as &$arSection)
        	{
                if ($arSection['IBLOCK_SECTION_ID']) continue;
                $active = ($arSection['SECTION_PAGE_URL']==$APPLICATION->GetCurDir())?' class="active"':'';
        		echo '<li><a href="'.$arSection['SECTION_PAGE_URL'].'"'.$active.'>'.$arSection['NAME'].'</a></li>';
        	}
        	?>
        </ul>
    </nav>
</div>
</div><!--inner_page_menu-->