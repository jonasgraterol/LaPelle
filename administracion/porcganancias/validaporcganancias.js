
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormGanancia()
{
	for(i=0; i<=2; i++)
	{
		form.elements[i].className=claseNormal;
	}
	//document.getElementById("descripcion").className=claseNormal;
}

function escondeError()
{
	$j("input, textarea").each(function () {
		id = $j(this).attr("id");								  	
		$j("#"+id+"-error").hide();															
	});
}

function blanquearGanancia()
{
	for(i=0; i<=2; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaPorcGan(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormGanancia();
	escondeError();
	error=0;
	
	var porc1=eliminaEspacios(form.porc1.value);
	var porc2=eliminaEspacios(form.porc2.value);
	var porc3=eliminaEspacios(form.porc3.value);
	
	if(!validaLongitud(porc1, 0, 1, 10)) muestraError(form.porc1.id);
	if(!validaNumero(porc1)) muestraError(form.porc1.id);
	if(!validaLongitud(porc2, 0, 1, 10)) muestraError(form.porc2.id);
	if(!validaNumero(porc2)) muestraError(form.porc2.id);
	if(!validaLongitud(porc3, 0, 1, 10)) muestraError(form.porc3.id);
	if(!validaNumero(porc3)) muestraError(form.porc3.id);
	
	var automatico=0;
	if($j("#automatico").is(":checked")) automatico=1;
	
	if(error==1)
	{
		
	}
	else
	{
		//$j("#message_sent").html(" <img src='images/cargando.gif' alt='Enviando...' class='cargaMsj' /> Enviando...").slideDown(500);
		msj('cargando','Cargando...');
		var ajax=nuevoAjax();
		ajax.open("POST", "administracion/"+modulo+"/guardar"+modulo+".php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("accion="+accion+"&id="+id+"&porc1="+porc1+"&porc2="+porc2+"&porc3="+porc3+"&automatico="+automatico);
		
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				
				if (accion=="guardar")
				{	
					//respuesta.lastIndexOf("Existe"); busca el string "Existe" en respuesta y devuelve el indice de la ultima ocurrencia donde lo encuentra 
					// si no lo encuentra retorna -1
					var exis=respuesta.lastIndexOf("Existe");
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						//$j("#message_sent").html('El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.');
						msj('warning','El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.')
					}
					else
					{
						var ok=respuesta.lastIndexOf("OK");
						if(ok!=-1)
						{
							texto = "<strong>Operacion Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearGanancia.php');",4000);
							cargarDiv('centro','administracion/'+modulo+'/administrar'+modulo+'.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente más tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearGanancia();
					}	
				}
				if (accion=="editar")
				{
					var exis=respuesta.lastIndexOf("Existe");
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						var texto = 'El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.';
						msj('warning',texto);
					}
					else
					{
						var edit=respuesta.lastIndexOf("Editado");
						if(edit!=-1)
						{
							var texto="<strong>Edicion Exitosa</strong> Se han Editado correctamente los datos.";
							msj('valid',texto);
							//setTimeOut(3000);
							//cargarDiv('medio','formulario/editarTipoHabitacion.php?id='+id);
						}
						else 
						{
							var texto="Error: El servidor fallo al intentar Actualizar el registro, intente más tarde.["+respuesta+"]<br><br>";
							msj('error',texto);
						}
						
						var t = "cargarDiv('derecha','administracion/"+modulo+"/crear"+modulo+".php?id="+id+"')";
						setTimeout(t,4000);
					}
				}
				if (accion=="eliminar")
				{
					var eli=respuesta.lastIndexOf("Eliminado");
					if(eli!=-1)
					{
						var texto="<strong>Eliminado con exito</strong> Se han Eliminado con exito el registro.";
						msj('valid',texto);
						cargarDiv('centro','administracion/'+modulo+'/administrar'+modulo+'.php');
						
						//blanquearGanancia();
					}
					else
					{
						var texto="Error: El servidor fallo al intentar Eliminar el registro, intente más tarde.["+respuesta+"]";
						msj('error',texto);
					}
					
					setTimeout('limpiarDivSinCarga("derecha");',5000);
				}
			}
		}
	}
}