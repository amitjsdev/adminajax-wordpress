<script>
jQuery(document).ready(function($){
		$("#studentBtn").click(function(event){
			//event.preventDefault(); 
			var student_code = $('.student_code').val();
			var paidAmount = $('.paidAmount').val();
					var stdCode  = student_code.trim();
			if(stdCode == ""){
				alert("Please fill the Student Promocode!");
				return false;
			}
			//alert('<?php echo get_site_url();?>/event-payment-complete/?'+stdCode);
			$.ajax({
						 url: '<?php echo admin_url('admin-ajax.php'); ?>',
						 type: 'POST',
						 data: {'action': 'my_ajax_request', 'promocode': stdCode},
						 //dataType: "xml",
						 success: function(data) {
							 if(data == 1){
									$('.passCustom').val(stdCode);
									$('.returnUrl').val('<?php echo get_site_url();?>/event-payment-complete/?studentCode='+stdCode+'&paidAmount='+paidAmount);
								 	 $('.invlidPromo').css("display","none");
									$('#payStdent').trigger('click');
							 }else{
								  	 $('.invlidPromo').css("display","inline-block");
							 }
						
							
						},
						error: function(xhr, textStatus, errorThrown){							
									console.log('something going wrong please try again.');
								}  
				   });
		}); 
		
	
});	
</script>
<?php
//katalformsbmt
  add_action( 'wp_ajax_my_ajax_request', 'tft_handle_ajax_request' );
  add_action( 'wp_ajax_nopriv_my_ajax_request', 'tft_handle_ajax_request' );
  function tft_handle_ajax_request() {
	  global $wpdb;
	  $promoCode = $_POST['promocode'];
	   $tablename=$wpdb->prefix.'register_student';
  		$promoChek=$wpdb->get_results( "SELECT * FROM `$tablename` where promoCode='$promoCode' AND paymentStatus = 'No'");
			
			echo $relt_count = $wpdb->num_rows;
		/* 	if($relt_count != 0){
				    echo '1';
					student90k4
			} */

    exit;
  }
  