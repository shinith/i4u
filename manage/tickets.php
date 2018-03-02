<?php 
require_once  'su-template.php';
admin_header("Vyapar Formations | Tickets","");
//<button type='button' class='btn btn-info usrBtn' href='#' data-mail='' data-id='' data-mob='' data-dt='' data-title='' data-type='1'>Create New User</button>
$serobj=new MysqliDb(HOST,USER,PWD,DB);
$serobj->orderBy("ap.ap_id");
$serobj->join("vf_company cmp","cmp.cmp_id=ap.cmp_id");
$serobj->where("ap.ap_status",9,"!=");
$myservices=$serobj->get("vf_application ap",null,"ap_id,ap.ap_apstatus,ap.ap_updateby,ap.ap_service,cmp.cmp_name,ap.ap_lastupdate_date");

//print_r($ticketarr);exit;
?>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery.table2excel.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
$("#btnExport").click(function(){
	sheetName=$(this).data("sheet");
	flname=$(this).data("fname");
  $("#tblService").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: sheetName,
    filename: flname //do not include extension
  }); 
});	
	});
</script>
<div class="ks-column ks-page ">
<div class="ks-header">
<section class="ks-title">
<h3>Vyapar fromations Recent Tickets</h3>
</section>
</div>
<div class="ks-content">
<div class="ks-body">
<div class="container-fluid ks-rows-section">

<div class="ks-content">
<div class="ks-body tables-page">
<div class="container-fluid ks-rows-section">
<div class="row">
<div class="col-lg-12" >

<div class="card panel panel-default panel-table">
<div class="card-block">
<table id="tblService" class="table table-bordered">
<thead>
<tr>
<th width="1">#</th>
<th>Service</th>
<th>Company</th>
<th>Assigned to</th>
<th>Last updated</th>
<th>Status</th>
<th class="noExl">Option</th>

</tr>
</thead>
<tbody>
<?php 
foreach ($myservices as $ticket){ 
$ticketno="VF-".str_pad($ticket['ap_id'], 5,"0",STR_PAD_LEFT);
?>
<tr>
<td scope="row"><?php echo $ticketno; ?></td>
<td> <?php echo $ticket['ap_service']?></td>
<td> <?php echo $ticket['cmp_name']?></td>
<td> --</td>
<td> <?php echo $ticket['ap_lastupdate_date']?date("d M,Y h:i a",strtotime($ticket['ap_lastupdate_date'])):"--"?></td>
<td> --</td>
<td class="noExl">

<a  href='#' >Edit</a>
</td>

</tr><?php  }?>

</tbody>
</table>
</div>

</div>
<div class="">
<br>
<button type="button" data-fname="vyapar-tickets-<?php echo date("d-m-Y")?>" data-sheet="tickets" class="btn btn-success" id="btnExport" >Export as Excel</button>
</div>
</div>

</div>



</div>
</div>
</div>



</div>
</div>
</div>
</div>
<?php admin_footer(); ?> 