<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/hitungWaktu.php";

// Bagian Home
if ($_GET[module]=='home'){
    echo "<h2>Aplikasi Data Mining Algoritma C4.5</h2>
    <table width='100%'>
        <tr>
            <td>
                <h2 align='justify'>
                    Selamat Datang.<br>
                </h2>
            </td>
        </tr>
    </table>";
}

// Modul Data mahasiswa
elseif ($_GET[module]=='data_mahasiswa'){
    include "modul/data_mahasiswa.php";
}

// Modul C4.5
elseif ($_GET[module]=='c45'){
    include "modul/c45.php";
}

// Modul Lain-Lain
elseif ($_GET[module]=='lain-lain'){
    include "modul/lain-lain.php";
}

// Modul Penentu Keputusan
elseif ($_GET[module]=='penentu_keputusan'){
    include "modul/penentu_keputusan.php";
}

// Modul Lihat Nilai
elseif ($_GET[module]=='lihat_nilai'){
    include "modul/lihat_nilai.php";
}

else{
    echo "<p><b>MENU BELUM ADA</b></p>";
}
?>