<?php
$out = '';
if(session_status() == PHP_SESSION_NONE){
session_start();
}
require('connect.php');

require('header.html');

require('nav.php');

$out .=		'<div class="row">';
$out .=			'<div class="col-md-12">';
$out .= 			 '<hr class = "hor-line">';
$out .=			'</div>';
$out .=     '</div>';

$out .=		'<div class="row">';

$out .=			'<div class="col-md-8">';
$out .=				'<h1>Advanced Search</h1>';

$out .=				'<div class = "advanced-search-wrapper">';
$out .=					'<label>Keyword</label><br>';
$out .=					'<input id = "key" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "key-button" class = "add-button">Add</button><br>';
$out .=					'<label>Year</label><br>';
$out .=					'<input id = "year" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "year-button" class = "add-button">Add</button><br>';
$out .=					'<label>Semester</label><br>';
$out .=					'<input id = "semester" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "semester-button" class = "add-button">Add</button><br>';
$out .=					'<label>Supervisor</label><br>';
$out .=					'<input id = "advisor" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "advisor-button" class = "add-button">Add</button><br>';
$out .=					'<label>School</label><br>';
$out .=					'<input id = "school" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "school-button" class = "add-button">Add</button><br>';
$out .=					'<label>Department</label><br>';
$out .=					'<input id = "dept" class = "advanced-field" type = "text"></input>';
$out .=					'<button id = "dept-button" class = "add-button">Add</button><br>';
$out .=				'<div class = "advanced-back-button-wrapper">';
$out .=					'<a class = "back-button" href = "index.php">Back</a>';
$out .=				'</div>';
$out .=				'</div>';

$out .=			'</div>';

$out .=			'<div class="col-md-4">';
$out .= 			'<form id = "advanced-form" action = "results.php" method = "post">';
$out .=  				'<fieldset>';
$out .=   					'<legend>Search Criteria</legend>';
$out .=						  '<div class = "remove-all-wrapper">';
$out .=						  	'<input type = "button" class = "remove-all" value = "Remove All Filters"></input>';
$out .=						  '</div>';
$out .=							'<div class = "advanced-form-wrapper">';
$out .=									'<div class = "advanced-add-field">';
$out .=									'</div>';
$out .=							'</div>';
$out .=  				'</fieldset>';
$out .=					'<input id = "advanced-query" name = "advanced_search" type = "hidden">';
$out .=						 '<div class = "submit-wrapper">';
$out .=							'<input class = "advanced-submit" type = "submit" value = "Submit"></input>';
$out .=						 '</div>';
$out .= 			'</form>';
$out .=			'</div>';

$out .=     '</div>';

$out .= 	'</div>';
$out .= '</body>';

echo $out;


    require('footer.html');

?>

<script>
$(document).ready(function() {
  $('#key-button').click(function() {

  		var value = $('#key').val();
		var parent = $('#advanced-add-field');
		var c = 0;
		if(value != ''){
				if(parent.children().length < 1){

					if (!$(".key-title")[0]){
					    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'key-title field-title'>Keyword</h5>");
					   	$("<div class = 'key-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.key-title');
					   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.key-field');
					   	$('.key-field').attr('class', 'field key-field' + c);
					   	c++;
					}
					else{
					   	$("<div class = 'key-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.key-title');
					   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.key-field');
					    $('.key-field').attr('class', 'field key-field' + c);
					   	c++;
					}
					$('#key').val('');

					}
					else{

						if (!$(".key-title")[0]){
					    	$('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'key-title field-title'>Keyword</h5>");
					   		$("<div class = 'key-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.key-title');
					   		$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.key-field');
					   		$('.key-field').attr('class', 'field key-field' + c);
					   		c++;
						}
						else{
					   		$("<div class = 'key-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.key-title');
					   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.key-field');
					   		$('.key-field').attr('class', 'field key-field' + c);
					   		c++;
						}
						$('#key').val('');

				}
			}
  });
});
</script>


<script>
$(document).ready(function() {
  $('#year-button').click(function() {

  		var value = $('#year').val();
		var parent = $('#advanced-add-field');
		var d = 0;
	if(value != ''){
		if(parent.children().length < 1){

			if (!$(".year-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'year-title field-title'>Year</h5>");
			   	$("<div class = 'year-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.year-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.year-field');
			   	$('.year-field').attr('class', 'field year-field' + d);
			   	d++;
			}
			else{
			   	$("<div class = 'year-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.year-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.year-field');
			   	$('.year-field').attr('class', 'field year-field' + d);
			   	d++;
			}
			$('#year').val('');

		}
			else{
			
				if (!$(".year-title")[0]){
			    	$('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'year-title field-title'>Year</h5>");
			   		$("<div class = 'year-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.year-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input></div>>").insertBefore('.year-field');
			   		$('.year-field').attr('class', 'field year-field' + d);
			   		d++;
				}
				else{
			   		$("<div class = 'year-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.year-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.year-field');
			   		$('.year-field').attr('class', 'field year-field' + d);
			   		d++;
				}
				$('#year').val('');

		}
	}
  });
});
</script>

<script>
$(document).ready(function() {
  $('#semester-button').click(function() {

  		var value = $('#semester').val();
		var parent = $('#advanced-add-field');
		var e = 0
	if(value != ''){
		if(parent.children().length < 1){

			if (!$(".semester-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'semester-title field-title'>Semester</h5>");
			   	$("<div class = 'semester-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.semester-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.semester-field');
			   	$('.semester-field').attr('class', 'field semester-field' + e);
			   	e++;
			}
			else{
			   	$("<div class = 'semester-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.semester-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.semester-field');
			   	$('.semester-field').attr('class', 'field semester-field' + e);
			   	e++;
			}
			$('#semester').val('');

			}
			else{
				if (!$(".semester-title")[0]){
				    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'semester-title field-title'>Semester</h5>");
			   		$("<div class = 'semester-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.semester-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.semester-field');
			   		$('.semester-field').attr('class', 'field semester-field' + e);
			   		e++;
					}
				else{
			   		$("<div class = 'semester-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.semester-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.semester-field');
			   		$('.semester-field').attr('class', 'field semester-field' + e);
			   		e++;
					}
					$('#semester').val('');

		}
	}
  });
});
</script>

<script>
$(document).ready(function() {
  $('#advisor-button').click(function() {

  		var value = $('#advisor').val();
		var parent = $('#advanced-add-field');
		var f = 0;
	if(value != ''){
		if(parent.children().length < 1){

			if (!$(".advisor-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'advisor-title field-title'>Supervisor</h5>");
			   	$("<div class = 'advisor-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.advisor-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.advisor-field');
			   	$('.advisor-field').attr('class', 'field advisor-field' + f);
			   	f++;
			}
			else{
			   	$("<div class = 'advisor-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.advisor-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.advisor-field');
			    $('.advisor-field').attr('class', 'field advisor-field' + f);
			   	f++;
			}
			$('#advisor').val('');

			}
			else{

				if (!$(".advisor-title")[0]){
			    	$('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'advisor-title field-title'>Supervisor</h5>");
			   		$("<div class = 'advisor-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.advisor-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.advisor-field');
			   		$('.advisor-field').attr('class', 'field advisor-field' + f);
			   		c++;
				}
				else{
			   		$("<div class = 'advisor-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.advisor-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.advisor-field');
			   		$('.advisor-field').attr('class', 'field advisor-field' + c);
			   		c++;
				}
				$('#advisor').val('');

		}
	}
  });
});
</script>

<script>
$(document).ready(function() {
  $('#school-button').click(function() {

  		var value = $('#school').val();
		var parent = $('#advanced-add-field');
		var g = 0;
	if(value != ''){
		if(parent.children().length < 1){

			if (!$(".school-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'school-title field-title'>School</h5>");
			   		$("<div class = 'school-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.school-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.school-field');
			   		$('.school-field').attr('class', 'field school-field' + g);
			   		g++;
			}
			else{
			   		$("<div class = 'school-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.school-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.school-field');
			   		$('.school-field').attr('class', 'field school-field' + g);
			   		g++;
			}
			$('#school').val('');

		}
			else{
			
				if (!$(".school-title")[0]){
			    	$('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'school-title field-title'>School</h5>");
			   		$("<div class = 'school-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.school-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.school-field');
			   		$('.school-field').attr('class', 'field school-field' + g);
			   		g++;
				}
				else{
			   		$("<div class = 'school-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.school-title');
			   		$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.school-field');
			   		$('.school-field').attr('class', 'field school-field' + g);
			   		g++;
				}
				$('#school').val('');

		}
	}
  });
});
</script>

<script>
$(document).ready(function() {
  $('#dept-button').click(function() {

  		var value = $('#dept').val();
		var parent = $('#advanced-add-field');
		var h = 0;
	if(value != ''){
		if(parent.children().length < 1){

			if (!$(".dept-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'dept-title field-title'>Department</h5>");
			   	$("<div class = 'dept-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.dept-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.dept-field');
			   	$('.dept-field').attr('class', 'field dept-field' + h);
			   	h++;
			}
			else{
			   	$("<div class = 'dept-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.dept-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('.dept-field');
			   	$('.dept-field').attr('class', 'field dept-field' + h);
			   	h++;
			}
			$('#dept').val('');

			}
			else{
			
				if (!$(".dept-title")[0]){
			    $('.advanced-add-field').append("<div class = 'advanced-field-submit'><h5 class = 'dept-title field-title'>Department</h5>");
			   	$("<div class = 'dept-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.dept-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input></div>").insertBefore('.dept-field');
			   	$('.dept-field').attr('class', 'field dept-field' + h);
			   	h++;
				}
				else{
			   	$("<div class = 'dept-field field'>" + value + "</div><br class = 'field-break'>").insertAfter('.dept-title');
			   	$("<input class = 'remove-field-button' value = 'X'></input>").insertBefore('dept-field');
			   	$('.dept-field').attr('class', 'field dept-field' + h);
			   	h++;
				}
				$('#dept').val('');

		}
	}
  });
});
</script>

<script>
	$(document).on('click', '.remove-field-button', function() {
		var keyTitle = $('.key-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
		//$('#key-button').prop("disabled",false);
		//$('#key-button').css("background-color", "#CE1141");
    	if(keyTitle.siblings().length < 1){
    		$('.key-title').remove();
    	}
	});
</script>

<script>
	$(document).on('click', '.remove-field-button', function() {
		var yearTitle = $('.year-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
    	//$('#year-button').prop("disabled",false);
		//$('#year-button').css("background-color", "#CE1141");
    	if(yearTitle.siblings().length < 1){
    		$('.year-title').remove();
    	}
	});
</script>

<script>
	$(document).on('click', '.remove-field-button', function() {
		var semesterTitle = $('.semester-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
  		//$('#semester-button').prop("disabled",false);
		//$('#semester-button').css("background-color", "#CE1141");
    	if(semesterTitle.siblings().length < 1){
    		$('.semester-title').remove();
    	}
	});
</script>

<script>
	$(document).on('click', '.remove-field-button', function() {
		var advisorTitle = $('.advisor-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
		//$('#advisor-button').prop("disabled",false);
		//$('#advisor-button').css("background-color", "#CE1141");    	
    	if(advisorTitle.siblings().length < 1){
    		$('.advisor-title').remove();
    	}
	});
</script>
<script>
	$(document).on('click', '.remove-field-button', function() {
		var schoolTitle = $('.school-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
		//$('#school-button').prop("disabled",false);
		//$('#school-button').css("background-color", "#CE1141");   	
    	if(schoolTitle.siblings().length < 1){
    		$('.school-title').remove();
    	}
	});
</script>

<script>
	$(document).on('click', '.remove-field-button', function() {
		var deptTitle = $('.dept-title');
		$(this).next().next().remove();
    	$(this).next().remove();
    	$(this).remove();
		//$('#dept-button').prop("disabled",false);
		//$('#dept-button').css("background-color", "#CE1141");   	
    	if(deptTitle.siblings().length < 1){
    		$('.dept-title').remove();
    	}
	});
</script>

<script>
	$(document).on('click', '.remove-all', function() {
    	$('.field-break').remove();
    	$('.field').remove();
    	$('.field-title').remove();
    	$('.remove-field-button').remove();


	});
</script>

<script>

$(document).ready(function() {
  	$('.advanced-submit').click(function() {
	var children = $('.advanced-field-submit').children();
	var build = new Array();
		for (var i = 0; i < children.length; i++) {
		  var child = children[i];
		  if(child.innerHTML != '' || child.innerHTML != null){
		  build[i] = child.innerHTML;
		  }
		}
		$('#advanced-query').val(build);
  });
 });
</script>



<!--<script>
	$(document).on('click', '.add-button', function() {
		$(this).prop("disabled",true);
		$(this).css("background-color", "gray");
	});
</script>-->