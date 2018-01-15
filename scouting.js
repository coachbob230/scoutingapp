$(function() {
	  var prev = 'blank';
    $('input[name=question_type]').change(function() {
	if($('input[name=type]').val() == 'mc' && prev == 'blank') { prev = 'mc'; }
	if($('input[name=type]').val() == 'yn' && prev == 'blank') { prev = 'yn'; }
	if($('input[name=type]').val() == 'op' && prev == 'blank') { prev = 'op'; }
    if($(this).val() == 'mc' && prev == 'blank') {$('#div_mc').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'yn' && prev == 'blank') {$('#div_yn').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'op' && prev == 'blank') {$('#div_op').slideToggle('500'); prev = $(this).val();}
	if($(this).val() == 'mc' && prev == 'yn') {$('#div_mc').slideToggle('500'); $('#div_yn').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'yn' && prev == 'mc') {$('#div_yn').slideToggle('500'); $('#div_mc').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'op' && prev == 'mc') {$('#div_op').slideToggle('500'); $('#div_mc').slideToggle('500'); prev = $(this).val();}
	if($(this).val() == 'mc' && prev == 'op') {$('#div_mc').slideToggle('500'); $('#div_op').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'yn' && prev == 'op') {$('#div_yn').slideToggle('500'); $('#div_op').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'op' && prev == 'yn') {$('#div_op').slideToggle('500'); $('#div_yn').slideToggle('500'); prev = $(this).val();}
    });
  });
  
$(function() {
	var prev = 'match';
    $('input[name=search_type]').change(function() {
	if($(this).val() == 'inter' && prev == 'match') {$('#div_inter').slideToggle('500'); $('#div_match').slideToggle('500'); prev = $(this).val();}
    if($(this).val() == 'match' && prev == 'inter') {$('#div_match').slideToggle('500'); $('#div_inter').slideToggle('500'); prev = $(this).val();}
    });
  });
  
var choice_num = 3;
function addChoice() {
	var choice_div = document.getElementById("choices");
	choice_div.innerHTML = choice_div.innerHTML + 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Choice " + choice_num + ": \
	</td> \
	<td> \
	<input type='text' name='choice" + choice_num + "'> \
	</td> \
	<td> \
	Value: \
	</td> \
	<td> \
	<input type='text' name='value" + choice_num + "'> \
	</td> \
	</tr> \
	</table> \
	<input type='hidden' name='choices' value='" + choice_num + "'>";
	choice_num = choice_num + 1;
}

function addChoice2(choices) {
	var choice_div = document.getElementById("choices");
	var but_div = document.getElementById("but");
	choice_div.innerHTML = 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Choice " + choices + ": \
	</td> \
	<td> \
	<input type='text' name='choice" + choices + "'> \
	</td> \
	<td> \
	Value: \
	</td> \
	<td> \
	<input type='text' name='value" + choices + "'> \
	</td> \
	</tr> \
	</table> \
	<input type='hidden' name='choices' value='" + choices + "'>";
	but_div.innerHTML = 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	<button type='button' onclick='return addChoice()'>Add Choice</button> \
	</td> \
	</tr> \
	</table>";
	choice_num = choices + 1;
}

var attribute_num = 3;
function addAttribute() {
	var attribute_div = document.getElementById("attributes");
	attribute_div.innerHTML = attribute_div.innerHTML + 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Game Attribute " + attribute_num + ": \
	</td> \
	<td> \
	<input type='text' name='attribute" + attribute_num + "'> \
	</td> \
	</tr> \
	</table> \
	<input type='hidden' name='num_attributes' value='" + attribute_num + "'>";
	attribute_num = attribute_num + 1;
}

var iattribute_num = 3;
function addAttribute2() {
	var attribute_div = document.getElementById("iattributes");
	attribute_div.innerHTML = attribute_div.innerHTML + 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Interview Attribute " + iattribute_num + ": \
	</td> \
	<td> \
	<input type='text' name='iattribute" + iattribute_num + "'> \
	</td> \
	</tr> \
	</table> \
	<input type='hidden' name='num_iattributes' value='" + iattribute_num + "'>";
	iattribute_num = iattribute_num + 1;
}

function addAttribute3(attributes) {
	var attribute_div = document.getElementById("attributes");
	var but_div = document.getElementById("but");
	attribute_div.innerHTML = 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Attribute " + attributes + ": \
	</td> \
	<td> \
	<input type='text' name='attribute" + attributes + "'> \
	</td> \
	</tr> \
	</table>";
	but_div.innerHTML = 
	"<button type='button' onclick='return addAttribute4()'>Add Attribute</button>";
	attribute_num = attributes + 1;
}

function addAttribute4() {
	var attribute_div = document.getElementById("attributes");
	attribute_div.innerHTML = attribute_div.innerHTML + 
	"<table style='text-align: left' align='center'> \
	<tr> \
	<td> \
	Attribute " + attribute_num + ": \
	</td> \
	<td> \
	<input type='text' name='attribute" + attribute_num + "'> \
	</td> \
	</tr> \
	</table>";
	attribute_num = attribute_num + 1;
}