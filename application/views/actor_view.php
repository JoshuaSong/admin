<!-- Content -->
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;">Actor</div>
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
		<form method="post" id="submit-form" action="actor/insert" enctype="multipart/form-data">
		<input type="hidden" name="channel_id" id="channel_id">
		<br /><br />
		<div class="innert-list">
    		<h1>ID</h1>
    		<div class="corner">
    			<input type="text" disabled="disabled" id="c_id">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Image</h1>
    		<div class="corner" style="width: 500px">
    			<input type="text" name="imageurl" id="imageurl" style="width: 100%">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1>Name</h1>
    		<div class="corner">
    			<input type="text" name="actor_name" id="actor_name">
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
				<th width="30px" >Actor_ID</th>
				<th>Actor Name</th>
				<th>Actor Poster Image</th>
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th width="30px" >Actor_ID</th>
				<th>Actor Name</th>
				<th>Actor Poster Image</th>
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
			 		<form method="post" id="remove-form" action="actor/remove">
                		<div class="action-area-right">
                  			<div class="button-strip">
				   				<input type="hidden" name="remove_channel_id" id="remove_channel_id">
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
		// Enable button insert
		$('#btn-insert').removeAttr("disabled");
		$('#btn-filter').removeAttr("disabled");
	});
		  
	/* Insert button */
	$('#btn-insert').bind('click', function(){
		// Reset submit form
		$(':hidden','#submit-form').val('');
		// Disabled button
		$('#btn-update').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
	});

	/* Update button */
	$('#btn-update').bind('click', function(){
		// Disabled button
		$('#btn-insert').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
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
 		openPages('actor');
		alert(query);
	}
	
		/** Set datatables **/

	var oTable = $('#tabels').dataTable({
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "actor/get",
		"iDisplayLength": 50,
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
            /* Append the grade to the default row class name */
           var url=aData[2];
           var imgTag = '<img src="' + url+ '" style="width: 48px"/>';
                $('td:eq(2)', nRow).html(imgTag);
           
            return nRow;
        }
         }).columnFilter({
		 	// Set filter type
	      	aoColumns: [{ type: "text" },
				        { type: "text" }]
		});


	$('#tabels tbody').on('click','tr', function () {
	
	 var aData = oTable.fnGetData(this);
	  
	 if(aData != null){
	 	// Set value form after select table for update data
		$('#remove_channel_id').val(aData[0]);
		$('#channel_id').val(aData[0]);
	 	$('#c_id').val(aData[0]);
	 	$('#actor_name').val(aData[1]);
		$('#imageurl').val(aData[2]);
	 	
	 
 			if ( $(this).hasClass('row_selected') ) {
            	$(this).removeClass('row_selected');
				// clear data form
				$(':hidden','#remove-form').val('');
				$(':hidden','#submit-form').val('');
				$('#btn-update').attr("disabled","disabled");
				$('#btn-remove').attr("disabled","disabled");
        	} else {
            	oTable.$('tr.row_selected').removeClass('row_selected');
            	$(this).addClass('row_selected');
				$('#btn-update').removeAttr("disabled");
				$('#btn-remove').removeAttr("disabled");
        	}
	  	}
		});
	});

</script>