<?php
include_once 'db_connect.php';
include_once 'functions.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/pos.png" type="image/png">

<title>Input Data</title>

<link href="css/style.default.css" rel="stylesheet">



<script type="text/javascript" language="javascript" src="assets/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/media/js/dataTables.responsive.js"></script>

<script src="js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">

<script type="text/javascript" language="javascript" src="assets/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="assets/media/js/common.js"></script>
<script type="text/javascript" language="javascript" >
   var dTable;
   // #Example adalah id pada table
   $(document).ready(function() {
    dTable = $('#table2').DataTable( {
     "bProcessing": true,
     //"bServerSide": true,
     "bJQueryUI": true,
     "responsive": true,
     //"sAjaxSource": "serverotp.php", // Load Data
	 "aaSorting": [[ 0, "desc" ]],
     "sServerMethod": "POST",
     "columnDefs": [
     { "orderable": true, "targets": 0, "searchable": true },
     { "orderable": true, "targets": 1, "searchable": true },
     { "orderable": true, "targets": 2, "searchable": true },
     { "orderable": true, "targets": 3, "searchable": true },
     { "orderable": true, "targets": 4, "searchable": true },
     { "orderable": true, "targets": 5, "searchable": true }
     ]
    } );

    // Untuk Pencarian, di kolom paling bawah
    dTable.columns().every( function () {
     var that = this;

     $( 'input', this.footer() ).on( 'keyup change', function () {
      that
      .search( this.value )
      .draw();
     } );
    } );
   } );
  </script>

</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> RFID OTP <span>]</span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">     
    </div><!-- leftpanelinner -->
	
  </div><!-- leftpanel -->


  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>

      <form class="searchform" action="http://themepixels.com/demo/webpage/bracket/index.html" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
      </form>

    </div><!-- headerbar -->

    <div class="pageheader">
      <h2><i class="fa fa-table"></i> Sistem RFID OTP</h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>

        <div class="contentpanel">
 <div class="row">
<div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="#" class="panel-close">&times;</a>
                <a href="#" class="minimize">&minus;</a>
              </div>
              <h4 class="panel-title">Data pengguna</h4>
            </div>
        <div class="panel-body">
          <br>
          <hr>
          <br>
            <table id="table2"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>OTP</th>
                <th>Jam masuk</th>
                <th>Jam keluar</th>
              </tr>
            </thead>
            <tbody>
			<?php
                include("conec.php");
                $id = $_SESSION['id'];
				$link=Conection();
				$result=mysqli_query($link, "select * from data where id='".$id."'");    
					while($row = mysqli_fetch_array($result)) {
						printf("<tr class=\"odd gradeX\">
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp;</td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp;</td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp;</td>
						</tr>",
            $row["no"], 
            $row["id"],
            $row["nama"],
            $row["otp"],
            $row["jam_masuk"], 
						$row["jam_keluar"]);
					}
				((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
			?>
            </tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
          </table>			
        </div><!-- panel-body -->
      </div><!-- panel -->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

</section>
<script src="js/custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.datatables.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>	


<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.cookies.js"></script>

<script src="js/flot/flot.min.js"></script>
<script src="js/flot/flot.resize.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael-2.1.0.min.js"></script>

<script src="js/jquery.datatables.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script src="js/dashboard.js"></script>
 <script type="text/javascript" src="ajax_daerah.js"></script> 
</body>
</html>
