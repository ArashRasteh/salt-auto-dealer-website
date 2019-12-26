<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = 'container'
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">


			<div class="contact-info my-2 text-center">
				<h3 class="">Contact Us</h3>
				<div class="row">
					<div class="col-md-4 my-1">
						Call: <a href="tel:18019006003">801-900-6003</a>
					</div>
					<div class="col-md-4 my-1">
						Text: <a href="sms:18019006003">801-900-6003</a>
					</div>
					<div class="col-md-4 my-1">
						Email: <a href="mailto:ash@saltauto.com">ash@saltauto.com</a>
					</div>
					<div class="col-12 my-1">
						Address: <a class="d-inline-block" href="https://goo.gl/maps/CHqDFmuGZBxrHomk8">3771 S State St, Salt Lake City, UT 84115</a>
					</div>
				</div>
			</div>

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info text-center">

						&copy; <?php echo date('Y'); ?> - <?php bloginfo( 'name' ); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->


<?php wp_footer(); ?>

<!-- Start of McAfee Secure Embed Code -->
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
<!-- End of McAfee Secure Embed Code -->

<!-- Start of HubSpot Embed Code -->
  <!-- <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5006669.js"></script> -->
<!-- End of HubSpot Embed Code -->

</body>

</html>
