<?php


function successOrFailure($math,$science){
  $sum = $math + $science;
  if($math >= 30 && $science >= 30 && $sum >= 80){
    echo "合格おめでとう";
  }else{
    echo "どんまい";
  }
}

successOrFailure(29,100);
