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
                    <input type='submit' value='REPARTE TUS CARTAS' />
                    <input type='hidden' name='oculto' value=1 />
                </td>
        </form>	
            </tr>
        </table>");

    if($_SESSION['marga'] != 1){
        global $ini;
        $ini = print("
        <div style='clear:both'></div>
            <table align='center' style=\"margin-top:20px; margin-bottom:10px; text-align: center; \" >
                <tr>
                    <td  valign='middle' style=\"text-align: center; font-size: 14px; color: #FF9900; padding: 20px; \">
            <p>1. HAY DOS JUGADORES, QUE SACAN 10 CARTAS AL AZAR QUE SE PUEDEN REPETIR.</p>
            <p>2. SE SUMAN LOS VALORES DE LAS CARTAS, DE CADA JUGADOR.</p>
                    </td>
                </tr>
            </table>
            <table align='center' style=\"margin-top:30px; margin-bottom:30px; text-align: center; \" >
                <tr>
                    <td  valign='middle' style=\"text-align: center; font-size: 34px; color: #FF9900; padding: 20px; \">
                        <p>REPARTE TUS CARTAS E INICIA EL JUEGO</p>
                    </td>
                </tr>
            </table>");}else{$ini = '';}

        } // FIN FUNCION SHOW_FORM

//////////////////////////////////////////////////////////////////////////////////////////////

function tirada(){
//$numero = rand(2, 7);
  $numero = 10;

// Guardamos los valores de las cartas en la matriz $cartas
$cartas = [];
for ($i = 0; $i < $numero; $i++) {
    $cartas[$i] = rand(1, 13);
    }

// Guardamos los valores de las cartas en la matriz $cartas2
$cartas2 = [];
for ($i = 0; $i < $numero; $i++) {
    $cartas2[$i] = rand(1, 13);
    }
    
//var_dump($cartas);
//var_dump($cartas2);

//////////////////////////////////////////////////////////////////////////////////////////////

// Mostramos las imágenes de las cartas obtenidos
print "  <h2>Tirada de ".$numero." cartas</h2>\n\n<p>";

foreach ($cartas as $carta) {
    print "<img src='Baraja_Francesa/Cartas/c".$carta.".png' width='100' height='160'>\n";
}
print "  </p>\n\n";

// Mostramos los valores numéricos de las cartas obtenidos
print "  <h2>RESULTADO: ";

$d = 0;
foreach ($cartas as $carta) { print ($carta." | ");
                            $d = $d + $carta;
                                    }
                    echo " * TOTAL = ".$d."</h2>";

/////////////////////////////

// Mostramos las imágenes de las cartas obtenidos

foreach ($cartas2 as $carta2) {
    print "<img src='Baraja_Francesa/Cartas/t".$carta2.".png' width='100' height='160'>\n";
}
print "  </p>\n\n";

// Mostramos los valores numéricos de los cartas obtenidos
print "  <h2>* RESULTADO: ";

$d2 = 0;
foreach ($cartas2 as $carta2) { print ($carta2." | ");
                            $d2 = $d2 + $carta2;
                                    }
                    echo " * TOTAL = ".$d2."</h2>\n\n";

    } // FIN FUNCION TIRADA

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'My.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////

/* Creado por Juan Barros Pazos 2020 */

?>