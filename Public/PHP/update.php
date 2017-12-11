<?php
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $types = $_POST['types'];
    $id = $_POST['ID'];
    $status = $_POST['submit'];
    update_question($id, $status, $types, $_POST['question_text'],
    $_POST['points'], $_POST['section'], $_POST['description']);
    $keywords = get_keyword_list($id);
    if(count($keywords) > 0){
      delete_keywords($id);
    }
    $keywords = $_POST['keywords'];
    $keywords_arr = array();
    $keywords_arr = explode(",", $keywords);
    foreach($keywords_arr as $keyword){
      insert_keywords($id, $keyword);
    }
    $answers = get_answer_choices($id);
    if(count($answers) > 0){
      delete_answers($id);
    }

    if($types === 'multiple'){
      if(isset($_POST['choices'])){
        $answer_options = $_POST['choices'];
        $number = count($answer_options);
        if(isset($_POST['submit'])){
          foreach($answer_options as $a){
            if($a === $_POST['answer'] ){
              $correct = 1;
              add_answer($id, $a, $correct, $number);
            }
            else {
              $correct = 0;
              add_answer($id, $a, $correct, $number);
            }
          }
        }
        else {
          $correct = 0;
          add_answer($id, $a, $correct, $number);
        }
      }
    }
    elseif ($types === 'checkbox'){
      if(isset($_POST['answer']) && isset($_POST['choices'])){
        $array = $_POST['answer'];
        $unchecked = array_diff($_POST['choices'], $_POST['answer']);
      }
      elseif(isset($_POST['choices'])){
        $unchecked = $_POST['choices'];
      }
      if(!empty($unchecked)){
        foreach($unchecked as $c){
          add_answer($id, $c, 0, count($_POST['choices']));
        }
      }
      if(isset($_POST['answer'])){
        foreach($_POST['answer'] as $a){
          add_answer($id, $a, 1, count($_POST['choices']));
        }
      }
    }
    elseif ($types === 'dropdown'){
      if(isset($_POST['choices']) && isset($_POST['answer'])){
        if(is_array($_POST['choices']) && is_array($_PoST['answer'])){
          $unchecked = array_diff($_POST['choices'], $_POST['answer']);
          foreach($unchecked as $c){
            add_answer($id, $c, 0, count($_POST['choices']));
          }
          foreach($_POST['answer'] as $a){
            add_answer($id, $a, 1, count($_POST['choices']));
            }
          }
        elseif(!is_array($_POST['choices'])){
          foreach($_POST['answer'] as $answer){
            add_answer($id, $c, 0, count($_POST['choices']));
          }
        }
      }
    }
    elseif ($types === 'short'){
      $answer = $_POST['answer'];
      $answer_arr = array();
      $answer_arr = explode("|", $answer);
      foreach($answer_arr as $a){
        add_short($id, $a);
      }

    }
    echo "Your question was successfully updated in the database!";
  }
?>
