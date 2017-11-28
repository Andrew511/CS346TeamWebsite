/*jslint browser: true */
/*jslint white: true */
"use strict";

var count = 0;

/*
JS code isn't done yet to add a question
*/
function update_dropdown(){
  var menu_option, select_list;
  select_list = document.getElementById("answer");
  menu_option = document.createElement("option");
  menu_option.value = document.getElementById("text").value;
  menu_option.innerHTML = document.getElementById("text").value;
  select_list.append(menu_option);
}

function edit_answer_option(){
  var menu_option, value, textbox;

  menu_option = document.getElementById("answer");
  value = menu_option.options[menu_option.selectedIndex].text;
  textbox = document.getElementById("text");
  textbox.value = value;
  menu_option.options[menu_option.selectedIndex].remove();
}

function add_answer_options(){
  var e = document.getElementById("answerTypes"),
  type = e.options[e.selectedIndex].value,
  options = document.getElementById("answer_options"), label, input, textbox,
            label_text, character, select, update, edit, id = -1;

  count+=1;
  id+=1;
  character = String.fromCharCode(96 + count);
  label_text = document.createTextNode(character);
  label = document.createElement("label");
  input = document.createElement("input");
  textbox = document.createElement("textarea");
  update = document.createElement("button");
  edit = document.createElement("button");

  if(type === "radio"){
    input.type = "radio";
    input.name = "answer";
    input.id = character;
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    textbox.id = character + id;
    options.appendChild(textbox);
  }
  else if(type === "checkbox" ){
    input.type = "checkbox";
    input.name =  "answer";
    input.id = character;
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    textbox.id = character + id;
    options.appendChild(textbox);
  }
  else if(type === "dropdown"){ //Still need to add JS to allow editing of drowndown menu
    if(count === 1){
      select = document.createElement("select");
      select.name="answer";
      select.id="answer";
      options.appendChild(select);
      edit.type = "button";
      edit.id = "edit";
      edit.innerHTML = "Remove & Edit Option";
      options.append(edit);
    }

    update.type = "button";
    update.id = "update";
    textbox.id = "text";
    update.innerHTML = "Update List";
    options.append(textbox);
    options.append(update);
    update.onclick = update_dropdown;
    edit.onclick = edit_answer_option;
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

function update_values() {
  var e = document.getElementById("answerTypes"), vals,
    type = e.options[e.selectedIndex].value, iter = 0,
    character = String.fromCharCode(97 + iter);

  if(type === "radio"){
    vals = document.getElementsByName("answer");
    for(iter = 0; iter < vals.length; iter+=1){
      vals[iter].value = document.getElementById(character + iter);
    }
  }
}

window.onload = function() {
  var submit = document.getElementsByName("status"), iter;
  document.getElementById("add_answer").onclick = add_answer_options;
  for(iter = 0; iter < submit.length; iter+=1){
    submit[iter].onclick = update_values;
  }

};
