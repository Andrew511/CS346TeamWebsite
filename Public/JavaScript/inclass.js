/*jslint browser: true */
/*jslint white: true */
"use strict";
var seconds = 0, minutes = 0, hours = 0, t, time_text, ctx, height = 0, section;

function timer() {
  t = setTimeout(add, 1000);
}

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
    if(ajax.readyState == 4){
      if (ajax.readyState == 4) {
        var counts = JSON.parse(ajax.responseText);
        var counts2 = counts.map( function (e) {
             return { "text" : e['word'], "size" : 10+2*parseInt(e['count'],10) };
        });
        draw_graph(height);
      }
    }
  };
  ajax.open("GET", "get_student_answers.php", true);
  ajax.send(null);
}

function draw_graph(h){
    var columnSize = 50, margin = 10, step = 2, i;
   answers = document.getElementsByClassName("answers");
  sections = answers.length;
  ctx.font = "20pt Arial";
  ctx.textBaseline = "bottom";
   
  for(i = 0; i<section; i+=1){
    ctx.fillText(answers[i], 10 * i, 10 * i);
  }
  ctx.fillStyle = black;
  grid.fillRect(10, 10, 15, h);
}

window.onload = function () {
    var timeout_id, canvas = document.getElementById("live_stats"),
        time_text = document.getElementById("timer"),
        answers = document.getElementsByClassName("answers");
  timeout_id = setInterval(update_graph, 1000);
  ctx = canvas.getContext('2d');
  timer();
};
