
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormCliente()
{
	for(i=0; i<=6; i++)
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

function blanquearCliente()
{
	for(i=0; i<=6; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaCli(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormCliente();
	escondeError();
	error=0;
	
	var cedrif=eliminaEspacios(form.cedrif.value);
	var nomb=eliminaEspacios(form.nombre.value);
	var tel1=eliminaEspacios(form.tel1.value);
	var twi=eliminaEspacios(form.twitter.value);
	var correo=eliminaEspacios(form.correo.value);
	var dire=eliminaEspacios(form.dire.value);
	var credimonto=eliminaEspacios(form.credimonto.value);
	var credidias=eliminaEspacios(form.credidias.value);
	
	
	if(!validaLongitud(cedrif, 0, 3, 12)) muestraError(form.cedrif.id);
	if(!validaLongitud(nomb, 0, 3, 500)) muestraError(form.nombre.id);
	if(!validaLongitud(tel1, 1, 5, 50)) muestraError(form.tel1.id);
	if(!validaLongitud(twi, 1, 5, 50)) muestraError(form.twitter.id);
	if(!validaLongitud(correo, 1, 5, 50)) muestraError(form.correo.id);
		if (correo != "")
		{
			if(!validaCorreo(correo)) campoError(form.inputCorreo);
		}
	if(!validaLongitud(dire, 1, 3, 500)) muestraError(form.dire.id);
	
	if(!validaLongitud(credimonto, 0, 1, 15)) muestraError(form.credimonto.id);
	if(!validaNumero(credimonto)) muestraError(form.credimonto.id);
	
	if(!validaLongitud(credidias, 0, 1, 3)) muestraError(form.credidias.id);
	if(!validaNumero(credidias)) muestraError(form.credidias.id);
	
	
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
		ajax.send("accion="+accion+"&id="+id+"&cedrif="+cedrif+"&nombre="+nomb+"&dire="+dire+"&tel1="+tel1+"&twi="+twi+"&correo="+correo+"&credimonto="+credimonto+"&credidias="+credidias);
		
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
						muestraError(form.cedrif.id);
						//$j("#message_sent").html('El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.');
						msj('warning','La cedula <font color=red>'+cedrif+'</font> ya existe, por favor verifiquelo.')
					}
					else
					{
						var ok=respuesta.lastIndexOf("OK");
						if(ok!=-1)
						{
							texto = "<strong>Operacion Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearCliente.php');",4000);
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
						blanquearCliente();
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
							msj(texto);
						}
						
						var t = "cargar2Div('derecha','administracion/"+modulo+"/editar"+modulo+".php?id="+id+"','centro','administracion/"+modulo+"/administrar"+modulo+".php')";
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
						
						//blanquearCliente();
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