<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<?php
switch($_GET[act]){
    default:
        echo "<h2>Data Mahasiswa</h2>";
        include "form_data_mahasiswa.php";
        echo "<form action='' method='post' enctype='multipart/form-data' name='form1' id='form1'>
                  <p>Ambil File .csv : 
                  <input name='csv' type='file' id='csv' />
                  <input type='submit' name='Submit' value='Submit' /></p >
                </form>";
                if ($_FILES[csv][size] > 0) {

                    //get the csv file
                    $file = $_FILES[csv][tmp_name];
                    $handle = fopen($file,"r");
                    
                    //loop through the csv file and insert into database
                    mysql_query("TRUNCATE data_mahasiswa");
                    do {
                        if ($data[0]) {
                            mysql_query("INSERT INTO data_mahasiswa (nim, tahun, semester, jenis_kelamin, agama, mk_prasyarat, nilai, class) VALUES
                                (
                                    '".addslashes($data[0])."',
                                    '".addslashes($data[1])."',
                                    '".addslashes($data[2])."',
                                    '".addslashes($data[3])."',
                                    '".addslashes($data[4])."',
                                    '".addslashes($data[5])."',
                                    '".addslashes($data[6])."',
                                    '".addslashes($data[7])."'
                                )
                            ");
                        }
                    } while ($data = fgetcsv($handle,1000,",","'"));
                    //

                    //redirect
                    echo "<script>alert('Data berhasil diinput!'); document.location.href='media.php?module=data_mahasiswa';</script>\n";

                }
        echo "<p><a href='media.php?module=data_mahasiswa&act=lihat_data'>Lihat Data Input</a></p>";

    break;
    case "lihat_data";
        echo " <p>Opsi: <a href=./aksi.php?module=data_mahasiswa&act=hapus_semua_data_mahasiswa>Hapus Semua Data</a></p>";
        echo "<table bgcolor='#00CCFF' border='1' cellspacing='0' cellspading='0'>
            <tr>
                <th>No</th>
                <th>nim</th>
                <th>tahun</th>
                <th>semester</th>
                <th>jenis kelamin</th>
                <th>agama</th>
                <th>mk prasyarat</th>
                <th>nilai</th>
                <th>Class</th>
                <th>Opsi</th>
           </tr>";

    $sql=mysql_query('SELECT * FROM data_mahasiswa ORDER BY id');
    $warna1 = '#FFFFFF';
    $warna2 = '#CCFFFF'; 
    $warna  = $warna1; 
    $no = 1;
    while ($data=mysql_fetch_array($sql)){
        if($warna == $warna1){ 
            $warna = $warna2; 
        } else { 
            $warna = $warna1; 
        } 
        echo " <tr bgcolor='$warna'>
                   <td>$no</td>
                   <td>$data[nim]</td>
                   <td>$data[tahun]</td>
                   <td>$data[semester]</td>
                   <td>$data[jenis_kelamin]</td>
                   <td>$data[agama]</td>
                   <td>$data[mk_prasyarat]</td>
                   <td>$data[nilai]</td>
                   <td>$data[class]</td>
                   <td><a href=?module=data_mahasiswa&act=edit_data_mahasiswa&id=$data[id]>Edit</a> |
                   <a href=./aksi.php?module=data_mahasiswa&act=hapus_data_mahasiswa&id=$data[id]>Hapus</a>
                   </td>
               </tr>";
    $no++;
    }
    echo"</table>";
    echo "<p><a href=javascript:history.back(-1)>Sebelumnya</a></p>";
    break;
    
    case "edit_data_mahasiswa";
        echo "<h2>Data Mahasiswa &#187; Edit Data Mahasiswa</h2>";
        include "form_edit_data_mahasiswa.php";
    break;
    
}