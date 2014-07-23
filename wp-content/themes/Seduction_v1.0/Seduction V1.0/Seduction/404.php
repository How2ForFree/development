<?php
/* INSTEAD OF A 404 PAGE, SEARCH FOR THE REQUESTED URL AND SHOW */
header('Location:' . get_bloginfo('url') . '/?s=' . str_replace('/', ' ', $_SERVER['REQUEST_URI']));
exit();
?>