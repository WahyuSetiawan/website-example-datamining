<?php
error_reporting(0);
?>
<html>
<head>
    <title>SPK Penentuan Kelayakan Pengambilan MK Prasyarat menggunakan Pohon Keputusan C4.5</title>
    <link  href="icon.png" rel="shortcut icon" type="image/png" />
    <link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="header">
        <br>
        <div class='menupic'>
            <div class='menuhorisontal'>
                <ul>
                    <li><a href=?module=home>&#187; Home</a></li>
                    <li><a href=?module=data_mahasiswa>&#187; Data Mahasiswa</a></li>
                    <li><a href=?module=c45>&#187; C45</a></li>
                    <li><a href=?module=penentu_keputusan>&#187; Penentu Keputusan</a></li>
                    <li><a href=?module=lain-lain>&#187; Lain-lain</a></li>
                </ul>
            </div>
        </div>

        <div id="content">
            <?php include "content.php"; ?>
        </div>
        
        <div id="footer">
            <p>Copyright&copy; 2014 by:<br />
            <b>Ilham Alfiansyah</b></p>
        </div>
    </div>
</body>
</html>
<?php
// }
?>