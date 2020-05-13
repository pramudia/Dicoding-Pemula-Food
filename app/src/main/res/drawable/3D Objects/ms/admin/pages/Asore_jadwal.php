<?php
ini_set("display_errors","Off");
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>
<!-------------------------------------------------------------------------->
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	
	<style type="text/css">
		.atas{
			width:120px;
			float:atas;
		}
		.atas table{
			background:#E0ECFF;
		}
		.atas td{
			background:#eee;
		}
		.bawah{
			float:bawah;
			width:600px;
		}
		.bawah table{
			background:#E0ECFF;
			width:100%;
		}
		.bawah td{
			background:#fafafa;
			text-align:center;
			padding:2px;
		}
		.bawah td{
			background:#E0ECFF;
		}
		.bawah td.drop{
			background:#fafafa;
			width:100px;
		}
		.bawah td.over{
			background:#FBEC88;
		}
		.item{
			text-align:center;
			border:1px solid #499B33;
			background:#fafafa;
			width:100px;
		}
		.assigned{
			border:1px solid #BC2A4D;
		}
		
	</style>
	<script>
		$(function(){
			$('.atas .item').draggable({
				revert:true,
				proxy:'clone'
			});
			$('.bawah td.drop').droppable({
				onDragEnter:function(){
					$(this).addClass('over');
				},
				onDragLeave:function(){
					$(this).removeClass('over');
				},
				onDrop:function(e,source){
					$(this).removeClass('over');
					if ($(source).hasClass('assigned')){
						$(this).append(source);
					} else {
						var c = $(source).clone().addClass('assigned');
						$(this).empty().append(c);
						c.draggable({
							revert:true
						});
					}
				}
			});
		});
        
        
	</script>
        <div class="page-region">
        
        <div class="page-region-content">
                     <?php
/* cek udah login pa blun */
/*
session_is_registered() sebaiknya tidak digunakan (Deprecated Function)
if( !session_is_registered( 'ID' ) || !session_is_registered( 'PASS' ) )
*/
if( !isset($_SESSION['ID']) || !isset($_SESSION['PASS']) ) {
 die( 'Illegal Acces' );
}
?><?php include "koneksi.php"?>
                   </p>
                    
                    <p>
          <div class="bg-color-green fg-color-white padding20">
                        <h3 class="fg-color-white">Generate Jadwal.</h3>
                    </div>
          <div style="height:500px;width:700px;border:solid 4px green;overflow:scroll;overflow-y:scroll;overflow-x:scroll;">
  <p style="width:20000px;">

<!---------------------------------------------------->
<div class="bawah">
 <form name="in_matkul" action="../admin/admin.php?p=g_jadwal" method="POST">
TAHUN AJARAN:<select name ="thnajaran"><?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT thn_ajaran FROM jadwal GROUP BY thn_ajaran";
   					$hasil = mysql_query($query);
   					while ($thnajar = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$thnajar['thn_ajaran']."'>".$thnajar['thn_ajaran']."</option>";
   				}
					?></select>
                   <input type="submit" value="Submit" />

<table>
                    <thead >
                        <tr > 
                            <th colspan="2">Pagi</th>
                            <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (â€œgagalâ€?);
	for ($i=0;$i<$data = mysql_fetch_array($query);$i++){
		$kode = $data['kd_ruang'];
		
    
    ?>
                            <th class="center" colspan="4"><?php echo $data['kd_ruang'] ?></th>
                          
                             <?PHP
$no++;
}
?>
							<th class="center" colspan="4">Tahun Ajaran</th>
                        </tr>
                    </thead>

                    <tbody>
                   
                    <tr >
                      <td>HR</td>
                      <td>JAM</td><?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
                      <td class="drop">MK</td>
                      <td class="drop">SMT</td>
                      <td class="drop">KLS</td>
                      <td class="drop">DSN</td>
                      
                             <?PHP
$no++;
}
?>
                     </tr>
                    <tr >
                    
                            <td rowspan="3">snn</td>
                            <td> 1 </td>
                            <?php
   $thn_ajaran= $_POST['thnajaran'];
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                         <tr >
                            <td> 3 </td> <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'senin' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                            
                        </tr> 
                    <tr >
                            <td rowspan="3">slss</td>
                            <td> 1 </td> <?php
   //SELASA JAM PERTAMA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td><?php
   //SELASA JAM KEDUA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                         <tr >
                            <td> 3 </td>
                           <?php
   //SELASA JAM KETIGA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                        <tr >
                            <td rowspan="3">rb</td>
                            <td> 1 </td><?php
   //RABU JAM PERTAMA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'SELASA' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td><?php
   //RABU JAM KEDUA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                         <tr >
                            <td> 3 </td>
                           <?php
   //RABU JAM KETIGA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'RABU' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                     <tr >
                            <td rowspan="3">kms</td>
                            <td> 1 </td><?php
   //KAMIS JAM PERTAMA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td><?php
   //KAMIS JAM KEDUA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                         <tr >
                            <td> 3 </td>
                           <?php
   //KAMIS JAM KETIGA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'KAMIS' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                        <tr >
                            <td rowspan="3">jmt</td>
                            <td> 1 </td><?php
   //JUMAT JAM PERTAMA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td><?php
   //JUMAT JAM KEDUA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                         <tr >
                            <td> 3 </td>
                           <?php
   //JUMAT JAM KETIGA
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='III' AND waktu = 'pagi' AND hari = 'JUMAT' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                        </tr> 
                     
                        
                        
          </tbody>

                    <tfoot></tfoot>
        </table>
                
        <p>&nbsp;</p>
        <table>
          <thead >
            <tr >
              <th colspan="2">Sore</th>
              <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (&acirc;&euro;&oelig;gagal&acirc;&euro;?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
              <th class="center" colspan="4"><?php echo $data['kd_ruang'] ?></th>
              <?PHP
$no++;
}
?>
              <th class="center" colspan="4">Tahun Ajaran</th>
            </tr>
          </thead>
          <tbody>
            <tr >
              <td>HR</td>
              <td>JAM</td>
              <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (&acirc;&euro;&oelig;gagal&acirc;&euro;?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
              <td class="drop">MK</td>
              <td class="drop">SMT</td>
              <td class="drop">KLS</td>
              <td class="drop">DSN</td>
              <?PHP
$no++;
}
?>
            </tr>
            <tr >
              <td rowspan="2">snn</td>
              <td> 1 </td>
              <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>

							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'senin' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
            </tr>
            
            <tr >
              <td rowspan="2">sls</td>
              <td> 1 </td>
             <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>

							<td class="drop"></td>

                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'selasa' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
            </tr>
                        <tr >
              <td rowspan="2">rb</td>
              <td> 1 </td>
              <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>

							<td class="drop"></td>

                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'rabu' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
            </tr>
            
            <tr >
              <td rowspan="2">kms</td>
              <td> 1 </td>
              <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>

							<td class="drop"></td>

                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'kamis' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
            </tr>
            <tr >
              <td rowspan="2">jmt</td>
              <td> 1 </td>
              <?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='I' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td> 2 </td>
                           <?php
  //jam kedua
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'D3.19' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'D3.20' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'F3.13' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'F3.14' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>

							<td class="drop"></td>

                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap ALGO' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap RPL' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
<?php
   
	$query1 = mysql_query ("SELECT jadwal.kd_matkul, matkul.semester, jadwal.kelas, jadwal.kd_dosen, jadwal.kd_ruang FROM jadwal LEFT JOIN matkul 
ON jadwal.kd_matkul = matkul.kd_matkul WHERE jam ='II' AND waktu = 'sore' AND hari = 'jumat' AND kd_ruang = 'Lap SBC' AND thn_ajaran = '$thn_ajaran' ORDER BY kd_ruang");
   			
	if(mysql_num_rows($query1)>0){
		//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data1 = mysql_fetch_array($query1)){
		 
		
		$kode1 = $data1['kd_ruang'];
	 
		?>			
							<td class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td class="drop"><?php echo $data1['semester'] ?></td>
                            <td class="drop"><?php echo $data1['kelas'] ?></td>
                            <td class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
                            <td class="drop"></td>
        	<?PHP		 
	}
 
?>
            </tr>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
        <p>&nbsp;</p>
        <div> <button class="right">SAVE</button> </div>
            </div>
<!---------------------------------------------------->
</div>

</div>




   

                    
</div>
</div>




     
   

