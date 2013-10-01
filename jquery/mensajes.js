
function msj(color,texto)
{
	$j(".cargando_box").hide();
	var tiempo = 2000;
	if (color == "cargando")
	{
		tiempo = 100;	
	}
	var a = '<a href="#" id="cerrar_'+color+'" class="cerrar" onclick="cer(this.id)"></a>';
	$j("."+color+"_box").html(texto+a).fadeIn(tiempo);
	if(color == "valid")
	{
		$j("."+color+"_box").fadeOut(4000);	
	}
}

function cer(este)
{
	$j("#"+este).parent().fadeOut(2000);
}