/*jslint browser: true */
/*jslint white: true */
"use strict";

var count = 0;


function update_dropdown(){
  var menu_option, select_list, character;
  character = String.fromCharCode(96 + count);
  select_list = document.getElementById("answer");
  menu_option = document.createElement("option");
  menu_option.value = document.getElementById('text').value;
  menu_option.innerHTML = document.getElementById('text').value;
  select_list.append(menu_option);
}

function edit_answer() {
  var menu_option, select_list, character, text, textbox;
  select_list = document.getElementById("answer");
  menu_option = select_list.options[select_list.selectedIndex];
  text = menu_option.value;
  select_list.remove(menu_option);
  textbox = document.getElementById('text');
  textbox.value = text;

}

function update_answers(){
  var e = document.getElementById("answerTypes"),
  type = e.options[e.selectedIndex].value,
  options = document.getElementById("answer_options"), i,
  input, textbox, id,
  character;

  if(type === "radio"){
    textbox = document.getElementsByName("answer_choices");
    input = document.getElementsByName("answer")
    for(i = 0; i < input.length; i+=1){
      input[i].value = textbox[i].value;
    }
  }
  else if(type === "checkbox" ){
    textbox = document.getElementsByName("answer_choices");
    input = document.getElementsByName("answer[]")
    for(i = 0; i < textbox.length; i+=1){
      input[i].value = textbox[i].value;
    }
  }
}

function add_answer_options(){
  var e = document.getElementById("answerTypes"),
  type = e.options[e.selectedIndex].value,
  options = document.getElementById("answer_options"), label, input, textbox,
  label_text, character, select, update, edit, tab;

  count+=1;
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
    textbox.name ="answer_choices"
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    options.appendChild(textbox);
  }
  else if(type === "checkbox" ){
    input.type = "checkbox";
    input.name =  "answer[]";
    input.id = character;
    textbox.name = "answer_choices"
    label.setAttribute("for", character);
    label.append(label_text);
    options.append(label);
    options.appendChild(input);
    options.appendChild(textbox);
  }
  else if(type === "dropdown"){
    if(count === 1){
      select = document.createElement("select");
      select.multiple = "multiple";
      select.name="answer[]";
      select.id="answer";
      options.appendChild(select);
    }

    update.type = "button";
    update.id = "update";
    textbox.id = "text";
    update.innerHTML = "Update List";
    options.append(textbox);
    edit.type = "button";
    edit.id = "edit";
    edit.innerHTML = "Edit Option";
    tab = document.createTextNode("\t");

    options.append(edit);
    edit.onclick = edit_answer;
    options.append(tab);
    options.append(update);
    update.onclick = update_dropdown;
    document.getElementById("add_answer").style.display = "none";
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
  var submit = document.getElementsByName("status"), i;
  document.getElementById("add_answer").onclick = add_answer_options;
  for(i = 0; i < submit.length; i+=1){
    submit[i].onclick = update_answers;
  }
};
