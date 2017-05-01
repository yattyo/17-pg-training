
<?php

for($x=1;$x<10;$x++){
  for($y=1;$y<10;$y++){
    $multi = $x * $y;
    $multiLength = strlen ((string)$multi);
    if($multiLength == 1){
      echo "&nbsp;&nbsp;".$multi."&nbsp;";
    }else{
      echo $multi."&nbsp;";
    }
  }
  echo '<br>';
}
