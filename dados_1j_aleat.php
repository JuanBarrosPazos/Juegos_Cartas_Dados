<?php

session_start();

	//require 'My.Inclu/error_hidden.php';
	require 'My.Inclu/Admin_Inclu_01a.php';


//////////////////////////////////////////////////////////////////////////////////////////////

print ( "<h1>Tirada de dados</h1>
         <p>Actualice la página para mostrar una nueva tirada.</p>"
            );

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

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'My.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Barros Pazos 2020 */

?>