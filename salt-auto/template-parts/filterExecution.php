<?php

//This function is used to execute the filter, if does not fit within filter will return true

function filterExecution($car) {
  if (count($_REQUEST) > 0) {

    if (isset($_REQUEST["STOCK"])) {
      if ($car["STOCK"] != $_REQUEST["STOCK"]) return true;
    }
    else {
      //filter by year
      if (isset($_REQUEST["minYear"]) || isset($_REQUEST["maxYear"])) {
        $filterStartYear = $_REQUEST["minYear"] ?: 0;
        $filterEndYear = $_REQUEST["maxYear"] ?: 5000;

        // fix years, incase reversed
        if ($filterStartYear > $filterEndYear ) {
          $filterTempYear = $filterEndYear;
          $filterEndYear = $filterStartYear;
          $filterStartYear = $filterTempYear;
        }

        if ($car['YEAR'] < $filterStartYear) return true;
        else if ($car['YEAR'] > $filterEndYear) return true;
      }

      //filter by Mileage
      if (isset($_REQUEST["minMiles"]) || isset($_REQUEST["maxMiles"])) {
        $filterMinMiles = $_REQUEST["minMiles"] ?: 0;
        $filterMaxMiles = $_REQUEST["maxMiles"] ?: 999999;

        if ($filterMinMiles > $filterMaxMiles) {
          $filterTempMiles = $filterMaxMiles;
          $filterMaxMiles = $filterMinMiles;
          $filterMinMiles = $filterTempMiles;
        }

        if ($car['Mileage'] < $filterMinMiles) return true;
        else if ($car['Mileage'] > $filterMaxMiles) return true;
      }

      //filter by Price
      if (isset($_REQUEST["minPrice"]) || isset($_REQUEST["maxPrice"])) {
        $filterMinPrice = $_REQUEST["minPrice"] ?: 0;
        $filterMaxPrice = $_REQUEST["maxPrice"] ?: 999999;

        if ($filterMinPrice > $filterMaxPrice) {
          $filterTempPrice = $filterMaxPrice;
          $filterMaxPrice = $filterMinPrice;
          $filterMinPrice = $filterTempPrice;
        }

        if ($car['Internet Price'] < $filterMinPrice) return true;
        else if ($car['Internet Price'] > $filterMaxPrice) return true;
      }

      //filter by type
      if (isset($_REQUEST["vehicleType"]) && $_REQUEST["vehicleType"] && $_REQUEST["vehicleType"] != $car['Vehicle Type'] )
      {
        return true;
      }

      //filter by drivetrain
      if (isset($_REQUEST["vehDrivetrain"]) && $_REQUEST["vehDrivetrain"]) {
        $filterVehDrivetrain = $_REQUEST["vehDrivetrain"] ?: "";

        if ($filterVehDrivetrain == "AWD/4WD") {
          if ($car['Drive Train'] == "AWD" || $car['Drive Train'] == "4WD" ) {return false;}
          else return true;
        }
        else if ($car['Drive Train'] !== $filterVehDrivetrain) return true;
        // Drive Train
      }

    }
  }
}
