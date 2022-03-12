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
            <p>1. SE SACAN DOS CARTAS DE REFERENCIA QUE SON LAS QUE PUNTUAN</p>
            <p>2. POR CADA CARTA QUE COINCIDA CON LAS DE REFERENCIA SE RECIBE ESA PUNTUACIÓN</p>
            <p>3. GANA EL JUGADOR CON MÁS PUNTOS.</p>
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
  $numero = 7;
  $nref = 2;

// Guardamos los valores de la referencia en la matriz $refer
    $refer = [];
    for ($i = 0; $i < $nref; $i++) {
        $refer[$i] = rand(1, 13);
        }
//var_dump($refer);

// Guardamos los valores de las cartas en la matriz $cartas
    $cartas = [];
    for ($a = 0; $a < $numero; $a++) {
        $cartas[$a] = rand(1, 13);
        }
//var_dump($cartas);

// Guardamos los valores de las cartas en la matriz $cartas2
    $cartas2 = [];
    for ($i = 0; $i < $numero; $i++) {
        $cartas2[$i] = rand(1, 13);
        }
//var_dump($cartas2);
    
//////////////////////////////////////////////////////////////////////////////////////////////

// interseccion de los array

$result_array_j1 = array_intersect($refer, $cartas);
$result_array_j2 = array_intersect($refer, $cartas2);
global $rj1;
$rj1 = count($result_array_j1);
global $rj2;
$rj2 = count($result_array_j2);
$rt = $rj1 + $rj2;
/*
if ($rj1 >= 1){ print_r($result_array_j1);}
if ($rj2 >= 1){ print_r($result_array_j2);}

print (" * NÚMERO DE COINCIDENCIAS J1: ".$rj1.".");
print (" * NÚMERO DE COINCIDENCIAS J2: ".$rj2.".");
print (" * NÚMERO DE COINCIDENCIAS TOTAL: ".$rt.".");
var_dump($result_array_j1);
var_dump($result_array_j2);
*/
//////////////////////////////////////////////////////////////////////////////////////////////

// IMAGENES REFERENCIA.
print "  <h2>TIRADA DE ".$numero." CARTAS Y ".$nref." DOS DE REFERENCIA. </h2>\n<p>";

    foreach ($refer as /*$refc =>*/ $referv) {
    print "<img src='Baraja_Francesa/Cartas/c".$referv.".png' width='100px' height='160px' >\n";
        }
    print "  </p>\n\n";

// VALORES DE REFERENCIA.
    print "  <h4>* RESULTADOS REFERENCIA: ";

    $d0 = 0;
    foreach ($refer as $referv) { print ($referv." | ");
                                  $d0 = $d0 + $referv;
                                } // FIN FOREACH

    //  echo " * TOTAL REFERENCIA 1 = ".$d0."</h4>";

//////////////////////////////////////////////////////////////////////////////////////////////

// IMAGENES PRIMER JUGADOR.
/**/
print " \n<p>";

foreach ($cartas as $carta) {
        
        foreach ($result_array_j1 as $result){
            if($carta == $result){ 
                $carta  = $carta.".png' style=\"width: 92px; height: 152px; border: 4px solid #FF9900; border-radius: 12px; opacity: 0.8; \" ";
            } else { $carta = $carta.".png' width='100px' height='160px' ";}
                }  // FIN 2º FOREACH
    global $rj1;
    if ($rj1 < 1){ $carta = $carta.".png' width='100px' height='160px'";}
                
    print "<img src='Baraja_Francesa/Cartas/c".$carta." >\n";
}
print "  </p>\n";


//////////////////////////////////////////////////////////////////////////////////////////////

// VALORES PRIMER JUGADOR.
print "  <h4>* RESULTADO: ";
global $d1;
$d1 = 0;
foreach ($cartas as $carta) {
    foreach ($result_array_j1 as $result){
        if($carta == $result){ 
            $cartan = $carta;
            $d1 = $d1 + $cartan;
            $carta = "<font color='#FF9900'>".$carta."</font>";
        } else { $carta = $carta;}
            }  // FIN 2º FOREACH
                print ($carta." | ");
        } // FIN 1º FOREACH

    echo " * TOTAL JUGADOR 1 = ".$d1."</h4>";


//////////////////////////////////////////////////////////////////////////////////////////////

// IMAGENES SEGUNDO JUGADOR

print " \n<p>";
foreach ($cartas2 as $carta2) {
    foreach ($result_array_j2 as $result){
        if($carta2 == $result){ 
            $carta2  = $carta2.".png'  style=\"width: 92px; height: 152px; border: 4px solid #FF9900; border-radius: 12px; opacity: 0.8; \" ";
        } else { $carta2 = $carta2.".png' width='100px' height='160px' ";}
            }  // FIN 2º FOREACH
global $rj2;
if ($rj2 < 1){ $carta2 = $carta2.".png' width='100px' height='160px'";}

    print "<img src='Baraja_Francesa/Cartas/t".$carta2." >\n";
}
print "  </p>\n";

//////////////////////////////////////////////////////////////////////////////////////////////

// VALORES SEGUNDO JUGADOR
print "  <h4>* RESULTADO: ";
global $d2;
$d2 = 0;
foreach ($cartas2 as $carta2) {
    foreach ($result_array_j2 as $result2){
        if($carta2 == $result2){ 
            $cartan2 = $carta2;
            $d2 = $d2 + $cartan2;
            $carta2 = "<font color='#FF9900'>".$carta2."</font>";
        } else { $carta2 = $carta2;}
            }  // FIN 2º FOREACH
                print ($carta2." | ");
        } // FIN 1º FOREACH

    echo " * TOTAL JUGADOR 1 = ".$d2."</h4>";

//////////////////////////////////////////////////////////////////////////////////////////////

// En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
/* */
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
    echo "&nbsp;&nbsp;&nbsp;<font color='#FF9900'>* TIRADA GANADORA JUGADOR 1.</font></h2>";
} elseif ($d1 < $d2) {
    $gana2 = $gana2 + 1;
    $_SESSION['gana2'] = $gana2;
    echo "&nbsp;&nbsp;&nbsp;<font color='#FF9900'>* TIRADA GANADORA JUGADOR 2</font></h2>";
} elseif ($d1 == $d2) {
    $empate = $empate + 1;
    $_SESSION['empate'] = $empate;
    echo "&nbsp;&nbsp;&nbsp;<font color='#FF9900'>* TIRADA EMPATADA</font></h2>";
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