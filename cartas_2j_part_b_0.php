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
            <p>2. SE COMPARAN LAS CARTAS EN EL ORDEN QUE HAN SALIDO.</p>
            <p>3. SI NO COINCIDE NINGUNA CARTA GANA EL JUGADOR A.</p>
            <p>4. SI COINCIDE UNA SOLA CARTA GANA EL JUGADOR B.</p>
            <p>5. SI COINCIDE MÁS DE UNA CARTA SE PRODUCE UN EMPATE.</p>
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

$result_array = array_intersect_assoc($cartas, $cartas2);
global $r;
$r = count($result_array);
if ($r >= 1){ //print_r($result_array);
        }
else {$cl = '';}
print (" * NÚMERO DE COINCIDENCIAS: ".$r.".");

//////////////////////////////////////////////////////////////////////////////////////////////

// IMAGENES PRIMER JUGADOR.
print "  <h2>TIRADA DE ".$numero." CARTAS. * SE COMPARAN LAS CARTAS Y EL INDICE.</h2>\n\n<p>";

foreach ($cartas as $clavec => $carta) {
        /**/
        foreach ($result_array as $claver => $result){
            if(($carta == $result)&&($clavec == $claver)){ 
                $carta  = $carta.".png' style=\"border: 4px solid #FF9900; border-radius: 12px; \" ";
            } else { $carta = $carta.".png' ";}
                }  // FIN 2º FOREACH
    global $r;
    if ($r < 1){ $carta = $carta.".png'";}
                
    print "<img src='Baraja_Francesa/Cartas/c".$carta." width='100' height='160'>\n";
}
print "  </p>\n\n";

// VALORES PRIMER JUGADOR.
print "  <h4>* RESULTADO: ";

$d1 = 0;
foreach ($cartas as $clavec => $carta) {

    /**/
    foreach ($result_array as $claver => $result){
        if(($carta == $result)&&($clavec == $claver)){ 
            $carta = "<font color='#FF9900'>".$carta."</font>";
        } else { $carta = $carta;}
            }  // FIN 2º FOREACH
                print ($carta." | ");
                $d1 = $d1 + intval($carta);

            } // FIN 1º FOREACH

          echo " * TOTAL JUGADOR 1 = ".$d1."</h4>";

/////////////////////////////

// IMAGENES SEGUNDO JUGADOR

foreach ($cartas2 as  $clavec2 => $carta2) {
    foreach ($result_array as $claver => $result){
        if(($carta2 == $result)&&($clavec2 == $claver)){ 
            $carta2  = $carta2.".png' style=\"border: 4px solid #FF9900; border-radius: 12px; \" ";
        } else { $carta2 = $carta2.".png' ";}
            }  // FIN 2º FOREACH
global $r;
if ($r < 1){ $carta2 = $carta2.".png'";}

    print "<img src='Baraja_Francesa/Cartas/t".$carta2." width='100' height='160'>\n";
}
print "  </p>\n\n";

// VALORES SEGUNDO JUGADOR
print "  <h4>* RESULTADO: ";

$d2 = 0;
foreach ($cartas2 as  $clavec2 => $carta2) { 
    
    /**/
    foreach ($result_array as $claver => $result){//print("</br>".$result."</br>");
        if(($carta2 == $result)&&($clavec2 == $claver)){ 
            $carta2 = "<font color='#FF9900'>".$carta2."</font>";
        } else { $carta2 = $carta2;}
            }  // FIN 2º FOREACH
                print ($carta2." | ");
                            $d2 = $d2 + intval($carta2);
                                    }
                    echo " * TOTAL JUGADOR 2 = ".$d2."</h4>\n\n";

                    /////////////////////////

// En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
print "<h2>RESULTADOS TOTALES: ";

$gana1  = 0;
$gana2  = 0;
$empate = 0;

if (isset($_SESSION['gana1']) < 1){$gana1 = 0;}else{$gana1 = $_SESSION['gana1'];}
if (isset($_SESSION['gana2']) < 1){$gana2 = 0;}else{$gana2 = $_SESSION['gana2'];}
if (isset($_SESSION['empate']) < 1){$empate = 0;}else{$empate = $_SESSION['empate'];}

if ($r == 0) {
    $gana1 = $gana1 + 1;
    $_SESSION['gana1'] = $gana1;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 1 (NO HAY NINGUNA COINCIDENCIA).</h2>";
} elseif ($r == 1) {
    $gana2 = $gana2 + 1;
    $_SESSION['gana2'] = $gana2;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA GANADORA JUGADOR 2 (HAY UNA SOLA COINCIDENCIA)</h2>";
} elseif ($r > 1) {
    $empate = $empate + 1;
    $_SESSION['empate'] = $empate;
    echo "&nbsp;&nbsp;&nbsp;* TIRADA EMPATADA (HAY MAS DE UNA COINCIDENCIA)</h2>";
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