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
                                    else{ resetea();
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
                    <input type='submit' value='LANZAR LOS DADOS' />
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
  $numero = 5;

// JUGADOR 1

// Guardamos los valores del Jugador 1 en la matriz $dados1
$dados1 = [];
for ($i = 0; $i < $numero; $i++) {
    $dados1[$i] = rand(1, 6);
}

// Mostramos los valores numéricos de los dados obtenidos
print "  <h2>RESULTADO JUGADOR 1. * Valores:  ";
$d1 = 0;
foreach ($dados1 as $dado1) {
    print $dado1." | ";
    $d1 = $d1 + $dado1;
}
echo "* TOTAL: ".$d1."</h2>\n\n";

// Mostramos los resultados obtenidos por el Jugador 1
print "  <p>\n";
foreach ($dados1 as $dado1) {
    print "<img src='Dados/d0".$dado1.".png' width='140' height='140'>\n";
}
print "  </p>\n";
print "\n";

/////////////////////////
// JUGADOR 2

// Guardamos los valores del Jugador 2 en la matriz $dados2
$dados2 = [];
for ($i = 0; $i < $numero; $i++) {
    $dados2[$i] = rand(1, 6);
}

// Mostramos los valores numéricos de los dados obtenidos
print "  <h2>RESULTADO JUGADOR 2. * Valores: ";

$d2 = 0;
foreach ($dados2 as $dado2) {
    print $dado2." | ";
    $d2 = $d2 + $dado2;
}
echo "* TOTAL: ".$d2."</h2>\n\n";

// Mostramos los resultados obtenidos por el Jugador 2
print "  <p>\n";
foreach ($dados2 as $dado2) {
    print "<img src='Dados/d0".$dado2.".png' width='140' height='140'>\n";
}
print "  </p>\n";
print "\n";

/////////////////////////

// En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
print "<h2>RESULTADOS TOTALES</h2>\n\n";

    $gana1  = 0;
    $gana2  = 0;
    $empate = 0;

    if (isset($_SESSION['gana1']) < 1){$gana1 = 0;}else{$gana1 = $_SESSION['gana1'];}
    if (isset($_SESSION['gana2']) < 1){$gana2 = 0;}else{$gana2 = $_SESSION['gana2'];}
    if (isset($_SESSION['empate']) < 1){$empate = 0;}else{$empate = $_SESSION['empate'];}

    if ($d1 > $d2) {
        $gana1 = $gana1 + 1;
        $_SESSION['gana1'] = $gana1;
        echo "<h2>&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 1</h2>";
    } elseif ($d1 < $d2) {
        $gana2 = $gana2 + 1;
        $_SESSION['gana2'] = $gana2;
        echo "<h2>&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 2</h2>";
    } else {
        $empate = $empate + 1;
        $_SESSION['empate'] = $empate;
        echo "<h2>&nbsp;&nbsp;&nbsp;* TIRADA EMPATADA</h2>";
    }

// Mostramos cuántas partidas ha ganado cada uno
        print "  <p>* El jugador 1 ha ganado <strong>$gana1</strong> ve";
        if ($gana1 != 1) {
            print "ces</br>";
            } else {
                print "z</br>";
            }
            print "* El jugador 2 ha ganado <strong>$gana2</strong> ve";
        if ($gana2 != 1) {
                print "ces</br>";
            } else {
                print "z</br>";
            }
            print "* Los jugadores han empatado <strong>$empate</strong> ve";
        if ($empate != 1) {
                print "ces.</p></br>";
            } else {
                print "z.</p></br>";
            }

// Mostramos quién ha ganado la partida
        if ($gana1 > $gana2) {
            print "  <h2>EN CONJUNTO HA GANADO EL JUGADOR 1.</h2>\n";
            } elseif ($gana1 < $gana2) {
                print "  <h2>EN CONJUNTO HA GANADO EL JUGADOR 2.</h2>\n";
                } else {
                    print "  <h2>EN CONJUNTO HAN EMPATADO.</h2>\n";
                }

} // FIN FUNCTION TIRADA

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'My.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Barros Pazos 2020 */

?>