<?php

/* Template Name: Home Temp */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header('');

?>

<div class="wrapper wrapper-content">
  <div class="container">
			<?php
			//if( strtotime($database_date) > strtotime('now') ) {
				if (strtotime('12/01/19') > strtotime('now')) {
					?>
					<div class="sale-announcement">
						<h2>Black Friday Sale</h2>
						<h3>Our Best Prices Ever</h3>
					</div>

					<style media="screen">
						.sale-announcement {
							background-color: yellow;
							margin: 10px auto;
							text-align: center;
							padding: 10px;
							transition: all 2s;
							font-size: 14.5px;
							width: 415px;
							max-width: 100%;
						}
						.sale-announcement h2, .sale-announcement h3 {
							font-weight: 900;
						}
						.sale-announcement h2 {
							font-size: 2em;
						}
						.sale-announcement h3 {
							font-size: 1.75em;;
						}
						.changed-color {
							color: yellow;
							background-color: black;
						}
					</style>

					<script type="text/javascript">

						changeColorsSalesAnnouncement();

						window.setInterval(changeColorsSalesAnnouncement, 2000);

						function changeColorsSalesAnnouncement() {
							var $change = jQuery('.sale-announcement');
								console.log ($change);
							if ($change.hasClass("changed-color")) {
								$change.removeClass("changed-color");
							} else {
								$change.addClass("changed-color");
							}
						}

					</script>
					<?php
				}
			?>


		<h5 style="text-align: center;font-size: 15px;padding: 10px;font-weight: bold;" class=" my-3">
			If you have any questions, <a href="tel:18019006003">Call</a> &nbsp;or &nbsp;<a href="sms:18019006003">Text</a> 801-900-6003<br>
		</h5>

		<!-- <div class="row mb-3">
			<div class="col-12">
				<a href="https://saltauto.com/quick-qualify/">
					<picture id="quick-qualify-banner">
				    <source srcset="/wp-content/uploads/2019/03/banner-set1-468x60.png" media="(max-width: 600px)">
				    <source srcset="/wp-content/uploads/2019/03/banner-set1-728X90.png" media="(max-width: 860px)">
				    <img src="/wp-content/uploads/2019/03/banner-set1-970X90.png" alt="Get Pre-Approved in Seconds! No Effect on Credit Score. No SSN or DOB!">
					</picture>
				</a>
			</div>
		</div> -->

		<div class="row">
      <?php
      $filepath = wp_upload_dir()['basedir'] . '/Cars/' . 'cars.csv';
      //echo $filepath . '<br>';
      //var_dump(wp_upload_dir());
      $csv = file_get_contents($filepath);
      $csv = explode(PHP_EOL, $csv);
      foreach ($csv as $key => $value) {
        $csv[$key] = str_getcsv($value);
      }
      $csv_fixed = [];
      for ($i=1; $i < count($csv) ; $i++) {
        if (is_null($csv[$i][0])) continue;
        for ($j=0; $j < count($csv[0]); $j++) {
          $csv_fixed[$i-1][$csv[0][$j]] = $csv[$i][$j];
        }
      }
      ?>

			<hr class="w-100 mt-0">

			<?php if( current_user_can('editor') || current_user_can('administrator') ) : ?>
				<h4 class="text-center col-12">
					<?php
					$total_internet_price = 0;
					$total_profit = 0;
					foreach ($csv_fixed as $car_index => $car) {
						$total_internet_price += $car["Internet Price"];
						$total_profit += ($car["Internet Price"] - $car["Total Cost"]);
					}
					echo "Total Price of " . count($csv_fixed) . " Vehicles: $" . number_format($total_internet_price) . " ($" . number_format($total_profit) . ")";
					?>
				</h4>
				<!-- <h3>$_REQUEST = <?php var_dump($_REQUEST); ?></h3> -->


			<?php endif; ?>

			<?php
			get_template_part('template-parts/filter');
			get_template_part('template-parts/filterExecution');
			get_template_part('template-parts/sortFilter');
			get_template_part('template-parts/carPrint');
			displayCarFilter($csv_fixed);
			?>

      <?php
			$stock_found = false;

			$sortBy = isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] !== "" ? $_REQUEST["sortBy"] : "default";
			$csv_fixed = sortFilter($csv_fixed, $sortBy);

			// if( current_user_can('editor') || current_user_can('administrator') ) {
			// 	sortFilter($csv_fixed, $sortBy);
			// }

			foreach ($csv_fixed as $car_index => $car):
				if (carPrint($car_index, $car)) {
					$stock_found = true;
				};
			endforeach; // endforeach $csv_fixed

			if ($stock_found == false) {
				?>
				<div class="col-12">
					<h2 class="text-center">
						Car Not Found<br>
						Questions? <span class="d-inline-block"><a href="tel:+18019006003">Call/Text 801-900-6003</a></span></h2>
					<p class="text-center"><a href="/">Click here to go back to full inventory.</a></p>
				</div>

				<?php
			}

			?>

			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div class="accordian w-100" id="accordianHomeAdmin">
					<div class="card">
						<div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Show var_dump for $csv
				        </button>
				      </h2>
				    </div>
				    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordianHomeAdmin">
				      <pre class="card-body"><?php var_dump($csv); ?></pre>
				    </div>
					</div>

					<div class="card">
				    <div class="card-header" id="headingTwo">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Show var_dump for $csv_fixed
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordianHomeAdmin">
				      <div class="card-body">
					      <pre class="card-body"><?php var_dump($csv_fixed); ?></pre>
				      </div>
				    </div>
				  </div>

				</div>
			<?php } ?>

    </div><!-- end row -->

  </div>
</div><!-- Wrapper end -->

<?php
get_template_part('template-parts/style');
get_template_part('template-parts/js');
?>

<?php get_footer(); ?>
