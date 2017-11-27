
<!DOCTYPE html>
    <?php    require_once('../../Private/PHP/initialize.php'); ?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
  </head>

  <body>
    <?php include 'instructor_navigation.php';?>
    <div class="border">
        <?php include 'header.php';?>
        <div id="flexContainer">
            <?php
            $questions = get_question_list();
            foreach ($questions as $question)
            {
                echo $question['QuestionId'] + "<br />";
                $scores = get_scores($question['QuestionId']);
                $avg = get_avg($question['QuestionId']);
                echo $avg['Average'] + "<br />";
                ?>
                <table>
                <?php    foreach ($scores as $score) { ?>
                        <tr>
                        <td> 
                        <?php echo $score['Username'];  ?>
                        </td>
                        <td> 
                        <?php echo $score['Score'] ; ?>
                        </td>
                        </tr>
                 <?php   } ?>
                </table>
                <?php
            }


            ?>

        </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
