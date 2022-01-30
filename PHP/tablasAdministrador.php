<?php 
/**
 * 
 */
class tablasAdministrador
{
	//$id,$tipo,$ci,$email,$nombre,$apellido,$direccion,$barrio,$departamento,$telefono,$agencia,$nombre_hotel,$direccion_hotel,$supervisor
	public function tablaUsuarios($index,$data){
          $TABLA_USUARIOS_ADMIN = `
              <tr>
                <td data-title='ID:'>`.$data[$index]['ID'].`</td>
                <td data-title='Tipo:'>`.$data[$index]['TIPO_USUARIO'].`</td>
                <td data-title='CI:'>`.$data[$index]['CI'].`</td>
                <td data-title='Email:'>`.$data[$index]['EMAIL'].`</td>
                <td data-title='Nombre:'>`.$data[$index]['NOMBRE'].`</td>
                <td data-title='Apellido:'>`.$data[$index]['APELLIDO'].`</td>
                <td data-title='Dirección:'>`.$data[$index]['DIRECCION'].`</td>
                <td data-title='Barrio:'>`.$data[$index]['BARRIO'].`</td>
                <td data-title='Departamento:'>`.$data[$index]['DEPARTAMENTO'].`</td>
                <td data-title='Teléfono:'>`.$data[$index]['TELEFONO'].`</td>
                <td data-title='Agencia:'>`.$data[$index]['AGENCIA_CONTRATISTA'].`</td>
                <td data-title='Nombre Hotel:'>`.$data[$index]['NOMBRE_HOTEL'].`</td>
                <td data-title='Dirección Hotel:'>`.$data[$index]['DIRECCION_HOTEL'].`</td>
                <td data-title='Supervisor:'>`.$data[$index]['SUPERVISOR'].`<i id='supervisor' class='fas fa-check-circle'></i></td>
                <td>
                  <button id='`.$data[$index]['ID'].`>Ver</button>
                </td>
              </tr>

          `;
		return $TABLA_USUARIOS_ADMIN;
	}

	public function tablaEmpresas(){
		$TABLA_EMPRESAS_ADMIN = '
              <tr>
                <td data-title="ID:">'.$id.'</td>
                <td data-title="RUT:">'.$id.'</td>
                <td data-title="Nombre Comercial:">'.$id.'</td>
                <td data-title="Razón Social:">'.$id.'</td>
                <td data-title="Dueño:">'.$id.'</td>
                <td data-title="Tipo:">'.$id.'</td>
                <td>
                  <button id="'.$id.'">Ver</button>
                </td>
              </tr>

		';
		return $TABLA_EMPRESAS_ADMIN;
	}

	public function tablaVehiculos(){
		$TABLA_USUARIOS_ADMIN = '

              <tr>
                <td data-title="ID:">'.$id.'</td>
                <td data-title="Matrícula:">'.$id.'</td>
                <td data-title="Marca:">'.$id.'</td>
                <td data-title="Moelo:">'.$id.'</td>
                <td data-title="Combustible:">'.$id.'</td>
                <td data-title="Capacidad:">'.$id.'</td>
                <td data-title="Equipaje:">'.$id.'</td>
                <td data-title="RUT EM:">'.$id.'</td>
                <td data-title="RUT E:">'.$id.'</td>
                <td data-title="Pet Friendly:">'.$id.'</td>
                <td>
                  <button id="'.$id.'">Ver</button>
                </td>
              </tr>

		';
		return $TABLA_USUARIOS_ADMIN;
	}
}




 ?>