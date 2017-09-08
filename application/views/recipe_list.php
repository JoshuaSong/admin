<!-- Content -->
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;">RECIPE LIST</div>
<div style="float:right;">
	<div class="menu">
		<a href="#view"><button id="btn-view">View</button></a> 
		<a href="#form"><button id="btn-insert">Insert</button></a> 
		<a href="#form"><button id="btn-update" disabled="disabled">Update</button></a>
		<button id="btn-remove" disabled="disabled">Remove</button>
		<button id="btn-filter" value="on">Filter</button>
	</div>
</div>

<div class="mainview view">
	<div id="form" style="display:none; padding-bottom:45px;">
		<form method="post" id="submit-form" action="recipe_list/insert" enctype="multipart/form-data">
		<input type="hidden" name="list_id" id="list_id">
		<br /><br />
		<div class="innert-list">
    		<h1>Name</h1>
    		<div class="corner">
    			<input type="text" name="list_name" id="list_name">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Category</h1>
    		<div class="corner">
				<select id="list_category_id" name="list_category_id">
        		</select>
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Cook Time</h1>
    		<div class="corner">
    			<input type="text" name="list_cook_time" id="list_cook_time">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Summary</h1>
    		<div class="corner">
    			<input type="text" name="list_summary" id="list_summary">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Image</h1>
    		<div class="corner">
    			<input type="file" name="list_image" id="list_image">
    		</div>
    	</div>
		<div class="innert-list" style="height: 200px;">
    		<h1 style="border-bottom: 0px;">Ingredients</h1>
    		<div class="corner">
				<textarea name="list_ingredients" id="list_ingredients"></textarea>
    		</div>
    	</div>
		<div class="innert-list" style="height: 200px;">
    		<h1 style="border-bottom: 0px;">Instruction</h1>
    		<div class="corner">
				<textarea name="list_instruction" id="list_instruction"></textarea>
    		</div>
    	</div>
		<div class="innert-list">
    	<br />
    	<div class="corner">
    		  <button type="reset">Reset</button>
              <button type="submit">Submit</button>
    	</div>
    </div>
	</form>
</div>

<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels">
		<thead>
			<tr>
				<th width="20%">Name</th>
				<th width="15%">Category</th>
				<th width="15%">Cook Time</th>
				<th width="20%">Summary</th>
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th width="20%">Name</th>
				<th width="15%">Category</th>
				<th width="15%">Cook Time</th>
				<th width="20%">Summary</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="5" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>

	<!-- Remove Modal -->
	<div class="overlay" style="display: none; padding-bottom:45px;">
    	<div class="page">
              <h1><b>Confirm</b></h1>
              	<div class="content-area">
               		Are you sure you want to remove this data? 
              	</div>
              	<div class="action-area">
			 		<form method="post" id="remove-form" action="recipe_list/remove">
                		<div class="action-area-right">
                  			<div class="button-strip">
				   				<input type="hidden" name="remove_list_id" id="remove_list_id">
                    			<button type="reset">Cancel</button>
                    			<button type="submit">Okay</button>
                  			</div>
                		</div>
					</form>
              	</div>
            </div>
		</div>
</div>
<!-- End -->

<script type="text/javascript"> 

$(document).ready(function() {
	
	/** Action button menu **/

	/* Menu transition */
	$('.menu a').click(function(ev) {

        ev.preventDefault();
        var selected = 'selected';

        $('.mainview > *').removeClass(selected);
        $('.menu button').removeClass(selected);
		 setTimeout(function() {
          $('.mainview > *:not(.selected)').css('display', 'none');
        }, 100);
		$(ev.currentTarget).parent().addClass(selected);
        var currentView = $($(ev.currentTarget).attr('href'));
        currentView.css('display', 'block');
        setTimeout(function() {
          currentView.addClass(selected);
        }, 0);
      });

	/* View button */
	$('#btn-view').bind('click', function(){
		// Enable button
		$('#btn-insert').removeAttr("disabled");
		$('#btn-filter').removeAttr("disabled");
	});

	/* Insert button */
	$('#btn-insert').bind('click', function(){
		// Reset submit form
		$('#list_id').val('');
		$("#submit-form")[0].reset();		
		// Disabled button
		$('#btn-update').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
		$('#btn-add-image').attr("disabled","disabled");
	});

	/* Update button */
	$('#btn-update').bind('click', function(){
		// Disabled button
		$('#btn-insert').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
		$('#btn-add-image').attr("disabled","disabled");
	});
	
	/* Filter button */	
  	$('#btn-filter').bind('click', function(){
		
		if($('#btn-filter').attr("value") == "on"){
			$('#form_filter').show();
			$('#btn-filter').attr("value","off");
    	}else{
			$('#form_filter').hide();
			$('#btn-filter').attr("value","on");
		}
			
		});

	/* Remove button */
	$('#btn-remove').bind('click', function(){
		$('.overlay').show();
		$('.overlay').find('button').click(function() {
         	$('.overlay').hide();
        });
			
		$('.overlay').click(function() {
        	$('.overlay').find('.page').addClass('pulse');
        	$('.overlay').find('.page').on('webkitAnimationEnd', function() {
            	$(this).removeClass('pulse');
          	});
        });

	});


	
	/** Get request data category  **/
	getRequest("recipe_list/get_category", function(data) {
         
        var data = JSON.parse(data.responseText);
    
        for (var i = 0; i < data.length; i++) {
			$("#list_category_id").append("<option value="+data[i].category_id+">"+data[i].category_name+"</option>");
        }

    });

	function getRequest(url, callback) {
    	var request;
    	if (window.XMLHttpRequest) {
       		request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
    	} else {
        	request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
    	}
    	request.onreadystatechange = function() {
        	if (request.readyState == 4 && request.status == 200) {
            	callback(request);
				$('.loading').hide();
        	}
    	}
    	request.open("GET", url, true);
    	request.send();
	}

	/** Form submit action **/ 
	
	/* Set "submit-form" action */	 
	$('#submit-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	
	/* Set "remove-form" action */
	$('#remove-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	
	/* Alert form action */
	function alertForm(query){
		// Reload page
 		openPages('recipe_list');
		alert(query);
	}
	
		/** Set datatables **/

	var oTable = $('#tabels').dataTable({
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "recipe_list/get",
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


	/** Show detail data datatables **/
	
	function fnFormatDetails ( nTr )
		{

	
		 var aData = oTable.fnGetData( nTr );
		 if(aData != null){
						
			var sOut = '<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">';
  				sOut += '<tr>';
    			sOut += '<td width="10%" rowspan="3"><div align="center"><img src="<?php echo base_url(); ?>upload/images/'+aData[4]+'" width="100" height="100"></div></td>';
				sOut += '<tr>';
				sOut += '<td width="10%"><strong>Ingredients : </strong></td>';
				sOut += '<td>'+aData[5]+'</td>';
				sOut += '</tr>';
				sOut += '<tr>';
				sOut += '<td width="10%"><strong>Instruction : </strong></td>';
				sOut += '<td>'+aData[6]+'</td>';
				sOut += '</tr>';
				sOut += '</table>';

				return sOut;
			}
				}
			
				$('#tabels tbody').on( 'dblclick','td', function () {
					var nTr = $(this).parents('tr')[0];
					if ( oTable.fnIsOpen(nTr) )
					{
						oTable.fnClose( nTr );
					}
					else
					{
						oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
					}
				} );
	
	/** Set form edit value after click datatables **/	
	$('#tabels tbody').on('click','tr', function () {
	 var aData = oTable.fnGetData(this);
	 if(aData != null){
	 	// Set value form after select table for update data
		$('#list_id').val(aData[8]);
		$('#remove_list_id').val(aData[8]);
		$('#list_category_id > option[value="'+aData[7]+'"]').prop("selected", "selected");
	 	$('#list_name').val(aData[0]);
		$('#list_cook_time').val(aData[2]);
	 	$('#list_summary').val(aData[3]);
		$('#list_ingredients').val(aData[5]);
	 	$('#list_instruction').val(aData[6]);
		
 		if($(this).hasClass('row_selected')) {
            $(this).removeClass('row_selected');
			// clear data form
			$(':hidden','#remove-form').val('');
			$('#btn-update').attr("disabled","disabled");
			$('#btn-remove').attr("disabled","disabled");
			$('#btn-add-image').attr("disabled","disabled");
			
        } else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
			$('#btn-update').removeAttr("disabled");
			$('#btn-remove').removeAttr("disabled");
			$('#btn-add-image').removeAttr("disabled");
        }
	  }
	});
});
</script>