<?php
echo "
<form method=POST action='./aksi.php?module=data_mahasiswa&act=input'>
	<table>
        <tr>
        <td colspan=2><b><center>Input Data Mahasiswa</center></b></td>
        </tr>";

        include "form_mahasiswa.html";

        echo "<tr>
        <td><b>Class<b></td>        
        <td>: 
            <select name='class' type='text'>
            <option value='Tidak'>Tidak</option>
            <option value='Ya'>Ya</option>
            </select>
        </td>
        </tr>

		<tr>
        <td colspan=2>
		<input type=submit value=Input>
		</td>
        </tr>
    </table>
</form>";
?>