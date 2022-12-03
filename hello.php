<?php
ob_start();
include "header.php";
include "action.php";
echo "\n<h2>Secret information</h2>\n";
if (isset($_GET['login']) && $_GET['login'] != "") {
    $admin = $_GET['login'];
    if (check_log("admin") == true) {
        $seans = (rand(13 , 21));
        $mon = (rand(3300 , 5100));
        $bil = (rand(24 , 59));
        echo date("Сегодня d.m.Y")."<p></p>"; 
        echo "Сеансов:" .$seans, "<p></p>"; 
        echo "Прибыль:" .$mon, "<p></p>";
        echo "Проданных билетов:" .$bil;
    }
} else {
    header("Location: index.php");
    ob_end_flush();
}
include "footer.php";
