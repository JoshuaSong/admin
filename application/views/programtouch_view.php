<!-- Content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;">Program LIST</div>


<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels"   style="word-break:break-all;  ">
		<thead>
			<tr>
				<th width="30px" >ID</th>
				<th width="30px"  >User_id</th>
				<th  width="200px" >Program</th>
				<th width="250px">Touch Time</th>
				
				
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th width="30px" >ID</th>
				<th width="30px"  >User_id</th>
				<th  width="200px" >Program</th>
				<th width="250px">Touch Time</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="5" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>

	

<script type="text/javascript"> 

$(document).ready(function() {


	var oTable = $('#tabels').dataTable({
		"aaSorting": [[0, 'desc']],
		"bProcessing": false,
		"bServerSide": true,
		"iDisplayLength": 25,
		"sAjaxSource": "programtouch/get",
		'sPaginationType': 'full_numbers',					
       	"fnServerData": function( sUrl, aoData, fnCallback ) {
            $.ajax( {
                "url": sUrl,
                "data": aoData,
                "success": fnCallback,
                "dataType": "jsonp",
                "cache": false
            } );
          }
         }).columnFilter({
		 	// Set filter type
	      	aoColumns: [{ type: "text" },
						{ type: "text" },
						{ type: "text" },
						{ type: "text" },
				        { type: "text" }]
		});


	

});
</script>