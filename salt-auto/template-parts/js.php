
<script type="text/javascript">
	$(() => {
		$('.monthly-payment-tooltip').tooltip()
	})
</script>

<!-- Car Gurus Badge Script -->
<script>
  var CarGurus = window.CarGurus || {}; window.CarGurus = CarGurus;
  CarGurus.DealRatingBadge = window.CarGurus.DealRatingBadge || {};
CarGurus.DealRatingBadge.options = {
 "style": "STYLE1",
 "minRating": "FAIR_PRICE",
 "defaultHeight": "35"
};

(function() {
    var script = document.createElement('script');
    script.src = "https://static.cargurus.com/js/api/en_US/1.0/dealratingbadge.js";
    script.async = true;
    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
</script>

<!-- Bluestar Badge Script -->
<script type="text/javascript">
	// $( document ).ready(function() {
	// 	console.log( "ready!" );
  //
	// 	jQuery("[data-bluestar-vin]").each(function() {
	// 		var $this = jQuery(this);
	// 		var url = "https://www.bluestar.com/app/api/getreportlink";
	// 		var formData = {
	// 			bluestar_api: "08bd649c6437c81babcef49a45b56593",
	// 			vin : $this.data('bluestar-vin')
	// 		};
  //
	// 		jQuery.ajax({
	// 			type: 'POST',
	// 			url: url,
	// 			data: formData,
	// 			success: function (response, status, xhr) {
	// 				console.log(response);
	// 				if (!response["report_url"]) {
	// 					return;
	// 				}
  //
	// 				var url = response["report_url"].split( '/' );
	// 				jQuery($this)[0].href =
	// 					"https://www.bluestar.com/app/inspection-report/view-web/" + url[ url.length - 2 ] + "/" + url[ url.length - 1 ];
  //
	// 				$this.parent('.car-bluestar').css('display','block');
	// 			}
	// 		});
  //
	// 	});
	// });
</script>
