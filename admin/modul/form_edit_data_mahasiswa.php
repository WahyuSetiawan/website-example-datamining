<?php
$query = mysql_query("SELECT * FROM data_mahasiswa WHERE id='$_GET[id]'");
$data = mysql_fetch_array($query);

echo "<form method=POST action=./aksi.php?module=data_mahasiswa&act=update_data_mahasiswa>
      <input type=hidden name=id value=$data[id]>
      <table>
        <tr>
        <td colspan=2><b><center>Edit Data Mahasiswa</center></b></td>
        </tr>

        <tr>
        <td>nim</td>        
        <td>: 
            <input name='nim' value='$data[nim]' type='text'>
        </td>
        </tr>

        <tr>
        <td>Tahun</td>        
        <td>: 
            <select name='tahun' type='text'>
            <option value='$data[tahun]' selected='selected'>$data[tahun]</option>
            <option value='2011'>2011</option>
            <option value='2012'>2012</option>
            </select>
        </td>
        </tr>

        <tr>
        <td>Semester</td>        
        <td>: 
            <select name='semester' type='text'>
            <option value='$data[semester]' selected='selected'>$data[semester]</option>
            <option value='Ganjil'>Ganjil</option>
            <option value='Genap'>Genap</option>
            </select>
        </td>
        </tr>

        <tr>
        <td>Jenis Kelamin</td>        
        <td>: 
            <select name='jenis_kelamin' type='text'>
            <option value='$data[jenis_kelamin]' selected='selected'>$data[jenis_kelamin]</option>
            <option value='L'>L</option>
            <option value='P'>P</option>
            </select>
        </td>
        </tr>

        <tr>
        <td>Agama</td>        
        <td>: 
            <select name='agama' type='text'>
            <option value='$data[agama]' selected='selected'>$data[agama]</option>
            <option value='Islam'>Islam</option>
            <option value='Budha'>Budha</option>
            <option value='Katolik'>Katolik</option>
            <option value='Protestan'>Protestan</option>
            </select>
        </td>
        </tr>

        <tr>
        <td>MK Prasyarat</td>        
        <td>: 
            <select name='mk_prasyarat' type='text'>
            <option value='$data[mk_prasyarat]' selected='selected'>$data[mk_prasyarat]</option>
            <option value='E-Commerce'>E-Commerce</option>
            <option value='Jarkom'>Jarkom</option>
            <option value='Jarkom II'>Jarkom II</option>
            <option value='Metopen'>Metopen</option>
            <option value='MML'>MML</option>
            <option value='Multimedia'>Multimedia</option>
            <option value='PBD'>PBD</option>
            <option value='PW'>PW</option>
            <option value='SBD'>SBD</option>
            </select>
        </td>
        </tr>

        <tr>
        <td>Nilai</td>        
        <td>: 
            <select name='nilai' type='text'>
            <option value='$data[nilai]' selected='selected'>$data[nilai]</option>
            <option value='A'>A</option>
            <option value='B'>B</option>
            <option value='C'>C</option>
            <option value='D'>D</option>
            <option value='E'>E</option>
            </select>
        </td>
        </tr>
        
        <tr>
        <td><b>Class<b></td>        
        <td>: 
            <select name='class' type='text'>
            <option value='$data[class]' selected='selected'>$data[class]</option>
            <option value='Tidak'>Tidak</option>
            <option value='Ya'>Ya</option>
            </select>
        </td>
        </tr>

        <tr>
        <td colspan=2>
        <input type=submit value=Simpan><input type=button value=Batal onclick=self.history.back()>
        </td>
        </tr>
  </table>
  </form>";
?>