<?php
function deleteAllDb()
{
    mysql_query("TRUNCATE atribut");
    mysql_query("TRUNCATE data_mahasiswa");
    mysql_query("TRUNCATE data_keputusan");
    
    mysql_query("TRUNCATE mining_c45");
    mysql_query("TRUNCATE pohon_keputusan_c45");
    mysql_query("TRUNCATE rule_c45");

    mysql_query("TRUNCATE rule_penentu_keputusan");
    mysql_query("TRUNCATE data_penentu_keputusan");
}

// session_start();
include "../config/koneksi.php";
include "../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// hapus data Mahasiswa per item
if ($module=='data_mahasiswa' AND $act=='hapus_data_mahasiswa'){
    mysql_query("DELETE FROM data_mahasiswa WHERE id='$_GET[id]'");
    echo "<script>alert('Data berhasil dihapus!'); document.location.href='media.php?module=data_mahasiswa';</script>\n";
}

// hapus semua data Mahasiswa
elseif ($module=='data_mahasiswa' AND $act=='hapus_semua_data_mahasiswa'){
	mysql_query("TRUNCATE `data_mahasiswa`");
    deleteAllDb();
    echo "<script>alert('Data berhasil dihapus!'); document.location.href='media.php?module=data_mahasiswa';</script>\n";
}

// Input Data Mahasiswa
elseif ($module=='data_mahasiswa' AND $act=='input'){
    mysql_query("INSERT INTO data_mahasiswa VALUES('',
        '$_POST[nim]',
        '$_POST[tahun]',
        '$_POST[semester]',
        '$_POST[jenis_kelamin]',
        '$_POST[agama]',
        '$_POST[mk_prasyarat]',
        '$_POST[nilai]',
        '$_POST[class]'
        )");
    echo "<script>alert('Data berhasil diinput!'); document.location.href='media.php?module=data_mahasiswa';</script>\n";
}

// Update Data Mahasiswa
elseif ($module=='data_mahasiswa' AND $act=='update_data_mahasiswa'){
	mysql_query("UPDATE data_mahasiswa SET 
        nim = '$_POST[nim]',
        tahun = '$_POST[tahun]',
        semester = '$_POST[semester]',
        jenis_kelamin = '$_POST[jenis_kelamin]',
        agama = '$_POST[agama]',
        mk_prasyarat = '$_POST[mk_prasyarat]',
        nilai = '$_POST[nilai]',
        class = '$_POST[class]'
        WHERE id      = '$_POST[id]'");
    echo "<script>alert('Data berhasil diupdate!'); document.location.href='media.php?module=data_mahasiswa';</script>\n";
}

// Hapus Semua Data Pohon Keputusan C45
elseif ($module=='c45' AND $act=='hapus_pohon_keputusan'){
	mysql_query("TRUNCATE `pohon_keputusan_c45`");
	mysql_query("TRUNCATE `rule_c45`");
    mysql_query("DELETE FROM rule_penentu_keputusan where pohon = 'C45'");
    header('location:media.php?module=c45');
}

// Hapus Semua Data Penentu Keputusan
elseif ($module=='penentu_keputusan' AND $act=='delete_data_penentu_keputusan'){
	mysql_query("TRUNCATE `data_keputusan`");
    header('location:media.php?module=penentu_keputusan');
}

// Hapus Semua Data Penentu Keputusan per Item
if ($module=='penentu_keputusan' AND $act=='hapus'){
  mysql_query("DELETE FROM data_keputusan WHERE id='$_GET[id]'");
  header('location:media.php?module='.$module);
}

// Hapus Semua Data Kinerja
elseif ($module=='kinerja' AND $act=='hapus_data_kinerja'){
	mysql_query("TRUNCATE `data_keputusan_kinerja`");
    header('location:media.php?module=kinerja');
}

// Hapus Seluruh Database
elseif ($module=='lain-lain' AND $act=='delete_all_db'){
    deleteAllDb();
    header('location:media.php?module=lain-lain');
}
