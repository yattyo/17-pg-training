<?php

for($divideNum = 2;$divideNum<1001;$divideNum++){
  for($num = 2;$num <= $divideNum;$num++){
    if($divideNum == $num){
      echo "{$divideNum}<br/>";
    }else if($divideNum % $num == 0){
      break;
    }else{
    }
  }
}
