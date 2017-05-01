<?php
//オープニング
print 'Hello,World!<br/>';
print 'ようこそPHPパークへ<br/>';

$prefs = ['北海道'=>'札幌','神奈川'=>'横浜'];
print $prefs['北海道'];

$x = 3;
$y = ++$x;
echo "{$x} {$y}<br/>";


for($i=1;$i<100;$i++){
  if($i % 3 == 0 && $i % 5 ==0){
    echo "Fizz Buzz<br/>";
  }else if($i % 3 == 0){
    echo "Fizz<br/>";
  }else if($i % 5 ==0){
    echo "Buzz<br/>";
  }else{
    echo "{$i}<br/>";
  }
}
