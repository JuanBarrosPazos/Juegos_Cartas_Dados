<?php

session_start();

	//require 'My.Inclu/error_hidden.php';
	require 'My.Inclu/Admin_Inclu_01a.php';


//////////////////////////////////////////////////////////////////////////////////////////////

        if(isset($_POST['oculto']) == 1){ $_SESSION['marga'] = 1;
                                        show_form();
                                        tirada();
                                    }
                                    else{ $_SESSION['marga'] = 0;
                                          show_form();
                                            }

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	print("<div style='clear:both'></div>
            <table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
        <form name='lanzar' method='post' action='$_SERVER[PHP_SELF]'>
            <tr>
                <td valign='middle' align='center'>
                    <input type='submit' value='LANZAR LOS DADOS' />
                    <input type='hidden' name='oculto' value=1 />
                </td>
        </form>	
            </tr>
        </table>");

    if($_SESSION['marga'] != 1){
        global $ini;
        $ini = print("
        <div style='clear:both'></div>
            <table align='center' style=\"margin-top:122px; margin-bottom:122px; text-align: center; \" >
                <tr>
                    <td  valign='middle' style=\"text-align: center; font-size: 34px; padding: 20px; \">
                        <p>LANZA TUS DADOS E INICIA EL JUEGO</p>
                    </td>
                </tr>
            </table>");}else{$ini = '';}

        }

//////////////////////////////////////////////////////////////////////////////////////////////

function tirada(){
//$numero = rand(2, 7);
  $numero = 4;

// Guardamos los valores de los dados en la matriz $dados
$dados = [];
for ($i = 0; $i < $numero; $i++) {
    $dados[$i] = rand(1, 6);
    }

// Mostramos las imágenes de los dados obtenidos
print "  <h2>Tirada de ".$numero." dados</h2>\n";
print "\n";
print "  <p>\n";
foreach ($dados as $dado) {
    print "<img src='Dados/d0".$dado.".png' width='140' height='140'>\n";
}
print "  </p>\n";
print "\n";

// Mostramos los valores numéricos de los dados obtenidos
print "  <h2>Resultado</h2>\n\n<p>Los valores obtenidos son: ";

$d = 0;
foreach ($dados as $dado) { print ($dado." ");
                            $d = $d + $dado;
                                    }
                    echo "* Total = ".$d."</p>\n\n";
    } // FIN FUNCION TIRADA

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'My.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Barros Pazos 2020 */

?>