<?php
if($q['QuestionType'] === "radio") {
  foreach($answers as $a){
    echo "<input type=\"radio\" name=\"answer\" value=\"$a\"\>";
    echo "<input type=\"hidden\" name=\"choices[]\" value=\"$a\"\>";
  }
}
else if($q['QuestionType'] === "radio") {
  foreach($answers as $a){
    echo "<input type=\"checkbox\" name=\"answer[]\" value=\"$a\"\>";
    echo "<input type=\"hidden\" name=\"choices[]\" value=\"$a\"\>";
  }
}
else if($q['QuestionType'] === "dropdown") {
  echo "<select name=\"answer[]\" id=\"answer\" multiple>";
  foreach($answers as $a){
    echo "<option value=\"$a\">$a</option>";
    echo "<input type=\"hidden\" name=\"choices[]\" value=\"$a\"\>";
  }
}
else if($q['QuestionType'] === "short"){
  echo "<textarea name=\"answer\" id=\"answer\">";
  $count = count($answers);
  foreach($answers as $a){
    echo $a;
    $count--;
    if($count > 1){
      echo " | ";
    }
  }
}
 ?>
