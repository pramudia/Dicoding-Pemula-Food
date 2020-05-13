<div class="panel panel-info col-md-12" align="center">
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
			width:100%;
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
 <script>   
    function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}</script>

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
          <div style="height:100%;width:100%;border:solid 4px green;overflow:scroll;overflow-y:scroll;overflow-x:scroll;">
  <p style="width:20100px;">

<div id="print-area-1" class="print-area">
    <div style="text-align:right;"><a class="no-print" href="javascript:printDiv('print-area-1');">Print</a></div>
<!---------------------------------------------------->
 

<div class="bawah">
<?php $thn_ajaran= $_POST['thnajaran']; ?>
 <form name="in_matkul" action="../admin/admin.php?p=g_jadwal" method="POST">
TAHUN AJARAN:<select name ="thnajaran" onchange="ganti(document.form.menu.options[document.form.menu.selectedIndex].value)">
<option value="<?php echo "$thn_ajaran";?>" selected="selected"><?php echo "$thn_ajaran";?></option>
<?php 
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT thn_ajaran FROM jadwal GROUP BY thn_ajaran";
   					$hasil = mysql_query($query);
   					while ($thnajar = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$thnajar['thn_ajaran']."' >".$thnajar['thn_ajaran']."</option>";
   				}
					?></select>
                   <input type="submit" value="Submit" />

<table width="1089" border="1" align="center" bordercolor="#000000" class="table">
                    <thead >
					
					
                        <tr align="center" > 
                            <th colspan="2"><strong>Pagi</strong></th>
                            <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (â€œgagalâ€?);
	for ($i=0;$i<$data = mysql_fetch_array($query);$i++){
		$kode = $data['kd_ruang'];
		
    
    ?>
                          <th colspan="4" class="center"><strong><?php echo $data['kd_ruang'] ?></strong></th>
                          
                             <?PHP
$no++;
}
?>
							
                        </tr>
                    </thead>

                    <tbody>
                   
                    <tr >
                      <td width="25"><strong>HR</strong></td>
                      <td width="31"><strong>JAM</strong></td><?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (â€œgagalâ€?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
                      <td width="26" class="drop"><strong>MP</strong></td>
                      <td width="32" class="drop"><strong>SMT</strong></td>
                      <td width="30" class="drop"><strong>KLS</strong></td>
                      <td width="32" class="drop"><strong>GR</strong></td>
                      
                             <?PHP
$no++;
}
?>
                     </tr>
                    <tr >
                    
                            <td rowspan="3" align="center" valign="middle"><strong>snn</strong></td>
                            <td><strong> 1 </strong></td>
                            <?php
   
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
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
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
							<td width="4" class="drop"><?php echo $data1['kd_matkul'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['semester'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kelas'] ?></td>
                            <td width="4" class="drop"><?php echo $data1['kd_dosen'] ?></td>		
		
        <?php
        $no++;
       }
	}else {
			?>
							<td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="4" class="drop"></td>
                            <td width="27" class="drop"></td>
        	<?PHP		 
	}
 
?>
                      </tr> 
                          <tr >
                            <td><strong> 2 </strong></td>
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
                            <td><strong> 3 </strong></td> <?php
   
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
                            <td rowspan="3" align="center" valign="middle"><strong>sls</strong></td>
                            <td><strong> 1 </strong></td> 
                            <?php
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
                            <td><strong> 2 </strong></td><?php
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
                            <td><strong> 3 </strong></td>
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
                            <td rowspan="3" align="center" valign="middle"><strong>rb</strong></td>
                            <td><strong> 1 </strong></td><?php
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
                            <td><strong> 2 </strong></td><?php
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
                            <td><strong> 3 </strong></td>
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
                            <td rowspan="3" align="center" valign="middle"><strong>kms</strong></td>
                            <td><strong> 1 </strong></td><?php
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
                            <td><strong> 2 </strong></td><?php
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
                            <td><strong> 3 </strong></td>
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
                            <td rowspan="3" align="center" valign="middle"><strong>jmt</strong></td>
                            <td><strong> 1 </strong></td><?php
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
                            <td><strong> 2 </strong></td><?php
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
                            <td><strong> 3 </strong></td>
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
        <table border="1" align="center" bordercolor="#000000" class="table">
          <thead >
            <tr align="center" >
              <th colspan="2"><strong>Sore</strong></th>
              <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (&acirc;&euro;&oelig;gagal&acirc;&euro;?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
              <th colspan="4" class="center"><strong><?php echo $data['kd_ruang'] ?></strong></th>
              <?PHP
$no++;
}
?>
            </tr>
          </thead>
          <tbody>
            <tr >
              <td><strong>HR</strong></td>
              <td><strong>JAM</strong></td>
              <?php
    $query = mysql_query ("SELECT * FROM ruang ORDER BY kd_ruang");
    $no  = 1;
	//$result = mysql_query($query) or die (&acirc;&euro;&oelig;gagal&acirc;&euro;?);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
              <td class="drop"><strong>MP</strong></td>
              <td class="drop"><strong>SMT</strong></td>
              <td class="drop"><strong>KLS</strong></td>
              <td class="drop"><strong>GR</strong></td>
              <?PHP
$no++;
}
?>
            </tr>
            <tr >
              <td rowspan="2" align="center" valign="middle"><strong>snn</strong></td>
              <td><strong> 1 </strong></td>
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
                            <td><strong> 2 </strong></td>
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
              <td rowspan="2" align="center" valign="middle"><strong>sls</strong></td>
              <td><strong> 1 </strong></td>
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
                            <td><strong> 2 </strong></td>
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
              <td rowspan="2" align="center" valign="middle"><strong>rb</strong></td>
              <td><strong> 1 </strong></td>
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
                            <td><strong> 2 </strong></td>
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
              <td rowspan="2" align="center" valign="middle"><strong>kms</strong></td>
              <td><strong> 1 </strong></td>
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
                            <td><strong> 2 </strong></td>
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
              <td rowspan="2" align="center" valign="middle"><strong>jmt</strong></td>
              <td><strong> 1 </strong></td>
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
                            <td><strong> 2 </strong></td>
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
        </div>
        
        <textarea id="printing-css" style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
        
        <p></p>
        <div>  </div>
            </div>
<!---------------------------------------------------->
</div>

</div>




   
<br>
                    
</div>
</div>




     
   


</div>