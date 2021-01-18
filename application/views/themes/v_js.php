<!-- ACE 1.2.6 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js"></script> -->
<script src="{BASE_URL}themes/assets/ace.js"></script>

<!-- Basic Plugins -->
<script src="{BASE_URL}themes/admina/js/jquery-2.1.4.min.js"></script>
<script src="{BASE_URL}themes/admina/js/bootstrap.min.js"></script>
<script src="{BASE_URL}themes/admina/js/modernizr.min.js"></script>
<script src="{BASE_URL}themes/admina/js/pace.min.js"></script>
<script src="{BASE_URL}themes/admina/js/wow.min.js"></script>
<script src="{BASE_URL}themes/admina/js/jquery.scrollTo.min.js"></script>
<script src="{BASE_URL}themes/admina/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{BASE_URL}themes/admina/plugins/chat/moment-2.2.1.js"></script>
<script src="{BASE_URL}themes/admina/plugins/toggles/toggles.min.js"></script>
<!-- Todo -->
<script src="{BASE_URL}themes/admina/js/todo.js"></script>
<!-- Site Script -->
<script src="{BASE_URL}themes/admina/js/app.js"></script>
<!-- Demo Swicth Color -->
<script src="{BASE_URL}themes/admina/js/demo_color.js"></script>

<!-- Themes/Assets -->
<!-- DataTables -->
<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/RowReorder/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Table Default
		$("table.datatable").DataTable();

		// Table Data Custom Show Entries
		$("table.datatables").DataTable({
			"lengthMenu": [[10,25,50,100,-1],[10,25,50,100,"All"]],
			"rowReorder": {selector: 'td:nth-child(2)'},
	        "responsive": true
		});

		// Table Data Custom Show Entries
		$("table.datatables25").DataTable({
			"lengthMenu": [[25,50,100,-1],[25,50,100,"All"]],
			"rowReorder": {selector: 'td:nth-child(2)'},
	        "responsive": true
		});

		// Table Data Custom Show Entries
		$("table.datatables50").DataTable({
			"lengthMenu": [[50,100,-1],[50,100,"All"]],
			"rowReorder": {selector: 'td:nth-child(2)'},
	        "responsive": true
		});

		// Table Data Custom Show Entries
		$("table.datatables100").DataTable({
			"lengthMenu": [[10,25,50,100,-1],[10,25,50,100,"All"]],
			"rowReorder": {selector: 'td:nth-child(2)'},
	        "responsive": true
		});

		// Table Custom 2
		$('table.datatables2').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false
		});

		// Table Custom 3
		$("table.datatables3").DataTable({
			// Custom Show Entries
			"lengthMenu": [[10,25,50,100,-1],[10,25,50,100,"All"]],
			// Custom Ordering
			"order": [[1, "desc"]]
		});

		// Table Data Add Searching
		// Setup - Add a Text Input to each footer cell
		$('table.datatables4 tfoot th').each(function(){
			var title = $(this).text();
			$(this).html('<input type="text" placeholder="Search '+title+'"/>');
		});
		// DataTable
		var table = $('table.datatables4').DataTable({
		    "lengthMenu": [[25,50,100,-1],[25,50,100,"All"]]
		});
		// Apply the Search
		table.columns().every(function(){
			var that = this;

			$('input', this.footer()).on('keyup change', function(){
			  if(that.search()!==this.value){
			    that
			      .search(this.value)
			      .draw();
			  }
			});
		});
		// Table Data Add Searching
	});
</script> <!-- DataTables -->

<!-- Form validation -->
<script type="text/javascript" src="{BASE_URL}themes/assets/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{BASE_URL}themes/assets/jquery-validate/form-validation-init.js"></script>
<script type="text/javascript">
	function number(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode>31 && (charCode<48 || charCode>57))
			return false;
		return true;
	}
	function number_point(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode>31 && charCode!=46 && (charCode<48 || charCode>57))
			return false;
		return true;
	}
	function string(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode==34 || charCode==37 || charCode==39 || charCode==59 || charCode==61 || charCode==96)
			return false;
		return true;
	}

	function file(form,id){
	    var input = document.getElementById('input_'+id);
	    var path = input.value;
	    var extensions = /(\.jpg|\.jpeg|\.png|\.gif|\.doc|\.docx|\.xls|\.xlsx|\.ppt|\.pptx|\.pdf|\.txt)$/i;
	    var size = form.files[0].size/1024/1024;
	    if(!extensions.exec(path)){
	        alert('Image/Office/PDF files are only allowed !!!');
	        input.value = '';
	    }
	    if(size>2){
	        alert('File size exceeds 2 MB');
	        input.value = '';
	    		        
	    }
	    return false;
	}

	function file_img(form,id){
	    var input = document.getElementById('input_'+id);
	    var path = input.value;
	    var extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
	    var size = form.files[0].size/1024/1024;
	    if(!extensions.exec(path)){
	        alert('Image files are only allowed !!!');
	        input.value = '';
	    }
	    if(size>2){
	        alert('File size exceeds 2 MB');
	        input.value = '';
	    		        
	    }
	    return false;
	}

	$(document).ready(function (){
		$("#contact-form").validate({
		  rules: {
		    captcha: {
		      required: true,
		      remote: {
		        url: '{BASE_URL}themes/assets/captcha/verify-captcha.php',
		        type: 'post',
		        data: {
		          username: function() {
		            return $( '#captcha' ).val();
		          }
		        }
		      }
		    }
		  },
		  messages: {
		    captcha: {
		      remote: "Enter the correct text"
		    }
		  }
		});

		$('#refresh-captcha').click(function(){
		  $('#captcha-image').attr('src', '{BASE_URL}themes/assets/captcha/generate-captcha.php?r=' + Math.random());
		  return false;
		});
	});
</script>

<!-- Date Picker -->
<script type="text/javascript" src="{BASE_URL}themes/assets/datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		// Class
		$('.datepicker').datepicker({
		  autoclose: true,
		  todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
		  $(this).prev().focus();
		});
	});
</script>

<!-- Time Picker -->
<script type="text/javascript" src="{BASE_URL}themes/assets/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
	jQuery('.timepicker').timepicker({
		defaultTIme : false
	});
	jQuery('.timepicker2').timepicker({
		showMeridian : false
	});
	jQuery('.timepicker3').timepicker({
		minuteStep : 15
	});
</script>

<!-- Select2 -->
<script type="text/javascript" src="{BASE_URL}themes/assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
	//$.fn.select2.defaults.set( "theme", "bootstrap" );
	$( ".select2" ).select2({
	    theme: "bootstrap",
	    width: "100%"
	});
</script>

<!-- WYSIHTML5 Text Editor -->
<script type="text/javascript" src="{BASE_URL}themes/assets/wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
	window.onload = function(){ // window.onload berfungsi untuk menjalankan javascript jika letaknya pada tag head html
		$('.textarea').wysihtml5();
	}
</script>

<!-- Currency (Simple Money Format) -->
<script type="text/javascript" src="{BASE_URL}themes/assets/currency/simple.money.format.js"></script>
<script type="text/javascript">
	$('.currency').simpleMoneyFormat();
</script>
<!-- Themes/Assets -->

<!-- Other -->
<script type="text/javascript">
  function change(form,i,j){
    var input1 = document.getElementById("input_"+i+"_"+j);
    var input2 = document.getElementById("input_"+j+"_"+i);
    var hasil = 1/input1.value
    input2.value = hasil.toFixed(3)
  }
</script>
<!-- Other -->