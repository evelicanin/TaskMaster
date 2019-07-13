
    <!-- jquery -->
    <script src="js/jquery-2.1.3.min.js"></script>
	
	<!--[if (gte IE 6)&(lte IE 8)]>
	<script src="js/selectivizr.js"></script>
	<![endif]-->

	<!-- live search -->
	<script src="js/jQuery-Table-Plugin.js"></script>
	<!-- live search -->
	
    <!-- excell & pdf -->
    <script src="lib/jspdf.js"></script>
    <script src="lib/jspdf.debug.js" type="text/javascript" ></script>
	<!-- excell & pdf -->
		
	<!-- bootstrap -->
    <script src="js/jquery-1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootswatch.js"></script>
	<!-- bootstrap -->

	<script src="js/jquery.validate.min.js"></script>
	<script>
	$.validator.setDefaults({
        submitHandler: function(form) 
		            {  
                           if ($(form).valid()) 
                               form.submit(); 
                           return false; // prevent normal form posting
                    }
	});

	$().ready(function() {

		// validacija forme as custom porukama
		$("#novi_task").validate({
			rules: {
				naslov: "required",
				tip: "required",
				pn: {
					required: true
				},
				sn: {
					required: true,
					minlength: 13
				}
			},
			messages: {
				naslov: "Nslov taska je obavezan",
				tip: "Unesite tip uređaja",
				pn: {
					required: "Unesite PN broj"
				},
				sn: {
					required: "Unesite SN broj",
					minlength: "SN broj mora imati barem 13 karaktera"
				}
			}
		});
	});
	</script>

</body>
</html>