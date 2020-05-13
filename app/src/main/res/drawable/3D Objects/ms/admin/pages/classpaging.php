<?php
class Paging
{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas,$halaman)
{
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas)
{
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
function navHalaman($halaman_aktif, $jmlhalaman, $file,$halaman)
{

//$link_halaman = "";
$link_halaman = ($halaman > 3 ? " ... " : " ");

// Link First dan Previous
if ($halaman_aktif > 1)
{
$link_halaman .= " <a href='".$file."&halaman=1'>&laquo; First</a> | ";
}

if (($halaman_aktif-1) > 0)
{
$previous = $halaman_aktif-1;
$link_halaman .= "<a href='".$file."&halaman=".$previous."'>&lsaquo; Previous</a> | ";
}

// Angka tengah
$link_halaman .= ($halaman_aktif > 3 ? " ... " : " ");
for($i=$halaman_aktif-2;$i<$halaman_aktif;$i++)
{
  if ($i < 1) 
      continue;
  $link_halaman .= "<a href='".$file."&halaman=".$i."'>$i</a> ";
}

$link_halaman .= "&nbsp;<b style='color: #FF0000; font-size: 11pt;'>$halaman_aktif</b>&nbsp;";

for($i=$halaman_aktif+1;$i<($halaman_aktif+3);$i++)
{
  if ($i > $jmlhalaman) 
      break;
  $link_halaman .= "<a href='".$file."&halaman=".$i."'>$i</a> ";
}

if($jmlhalaman-$halaman_aktif<3){}else{
$link_halaman .= ($halaman+2<$jmlhalaman ? " ...  <a href='".$file."&halaman=".$jmlhalaman."'>$jmlhalaman</a> " : " ");
}
// Akhir angka

/*
// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++)
{
if ($i == $halaman_aktif)
{
$link_halaman .= "<b>$i</b> | ";
}
else
{
$link_halaman .= "<a href=$file?halaman=$i>$i</a> | ";
}
$link_halaman .= " ";
}*/

// Link Next dan Last
if ($halaman_aktif < $jmlhalaman)
{
$next=$halaman_aktif+1;
$link_halaman .= " <a href='".$file."&halaman=".$next."'>Next &rsaquo;</a> ";
}

if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0))
{
$link_halaman .= " | <a href='".$file."&halaman=".$jmlhalaman."'>Last &raquo;</a> ";
}
return $link_halaman;
}
}
?>
