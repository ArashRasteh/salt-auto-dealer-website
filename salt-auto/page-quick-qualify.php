<?php

/* Template Name: Quick Qualify */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header('');

// https://www.700dealer.com/QuickQualify/09b8bfeb12144217a1ba16d577da3ec8-201926?vin=VINPLACEHOLDER

$qqcarvinexists = false;

if( current_user_can('editor') || current_user_can('administrator') ) :
  ?>
  <!-- <h3>$_REQUEST = <?php var_dump($_REQUEST); ?></h3> -->
  <?php
endif;

if (count($_REQUEST) > 0) {
  if (isset($_REQUEST["vin"])) {
    $qqcarvinexists = true;
  }
}

?>

<div class="wrapper wrapper-content">

  <div class="headline container mt-3">
    <h1>Fill out the information below to get Prequalified</h1>
    <h3>
      No effect on Credit Score
      <br>No SSN or DOB
    </h3>
    <?php if ($qqcarvinexists): ?>
      <h3><?php echo urldecode($_REQUEST["carinfo"]); ?></h3>
    <?php endif; ?>
  </div>

  <iframe id="quick-qualify" src="https://www.700dealer.com/QuickQualify/09b8bfeb12144217a1ba16d577da3ec8-201926?<?php echo $_SERVER['QUERY_STRING'] ?>" width="700" height="1000"></iframe>
</div><!-- .wrapper wrapper-content end -->

<style media="screen">
  .wrapper.wrapper-content {
    min-height: 50vh;
  }

  iframe#quick-qualify {
    width: 100%;
    min-height: 1400px;
    border: 0;
  }

  .headline h1 {
    font-size: 1.5rem;
    text-align: center;
    font-weight: bold;
  }
  .headline h3 {
    font-size: 1.25rem;
    text-align: center;
  }
</style>

<?php get_footer(); ?>
