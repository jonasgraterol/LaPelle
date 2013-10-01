(function($) {

$.fn.select_autocomplete = function(options) {

// make sure we have an options object
options = options || {};

// setup our defaults
var defaults = {
minChars: 0
, width: 362
, matchContains: true
, autoFill: false
, formatItem: function(row, i, max) {
return row.name;
}
, formatMatch: function(row, i, max) {
return row.name;
}
, formatResult: function(row) {
return row.name;
}
};

options = $.extend(defaults, options);
// AGREGADO POR JONAS 28/04/2010
// VARIABLE CREADA PARA DARLE UN ID UNICO A CADA CAJA QUE SE CREA POR CADA SELECT

// fin
return this.each(function() {

//stick each of it's options in to an items array of objects with name and value attributes
var $this = $(this),
data = [],
nombreCaja = "caja_"+$(this).attr("id"),
// AGREGANDO LA VAIRABLE CREADA
$input = $('<input type="text" id="'+nombreCaja+'" />');
// FIN
if (this.tagName.toLowerCase() != 'select') { return; }


$this.children('option').each(function() {

var $option = $(this);

if ($option.val() != '') { //ignore empty value options

data.push({
name: $option.html()
, value:$option.val()
});
}
});

// insert the input after the select
if ($this.attr("disable"))
{
	$input.attr("disable","true");
}
if ($this.next().attr("id") != nombreCaja)
{
	$this.after($input);
}

// add it our data
options.data = data;

//make the input box into an autocomplete for the select items
$input.autocomplete(data, options);

//make the result handler set the selected item in the select list
$input.result(function(event, selected_item, formatted) {
$($this.find('option[value=' + selected_item.value + ']')[0]).attr('selected', true);
});

      $input.blur(function(){
          // autocomplete has removed blank options
          // ensure that if value is removed we select the blank option if available
          if(this.value == ""){
            $($this.find('option[value=]')[0]).attr('selected', true);
          }

          /* failsafe to ensure text box always represents the value being used in the select
* there are edge cases where if you leave the field part way through the word, or clear the value when no blank option is available
* that force a mismatch between the 2 elements
*/
          if(this.value != $this[0].options[$this[0].selectedIndex].text){
            $input.val($this[0].options[$this[0].selectedIndex].text);
          }
      });

//set the initial text value of the autocomplete input box to the text node of the selected item in the select control
$input.val($this[0].options[$this[0].selectedIndex].text);

//normally, you'd hide the select list but we won't for this demo
$this.hide();
});
};
  
})(jQuery);