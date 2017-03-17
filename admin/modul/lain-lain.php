<?php
switch($_GET[act]){
default:
echo "<h2>Lain - Lain &#187; Bantuan</h2>";
include "menu_lain-lain.php";
echo "<pre>
Aplikasi Prediksi Mahasiswa STMIK AMIKOM 

Aplikasi ini adalah untuk memprediksi jumlah mahasiswa memilih mata kuliah pilihan dan Konsentrasi,
Bagian-bagian yang terdapat pada aplikasi ini adalah :

<br>1. Data Mahasiswa : Berfungsi untuk Memasukkan data kasus mahasiswa yang akan diproses menjadi pohon keputusan.</br>
<br>2. C45 : Berfungsi untuk proses lakukan mining dan membentuk pohon keputusan dari data yang telah di masukkan sebelumnya.</br>
<br>3. Penentu Keputusan : Digunakan untuk menampilkan jumlah mahasiswa yang akan mengambil matakuliah pilihan dan konsentrasi sesuai dengan tahun</br>
					   <br>dan semester yang telah di tempuh sebelumnya.</br>
<br>4. lain-lain : Berfungsi untuk melihat pembuat sistem dan Bantuan sistem serta untuk menghapus semua data yang telah di masukkan </br>
<br>sebelumnya. </br>

</pre>     
";
break;

case "delete_all";
    echo "<h2>Lain - Lain &#187; Hapus Semua Data</h2>";
    include "menu_lain-lain.php";
    echo "<h3>Ingin Hapus Seluruh Data?
    <a href=./aksi.php?module=lain-lain&act=delete_all_db>Ya</a> | <a href=javascript:history.back(-1)>Tidak</a></h3>";
break;

case "about";
    echo "<h2>Lain - Lain &#187; About</h2>";
    include "menu_lain-lain.php";
    include "about.php";
break;
}
?>