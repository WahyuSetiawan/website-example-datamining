<?php
// include "../../config/koneksi.php";
echo "<h2>C45 &#187; Pohon Keputusan</h2>";
include "menu_c45.php";
echo " <p>Opsi: <a href=./aksi.php?module=c45&act=hapus_pohon_keputusan>Hapus Semua Data</a></p>";
echo "<font face='Courier New' size='2'>";
echo "<h3><b>Pohon Keputusan: <br></b></h3>";
function get_subfolder($idparent, $spasi){
    $result = mysql_query("select * from pohon_keputusan_c45 where id_parent= '$idparent'");
    while($row=mysql_fetch_row($result)){
        for($i=1;$i<=$spasi;$i++){
            echo "|&nbsp;&nbsp;";
        }
        if ($row[6] === 'Ya') {
            $keputusan = "<font color=green>$row[6]</font>";
        } elseif ($row[6] === 'Tidak') {
            $keputusan = "<font color=red>$row[6]</font>";
        } elseif ($row[6] === '?') {
            $keputusan = "<font color=blue>$row[6]</font>";
        } else {
            $keputusan = "<b>$row[6]</b>";
        }
        echo "<font color=red>$row[1]</font> = $row[2] (Tidak = $row[4], Ya = $row[5]) : <b>$keputusan</b><br>";

        /*panggil dirinya sendiri*/
        get_subfolder($row[0], $spasi + 1);
    }
}

    get_subfolder('0', 0);
echo "<hr>";

echo "<h3><b>Rule: <br></b></h3>";
$no = 1;
$sqlLihatRule = mysql_query("select * from rule_c45 order by id" );
while($rowLihatRule=mysql_fetch_array($sqlLihatRule)){
    if ($rowLihatRule['keputusan'] === 'Ya') {
        $keputusan = "<font color=green>$rowLihatRule[keputusan]</font>";
    } elseif ($rowLihatRule['keputusan'] === 'Tidak') {
        $keputusan = "<font color=red>$rowLihatRule[keputusan]</font>";
    } elseif ($rowLihatRule['keputusan'] === '?') {
        $keputusan = "<font color=blue>$rowLihatRule[keputusan]</font>";
    } else {
        $keputusan = "<b>$rowLihatRule[keputusan]</b>";
    }
    echo "<b>$no.</b> if <b>(</b>$rowLihatRule[rule]<b>)</b> then <b>$keputusan</b> <font color=blue>(id = $rowLihatRule[id])</font><br>";
$no++;
}
echo "</font>";