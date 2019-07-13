
    <!-- jquery -->
    <script src="js/jquery-2.1.3.min.js"></script>

	<!-- excell and pdf - mora biti ovdje po redoslijedu -->
    <script src="js/jQuery_xcl_pdf_export.js"></script>

	<!--[if (gte IE 6)&(lte IE 8)]>
	<script src="js/selectivizr.js"></script>
	<![endif]-->
		
    <!-- excell & pdf -->
    <script src="lib/jspdf.js"></script>
    <script src="lib/jspdf.debug.js" type="text/javascript" ></script>
	
	<!-- bootstrap -->
    <script src="js/jquery-1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootswatch.js"></script>
	
	<!-- live search -->
	<script src="js/jquery.quicksearch.js"></script>
	<script>
		$(document).ready(function () {
			$("#id_search").quicksearch("table tbody tr", {
				noResults: '#noresults',
				stripeRows: ['odd', 'even'],
				loader: 'span.loading',
				minValLength: 2
			});
		});
	</script>
    <!-- live search -->
    <script src="js/modal.js"></script>
    <script src="js/jquery.datepicker.js"></script>
</body>
</html>