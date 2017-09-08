<!-- Content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <style>
 #view div{
 	}
 </style>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;">Program LIST</div>


<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels"   style="word-break:break-all;  ">
		<thead>
			<tr>
				<th width="30px" >ID</th>
				<th width="30px"  >U_id</th>
				<th  width="30px" >Name</th>
				<th  width="100px" >IP</th>
				<th width="10px">C</th>
				<th width="10px">S</th>
				<th width="100px">City</th>
				
				<th width="130px">time</th>
				<th>User Agend</th>
				
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th width="30px" >ID</th>
				<th width="30px"  >User_id</th>
				<th  width="30px" >User_name</th>
				<th  width="100px" >IP</th>
				<th width="30px">Country</th>
				<th width="15px">State</th>
				<th width="100px">City</th>
				
				<th width="130px">time</th>
				<th>User Agend</th>
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
		"sAjaxSource": "sitetouch/get",
		'sPaginationType': 'full_numbers',					
       	"fnServerData": function( sUrl, aoData, fnCallback ) {
            $.ajax( {
                "url": sUrl,
                "data": aoData,
                "success": fnCallback,
                "dataType": "jsonp",
                "cache": false
            } );
         },
          "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
           var agent='<div>'+aData[9].substr(0,50)+'</div>';
           $('td:eq(9)', nRow).html(agent);
            return nRow;
        }
         }).columnFilter({
		 	// Set filter type
	      	aoColumns: [{ type: "text" },
						{ type: "text" },
						{ type: "text" },
						{ type: "text" },
				        { type: "text" }]
		});






	$('#tabels tbody').on('click','tr', function () {
	
	 var aData = oTable.fnGetData(this);
	  
	 if(aData != null){
	 	// Set value form after select table for update data
		
		
		
	 
 			if ( $(this).hasClass('row_selected') ) {
            	$(this).removeClass('row_selected');
				
        	} else {
            	oTable.$('tr.row_selected').removeClass('row_selected');
            	$(this).addClass('row_selected');
			
        	}
	  	}
		});

});
</script>