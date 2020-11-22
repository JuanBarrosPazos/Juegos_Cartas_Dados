<?php
session_start();

	//require 'My.Inclu/error_hidden.php';
	require 'My.Inclu/Admin_Inclu_01a.php';

//////////////////////////////////////////////////////////////////////////////////////////////

        if(isset($_POST['oculto']) == 1){ $_SESSION['marga'] = 1;
                                        show_form();
                                        tirada();
                                    }
            elseif(isset($_POST['oculto2']) == 1){ resetea();
                                                   show_form();
                                                }
                                    else{ $_SESSION['marga'] = 0;
                                          show_form();
                                            }

//////////////////////////////////////////////////////////////////////////////////////////////

function resetea(){

    global $gana1;
    global $gana2;
    global $empate;
    $gana1  = 0;
    $gana2  = 0;
    $empate = 0;
    $_SESSION['gana1'] = 0;
    $_SESSION['gana2'] = 0;
    $_SESSION['empate'] = 0;
    $_SESSION['marga'] = 0;
}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

    if($_SESSION['marga'] == 1){
                        global $resetea;
                        $resetea = " <form name='limpiar' method='post' action='$_SERVER[PHP_SELF]'>
                                        <td valign='middle' align='center'>
                                            <input type='submit' value='RESETEAR LA PARTIDA' />
                                            <input type='hidden' name='oculto2' value=1 />
                                        </td>
                                     </form> ";}else{$resetea = '';}

	print("<div style='clear:both'></div>
            <table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
        <form name='lanzar' method='post' action='$_SERVER[PHP_SELF]'>
            <tr>
                <td valign='middle' align='center'>
                    <input type='submit' value='REPARTE TUS CARTAS' />
                    <input type='hidden' name='oculto' value=1 />
                </td>
        </form>	
        ".$resetea."
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
            <p>2. SE SUMAN LOS RESULTADOS DE LOS DOS JUGADORES.</p>
            <p>3. GANA LA MÁXIMA PUNTUACIÓN.</p>
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
print "  <h2>TIRADA DE ".$numero." CARTAS. * GANA LA MÁXIMA PUNTUACIÓN.</h2>\n\n<p>";

foreach ($cartas as $carta) {
    print "<img src='Baraja_Francesa/Cartas/c".$carta.".png' width='100' height='160'>\n";
}
print "  </p>\n\n";

// Mostramos los valores numéricos de las cartas obtenidos
print "  <h2>RESULTADO: ";

$d1 = 0;
foreach ($cartas as $carta) { 
                            print ($carta." | ");
                            $d1 = $d1 + $carta;
                                    }
                    echo " * TOTAL JUGADOR 1 = ".$d1."</h2>";

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
                    echo " * TOTAL JUGADOR 2 = ".$d2."</h2>\n\n";

                    /////////////////////////

// En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
print "<h2>RESULTADOS TOTALES: ";

$gana1  = 0;
$gana2  = 0;
$empate = 0;

if (isset($_SESSION['gana1']) < 1){$gana1 = 0;}else{$gana1 = $_SESSION['gana1'];}
if (isset($_SESSION['gana2']) < 1){$gana2 = 0;}else{$gana2 = $_SESSION['gana2'];}
if (isset($_SESSION['empate']) < 1){$empate = 0;}else{$empate = $_SESSION['empate'];}

if ($d1 > $d2) {
    $gana1 = $gana1 + 1;
    $_SESSION['gana1'] = $gana1;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 1</h2>";
} elseif ($d1 < $d2) {
    $gana2 = $gana2 + 1;
    $_SESSION['gana2'] = $gana2;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 2</h2>";
} else {
    $empate = $empate + 1;
    $_SESSION['empate'] = $empate;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA EMPATADA</h2>";
}

// Mostramos cuántas partidas ha ganado cada uno
    print "  <p>* El jugador 1 ha ganado <strong>$gana1</strong> ve";
    if ($gana1 != 1) {
        print "ces.</br>";
        } else {
            print "z.</br>";
        }
        print "* El jugador 2 ha ganado <strong>$gana2</strong> ve";
    if ($gana2 != 1) {
            print "ces.</br>";
        } else {
            print "z.</br>";
        }
        print "* Los jugadores han empatado <strong>$empate</strong> ve";
    if ($empate != 1) {
            print "ces.</p>";
        } else {
            print "z.</p>";
        }

// Mostramos quién ha ganado la partida
    if ($gana1 > $gana2) {
        print "  <h2>EN CONJUNTO HA GANADO EL JUGADOR 1.</h2>\n";
        } elseif ($gana1 < $gana2) {
            print "  <h2>EN CONJUNTO HA GANADO EL JUGADOR 2.</h2>\n";
            } else {
                print "  <h2>EN CONJUNTO HAN EMPATADO.</h2>\n";
            }

    } // FIN FUNCION TIRADA

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'My.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Barros Pazos 2020 */

?>