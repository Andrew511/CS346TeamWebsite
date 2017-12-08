/*jslint browser: true */
/*jslint white: true */
"use strict";

var seconds = 0, minutes = 0, hours = 0, t, time_text, ctx, height = 0;


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
    if(ajax.readyState === 4){
      if (ajax.readyState === 4) {
        var counts = JSON.parse(ajax.responseText);
        var counts2 = counts.map( function (e) {
             return { "text" : e['word'], "size" : 10+2*parseInt(e['count'],10) };
        });
        
        height+=5;
        draw_graph(height, counts);

      }
    }
  };
  ajax.open("GET", "get_student_answers.php", true);
  ajax.send(null);
}

function draw_graph(h){
  
  var columnSize = 50, margin = 0, step = 2, i,
  answers = document.getElementsByClassName("answer"),
  canvas = document.getElementById("live_stats"), ctx = canvas.getContext('2d'),
  sections = answers.length, width;
  width = canvas.width;
  ctx.fillStyle = "black";
  ctx.font = "12px sans-serif";
  ctx.textBaseline = "baseline";
  for(i = 0; i<sections; i+=1){
    ctx.fillText(answers[i].value, 10+margin, 300);
    margin += 10;

  }

//  ctx.fillRect(10, 10, 15, h);
}


window.onload = function () {

  var timeout_id,  time_text = document.getElementById("timer");

  timeout_id = setInterval(update_graph, 1000);
  timer();

};
