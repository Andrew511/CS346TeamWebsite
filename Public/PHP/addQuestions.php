<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
    <script src="../JavaScript/add_question.js"></script>
  </head>
  <body>
    <div>
      <?php include 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <div id="pageHeader">
        <h1 id="headerTitle"><span id="mainU">U</span>W<span id="mainO">O
        </span><span id="mainW"> W</span>eb<span id="mainC">C</span>licker</h1>
      </div>
      <div id="flexContainer">
        <div class="question">
          <form action ="confirmSave.php" method="post">
            <h1>Add Question</h1>
            <p>Question ID: </p>
            <input type="number" name="ID"><br/>
            <p>Description</p>
            <input type="text" name="description"/>
            <p>Keywords (Please separate keywords by ,)</p>
            <input type="text" name="keywords"/><br/>
            <p>Book Section:</p>
            <input type="text" name="section"/>
            <p>Points</p>
            <input type="number" name="points"/>
            <div>
              <p>Type your question below:</p>
              <textarea class="questionText" name="question_text"></textarea>
              <select id="answerTypes" name="types">
                <option value="radio">Multiple Choice</option>
                <option value="checkbox">Checkboxes</option>
                <option value="dropdown">Dropdown</option>
                <option value="short">Short answer</option>
              </select>
              <div id="answer_options">
                Type the answer options and select the correct answer.
                <br/>

              </div>
              <p>
              <button type="button" id="add_answer">Add more answer choices</button>
              </p>
              <button type="submit" name="status" value="1">Save as Draft</button>
              <button type="submit" name="status" value="2">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
