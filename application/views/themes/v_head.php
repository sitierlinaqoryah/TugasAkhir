<meta charset="utf-8">
<link rel="icon" type="image/png" href="{BASE_URL}img/favicon.png">
<meta name="description" content="ecut-indonesia.com">
<meta name="keywords" content="web programming, mobile programming">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Icon fonts css-->
<link href="{BASE_URL}themes/admina/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="{BASE_URL}themes/admina/plugins/ionicon/css/ionicons.min.css" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="{BASE_URL}themes/admina/css/bootstrap.min.css" rel="stylesheet">
<link href="{BASE_URL}themes/admina/css/bootstrap-reset.css" rel="stylesheet">

<!--Animation css-->
<link href="{BASE_URL}themes/admina/css/animate.css" rel="stylesheet">

<!-- Themes/Assets -->
<!-- Font Awesome
<link rel="stylesheet" type="text/css" href="themes/assets/font-awesome/css/font-awesome.min.css">

Bootstrap
<link rel="stylesheet" type="text/css" href="themes/assets/bootstrap/css/bootstrap.min.css"> -->

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/media/css/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/extensions/RowReorder/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/extensions/Responsive/css/responsive.dataTables.min.css">

<!-- Date Picker -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datepicker/bootstrap-datepicker3.min.css"/>

<!-- Time Picker -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/timepicker/bootstrap-timepicker.min.css"/>

<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/select2/css/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/select2/select2-bootstrap.css"/>

<!-- WYSIHTML5 Text Editor -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- jQuery
<script src="themes/admina/js/jquery-2.1.4.min.js"></script> -->
<!-- Themes/Assets -->

<!-- Custom styles -->
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/admina/css/style.css"/>
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/admina/css/helper.css"/>
<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/admina/css/style-responsive.css"/>
<script type="text/javascript" src="{BASE_URL}themes/admina/js/jquery-2.1.4.min.js"></script>

<style>
	.center{
		text-align: center;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
	    //group add limit
	    var maxGroup = 10;
	    
	    //add more fields group
	    $(".addMore").click(function(){
	        if($('body').find('.fieldGroup').length < maxGroup){
	            var fieldHTML = '<div class="fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
	            $('body').find('.fieldGroup:last').after(fieldHTML);
	        }else{
	            alert('Maximum '+maxGroup+' groups are allowed.');
	        }
	    });
	    
	    //remove fields group
	    $("body").on("click",".remove",function(){ 
	        $(this).parents(".fieldGroup").remove();
	    });
	});
</script>