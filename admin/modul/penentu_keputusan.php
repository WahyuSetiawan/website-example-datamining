<?php
echo "<h2>Penentu Keputusan</h2>";

echo "<form method=POST action=''>
	<table>
        <tr>
        <td colspan=4><b><center>Tampilkan Data</center></b></td>
        </tr>
		
		<tr>
		<td>Tahun</td>        
		<td>: 
			<select name='tahun' type='text'>
			<option value='2011'>2011</option>
			<option value='2012'>2012</option>
			</select>
		</td>
		<td>Semester</td>        
		<td>: 
			<select name='semester' type='text'>
			<option value='Ganjil'>Ganjil</option>
			<option value='Genap'>Genap</option>
			</select>
		</td>
		</tr>
		<tr>
        <td colspan=4>
			<input type=submit name=submit value=Tampilkan>
		</td>
        </tr>
	</table>
</form>";
if (isset($_POST['submit'])) {
	echo "<table bgcolor='#00CCFF' border='1' cellspacing='0' cellspading='0'>
			<tr>
				<th>No</th>
				<th>nilai</th>
				<th>mk prasyarat</th>
				<th>jumlah</th>
				<th>Opsi</th>
			</tr>";

	mysql_query("TRUNCATE nilai_temp");
    $sql=mysql_query("SELECT * FROM data_mahasiswa where tahun = '$_POST[tahun]' AND semester = '$_POST[semester]'");
    $warna1 = '#FFFFFF';
          $warna2 = '#CCFFFF';
          $warna  = $warna1; 
    while ($data=mysql_fetch_array($sql)){
    $sql2=mysql_query("SELECT count(*) as banyak FROM data_mahasiswa where tahun = '$data[tahun]' AND semester = '$data[semester]' AND nilai = '$data[nilai]' AND mk_prasyarat = '$data[mk_prasyarat]' ORDER BY id");
    $data2=mysql_fetch_array($sql2);
		mysql_query("INSERT INTO nilai_temp VALUES ('', '$data[nilai]', '$data[mk_prasyarat]', '$data2[banyak]')");
    }
	$no = 1;
    $sql3=mysql_query("SELECT distinct nilai, mk_prasyarat, jumlah FROM nilai_temp ORDER BY nilai");
    while ($data3=mysql_fetch_array($sql3)) {
        if($warna == $warna1){ 
            $warna = $warna2; 
        } else { 
            $warna = $warna1; 
        } 
        echo "<tr bgcolor='$warna'>
               <td>$no</td>
               <td>$data3[nilai]</td>
               <td>$data3[mk_prasyarat]</td>
               <td>$data3[jumlah]</td>
          <td>
            <a href='media.php?module=lihat_nilai&tahun=$_POST[tahun]&semester=$_POST[semester]&nilai=$data3[nilai]&mk_prasyarat=$data3[mk_prasyarat]'>Lihat</a>
          </td>
              </tr>";
	    $no++;
	}
    
    echo"</table>";
}

?>