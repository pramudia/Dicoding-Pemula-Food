<?php
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>
<!-------------------------------------------------------------------------->
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
?><?php include("koneksi.php");?>
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data User.</h3>
                    </div>
                   <?php 
$username = $_GET['username'];

$query = mysql_query("select * from user where username ='$username'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="admin.php?p=updateuser&username1=<?php echo $data['username1'] ?>" method="post">
  <div align="center">
  <input type="hidden" name="username" value="<?php echo $username; ?>" />
  <table border="0" cellpadding="5" cellspacing="0" class="table">
    <tbody>
      <tr>
        <td></td>
       	    <td></td>
       	    <td><input type="hidden" name="username1" maxlength="90" required value="<?php echo $data['username']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">User Name</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="username2" class="form-control" maxlength="90" required value="<?php echo $data['username']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Password</div></td>
       	    <td>:</td>
       	    <td><input type="password" name="password" class="form-control" maxlength="90" required value="<?php echo $data['password']; ?>" /></td>
          </tr>
      <tr>
        <td align="right" colspan="3"><input type="submit" class="btn btn-success" name="submit" value="Simpan" /></td>
          </tr>
      </tbody>
  </table>
          
                <div class="page-region-content">
                    <div id="pageDiv"></div>
                    <script type="text/javascript" src="js/modern/pagelist.js"></script>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        var page = $("#pageDiv").pagelist();
                        page.total = 10;
                        page.current = 1;
                        page.url = "pagelistresult.php?page={page}";
                        page.ajax = "#pageContent";
                        page.create();
                    });
                </script>
               
            </div>
        
                
                            
                   </p>

                    

                   

                    <p><strong>User</strong></p>

                    <ul class="">
                        <li>Hanya berlaku untuk 1 hak akses Admin Panel</li>
                    
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

