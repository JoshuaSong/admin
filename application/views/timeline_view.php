
        <div style="width: 60%; float: left">
        <table class="table" id="timeline_tabels"   style="word-break:break-all;  ">
		<thead>
			<tr>
			
				<th   >DateTime</th>
				<th >Program Title</th>
				<th width="30px" >Length</th>

				
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th width="40px"  >DateTime</th>
				<th >Program Title</th>
				<th >Length</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="3" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>
        </div>
        <div style="width: 35%; float: right; margin-bottom: 50px;">
        <center>
   	<form method="post" id="addTL-form" action="timeline/addtl" enctype="multipart/form-data">
   		<input style="display: none" id="tl_pid" name="tl_pid">
		
		<p><input id="tl_title" name="tl_title" type='text' class="form-control" placeholder="program title"></p>
		<br/>
		<p><input id="tl_time" name="tl_time"  type='text' class="form-control" placeholder="program time"></p>
		<br/>
   	<div class="corner">
    		 
              <button type="submit" style="background:#5bc0de;color:#ffffff"><i class="icon-point-left"></i> Add to Timeline</button>
    	</div>
    	
    </form>
    	
    		<form method="post" style="display: none" id="repeatTL-form" action="timeline/repeat" enctype="multipart/form-data">
    	<p><input style="display: none" type='text' id="selected_tl" name="selected_tl"/></p>
    	<p><input style="display: none" type='text' id="first_tl" name="first_tl" /></p>
    	<p><input  id="length_tl" name="length_tl" type='text'/></p>
    	<br/>
    	<p><input  id="repeat_tl" name="repeat_tl" placeholder="repeat number" type='text'/></p>
    	<br/>
    	<div class="corner">
    		 
              <button type="submit" style="background: #5cb85c; color: #ffffff"  >Copy and Paste</button>
    	</div>
    	
      </form>
     <br/>
      <table cellpadding="10" >
      	<tr><td width="50%"> <form method="post" id="save-form" action="timeline/save2timeline" enctype="multipart/form-data">
    	
    	<br/>
    	<div class="corner">
    		 
              <button type="submit" style="background: #337ab7;color:#ffffff;"><i class=".icon-cancel-circle"></i>Save to Timeline</button>
    	</div>
    	
      </form></td><td> <form method="post" id="clear-form" action="timeline/clear" enctype="multipart/form-data">
    	
    	<br/>
    	<div class="corner" style="float: right">
    		 
              <button type="submit"><i class=".icon-cancel-circle"></i>Clear All</button>
    	</div>
    	
      </form></td></tr>
      </table>
     </center>
        </div>
<!-- Content -->

<div class="mainview view">
	

<div id="view" style="">
<!-- Datatables -->
	<table class="table" id="tabels"   style="word-break:break-all;  ">
		<thead>
			<tr>
				<th width="30px" >ID</th>
				<th width="30%"  >Program Date</th>
				<th >Program Title</th>
				<th width="30px" >Length</th>
				
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th >ID</th>
				<th >Program Date</th>
				<th >Program Title</th>
				<th width="30px" >Length</th>
				
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
			 		<form method="post" id="remove-form" action="program/remove">
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
	getRequest("program/get_channel", function(data) {
         
        var data = JSON.parse(data.responseText);
    
        for (var i = 0; i < data.length; i++) {
			$("#list_category_id").append("<option value="+data[i].c_id+">"+data[i].channel_title+"</option>");
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
	
	/* Set "submit-form" action repeatTL-form*/	 
	$('#clear-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	$('#repeatTL-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	$('#addTL-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
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
	$('#save-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	/* Alert form action */
	function alertForm(query){
		// Reload page
 		openPages('timeline');
		//alert(query);
	}
	
		/** Set datatables **/
		
var tTable = $('#timeline_tabels').dataTable({
		"aaSorting": [[0, 'desc']],
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "timeline/gettimeline",
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

	var oTable = $('#tabels').dataTable({
		"aaSorting": [[0, 'desc']],
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "program/get4timeline",
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
	

	/** Set form edit value after click datatables **/	
	$('#tabels tbody').on('click','tr', function () {
		
		$('#addTL-form').show();
		$('#repeatTL-form').hide();
	 var aData = oTable.fnGetData(this);
	 var tData=tTable.fnGetData(0);
	 var firsttime;
	 if(tData !=null)
	 {
	 	firsttime=tData[0]+" + "+tData[2]+" minute";
	 }
	 else
	 {
	 	firsttime=aData[1];
	 	
	 }
	 if(aData != null){
	 	// Set value form after select table for update data
	 	//alert(aData[0]);
	 	
	 	$('#tl_title').val(aData[2]);
	 	$('#tl_pid').val(aData[0]);
	 	$('#tl_time').val(firsttime);
	 	
		$('#list_id').val(aData[0]);
		$('#remove_list_id').val(aData[0]);
		$('#list_category_id > option[value="'+aData[6]+'"]').prop("selected", "selected");
	 	$('#list_name').val(aData[0]);
		$('#list_cook_time').val(aData[2]);
	 	$('#list_summary').val(aData[3]);
		$('#list_image').val(aData[4]);
	 	
		
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
	
	
	
	$('#timeline_tabels tbody').on('click','tr', function () {
		$('#addTL-form').hide();
		$('#repeatTL-form').show();
		
	 var aaData = tTable.fnGetData(this);
	 var pid=$('#selected_tl').val();
	 var lg=$('#length_tl').val();
	 if(aaData != null){
	 	
	
 		if($(this).hasClass('row_selected')) {
 			$('#selected_tl').val("");
 			$('#first_tl').val("");
 			$('#length_tl').val("");
 			tTable.$('tr.row_selected').removeClass('row_selected');
          //  $(this).removeClass('row_selected');
			// clear data form
		
        } else {
          //  tTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
            $('#selected_tl').val(pid+"#"+aaData[3]);
            $('#first_tl').val(aaData[0]);
            $('#length_tl').val(lg+"#"+aaData[2]);
			
        }
	  }
	});
});
</script>

      
    </body>
