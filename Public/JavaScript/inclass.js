/*jslint browser: true */
/*jslint white: true */
"use strict";

var seconds = 0, minutes = 0, hours = 0, t, time_text, ctx, height = 0, height2 = 0,
text_height = 0, interval=0, margin = 0, correct = 0, wrong = 0;

//function for timer
function timer() {
  t = setTimeout(add, 1000);
}
//function for timer
function add() {
  time_text = document.getElementById("timer");
  seconds+=1;
  if(seconds >= 60){
    seconds = 0;
    minutes+=1;
    if(minutes >= 60){
      minutes = 0;
      hours+=1;
    }
  }

  time_text.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") +
    ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":"
    + (seconds > 9 ? seconds : "0" + seconds);

  timer();
}

function update_graph() {
  var ajax = new XMLHttpRequest(), id = document.getElementsByName("id");

  ajax.onreadystatechange = function() {
    if(ajax.readyState === 4){
      if (ajax.readyState === 4) {
        var counts = JSON.parse(ajax.responseText);
        var counts2 = counts.map( function (e) {
             return { "text" : e['StudentAnswer'] };
        });
        if(interval < counts2.length){
          draw_graph(counts);
          interval+=1;
        }
      }
    }
  };
  ajax.open("GET", "get_student_answers.php", true);
  ajax.send(null);
}

function draw_graph(counts){
  var columnSize = 50, k,
  answers = document.getElementsByClassName("answer"),
  canvas = document.getElementById("live_stats"), ctx = canvas.getContext('2d'),
  sections = answers.length, width, j, count, correctA, space;
  width = canvas.width;
  space = width / sections;
  ctx.fillStyle = "black";
  ctx.textBaseline = "baseline";
  ctx.font = "14px sans-serif";
  //draws bars for short answers
  if(document.getElementsByName("type")[0].value == "short"){
  for(j = 0; j < answers.length; j+=1){
      if(counts[interval]['StudentAnswer'] == answers[j].value){
        height += 20;
        correct+=1;
        ctx.fillRect(space * j + 1, canvas.height-20-height, 15, height);
        document.getElementById("right").innerHTML = "Correct: " + correct; //updates the correct count
      }
      else if(counts[interval]['StudentAnswer'] != answers[j].value) {
        height2 += 20;
        wrong +=1;
        ctx.fillRect(space * j + 1, canvas.height-20-height2, 15, height2);
        document.getElementById("wrong").innerHTML = "Incorrect: " + wrong; //updates incorrect count
      }
    }
  }
  else if(document.getElementsByName("type")[0].value == "checkbox")
  {//checkbox special case
	  var CBAnswers = counts[interval]['StudentAnswer'].split("|") ;
	  correctA = document.getElementsByName("correct_answers[]");
    //draws the bars for the questions with more than one answer, i.e. checkboxes and select
    if(correctA.length > 1){
      for(j = 0; j < answers.length; j+=1){
        k = 0;
        while(k < CBAnswers.length){
          if(CBAnswers[k] == correctA[j].value){
			correct+=1;
          }
		  if(CBAnswers[k] == correctA[j].value){
          height += 20;
          ctx.fillRect(space * j+1, canvas.height-20-height, 15, height);
          document.getElementById("right").innerHTML = "Correct: " + correct;
        }
        else if(CBAnswers[k] == answers[j].value) {
          height2 += 20;
          wrong +=1;
          ctx.fillRect(10+margin, canvas.height-20-height2, 15, height2);
          document.getElementById("wrong").innerHTML = "Incorrect: " + wrong;
        }
		  k+= 1 ;
        }
      }
  }
 /* else { //if it's not a short answer
    correctA = document.getElementsByName("correct_answers[]");
    //draws the bars for the questions with more than one answer, i.e. checkboxes and select
   /* if(correctA.length > 1){
      for(j = 0; j < answers.length; j+=1){
        k = 0;
        while(k < correctA.length){
          if(counts[interval]['StudentAnswer'] == correctA[k].value){
			correct+=1;
          }
		  k+= 1 ;
        }
        if(counts[interval]['StudentAnswer'] == answers[j].value){
          height += 20;
          ctx.fillRect(space * j+1, canvas.height-20-height, 15, height);
          document.getElementById("right").innerHTML = "Correct: " + correct;
        }
        else if(counts[interval]['StudentAnswer'] == answers[j].value) {
          height2 += 20;
          wrong +=1;
          ctx.fillRect(10+margin, canvas.height-20-height2, 15, height2);
          document.getElementById("wrong").innerHTML = "Incorrect: " + wrong;
        }
        k+=1;
      }

    } */
    else {
		correctA = document.getElementsByName("correct_answers[]");
      //draws the bars for the questions where there is only one answer i.e multiple choice
      for(j = 0; j < answers.length; j+=1){
        if(counts[interval]['StudentAnswer'] == answers[j].value &&
            counts[interval]['StudentAnswer'] == correctA[0].value){
          height += 20;
          correct+=1;
          ctx.fillRect(space * j+1, canvas.height-20-height, 15, height);
          document.getElementById("right").innerHTML = "Correct: " + correct;
        }
        else if(counts[interval]['StudentAnswer'] == answers[j].value) {
          height2 += 20;
          wrong +=1;
          ctx.fillRect(space * j+1, canvas.height-20-height2, 15, height2);
          document.getElementById("wrong").innerHTML = "Incorrect: " + wrong;
        }
        
      }
    }
  }
}

/*
draws the labels (i.e. the text at the bottom) for each answer on the canvas
*/
function draw_labels() {
  var columnSize = 50,  i, j,
  answers = document.getElementsByClassName("answer"),
  canvas = document.getElementById("live_stats"), ctx = canvas.getContext('2d'),
  sections = answers.length, width, size, testWidth, words;
  width = canvas.width;
  size = width/sections;
  ctx.fillStyle = "black";
  ctx.font = "14px sans-serif";
  ctx.textBaseline = "baseline";
  for(i = 0; i<sections; i+=1){
    text_height = ctx.measureText(answers[i]).width;
    ctx.fillText(answers[i].value, size * i+1, canvas.height);
    margin += text_height;
  }
  if(document.getElementsByName("type")[0].value == "short"){
    ctx.fillText("Other", size * i+1, canvas.height);
  }


}

window.onload = function () {

  var timeout_id,  time_text = document.getElementById("timer");

  timeout_id = setInterval(update_graph, 1000);
  draw_labels();
  timer();

};
