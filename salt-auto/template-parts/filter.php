<?php function displayCarFilter($csv_fixed) {
?>

<div id="filterFormWrapper">

  <h4 id="filterFormHider" class="collapsed desktop" data-toggle="collapse" data-target="#filterForm" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-caret-down left-caret-down"></i> Filters <i class="fas fa-caret-down"></i></h4>

  <h4 id="filterFormHider" class="mobile">Filters</h4>

  <form id="filterForm" action="/" method="get" class="collapse" aria-labelledby="headingOne" data-parent="#filterFormWrapper">

    <?php
    $yearsArr = [];
    $vehicleTypeArr = [];
    $vehicleTypeCount = [];
    $vehicleDrivetrainArr = [];
    $vehicleDrivetrainCount = [];
    $minPriceAllCars = 999999;
    $maxPriceAllCars = 0;

    foreach ($csv_fixed as $car_index => $car) {
      array_push($yearsArr,$car['YEAR']);
      array_push($vehicleTypeArr,$car['Vehicle Type']);
      array_push($vehicleDrivetrainArr,$car['Drive Train']);

      if ($minPriceAllCars > $car['Internet Price']) $minPriceAllCars = $car['Internet Price'];
      if ($maxPriceAllCars < $car['Internet Price']) $maxPriceAllCars = $car['Internet Price'];
    }

    $yearsArr = array_unique($yearsArr); sort($yearsArr);
    $vehicleTypeCount = array_count_values($vehicleTypeArr);
    $vehicleTypeArr = array_unique($vehicleTypeArr); sort($vehicleTypeArr);
    $vehicleDrivetrainCount = array_count_values($vehicleDrivetrainArr);
    $vehicleDrivetrainArr = array_unique($vehicleDrivetrainArr); sort($vehicleDrivetrainArr);
    $minPriceAllCars = floor($minPriceAllCars/1000); if ($minPriceAllCars % 2 !== 0) $minPriceAllCars -= 1; $minPriceAllCars *= 1000;
    $maxPriceAllCars = ceil($maxPriceAllCars/1000); if ($maxPriceAllCars % 2 !== 0) $maxPriceAllCars += 1; $maxPriceAllCars *= 1000;

    ?>
    <?php if( current_user_can('editor') || current_user_can('administrator') ): ?>
      <pre hidden> <?php var_debug($csv_fixed) ?></pre>
    <?php endif; ?>

    <div id="filterSort" class="filter-wrapper">
      <label class="">Sort By:</label>
      <div class="filter-inputs">
        <select class="custom-select wide" name="sortBy">
          <option <?php if ( !isset($_REQUEST["sortBy"]) || isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "default") {echo "selected";} ?> value="default">Default</option>
          <!-- <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "stockNumber") {echo "selected";} ?> value="stockNumber">Stock Number</option> -->
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "mileageLow") {echo "selected";} ?> value="mileageLow">Mileage Low</option>
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "mileageHigh") {echo "selected";} ?> value="mileageHigh">Mileage High</option>
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "priceLow") {echo "selected";} ?> value="priceLow">Price Low</option>
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "priceHigh") {echo "selected";} ?> value="priceHigh">Price High</option>
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "yearLow") {echo "selected";} ?> value="yearLow">Year Low</option>
          <option <?php if (isset($_REQUEST["sortBy"]) && $_REQUEST["sortBy"] == "yearHigh") {echo "selected";} ?> value="yearHigh">Year High</option>
        </select>
      </div>
    </div>

    <div id="filterType" class="filter-wrapper">
      <label class="">Vehicle Type:</label>
      <div class="filter-inputs">
        <select class="custom-select wide" name="vehicleType">
          <option value="">All</option>
          <?php for ($i=0; $i < count($vehicleTypeArr); $i++) {
            $selected = "";
            if (isset($_REQUEST["vehicleType"]) && $_REQUEST["vehicleType"] == $vehicleTypeArr[$i]) {$selected = "selected";}
            echo "<option " . $selected . " value=\"" . $vehicleTypeArr[$i] . "\">" . $vehicleTypeArr[$i] . " (" . $vehicleTypeCount[$vehicleTypeArr[$i]] . ")</option>";
          } ?>
        </select>
      </div>
    </div>

    <div id="filterDrivetrain" class="filter-wrapper">
      <label class="">Drivetrain:</label>
      <div class="filter-inputs">
        <select class="custom-select wide" name="vehDrivetrain">
          <option value="">All</option>
          <?php
          for ($i=0; $i < count($vehicleDrivetrainArr); $i++) {
            $selected = "";
            if (isset($_REQUEST["vehDrivetrain"]) && $_REQUEST["vehDrivetrain"] == $vehicleDrivetrainArr[$i]) {$selected = "selected";}

            echo "<option " . $selected . " value=\"" . $vehicleDrivetrainArr[$i] . "\">" . $vehicleDrivetrainArr[$i] . " (" . $vehicleDrivetrainCount[$vehicleDrivetrainArr[$i]] . ")</option>";
          }
          $combine4wdAwdSelected = "";
          $comine4wdAwdTotal = ($vehicleDrivetrainCount["AWD"] ?: 0) + ($vehicleDrivetrainCount["4WD"] ?: 0);
          if (isset($_REQUEST["vehDrivetrain"]) && $_REQUEST["vehDrivetrain"] == "AWD/4WD") { $combine4wdAwdSelected = "selected"; };
          echo "<option " . $combine4wdAwdSelected . ' value="AWD/4WD">AWD/4WD (' . $comine4wdAwdTotal . ")</option>";

          ?>
        </select>
      </div>
    </div>

    <div id="filterYears" class="filter-wrapper">
      <label class="">Years:</label>
      <div class="filter-inputs">
        <select class="custom-select" name="minYear">
          <?php for ($i=0; $i < count($yearsArr); $i++) {
            $selected = "";
            if ($i == 0 && !isset($_REQUEST["minYear"])) {$selected = "selected";}
            else if (isset($_REQUEST["minYear"]) && $_REQUEST["minYear"] == $yearsArr[$i]) {$selected = "selected";}
            echo "<option " . $selected . " value=\"" . $yearsArr[$i] . "\">" . $yearsArr[$i] . "</option>";
          } ?>
        </select> to
        <select class="custom-select" name="maxYear">
          <?php rsort($yearsArr);
          for ($i=0; $i < count($yearsArr); $i++) {
            $selected = "";
            if ($i == 0  && !isset($_REQUEST["maxYear"])) {$selected = "selected";}
            else if (isset($_REQUEST["maxYear"]) && $_REQUEST["maxYear"] == $yearsArr[$i]) {$selected = "selected";}
            echo "<option " . $selected . " value=\"" . $yearsArr[$i] . "\">" . $yearsArr[$i] . "</option>";
          } ?>
        </select>
      </div>
    </div>

    <div class="filter-wrapper" id="filterMiles">
      <label class="">Mileage:</label>
      <div class="filter-inputs">
        <?php
        $minMiles = isset($_REQUEST["minMiles"]) ? $_REQUEST["minMiles"] : "";
        $maxMiles = isset($_REQUEST["maxMiles"]) ? $_REQUEST["maxMiles"] : "";
        ?>
        <!-- <input name="minMiles" class="form-control" value="<?php echo $minMiles; ?>"> -->
        <select class="custom-select" name="minMiles">
          <?php
            for ($i=0; $i < 16; $i++) {
              $selected = "";
              if ($i * 10000 == 0  && !isset($_REQUEST["minMiles"]) ) {$selected = "selected";}
              else if (isset($_REQUEST["minMiles"]) && $_REQUEST["minMiles"] == $i * 10000) {$selected = "selected";}
              ?> <option <?php echo $selected; ?> value="<?php echo $i * 10000; ?>"><?php echo number_format($i * 10000); ?></option> <?php
            }
          ?>
        </select>
         to
        <!-- <input name="maxMiles" class="form-control" value="<?php echo $maxMiles; ?>"> -->
        <select class="custom-select" name="maxMiles">
          <?php
            for ($i=1; $i < 17; $i++) {
              $selected = "";
              if (isset($_REQUEST["maxMiles"]) && $_REQUEST["maxMiles"] == $i * 10000) {$selected = "selected";}
              else if ($i * 10000 == 160000) {$selected = "selected";}
              if ($i * 10000 == 160000) {
                ?> <option <?php echo $selected; ?> value="9999999">Infinity</option> <?php
              } else {
                ?> <option <?php echo $selected; ?> value="<?php echo $i * 10000; ?>"><?php echo number_format($i * 10000); ?></option> <?php
              }

            }
          ?>
        </select>
      </div>
    </div>

    <div class="filter-wrapper" id="filterPrice">
      <label class="">Price:</label>
      <div class="filter-inputs">
        <?php
        $minPrice = isset($_REQUEST["minPrice"]) ? $_REQUEST["minPrice"] : "";
        $maxPrice = isset($_REQUEST["maxPrice"]) ? $_REQUEST["maxPrice"] : "";
        ?>
        <!-- <input name="minPrice" class="form-control" value="<?php echo $minPrice; ?>"> -->
        <select class="custom-select" name="minPrice">
          <?php
            for ($i=0; $i < 100; $i++) {
              if ($i * 2000 < $minPriceAllCars || $i * 2000 > $maxPriceAllCars) continue;
              $selected = "";
              if ($i * 2000 == $minPriceAllCars  && !isset($_REQUEST["minPrice"])) {$selected = "selected";}
              else if (isset($_REQUEST["minPrice"]) && $_REQUEST["minPrice"] == $i * 2000) {$selected = "selected";}
              ?> <option <?php echo $selected; ?> value="<?php echo $i * 2000; ?>"><?php echo '$' . number_format($i * 2000); ?></option> <?php
            }
          ?>
        </select> to
        <!-- <input name="maxPrice" class="form-control" value="<?php echo $maxPrice; ?>"> -->
        <select class="custom-select" name="maxPrice">
          <?php
            for ($i=0; $i < 100; $i++) {
              if ($i * 2000 < $minPriceAllCars || $i * 2000 > $maxPriceAllCars) continue;
              $selected = "";
              if ($i * 2000 == $maxPriceAllCars  && !isset($_REQUEST["maxPrice"])) {$selected = "selected";}
              else if (isset($_REQUEST["maxPrice"]) && $_REQUEST["maxPrice"] == $i * 2000) {$selected = "selected";}
              ?> <option <?php echo $selected; ?> value="<?php echo $i * 2000; ?>"><?php echo '$' . number_format($i * 2000); ?></option> <?php
            }
          ?>
        </select>
      </div>
    </div>

    <button class="btn btn-outline-success mb-2" type="submit">SEARCH</button>
    <button class="btn btn-outline-secondary" type="button" onclick="window.location.href='/'">Reset</button>
  </form>
</div>


<style media="screen">
#filterFormWrapper {
  margin: auto;
  margin-bottom: 1rem;
  width: 224.6px;
  max-width: 100%;
}

#filterFormWrapper h4 {
  text-align: center;
  border-bottom: 1px solid black;
  padding-bottom: 0.5rem;
  cursor: pointer;
  text-transform: uppercase;
  user-select: none
}
#filterFormWrapper h4.mobile {
  display: none;
}

#filterFormWrapper h4 i {
  transform: translate(0px, -2px) rotate(-540deg);
  transition: transform 0.75s;
}

#filterFormWrapper h4 i.left-caret-down {
  transform: translate(0px, -2px) rotate(540deg);
}

#filterFormWrapper h4.collapsed i {
  transform: translate(0px, 2px) rotate(0deg);
}

#filterForm {
  position: absolute;
  z-index: 4;
  background-color: white;
  padding: 10px;
  width: 250px;
  margin-left: -10px;
  border: 1px solid #e6e6e6;
  border-top: 1px solid black;
  max-width: 100%;
  margin-top: -0.5rem;
  margin-top: calc(-0.5rem - 1px);
  border-bottom-right-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

#filterForm select {
  width: auto;
}
#filterForm select option {
  text-align: center;
}
#filterForm input {
  width: auto;
}

#filterForm .filter-wrapper {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 0.5rem;
}
#filterForm .filter-wrapper label {
  margin: 0;
  margin-right: 1rem;
  font-weight: bold;
  width: 100%;
  line-height: 1.4;
}

#filterForm .filter-inputs {
    display: inline-block;
    max-width: 100%;
    width: 100%;
}
#filterForm .filter-inputs input{
    display: inline-block;
}

#filterForm input, #filterForm select{
    width: 100px;
    max-width: 100%;
}

#filterForm select.wide, #filterForm button {
    width: 224.6px;
}

#filterForm select.custom-select {
    padding-right: 1.5rem;
    padding-left: 0.5rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    height: calc(2rem);
}

@media only screen and (max-width: 575.98px) {
  #filterForm {
    position: relative;
    margin-left: 0;
    display: block;
  }
  #filterFormWrapper {
    width: 247px;
  }
  #filterFormWrapper h4.desktop {
    display: none;
  }
  #filterFormWrapper h4.mobile {
    display: block;
  }
}

</style>


<?php
} ?>
