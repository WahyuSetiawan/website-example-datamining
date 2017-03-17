<?php
// include "../../../config/koneksi.php";
populateDb(); 
miningC45(null, null);
updateKeputusanUnknown();
generateRuleFinalPrePruning();
insertRuleC45PrePruning();

//---------- KUMPULAN FUNGSI YANG AKAN DILAKUKAN DALAM PROSES MINING ----------
function miningC45($atribut, $nilai_atribut)
{
    perhitunganC45($atribut, $nilai_atribut);
    insertAtributPohonKeputusan($atribut, $nilai_atribut);
    getInfGainMax($atribut, $nilai_atribut);
}

//#1# Hapus semua DB dan insert default atribut dan nilai atribut
function populateAtribut() 
{
    mysql_query("TRUNCATE atribut");
    mysql_query("insert into `atribut` values
                ('', 'total', 'total'),
                ('', 'jenis_kelamin', 'L'),
                ('', 'jenis_kelamin', 'P'),
                ('', 'tahun', '2011'),
                ('', 'tahun', '2012'),
                ('', 'semester', 'Ganjil'),
                ('', 'semester', 'Genap'),
                ('', 'agama', 'Islam'),
                ('', 'agama', 'Budha'),
                ('', 'agama', 'Katolik'),
                ('', 'agama', 'Protestan'),
                ('', 'mk_prasyarat', 'E-Commerce'),
                ('', 'mk_prasyarat', 'Jarkom'),
                ('', 'mk_prasyarat', 'Jarkom II'),
                ('', 'mk_prasyarat', 'Metopen'),
                ('', 'mk_prasyarat', 'MML'),
                ('', 'mk_prasyarat', 'Multimedia'),
                ('', 'mk_prasyarat', 'PBD'),
                ('', 'mk_prasyarat', 'PW'),
                ('', 'mk_prasyarat', 'SBD'),
                ('', 'nilai', 'A'),
                ('', 'nilai', 'B'),
                ('', 'nilai', 'C'),
                ('', 'nilai', 'D'),
                ('', 'nilai', 'E')
                ");
}

function populateDb() 
{
    //#1# Hapus semua DB dan insert default atribut dan nilai atribut
    mysql_query("TRUNCATE rule_penentu_keputusan");
    mysql_query("TRUNCATE pohon_keputusan_c45");
    mysql_query("TRUNCATE rule_c45");
    mysql_query("TRUNCATE mining_c45");
    populateAtribut();
}

// ================ FUNGSI PERHITUNGAN C45 =================
function perhitunganC45($atribut, $nilai_atribut) 
{
    if (empty($atribut) AND empty($nilai_atribut)) {
//#2# Jika atribut yg diinputkan kosong, maka lakukan perhitungan awal
        $kondisiAtribut = ""; // set kondisi atribut kosong
    } else if (!empty($atribut) AND !empty($nilai_atribut)) { 
        // jika atribut tdk kosong, maka select kondisi atribut dari DB
        $sqlKondisiAtribut = mysql_query("SELECT kondisi_atribut FROM pohon_keputusan_c45 WHERE atribut = '$atribut' AND nilai_atribut = '$nilai_atribut' order by id DESC LIMIT 1");
        $rowKondisiAtribut = mysql_fetch_array($sqlKondisiAtribut);
        $kondisiAtribut = str_replace("~", "'", $rowKondisiAtribut['kondisi_atribut']); // replace string ~ menjadi '
    } 
    
    // ambil seluruh atribut
    $sqlAtribut = mysql_query("SELECT distinct atribut FROM atribut");
    while($rowGetAtribut = mysql_fetch_array($sqlAtribut)) {
        $getAtribut = $rowGetAtribut['atribut'];
        if ($getAtribut === 'total') { 
//#3# Jika atribut = total, maka hitung jumlah kasus total, jumlah kasus Ya dan jumlah kasus Tidak
            // hitung jumlah kasus total
            $sqlJumlahKasusTotal = mysql_query("SELECT COUNT(*) as jumlah_total FROM data_mahasiswa WHERE class is not null $kondisiAtribut");
            $rowJumlahKasusTotal = mysql_fetch_array($sqlJumlahKasusTotal);
            $getJumlahKasusTotal = $rowJumlahKasusTotal['jumlah_total'];

            // hitung jumlah kasus Ya
            $sqlJumlahKasusYa = mysql_query("SELECT COUNT(*) as jumlah_ya FROM data_mahasiswa WHERE class = 'Ya' AND class is not null $kondisiAtribut");
            $rowJumlahKasusYa = mysql_fetch_array($sqlJumlahKasusYa);
            $getJumlahKasusYa = $rowJumlahKasusYa['jumlah_ya'];

            // hitung jumlah kasus Tidak
            $sqlJumlahKasusTidak = mysql_query("SELECT COUNT(*) as jumlah_tidak FROM data_mahasiswa WHERE class = 'Tidak' AND class is not null $kondisiAtribut");
            $rowJumlahKasusTidak = mysql_fetch_array($sqlJumlahKasusTidak);
            $getJumlahKasusTidak = $rowJumlahKasusTidak['jumlah_tidak'];

//#4# Insert jumlah kasus total, jumlah kasus Ya dan jumlah kasus Tidak ke DB
            // insert ke database mining_c45
            mysql_query("INSERT INTO mining_c45 VALUES ('', 'Total', 'Total', '$getJumlahKasusTotal', '$getJumlahKasusTidak', '$getJumlahKasusYa', '', '', '')");

        } else {
//#5# Jika atribut != total (atribut lainnya), maka hitung jumlah kasus total, jumlah kasus Ya dan jumlah kasus Tidak masing2 atribut
            // ambil nilai atribut
            $sqlNilaiAtribut = mysql_query("SELECT nilai_atribut FROM atribut WHERE atribut = '$getAtribut' ORDER BY id");
            while($rowNilaiAtribut = mysql_fetch_array($sqlNilaiAtribut)) {
                $getNilaiAtribut = $rowNilaiAtribut['nilai_atribut'];

                // set kondisi dimana nilai_atribut = berdasakan masing2 atribut dan status data = data training
                $kondisi = "$getAtribut = '$getNilaiAtribut' AND class is not null $kondisiAtribut";

                // hitung jumlah kasus per atribut
                $sqlJumlahKasusTotalAtribut = mysql_query("SELECT COUNT(*) as jumlah_total FROM data_mahasiswa WHERE $kondisi");
                $rowJumlahKasusTotalAtribut = mysql_fetch_array($sqlJumlahKasusTotalAtribut);
                $getJumlahKasusTotalAtribut = $rowJumlahKasusTotalAtribut['jumlah_total'];

                // hitung jumlah kasus Ya
                $sqlJumlahKasusYaAtribut = mysql_query("SELECT COUNT(*) as jumlah_ya FROM data_mahasiswa WHERE $kondisi AND class = 'Ya'");
                $rowJumlahKasusYaAtribut = mysql_fetch_array($sqlJumlahKasusYaAtribut);
                $getJumlahKasusYaAtribut = $rowJumlahKasusYaAtribut['jumlah_ya'];

                // hitung jumlah kasus Tidak
                $sqlJumlahKasusTidakAtribut = mysql_query("SELECT COUNT(*) as jumlah_tidak FROM data_mahasiswa WHERE $kondisi AND class = 'Tidak'");
                $rowJumlahKasusTidakAtribut = mysql_fetch_array($sqlJumlahKasusTidakAtribut);
                $getJumlahKasusTidakAtribut = $rowJumlahKasusTidakAtribut['jumlah_tidak'];

//#6# Insert jumlah kasus total, jumlah kasus Ya dan jumlah kasus Tidak masing2 atribut ke DB
                // insert ke database mining_c45
                mysql_query("INSERT INTO mining_c45 VALUES ('', '$getAtribut', '$getNilaiAtribut', '$getJumlahKasusTotalAtribut', '$getJumlahKasusTidakAtribut', '$getJumlahKasusYaAtribut', '', '', '')");
                
//#7# Lakukan perhitungan entropy
                // perhitungan entropy
                $sqlEntropy = mysql_query("SELECT id, jml_kasus_total, jml_kasus_ya, jml_kasus_tidak FROM mining_c45");
                while($rowEntropy = mysql_fetch_array($sqlEntropy)) {
                    $getJumlahKasusTotalEntropy = $rowEntropy['jml_kasus_total'];
                    $getJumlahKasusYaEntropy = $rowEntropy['jml_kasus_ya'];
                    $getJumlahKasusTidakEntropy = $rowEntropy['jml_kasus_tidak'];
                    $idEntropy = $rowEntropy['id'];

                    // jika jml kasus = 0 maka entropy = 0
                    if ($getJumlahKasusTotalEntropy == 0 OR $getJumlahKasusYaEntropy == 0 OR $getJumlahKasusTidakEntropy == 0) {
                        $getEntropy = 0;
                    // jika jml kasus Ya = jml kasus Tidak, maka entropy = 1
                    } else if ($getJumlahKasusYaEntropy == $getJumlahKasusTidakEntropy) {
                        $getEntropy = 1;
                    } else { // jika jml kasus != 0, maka hitung rumus entropy:
                        $perbandingan_ya = $getJumlahKasusYaEntropy / $getJumlahKasusTotalEntropy;
                        $perbandingan_tidak = $getJumlahKasusTidakEntropy / $getJumlahKasusTotalEntropy;

                        $rumusEntropy = (-($perbandingan_ya) * log($perbandingan_ya,2)) + (-($perbandingan_tidak) * log($perbandingan_tidak,2));
                        $getEntropy = round($rumusEntropy,4); // 4 angka di belakang koma
                    }

//#8# Update nilai entropy
                    // update nilai entropy
                    mysql_query("UPDATE mining_c45 SET entropy = $getEntropy WHERE id = $idEntropy");
                }
                
//#9# Lakukan perhitungan information gain
                // perhitungan information gain
                // ambil nilai entropy dari total (jumlah kasus total)
                $sqlJumlahKasusTotalInfGain = mysql_query("SELECT jml_kasus_total, entropy FROM mining_c45 WHERE atribut = 'Total'");
                $rowJumlahKasusTotalInfGain = mysql_fetch_array($sqlJumlahKasusTotalInfGain);
                $getJumlahKasusTotalInfGain = $rowJumlahKasusTotalInfGain['jml_kasus_total'];
                // rumus information gain
                $getInfGain = (-(($getJumlahKasusTotalEntropy / $getJumlahKasusTotalInfGain) * ($getEntropy))); 

//#10# Update information gain tiap nilai atribut (temporary)
                // update inf_gain_temp (utk mencari nilai masing2 atribut)
                mysql_query("UPDATE mining_c45 SET inf_gain_temp = $getInfGain WHERE id = $idEntropy");
                $getEntropy = $rowJumlahKasusTotalInfGain['entropy'];

                // jumlahkan masing2 inf_gain_temp atribut 
                $sqlAtributInfGain = mysql_query("SELECT SUM(inf_gain_temp) as inf_gain FROM mining_c45 WHERE atribut = '$getAtribut'");
                while ($rowAtributInfGain = mysql_fetch_array($sqlAtributInfGain)) {
                    $getAtributInfGain = $rowAtributInfGain['inf_gain'];

                    // hitung inf gain
                    $getInfGainFix = round(($getEntropy + $getAtributInfGain),4);

//#11# Looping perhitungan information gain, sehingga mendapatkan information gain tiap atribut. Update information gain
                    // update inf_gain (fix)
                    mysql_query("UPDATE mining_c45 SET inf_gain = $getInfGainFix WHERE atribut = '$getAtribut'");
                }
                

            }
            

        }
    }
}

//#17# Insert atribut dgn information gain max ke DB pohon keputusan
function insertAtributPohonKeputusan($atribut, $nilai_atribut)
{
    // ambil nilai inf gain tertinggi dimana hanya 1 atribut saja yg dipilih
    $sqlInfGainMaxTemp = mysql_query("SELECT distinct atribut, inf_gain FROM mining_c45 WHERE inf_gain in (SELECT max(inf_gain) FROM `mining_c45`) LIMIT 1");
    $rowInfGainMaxTemp = mysql_fetch_array($sqlInfGainMaxTemp);
    // hanya ambil atribut dimana jumlah kasus totalnya tidak kosong
    if ($rowInfGainMaxTemp['inf_gain'] > 0) {
        // ambil nilai atribut yang memiliki nilai inf gain max
        $sqlInfGainMax = mysql_query("SELECT * FROM mining_c45 WHERE atribut = '$rowInfGainMaxTemp[atribut]'");
        while($rowInfGainMax = mysql_fetch_array($sqlInfGainMax)) {
            if ($rowInfGainMax['jml_kasus_ya'] == 0 AND $rowInfGainMax['jml_kasus_tidak'] == 0) {
                $keputusan = 'Null'; // jika jml_kasus_ya = 0 dan jml_kasus_tidak = 0, maka keputusan Null
            } else if ($rowInfGainMax['jml_kasus_ya'] !== 0 AND $rowInfGainMax['jml_kasus_tidak'] == 0) {
                $keputusan = 'Ya'; // jika jml_kasus_ya != 0 dan jml_kasus_tidak = 0, maka keputusan Ya
            } else if ($rowInfGainMax['jml_kasus_ya'] == 0 AND $rowInfGainMax['jml_kasus_tidak'] !== 0) {
                $keputusan = 'Tidak'; // jika jml_kasus_ya = 0 dan jml_kasus_tidak != 0, maka keputusan Tidak
            } else {
                $keputusan = '?'; // jika jml_kasus_ya != 0 dan jml_kasus_tidak != 0, maka keputusan ?
            }
            
            if (empty($atribut) AND empty($nilai_atribut)) {
//#18# Jika atribut yang diinput kosong (atribut awal) maka insert ke pohon keputusan id_parent = 0
                // set kondisi atribut = AND atribut = nilai atribut
                $kondisiAtribut = "AND $rowInfGainMax[atribut] = ~$rowInfGainMax[nilai_atribut]~";
                // insert ke tabel pohon keputusan
                mysql_query("INSERT INTO pohon_keputusan_c45 VALUES ('', '$rowInfGainMax[atribut]', '$rowInfGainMax[nilai_atribut]', 0, '$rowInfGainMax[jml_kasus_tidak]', '$rowInfGainMax[jml_kasus_ya]', '$keputusan', 'Belum', '$kondisiAtribut', 'Belum')");
            }

//#19# Jika atribut yang diinput tidak kosong maka insert ke pohon keputusan dimana id_parent diambil dari tabel pohon keputusan sebelumnya (where atribut = atribut yang diinput)
            else if (!empty($atribut) AND !empty($nilai_atribut)) {
                $sqlIdParent = mysql_query("SELECT id, atribut, nilai_atribut, jml_kasus_ya, jml_kasus_tidak FROM pohon_keputusan_c45 WHERE atribut = '$atribut' AND nilai_atribut = '$nilai_atribut' order by id DESC LIMIT 1");
                $rowIdParent = mysql_fetch_array($sqlIdParent);
                    // insert ke tabel pohon keputusan
                    mysql_query("INSERT INTO pohon_keputusan_c45 VALUES ('', '$rowInfGainMax[atribut]', '$rowInfGainMax[nilai_atribut]', $rowIdParent[id], '$rowInfGainMax[jml_kasus_tidak]', '$rowInfGainMax[jml_kasus_ya]', '$keputusan', 'Belum', '', 'Belum')");
                    
                    //#PRE PRUNING#
                    // hitung Pessimistic error rate parent dan child 
                    $perhitunganParentPrePruning = loopingPerhitunganPrePruning($rowIdParent['jml_kasus_ya'], $rowIdParent['jml_kasus_tidak']);
                    $perhitunganChildPrePruning = loopingPerhitunganPrePruning($rowInfGainMax['jml_kasus_ya'], $rowInfGainMax['jml_kasus_tidak']);
                    
                    // hitung average Pessimistic error rate child 
                    $perhitunganPessimisticChild = (($rowInfGainMax['jml_kasus_ya'] + $rowInfGainMax['jml_kasus_tidak']) / ($rowIdParent['jml_kasus_ya'] + $rowIdParent['jml_kasus_tidak'])) * $perhitunganChildPrePruning;
                    // Increment average Pessimistic error rate child
                    $perhitunganPessimisticChildIncrement += $perhitunganPessimisticChild;
                    $perhitunganPessimisticChildIncrement = round($perhitunganPessimisticChildIncrement, 4);
                    
                    // jika error rate pada child lebih besar dari error rate parent
                    if ($perhitunganPessimisticChildIncrement >= $perhitunganParentPrePruning) {
                        // hapus child (child tidak diinginkan)
                        mysql_query("DELETE FROM pohon_keputusan_c45 WHERE id_parent = $rowIdParent[id]");
                        
                        // jika jml kasus Ya lbh besar, maka keputusan == Ya
                        if ($rowIdParent['jml_kasus_ya'] > $rowIdParent['jml_kasus_tidak']) {
                            $keputusanPrePruning = 'Ya';
                        // jika jml tdk kasus Ya lbh besar, maka keputusan == Tidak
                        } else if ($rowIdParent['jml_kasus_ya'] < $rowIdParent['jml_kasus_tidak']) {
                            $keputusanPrePruning = 'Tidak';
                        } 
                        // update keputusan parent
                        mysql_query("UPDATE pohon_keputusan_c45 SET keputusan = '$keputusanPrePruning' where id = $rowIdParent[id]");
                    }
                
            }
        }
    }
    loopingKondisiAtribut();
}

//#20# Lakukan looping kondisi atribut untuk diproses pada fungsi perhitunganC45()
function loopingKondisiAtribut() 
{
    // ambil semua id dan kondisi atribut
    $sqlLoopingKondisi = mysql_query("SELECT id, kondisi_atribut FROM pohon_keputusan_c45");
    while($rowLoopingKondisi = mysql_fetch_array($sqlLoopingKondisi)) {
        // select semua data dimana id_parent = id awal
        $sqlUpdateKondisi = mysql_query("SELECT * FROM pohon_keputusan_c45 WHERE id_parent = $rowLoopingKondisi[id] AND looping_kondisi = 'Belum'");
        while($rowUpdateKondisi = mysql_fetch_array($sqlUpdateKondisi)) {
            // set kondisi: kondisi sebelumnya yg diselect berdasarkan id_parent ditambah 'AND atribut = nilai atribut'
            $kondisiAtribut = "$rowLoopingKondisi[kondisi_atribut] AND $rowUpdateKondisi[atribut] = ~$rowUpdateKondisi[nilai_atribut]~";
            // update kondisi atribut
            mysql_query("UPDATE pohon_keputusan_c45 SET kondisi_atribut = '$kondisiAtribut', looping_kondisi = 'Sudah' WHERE id = $rowUpdateKondisi[id]");
        }
    }
}

//#22# Ambil information gain max untuk diproses pada fungsi loopingMiningC45()
function getInfGainMax($atribut, $nilai_atribut)
{
    // select inf gain max
    $sqlInfGainMaxAtribut = mysql_query("SELECT distinct atribut FROM mining_c45 WHERE inf_gain in (SELECT max(inf_gain) FROM `mining_c45`) LIMIT 1");
    while($rowInfGainMaxAtribut = mysql_fetch_array($sqlInfGainMaxAtribut)) {
        $inf_gain_max_atribut = "$rowInfGainMaxAtribut[atribut]";
        if (empty($atribut) AND empty($nilai_atribut)) {
            // jika atribut kosong, proses atribut dgn inf gain max pada fungsi loopingMiningC45()
            loopingMiningC45($inf_gain_max_atribut);
        } else if (!empty($atribut) AND !empty($nilai_atribut)) {
            // jika atribut tdk kosong, maka update diproses = sudah pada tabel pohon_keputusan_c45
            mysql_query("UPDATE pohon_keputusan_c45 SET diproses = 'Sudah' WHERE atribut = '$atribut' AND nilai_atribut = '$nilai_atribut'");
            // proses atribut dgn inf gain max pada fungsi loopingMiningC45()
            loopingMiningC45($inf_gain_max_atribut);
        }
    }
}

//#23# Looping proses mining dimana atribut dgn information gain max yang akan diproses pada fungsi miningC45()
function loopingMiningC45($inf_gain_max_atribut) 
{
    $sqlBelumAdaKeputusanLagi = mysql_query("SELECT * FROM pohon_keputusan_c45 WHERE keputusan = '?' and diproses = 'Belum' AND atribut = '$inf_gain_max_atribut'");
    while($rowBelumAdaKeputusanLagi = mysql_fetch_array($sqlBelumAdaKeputusanLagi)) {
        if ($rowBelumAdaKeputusanLagi['id_parent'] == 0) {
            populateAtribut();
        }
        $atribut = "$rowBelumAdaKeputusanLagi[atribut]";
        $nilai_atribut = "$rowBelumAdaKeputusanLagi[nilai_atribut]";
        $kondisiAtribut = "AND $atribut = \'$nilai_atribut\'";
        mysql_query("TRUNCATE mining_c45");
        mysql_query("DELETE FROM atribut WHERE atribut = '$inf_gain_max_atribut'");
        miningC45($atribut, $nilai_atribut);
    }
}

// rumus menghitung Pessimistic error rate
function perhitunganPrePruning($r, $z, $n)
{
    $rumus = ($r + (($z * $z) / (2 * $n)) + ($z * (sqrt(($r / $n) - (($r * $r) / $n) + (($z * $z) / (4 * ($n * $n))))))) / (1 + (($z * $z) / $n));
    $rumus = round($rumus, 4);
    return $rumus;
}

// looping perhitungan Pessimistic error rate
function loopingPerhitunganPrePruning($positif, $negatif)
{
    $confidenceLevel = $_POST['confidence'];

    $z = (1 / 0.5775) * ($confidenceLevel / 100); // z = batas kepercayaan (confidence treshold)
    $z = round($z, 4);
    $n = $positif + $negatif; // n = total jml kasus
    $n = round($n, 4);
    // r = perbandingan child thd parent
    if ($positif < $negatif) {
        $r = $positif / ($n);
        $r = round($r, 4);
        return perhitunganPrePruning($r, $z, $n);
    } elseif ($positif > $negatif) {
        $r = $negatif / ($n);
        $r = round($r, 4);
        return perhitunganPrePruning($r, $z, $n);
    } elseif ($positif == $negatif) {
        $r = $negatif / ($n);
        $r = round($r, 4);
        return perhitunganPrePruning($r, $z, $n);
    }
}

// update keputusan jika ada keputusan yg Null dan ?
function updateKeputusanUnknown()
{
    $sqlReplaceNull = mysql_query("SELECT id, id_parent FROM pohon_keputusan_c45 WHERE keputusan = 'Null'");
    while($rowReplaceNull = mysql_fetch_array($sqlReplaceNull)) {
        $sqlReplaceNullIdParent = mysql_query("SELECT jml_kasus_ya, jml_kasus_tidak, keputusan FROM pohon_keputusan_c45 WHERE id = $rowReplaceNull[id_parent]");
        $rowReplaceNullIdParent = mysql_fetch_array($sqlReplaceNullIdParent);
        if ($rowReplaceNullIdParent['jml_kasus_ya'] > $rowReplaceNullIdParent['jml_kasus_tidak']) {
            $keputusanNull = 'Ya'; // jika jml_kasus_ya != 0 dan jml_kasus_tidak = 0, maka keputusan Ya
        } else if ($rowReplaceNullIdParent['jml_kasus_ya'] < $rowReplaceNullIdParent['jml_kasus_tidak']) {
            $keputusanNull = 'Tidak'; // jika jml_kasus_ya = 0 dan jml_kasus_tidak != 0, maka keputusan Tidak
        }
        mysql_query("UPDATE pohon_keputusan_c45 SET keputusan = '$keputusanNull' WHERE id = $rowReplaceNull[id]");
    }

    $sqlReplaceUnknown = mysql_query("SELECT id, id_parent FROM pohon_keputusan_c45 WHERE keputusan = '?' and id not in (select id_parent from pohon_keputusan_c45)");
    while($rowReplaceUnknown = mysql_fetch_array($sqlReplaceUnknown)) {
        $sqlReplaceUnknownIdParent = mysql_query("SELECT jml_kasus_tidak, jml_kasus_ya FROM pohon_keputusan_c45 WHERE id = $rowReplaceUnknown[id_parent]");
        $rowReplaceUnknownIdParent = mysql_fetch_array($sqlReplaceUnknownIdParent);
        if ($rowReplaceUnknownIdParent['jml_kasus_ya'] > $rowReplaceUnknownIdParent['jml_kasus_tidak']) {
            $keputusanUnknown = 'Ya'; // jika jml_kasus_ya != 0 dan jml_kasus_tidak = 0, maka keputusan Ya
        } else if ($rowReplaceUnknownIdParent['jml_kasus_ya'] < $rowReplaceUnknownIdParent['jml_kasus_tidak']) {
            $keputusanUnknown = 'Tidak'; // jika jml_kasus_ya = 0 dan jml_kasus_tidak != 0, maka keputusan Tidak
        }
        mysql_query("UPDATE pohon_keputusan_c45 SET keputusan = '$keputusanUnknown' WHERE id = $rowReplaceUnknown[id]");
    }
}

function generateRuleAwal($idparent, $spasi)
{
    // ambil data pohon keputusan
    $sqlGetIdParent = mysql_query("select * from pohon_keputusan_c45 where id_parent='$idparent'");
    while($rowGetIdParent = mysql_fetch_array($sqlGetIdParent)){
        if (!empty($rowGetIdParent)) {
            // ambil data pohon keputusan dimana id = idparent
            $sqlGetId = mysql_query("select * from pohon_keputusan_c45 where id='$rowGetIdParent[id_parent]'");
            $rowGetId = mysql_fetch_array($sqlGetId);
            // jika atribut dan nilai atribut masih kosong
            if (empty($rowGetId['atribut']) AND empty($rowGetId['nilai_atribut'])){
                // insert pada db rule_c45
                mysql_query("insert into rule_c45 values ('', '$rowGetIdParent[id_parent]', '$rowGetIdParent[atribut] == $rowGetIdParent[nilai_atribut]', '$rowGetIdParent[keputusan]')");
            } else {
                // insert pada db rule_c45
                mysql_query("insert into rule_c45 values ('', '$rowGetIdParent[id_parent]', '$rowGetId[atribut] == $rowGetId[nilai_atribut] AND $rowGetIdParent[atribut] == $rowGetIdParent[nilai_atribut]', '$rowGetIdParent[keputusan]')");
            }
            // looping dirinya sendiri
            generateRuleAwal($rowGetIdParent['id'], $spasi + 1);
        }
    }
}

function generateRuleLooping()
{
    // ambil data rule
    $sqlGetDataRule = mysql_query("select * from rule_c45 order by id");
    while($rowGetDataRule=mysql_fetch_array($sqlGetDataRule)){
        if (!empty($rowGetDataRule)) {
            // ambil idparent rule dimana id = idparent
            $sqlGetIdParentUpdateRule = mysql_query("select id_parent from pohon_keputusan_c45 where id = '$rowGetDataRule[id_parent]'");
            $rowGetIdParentUpdateRule=mysql_fetch_array($sqlGetIdParentUpdateRule);
            
            $sqlGetIdUpdateRule = mysql_query("select * from pohon_keputusan_c45 where id = '$rowGetIdParentUpdateRule[id_parent]'");
            while($rowGetIdUpdateRule=mysql_fetch_array($sqlGetIdUpdateRule)){
                // bentuk rule
                $rule = "$rowGetIdUpdateRule[atribut] == $rowGetIdUpdateRule[nilai_atribut] AND $rowGetDataRule[rule]";
                // update rule
                mysql_query("update rule_c45 set rule = '$rule', id_parent = '$rowGetIdParentUpdateRule[id_parent]' where id = '$rowGetDataRule[id]'");
            }
            
            // ambil data pohon dimana idparent = 0 (root)
            $sqlGetDataPohonKeputusan = mysql_query("select * from pohon_keputusan_c45 where id_parent = 0");
            while($rowGetDataPohonKeputusan=mysql_fetch_array($sqlGetDataPohonKeputusan)){
                // jika idparent rule == id pohon
                if ($rowGetDataRule['id_parent'] == $rowGetDataPohonKeputusan['id']){
                    // update rule set id = id rule
                    mysql_query("update rule_c45 set id_parent = 0 where id = '$rowGetDataRule[id]'");
                }
            }
        }
    }
}

function generateRuleFinalPrePruning()
{
    // panggil fungsi generateRuleAwal()
    generateRuleAwal("0", 0);
    
    // ambil data rule
    $sqlUpdateRule = mysql_query("select * from rule_c45 order by id" );
    while($rowUpdateRule=mysql_fetch_array($sqlUpdateRule)){
        if (!empty($rowUpdateRule)) {
            // jika idparent rule == 0
            if ($rowUpdateRule['id_parent'] !== 0){
                // lakukan fungsi generateRuleLooping()
                generateRuleLooping();
                // delete rule dimana keputusan == ?
                mysql_query("delete from rule_c45 where keputusan = '?'");
            }
        }
    }
}

function insertRuleC45PrePruning()
{
    // ambil data pada db rule_c45
    $sqlRuleC45 = mysql_query("SELECT id, rule, keputusan FROM rule_c45");
    while($rowRuleC45 = mysql_fetch_array($sqlRuleC45)) {
        $RuleC45 = "$rowRuleC45[rule]";
        // explode string ' AND ' utk mendapatkan atribut
        $explodeRuleC45 = explode(" AND ", $RuleC45);
        foreach ($explodeRuleC45 as $dataExplodeRuleC45) {
            // explode string ' == ' utk mendapatkan nilai atribut
            $dataFixRuleC45 = explode(" == ", $dataExplodeRuleC45);
            // insert into db
            mysql_query("INSERT INTO rule_penentu_keputusan VALUES('', $rowRuleC45[id], '$dataFixRuleC45[0]', '$dataFixRuleC45[1]', '$rowRuleC45[keputusan]', '', 'C45')");
        }
    }
}