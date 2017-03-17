<?php
echo "<h2>Data Mahasiswa</h2>";
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
			
		</tr>";

$warna1 = '#FFFFFF';
$warna2 = '#CCFFFF';
$warna  = $warna1; 
$query = mysql_query("SELECT * FROM data_mahasiswa WHERE tahun = '$_GET[tahun]' AND semester = '$_GET[semester]' AND nilai = '$_GET[nilai]' AND mk_prasyarat = '$_GET[mk_prasyarat]'");
while ($data = mysql_fetch_array($query)) {
	$no = 1;
        if($warna == $warna1){ 
            $warna = $warna2; 
        } else { 
            $warna = $warna1; 
        } 
        echo "<tr bgcolor='$warna'>
               <td>$no</td>
               <td>$data[nim]</td>
               <td>$data[tahun]</td>
               <td>$data[semester]</td>
               <td>$data[jenis_kelamin]</td>
               <td>$data[agama]</td>
               <td>$data[mk_prasyarat]</td>
               <td>$data[nilai]</td>
			   
              </tr>";
	    $no++;
}
echo"</table>
<p><a href='http://mkprasyarat.orgfree.com/admin/media.php?module=penentu_keputusan'>Kembali</a></p>";

?>