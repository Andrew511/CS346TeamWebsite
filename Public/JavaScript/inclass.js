/*jslint browser: true */
/*jslint white: true */
"use strict";
var seconds = 0, minutes = 0, hours = 0, t, time_text;

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

}


window.onload = function () {
  var timeout_id, canvas = document.getElementById("live_stats"),
  grid = canvas.getContext('2d'),
  time_text = document.getElementById("timer");
  timeout_id = setInterval(update_graph, 1000);
  timer();
};
