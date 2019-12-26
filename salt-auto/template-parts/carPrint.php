<?php

function carPrint($car_index, $car) {

  if ((int) $car['Retail Price'] != 0 && $car['VIN']):?>

    <?php
    if (filterExecution($car)) return;

    $stock_found = true;

    $car_photos = explode( ',', $car["Photo URLs"]);

  ?>
  <div class="col-md-12">
    <div class="car-card" id="<?php echo $car['STOCK']; ?>">
      <div class="row">

        <a href="https://saltauto.com?STOCK=<?php echo $car['STOCK']; ?>" class="w-100 d-block d-md-none">
          <h4 class="car-title col-12 text-center"><?php echo $car['YEAR'] . ' ' . $car['MAKE'] . ' ' . $car['MODEL'] . ' ' . $car['STYLE']; ?></h4>
        </a>

        <div class="car-images-wrapper col-md-12 col-lg-8 offset-lg-2">
          <!-- <img src="<?php echo $car_photos[0] ?>" alt="" class="car-placeholder-img"> -->
          <div class="car-images car-images-<?php echo $car_index; ?> owl-carousel owl-theme ">
            <?php foreach ($car_photos as $photo_key => $photo_url): ?>
              <div class="item">
                <?php if (substr ( $photo_url , 0, 12) == "saltauto.com") {
                  $photo_url = "https://" . $photo_url;
                }  ?>
                <img class="owl-lazy" data-src="<?php echo $photo_url; ?>">
              </div>
            <?php endforeach; ?>
          </div>

        </div>


        <div class="car-info col-md-5">
          <div class=" px-3 mt-3">
            <a href="https://saltauto.com?STOCK=<?php echo $car['STOCK']; ?>">
              <h4 class="car-title d-none d-md-block"><?php echo $car['YEAR'] . ' ' . $car['MAKE'] . ' ' . $car['MODEL'] . ' ' . $car['STYLE']; ?></h4>
            </a>
            <div class="car-infos">Stock: &nbsp;<?php echo $car['STOCK']; ?></div>
            <div class="car-infos">Mileage: &nbsp;<?php echo number_format($car['Mileage']); ?></div>
            <div class="car-infos">VIN: &nbsp;<?php echo $car['VIN']; ?></div>
            <div class="car-title">Title: <?php
              echo $car["New/Used"] == "Used" ? 'Clean' : $car["New/Used"];
            ?></div>
            <?php if ($car['Transmission'] == "Continuously Variable") $car['Transmission'] = "Automatic, CVT"?>
            <div class="car-infos">Transmission: &nbsp;<?php echo $car['Transmission']; ?></div>

            <div class="car-prequalify">
              <a href="https://www.dealfi.com/pre-qualify?VIN=SaltAuto<?php echo urlencode($car['VIN']) ?>" target="_blank">
                Get Pre-approved Through DealFi
              </a>
            </div>

            <div class="car-price">
              <?php $reduced_price = $car["Internet Price"] != $car['Retail Price']; ?>
              <span class="car-retail <?php //echo $reduced_price ? 'reduced' : '' ?>">
                $<?php echo number_format($car['Internet Price']); ?>
              </span>
              <?php if (false): //$reduced_price): ?>
                <span class="car-reduced-retail">
                  &nbsp;$<?php echo number_format($car['Internet Price']); ?> - Price Reduced!
                </span>
              <?php endif; ?>
              <i class="fas fa-info-circle monthly-payment-tooltip" data-toggle="tooltip" title="Cash Price or On Approved Credit"></i>
            </div>

            <?php if (true): //date('Y') - 11 <= $car['YEAR']): ?>
              <div class="car-monthly" <?php //if ($car["Monthly Payment"] == "0.00") echo "hidden"; ?>>
                <?php
                $monthly_per_thousand = 16.11; //based on tooltip below
                if ($car['YEAR'] >= 2016) $calculated_reg = 224.75;
                  elseif ($car['YEAR'] >= 2013 && $car['YEAR'] < 2016) $calculated_reg = 184.75;
                  elseif ($car['YEAR'] >= 2010 && $car['YEAR'] < 2013) $calculated_reg = 154.75;
                  elseif ($car['YEAR'] >= 2007 && $car['YEAR'] < 2010) $calculated_reg = 124.75;
                  elseif ($car['YEAR'] < 2007) $calculated_reg = 84.75;
                $calculated_payment = ((( $car['Internet Price'] + 299 ) * 1.071 ) + $calculated_reg ) * $monthly_per_thousand / 1000;
                ?>
                $<span class="car-monthly-payment"><?php echo number_format($calculated_payment); ?></span> per Month
                <i class="fas fa-info-circle monthly-payment-tooltip" data-toggle="tooltip" title="With Approved Credit. $0 down, 72mo @ 4.99% (Based on best rates as of Saturday, December 01, 2018). The monthly payment includes Tax, Registration, and Fees. Contact us at 801-900-6003 for details.
                "></i>
              </div>
            <?php endif; ?>

            <div class="car-badges row">

              <div class="car-report car-badge col-12 col-md-6 text-center">
                <?php
                $carfax_img_url = strpos(strtolower($car['Features']), 'one owner') !== false ||
                  strpos(strtolower($car['Features']), '1 owner')  !== false ?
                  '/wp-content/uploads/2018/10/carfax_icon_1owner.gif' :
                  '/wp-content/uploads/2018/10/carfax_icon_show_me.gif';
                ?>
                <a href='http://www.carfax.com/VehicleHistory/p/Report.cfx?partner=DVW_1&vin=<?php echo $car['VIN']; ?>' target="_blank"><img src='<?php echo $carfax_img_url; ?>' width='155' height='56' border='0' /></a>
              </div>

              <div class="car-bluestar car-badge col-12 col-md-6 text-center" style="display: none;">
                <a data-bluestar-vin="<?php echo $car['VIN']; ?>" src="" target="_blank">
                  <img src="/wp-content/uploads/2019/08/bluestar-button.png" alt="View Inspection Report: Bluestar">
                </a>
              </div>

              <!-- <div class="quick-qualify-badge-link car-badge col-12 col-md-6">
                <a href="/quick-qualify?<?php
                  echo 'vin=' . urlencode($car['VIN']);
                  //echo '&year=' . $car['YEAR'];
                  echo '&make=' . urlencode($car['MAKE']);
                  echo '&model=' . urlencode($car['MODEL']);
                  echo '&carinfo=' . urlencode( $car['YEAR'] . ' ' . $car['MAKE'] . ' ' . $car['MODEL'] . ' ' . $car['STYLE'] . ' - '
                    . number_format($car['Mileage']) .  ' mi - $' . number_format($car['Internet Price']) );
                ?>">
                  <img src="/wp-content/uploads/2019/03/banner-set1-small.png" alt="Click Here for Instant Pre-Approval">
                </a>
              </div> -->

              <div class="car-cargurus car-badge col-12 col-md-6 text-center">
                <span data-cg-vin="<?php echo $car['VIN']; ?>"
                  data-cg-price="<?php echo $car['Internet Price']; ?>">
                </span>
              </div>

            </div><!-- end .car-badges -->




          </div>
        </div>

        <div class="car-features col-md-7">
          <div class="px-3 mt-3"><?php echo preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $car['Features']); ?></div>
        </div>
      </div>



    </div>
  </div>

  <script type="text/javascript">
    $(function() {
      $('.car-images-<?php echo $car_index; ?>').owlCarousel({
        items: 1,
        loop: true,
        lazyLoad: true,
        <?php if (isset($_REQUEST["STOCK"])) echo "lazyLoadEager: 3,"; else echo "lazyLoadEager: 1,"; ?>
        dots: false,
        nav: true,
        autoHeight:true,
        width: 1024
      });
    });
  </script>

  <hr class="w-100">

  <?php endif; //endif no VIN

  return true;
}
