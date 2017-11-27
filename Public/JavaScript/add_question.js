/*jslint browser: true */
/*jslint white: true */
"use strict";

var count = 0;


function update_dropdown(){
  var menu_option, select_list, character;
  character = String.fromCharCode(96 + count);
  select_list = document.getElementById("answer");
  menu_option = document.createElement("option");
  menu_option.value = document.getElementById(character).value;
  menu_option.innerHTML = document.getElementById(character).value;
  select_list.append(menu_option);
}

function update_answers(){

}

function add_answer_options(){
  var e = document.getElementById("answerTypes"),
  type = e.options[e.selectedIndex].value,
  options = document.getElementById("answer_options"), label, input, textbox,
  label_text, character, select, update;

  count+=1;
  character = String.fromCharCode(96 + count);
  label_text = document.createTextNode(character);
  label = document.createElement("label");
  input = document.createElement("input");
  textbox = document.createElement("textarea");
  update = document.createElement("button");

  if(type === "radio"){
    input.type = "radio";
    input.name = "answer";
    input.id = character;
    textbox.id = character;
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    options.appendChild(textbox);
  }
  else if(type === "checkbox" ){
    input.type = "checkbox";
    input.name =  "answer";
    input.id = character;
    textbox.id = character;
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    options.appendChild(textbox);
  }
  else if(type === "dropdown"){
    if(count === 1){
      select = document.createElement("select");
      select.name="answer";
      select.id="answer";
      options.appendChild(select);
    }

    update.type = "button";
    update.id = "update";
    textbox.id = character;
    update.innerHTML = "Update List";
    options.append(textbox);
    options.append(update);
    update.onclick = update_dropdown;
  }
  else if(type === "short"){
    textbox.id="answer";
    textbox.name = "answer";
    label_text = document.createTextNode("Please separate different accepted " +
                  " answers with a | sign (i.e. zero | 0)");
    options.append(label_text);
    options.append(textbox);
  }
}

window.onload = function() {
  document.getElementById("add_answer").onclick = add_answer_options;
};
