
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
		$("#novi_operater").validate({
			rules: {
				name: "required",
				lastname: "required",
				email: {
					required: true,
					email: true
				},
				username: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				}
			},
			messages: {
				name: "Ime je obavezno",
				lastname: "Prezime je obavezno",
				email: "Molimo unesite validnu e-mail adresu",
				username: {
					required: "Unesite username",
					minlength: "Username mora imati barem 5 karaktera"
				},
				password: {
					required: "Unesite password",
					minlength: "Password mora imati barem 5 karaktera"
				},
				confirm_password: {
					required: "Unesite password",
					minlength: "Password mora imati barem 5 karaktera",
					equalTo: "Niste unijeli isti password kao u polju iznad. Ponovite unos"
				}
			}
		});
	});
	</script>

</body>
</html>