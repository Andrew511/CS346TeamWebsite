<?php
if(is_array($keyword) && is_array($section) && is_array($score) &&
    is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($pointsAv as $pointsAv){
    $result = search_points_available($pointsAv);
    if($result){
      $pid[$count] = $result;
    }
    $count++;
  }
}
elseif(!is_array($keyword) && is_array($section) && is_array($score) &&
    is_array($pointsAv)){
      $count = 0;
    foreach($section as $section){
      $result = search_section($section);
      if($result){
        $sctid[$count] = $result;
      }
      $count++;
    }
    $count = 0;
    foreach($score as $score){
      $result = search_score($score);
      if($result){
        $scoreid[$count] = $result;
      }
      $count++;
    }
    if($keyword){
      $kid = search_keyword($keyword);
    }
    foreach($pointsAv as $pointsAv){
      $result = search_points_available($pointsAv);
      if($result){
        $pid[$count] = $result;
      }
      $count++;
    }
}
elseif(is_array($keyword) && !is_array($section) && is_array($score) &&
    is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($pointsAv as $pointsAv){
    $result = search_points_available($pointsAv);
    if($result){
      $pid[$count] = $result;
    }
    $count++;
  }
  if($section){
    $sctid = search_section($section);
  }
}
elseif(is_array($keyword) && is_array($section) && !is_array($score) &&
    is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($pointsAv as $pointsAv){
    $result = search_points_available($pointsAv);
    if($result){
      $pid[$count] = $result;
    }
    $count++;
  }
  if($score){
    $scoreid = search_score($score);
  }
}
elseif(is_array($keyword) && is_array($section) && is_array($score) &&
    !is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(!is_array($keyword) && !is_array($section) && is_array($score) &&
    is_array($pointsAv)){
  $count = 0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($pointsAv as $pointsAv){
    $result = search_points_available($pointsAv);
    if($result){
      $pid[$count] = $result;
    }
    $count++;
  }
  if($keyword){
    $kid = search_keyword($keyword);
  }
  if($section){
    $sctid = search_section($section);
  }
}
elseif(!is_array($keyword) && is_array($section) && !is_array($score) &&
    is_array($pointsAv)){
      $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($pointsAv as $pointsAv){
    $result = search_points_available($pointsAv);
    if($result){
      $pid[$count] = $result;
    }
    $count++;
  }
  if($keyword){
    $kid = search_keyword($keyword);
  }
  if($score){
    $scoreid = search_score($score);
  }
}
elseif(!is_array($keyword) && is_array($section) && is_array($score) &&
    !is_array($pointsAv)){
      $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  $count =0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  if($keyword){
    $kid = search_keyword($keyword);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(is_array($keyword) && !is_array($section) && !is_array($score) &&
    is_array($pointsAv)){
    $count = 0;
    foreach($keyword as $keyword){
      $result = search_keyword($keyword);
      if($result){
        $kid[$count] = $result;
      }
      $count++;
    }
    $count = 0;
    foreach($pointsAv as $pointsAv){
      $result = search_points_available($pointsAv);
      if($result){
        $pid[$count] = $result;
      }
      $count++;
    }
    if($section){
      $sctid = search_section($section);
    }
    if($score){
      $scoreid = search_score($score);
    }
}
elseif(is_array($keyword) && !is_array($section) && is_array($score) &&
    !is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($score as $score){
    $result = search_score($score);
    if($result){
      $scoreid[$count] = $result;
    }
    $count++;
  }
  if($section){
    $sctid = search_section($section);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(is_array($keyword) && is_array($section) && !is_array($score) &&
    !is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
    }
    $count++;
  }
  if($score){
    $scoreid = search_score($score);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(!is_array($keyword) && !is_array($section) && !is_array($score) &&
    is_array($pointsAv)){
      $count = 0;
      foreach($pointsAv as $pointsAv){
        $result = search_points_available($pointsAv);
        if($result){
          $pid[$count] = $result;
        }
        $count++;
      }
    if($keyword){
      $kid = search_keyword($keyword);
    }
    if($section){
      $sctid = search_section($section);
    }
    if($score){
      $scoreid = search_score($score);
    }
}
elseif(!is_array($keyword) && !is_array($section) && is_array($score) &&
    !is_array($pointsAv)){
      $count = 0;
      foreach($score as $score){
        $result = search_score($score);
        if($result){
          $scoreid[$count] = $result;
        }
        $count++;
      }
      if($keyword){
        $kid = search_keyword($keyword);
      }
      if($section){
        $sctid = search_section($section);
      }
      if($pointsAv){
        $pid = search_points_available($pointsAv);
      }
}
elseif(is_array($keyword) && !is_array($section) && !is_array($score) &&
    !is_array($pointsAv)){
  $count = 0;
  foreach($keyword as $keyword){
    $result = search_keyword($keyword);
    if($result){
      $kid[$count] = $result;
    }
    $count++;
  }
  if($section){
    $sctid = search_section($section);
  }
  if($score){
    $scoreid = search_score($score);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(!is_array($keyword) && is_array($section) && !is_array($score) &&
    !is_array($pointsAv)){
  $count = 0;
  foreach($section as $section){
    $result = search_section($section);
    if($result){
      $sctid[$count] = $result;
  //  array_push($sctid, $result);
    }
    $count++;
  }
  if($keyword){
    $kid = search_keyword($keyword);
  }
  if($score){
    $scoreid = search_score($score);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
elseif(!is_array($keyword) && !is_array($section) && !is_array($score) &&
    !is_array($pointsAv)){
  if($keyword){
    $kid = search_keyword($keyword);
  }
  if($section){
    $sctid = search_section($section);
  }
  if($score){
    $scoreid = search_score($score);
  }
  if($pointsAv){
    $pid = search_points_available($pointsAv);
  }
}
?>
