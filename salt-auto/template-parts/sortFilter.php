<?php

function sortFilter($csv_fixed, $sortBy){

  if (count($csv_fixed) == 0) return;

  switch ($sortBy) {
    case 'stockNumber':
      break;


    case 'mileageLow':
    case 'mileageHigh':

      $sortArr = $csv_fixed;

      for ($k=0; $k < count($sortArr); $k++) {
        for ($i=0; $i < count($sortArr) - 1; $i++) {

          if ( $sortArr[$i]["Mileage"] < $sortArr[$i+1]["Mileage"] ) {
            $tempCar = $sortArr[$i];
            $sortArr[$i] = $sortArr[$i+1];
            $sortArr[$i+1] = $tempCar;
          }
        }
      }

      if ($sortBy == 'mileageLow') $sortArr = array_reverse($sortArr);

      $csv_fixed = $sortArr;

      break;


    case 'priceLow':
    case 'priceHigh':

      $sortArr = $csv_fixed;

      for ($k=0; $k < count($sortArr); $k++) {
        for ($i=0; $i < count($sortArr) - 1; $i++) {

          if ( $sortArr[$i]["Internet Price"] < $sortArr[$i+1]["Internet Price"] ) {
            $tempCar = $sortArr[$i];
            $sortArr[$i] = $sortArr[$i+1];
            $sortArr[$i+1] = $tempCar;
          }
        }
      }

      if ($sortBy == 'priceLow') $sortArr = array_reverse($sortArr);

      $csv_fixed = $sortArr;

      break;


    case 'yearLow':
    case 'yearHigh':

      $sortArr = $csv_fixed;

      for ($k=0; $k < count($sortArr); $k++) {
        for ($i=0; $i < count($sortArr) - 1; $i++) {

          if ( $sortArr[$i]["YEAR"] < $sortArr[$i+1]["YEAR"] ) {
            $tempCar = $sortArr[$i];
            $sortArr[$i] = $sortArr[$i+1];
            $sortArr[$i+1] = $tempCar;
          }
        }
      }

      if ($sortBy == 'yearLow') $sortArr = array_reverse($sortArr);

      $csv_fixed = $sortArr;

      break;


    case 'default': //sorted by percent of profit vs total cost
    default:
      $sortArr = $csv_fixed;

      for ($k=0; $k < count($sortArr); $k++) {
        for ($i=0; $i < count($sortArr) - 1; $i++) {
          $currentCarCost = $sortArr[$i]["Total Cost"] != 0 ? $sortArr[$i]["Total Cost"] : ($sortArr[$i]["Internet Price"] ?: 20000);
          $nextCarCost = $sortArr[$i+1]["Total Cost"] != 0 ? $sortArr[$i+1]["Total Cost"] : ($sortArr[$i+1]["Internet Price"] ?: 20000);
          $CurrentCarProfit = ($sortArr[$i]["Internet Price"] - $currentCarCost) / $currentCarCost;
          $NextCarProfit = ($sortArr[$i+1]["Internet Price"] - $nextCarCost) / $nextCarCost;

          if ($CurrentCarProfit < $NextCarProfit) {
            $tempCar = $sortArr[$i];
            $sortArr[$i] = $sortArr[$i+1];
            $sortArr[$i+1] = $tempCar;
          }
        }
      }

      $csv_fixed = $sortArr;


      // if( current_user_can('editor') || current_user_can('administrator') ) {
      //   for ($i=0; $i < count($csv_fixed); $i++) {
      //     $CurrentCarProfit = ($csv_fixed[$i]["Internet Price"] - $csv_fixed[$i]["Total Cost"]) / $csv_fixed[$i]["Total Cost"];
      //     echo $csv_fixed[$i]["YEAR"] . " " . $csv_fixed[$i]["MODEL"] . " - " . $CurrentCarProfit . "<br>";
      //   }
      //   echo "<br>";
      // }

      break;
  }

  return $csv_fixed;
}

/*
$defaultArr = [];
$defaultArr[0] = $csv_fixed[0];

for ($i=1; $i < count($csv_fixed); $i++) {
  for ($j=0; $j < count($defaultArr); $j++) {
    // code...
  }
}
*/
