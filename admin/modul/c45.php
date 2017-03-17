<?php
switch($_GET[act]){
    default:
        include "pohon_keputusan_c45.php";
    break;
    case "mining";
        echo "<h2>C45 &#187; Mining C4.5</h2>";
        include "menu_c45.php";
        timer_start();
        include "function/miningPrePruningC45.php";
        $waktu = timer_stop(3);
        echo "<p>Proses Mining Selesai! Waktu yang dibutuhkan $waktu detik</p>";
    break;
}