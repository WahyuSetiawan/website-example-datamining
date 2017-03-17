<html>
<head>
    <title>.:Data Keputusan:.</title>
    <style type="text/css">
    th.data
        {
        width : 130px;
        }
    </style>
    <link href="adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2 align="center">Data Keputusan</h2>
    <table bgcolor="#00CCFF" border="1" cellspacing="0" cellspading="0">
      <tr>
      <th>No</th>
       <th>tahun</th>
       <th>semester</th>
       <th>jenis kelamin</th>
       <th>agama</th>
       <th>mk prasyarat</th>
       <th>nilai</th>
      <th>Keputusan C4.5<br>ID Rule C4.5</th>
      </tr>

        <?php
        include "../../config/koneksi.php";
        $no=1;
        $sql=mysql_query('SELECT * FROM data_keputusan ORDER BY id');
            
        $warna1 = '#FFFFFF'; 
        $warna2 = '#CCFFFF'; 
        $warna  = $warna1; 

        $no = 1; 
        while ($data=mysql_fetch_array($sql)){
            if($warna == $warna1){ 
            $warna = $warna2; 
            } 
            else { 
            $warna = $warna1; 
            } 
            echo"<tr bgcolor='$warna' class='data'>
              <td>$no</td>
               <td>$data[nim]</td>
                   <td>$data[tahun]</td>
                   <td>$data[semester]</td>
                   <td>$data[jenis_kelamin]</td>
                   <td>$data[agama]</td>
                   <td>$data[mk_prasyarat]</td>
                   <td>$data[nilai]</td>
                   <td>
                  ";
                  if ($data['keputusan_c45'] == 'Ya') {
                      echo "<font color=green><b>$data[keputusan_c45]</b></font>";
                  } elseif ($data['keputusan_c45'] == 'Tidak') {
                      echo "<font color=red><b>$data[keputusan_c45]</b></font>";
                  } else {
                      echo "<b>$data[keputusan_c45]</b>";
                  }
            echo "<br><b>$data[id_rule_c45]</b></td>              </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
