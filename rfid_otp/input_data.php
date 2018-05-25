<?php
include_once 'db_connect.php';
include_once 'functions.php';
sec_session_start();
if (login_check($mysqli) == true) {
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
     "bServerSide": true,
     "bJQueryUI": true,
     "responsive": true,
     "sAjaxSource": "serverInputData.php", // Load Data
	 "aaSorting": [[ 0, "desc" ]],
     "sServerMethod": "POST",
     "columnDefs": [
     { "orderable": true, "targets": 0, "searchable": true },
     { "orderable": true, "targets": 1, "searchable": true },
     { "orderable": true, "targets": 2, "searchable": true },
     { "orderable": true, "targets": 3, "searchable": true },
     { "orderable": true, "targets": 4, "searchable": true },
     { "orderable": true, "targets": 5, "searchable": true },
     { "orderable": true, "targets": 6, "searchable": true }
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
      
      <h5 class="sidebartitle">Navigasi</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
	    <li class="nav-parent"><a href="input_data.php"><i class="fa fa-edit"></i> <span>Input data</span></a>
          <ul class="children">
            <li class="active"><a href="input_data.php"><i class="fa fa-caret-right"></i> Input Data</a></li>
          </ul>
        </li>	
	  </ul>
       
      
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
        <span class="label">Selamat datang:</span>
        <ol class="breadcrumb">
          <li><a href=""><?php echo htmlentities($_SESSION['username']); ?></a></li>
        </ol>
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
              <h4 class="panel-title">Input Data</h4>
            </div>
        <div class="panel-body">

		  <button onClick="showModals()" class="btn btn-primary">Tambah Data</button>
          <br>
          <hr>
          <br>
            <table id="table2"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
            <thead>
              <tr>
              <th width="20%">Action</th>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>OTP</th>
                <th>Jam masuk</th>
                <th>Jam keluar</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody>
			<?php
				include("conec.php");
				$link=Conection();
				$result=mysqli_query($link, "select * from data order by no desc");    
					while($row = mysqli_fetch_array($result)) {
						printf("<tr class=\"odd gradeX\">
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"> &nbsp;%s&nbsp; </td>
						<td class=\"hidden-phone\"></td>
						<td class=\"hidden-phone\"></td>
						<td class=\"hidden-phone\"></td>
						<td class=\"hidden-phone\"></td>
						</tr>",
            $row["no"], 
            $row["id"],
            $row["nama"],
            $row["otp"],
            $row["jam_masuk"], 
						$row["jam_keluar"], 
						$row["pass"]);
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
                <th></th>
            </tfoot>
          </table>			
        </div><!-- panel-body -->
      </div><!-- panel -->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

</section>


    <!-- Modal Popup -->
    <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah data kayu</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-danger" role="alert" id="removeWarning">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              Anda yakin ingin menghapus data ini
            </div>
            <br>
            <form class="form-horizontal" id="formInputdata">
              <input type="hidden" class="form-control" id="type" name="type">

              <div class="form-group">
                <label for="no" class="col-sm-2 control-label">No</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no" name="no" >
                </div>
              </div>

              <div class="form-group">
                <label for="id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="id" name="id" >
                </div>
              </div>

              <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" >
                </div>
              </div>
					  
              <div class="form-group">
                <label for="otp" class="col-sm-2 control-label">OTP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="otp" name="otp" >
                </div>
              </div>

              <div class="form-group">
                <label for="jam_masuk" class="col-sm-2 control-label">Jam masuk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" >
                </div>
              </div>

              <div class="form-group">
                <label for="jam_keluar" class="col-sm-2 control-label">Jam keluar</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jam_keluar" name="jam_keluar" >
                </div>
              </div>

              <div class="form-group">
                <label for="pass" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pass" name="pass" >
                </div>
              </div>
			  
		   </form>
		   
          </div>
          <div class="modal-footer">
            <button type="button" onClick="submitInputdata()" class="btn btn-default" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
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

<script>
    //Tampilkan Modal
   function showModals( no )
   {
    waitingDialog.show();
    clearModals();

    // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus
    if( no )
    {
     $.ajax({
      type: "POST",
      url: "crudInputData.php",
      dataType: 'json',
      data: {no:no,type:"get"},
      success: function(res) {
       waitingDialog.hide();
       setModaldata( res );
      }
     });
    }
    // Untuk Tambahkan Data
    else
    {
     $("#myModals").modal("show");
     $("#myModalLabel").html("Data baru");
     $("#type").val("new");
     waitingDialog.hide();
    }
   }

   //Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit
   function setModaldata( data )
   {
    $("#myModalLabel").html(data.kec);
    $("#no").val(data.no);
    $("#id").val(data.id);
    $("#nama").val(data.nama);
    $("#otp").val(data.otp);
    $("#jam_masuk").val(data.jam_masuk);
    $("#jam_keluar").val(data.jam_keluar);
    $("#pass").val(data.pass);
    $("#type").val("edit");
    $("#myModals").modal("show");
		
	$('#myModals').on('shown.bs.modal', function (e) { 
    });
   }
   
   //Submit Untuk Eksekusi Tambah/Edit/Hapus Data
   function submitInputdata()
   {
    var formData = $("#formInputdata").serialize();
   //waitingDialog.show();
    $.ajax({
     type: "POST",
     url: "crudInputData.php",
     dataType: 'json',
     data: formData,
     success: function(data) {
      dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
      waitingDialog.hide();
     }
    });
   }

   //Hapus Data
   function deleteInputData( no )
   {	   
    clearModals();
    $.ajax({
     type: "POST",
     url: "crudInputData.php",
     dataType: 'json',
     data: {no:no,type:"get"},
     success: function(data) {
      $("#removeWarning").show();
      $("#myModalLabel").html("Hapus Data");
      $("#type").val("delete");
      $("#no").val(data.no);
      $("#id").val(data.id).attr("disabled","true");
	    $("#nama").val(data.nama).attr("disabled","true");
      $("#otp").val(data.otp).attr("disabled","true");
      $("#jam_masuk").val(data.jam_masuk).attr("disabled","true");
      $("#jam_keluar").val(data.jam_keluar).attr("disabled","true");
      $("#pass").val(data.pass).attr("disabled","true");
      $("#myModals").modal("show");
      waitingDialog.hide();
     }
    });
   }

   //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
   function clearModals()
   {
    $("#removeWarning").hide();
    $("#no").val("").removeAttr( "disabled" );
    $("#id").val("").removeAttr( "disabled" );
  	$("#nama").val("").removeAttr( "disabled" );
    $("#otp").val("").removeAttr( "disabled" );
    $("#jam_masuk").val("").removeAttr( "disabled" );
    $("#jam_keluar").val("").removeAttr( "disabled" );
    $("#pass").val("").removeAttr( "disabled" );
    $("#type").val("");
   }
  </script>
 <script type="text/javascript" src="ajax_daerah.js"></script> 
 <?php
}
else {
	echo 'Anda tidak memiliki hak untuk mengakses halaman ini, silahkan login terlebih dahulu.';
    $logged = 'out';
} ?>
</body>
</html>
