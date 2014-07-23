<?php
/* GET H1 COLOR */
$h1Color = get_option('_screen-h1Color');

$h1Color = ($h1Color !== false) ? ' color:#' . $h1Color . ';' : '';

/* GET H2 COLOR */
$h2Color = get_option('_screen-h2Color');

$h2Color = ($h2Color !== false) ? ' color:#' . $h2Color . ';' : '';

/* GET H3 COLOR */
$h3Color = get_option('_screen-h3Color');

$h3Color = ($h3Color !== false) ? ' color:#' . $h3Color . ';' : '';

/* GET H4 COLOR */
$h4Color = get_option('_screen-h4Color');

$h4Color = ($h4Color !== false) ? ' color:#' . $h4Color . ';' : '';

/* GET H5 COLOR */
$h5Color = get_option('_screen-h5Color');

$h5Color = ($h5Color !== false) ? ' color:#' . $h5Color . ';' : '';

/* GET H6 COLOR */
$h6Color = get_option('_screen-h6Color');

$h6Color = ($h6Color !== false) ? ' color:#' . $h6Color . ';' : '';

/* GET H6 COLOR */
$payofftextColor = get_option('_screen-payofftextColor');

$payofftextColor = ($payofftextColor !== false) ? ' color:#' . $payofftextColor . ';' : '';

/* GET PARAGRAPH COLOR */
$paragraphColor = get_option('_screen-paragraphColor');

$paragraphColor = ($paragraphColor !== false) ? ' color:#' . $paragraphColor . ';' : '';

/* GET LINK COLOR */
$linkColor = get_option('_screen-linkColor');

$linkColor = ($linkColor !== false) ? ' color:#' . $linkColor . ';' : '';

/* GET LINK HOVER COLOR */
$linkhoverColor = get_option('_screen-linkhoverColor');

$linkhoverColor = ($linkhoverColor !== false) ? ' color:#' . $linkhoverColor . ';' : '';

/* GET WIDGET TITLE COLOR */
$widgeth3Color = get_option('_screen-widgeth3Color');

$widgeth3Color = ($widgeth3Color !== false) ? ' color:#' . $widgeth3Color . ';' : '';

/* GET WIDGET LINK HOVER COLOR */
$widgetlinkhoverColor = get_option('_screen-widgetlinkhoverColor');

$widgetlinkhoverColor = ($widgetlinkhoverColor !== false) ? ' color:#' . $widgetlinkhoverColor . ';' : '';

/* GET BREADCRUMB COLOR */
$breadcrumbColor = get_option('_screen-breadcrumbColor');

$breadcrumbColor = ($breadcrumbColor !== false) ? ' color:#' . $breadcrumbColor . ';' : '';

/* GET BREADCRUMB HOVER COLOR */
$breadcrumbhoverColor = get_option('_screen-breadcrumbhoverColor');

$breadcrumbhoverColor = ($breadcrumbhoverColor !== false) ? ' color:#' . $breadcrumbhoverColor . ';' : '';

/* GET BLOG TITLE COLOR */
$blogh2Color = get_option('_screen-blogh2Color');

$blogh2Color = ($blogh2Color !== false) ? ' color:#' . $blogh2Color . ';' : '';

/* GET BLOG TITLE HOVER COLOR */
$blogh2hoverColor = get_option('_screen-blogh2hoverColor');

$blogh2hoverColor = ($blogh2hoverColor !== false) ? ' color:#' . $blogh2hoverColor . ';' : '';

/* GET BLOG META COLOR */
$blogmetaColor = get_option('_screen-blogmetaColor');

$blogmetaColor = ($blogmetaColor !== false) ? ' color:#' . $blogmetaColor . ';' : '';

/* GET BLOG META HOVER COLOR */
$blogmetahoverColor = get_option('_screen-blogmetahoverColor');

$blogmetahoverColor = ($blogmetahoverColor !== false) ? ' color:#' . $blogmetahoverColor . ';' : '';

/* GET LOGO TEXT COLOR */
$logotextColor = get_option('_screen-logotextColor');

$logotextColor = ($logotextColor !== false) ? ' color:#' . $logotextColor . ';' : '';

/* GET LOGO TEXT HOVER COLOR */
$logotexthoverColor = get_option('_screen-logotexthoverColor');

$logotexthoverColor = ($logotexthoverColor !== false) ? ' color:#' . $logotexthoverColor . ';' : '';

/* GET WIDGET LINKS COLOR */
$widgetlinkColor = get_option('_screen-widgetlinkColor');

$widgetlinkColor = ($widgetlinkColor !== false) ? ' color:#' . $widgetlinkColor . ';' : '';

/* GET WIDGET LINKS HOVER COLOR */
$widgetlinkhoverColor = get_option('_screen-widgetlinkhoverColor');

$widgetlinkhoverColor = ($widgetlinkhoverColor !== false) ? ' color:#' . $widgetlinkhoverColor . ';' : '';

/* GET WIDGET SUB LINKS COLOR */
$widgetsublinkColor = get_option('_screen-widgetsublinkColor');

$widgetsublinkColor = ($widgetsublinkColor !== false) ? ' color:#' . $widgetsublinkColor . ';' : '';

/* GET MENU LINKS COLOR */
$menulinkColor = get_option('_screen-menulinkColor');

$menulinkColor = ($menulinkColor !== false) ? ' color:#' . $menulinkColor . ';' : '';

/* GET MENU LINKS HOVER COLOR */
$menulinkhoverColor = get_option('_screen-menulinkhoverColor');

$menulinkhoverColor = ($menulinkhoverColor !== false) ? ' color:#' . $menulinkhoverColor . ';' : '';

/* GET MENU SUB TITLES COLOR */
$menusubtitlesColor = get_option('_screen-menusubtitlesColor');

$menusubtitlesColor = ($menusubtitlesColor !== false) ? ' color:#' . $menusubtitlesColor . ';' : '';

/* GET FOOTER MENU COLOR */
$footermenuColor = get_option('_screen-footermenuColor');

$footermenuColor = ($footermenuColor !== false) ? ' color:#' . $footermenuColor . ';' : '';

/* GET FOOTER MENU HOVER COLOR */
$footermenuhoverColor = get_option('_screen-footermenuhoverColor');

$footermenuhoverColor = ($footermenuhoverColor !== false) ? ' color:#' . $footermenuhoverColor . ';' : '';

/* GET COPYRIGHT LINK COLOR */
$copyrightColor = get_option('_screen-copyrightColor');

$copyrightColor = ($copyrightColor !== false) ? ' color:#' . $copyrightColor . ';' : '';

/* GET COPYRIGHT LINK HOVER COLOR */
$copyrighthoverColor = get_option('_screen-copyrighthoverColor');

$copyrighthoverColor = ($copyrighthoverColor !== false) ? ' color:#' . $copyrighthoverColor . ';' : '';

/* GET SUB MENU LINKS COLOR */
$submenulinkColor = get_option('_screen-submenulinkColor');

$submenulinkColor = ($submenulinkColor !== false) ? ' color:#' . $submenulinkColor . ';' : '';

/* GET SUB MENU LINKS HOVER COLOR */
$submenulinkhoverColor = get_option('_screen-submenulinkhoverColor');

$submenulinkhoverColor = ($submenulinkhoverColor !== false) ? ' color:#' . $submenulinkhoverColor . ';' : '';
?>



<style type="text/css">h1{<?php echo $h1Color ?>}h2{<?php echo $h2Color ?>}h3{<?php echo $h3Color ?>}h4{<?php echo $h4Color ?>}h5{<?php echo $h5Color ?>}h6{<?php echo $h6Color ?>}#payoff h2{<?php echo $payofftextColor ?>}html, body, p{<?php echo $paragraphColor ?>}a{<?php echo $linkColor ?>}a:hover{<?php echo $linkhoverColor ?>}.widgets h3 {<?php echo $widgeth3Color ?>}.widgets ul li a:hover{<?php echo $widgetlinkhoverColor ?>}.td-breadcrumb,.td-breadcrumb a {<?php echo $breadcrumbColor ?>}.td-breadcrumb a:hover {<?php echo $breadcrumbhoverColor ?>}.blog h2 a {<?php echo $blogh2Color ?>}.blog h2 a:hover {<?php echo $blogh2hoverColor ?>}.blogmeta, .blog .blogmeta a, .blogmeta a {<?php echo $blogmetaColor ?>}.blog a:hover, .blogmeta a:hover {<?php echo $blogmetahoverColor ?>}.blog a {<?php echo $linkColor ?>}.blog a:hover {<?php echo $linkhoverColor ?>}.reply a {<?php echo $linkColor ?>}.reply a:hover {<?php echo $linkhoverColor ?>}.commentmetadata a {<?php echo $linkColor ?>}.commentmetadata a:hover {<?php echo $linkhoverColor ?>}.comment-author {<?php echo $linkColor ?>}#comments {<?php echo $h3Color ?>}#logo p {<?php echo $logotextColor ?>}#logo p:hover {<?php echo $logotexthoverColor ?>}.widgets ul.menu li a {<?php echo $widgetlinkColor ?>}.widgets ul.menu ul li A:hover,.widgets ul.menu li a:hover {<?php echo $widgetlinkhoverColor ?>}.widgets ul.menu ul li a {<?php echo $widgetsublinkColor ?>}#header .menu ul li a {<?php echo $menulinkColor ?>}#header .menu ul li a:hover {<?php echo $menulinkhoverColor ?>}#header .menu ul li a .menu-subtitle {<?php echo $menusubtitlesColor ?>}.footermenu a {<?php echo $footermenuColor ?>}.footermenu a:hover {<?php echo $footermenuhoverColor ?>}.footercopyright a {<?php echo $copyrightColor ?>}.footercopyright a:hover {<?php echo $copyrighthoverColor ?>}#header .menu ul li ul li a{ <?php echo $submenulinkColor ?>}#header .menu ul li ul li a:hover{ <?php echo $submenulinkhoverColor ?>}</style>
