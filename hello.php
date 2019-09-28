<?php 
/*Ejercicio 1*/
$arreglo = [
	'keyStr1' => 'lado',
	0 => 'ledo',
	'keyStr2' => 'lido',
	1 => 'lodo',
	2 => 'ludo'
];
echo "<h2>FRASE</h2>";
$frase1 = "";
foreach($arreglo as $elemento){
    $frase1 .= $elemento .",";
}
$frase1 = ucfirst($frase1);
$frase1 .= "<br />decirlo al revés lo dudo.<br />";
$frase2 = "";
$arreglo = array_reverse($arreglo);
foreach($arreglo as $elemento){
    $frase2 .= $elemento .",";
}
$frase2 = ucfirst($frase2);
$frase2 .= "<br />¡Qué trabajo me ha costado!";
echo $frase1.$frase2;
echo "<br />";
/*Ejercicio 1*/
echo "<h2>PAISES</h2>";
$paises = [
	['nombre' => 'México', 'ciudades' => ['Morelia','Monterrey','Guadalajara'] ],
	['nombre' => 'USA', 'ciudades' => ['Miami','Los Angeles','New York'] ],
	['nombre' => 'Canadá', 'ciudades' => ['Vancouver','Montreal','Ottawa'] ],
	['nombre' => 'Argentina', 'ciudades' => ['Buenos Aires','Salta','Rosario'] ],
	['nombre' => 'Colombia', 'ciudades' => ['Cali','Cartagena','Bogotá'] ]
];
$paises_str = '';
foreach ($paises as $pais) {
    $paises_str .= '<strong>'.$pais['nombre'].':</strong>';
    foreach ($pais['ciudades'] as $ciudad) {
        $paises_str .= ' '. $ciudad . ' ';
    }
    $paises_str .= '<br/>';
}
echo $paises_str;
echo "<br />";
/*Ejercicio 3 */
echo "<h2>MAS PEQUEÑOS Y GRANDES</h2>";
$valores = [23, 54, 32, 67, 34, 78, 98, 56, 21, 34, 57, 92, 12, 5, 61];
sort($valores);
$mas_peques = "Mas pequeños: ";
for ($i=0; $i < 3; $i++) { 
    $mas_peques .= $valores[$i]. " ";
}
echo $mas_peques;
$grandes = array_reverse($valores);
$mas_grandes = "<br/> Mas grandes: ";
for ($i=0; $i < 3; $i++) { 
    $mas_grandes .= $grandes[$i]. " ";
}
echo $mas_grandes;

//EJERCICIO 1
$suma1 = 32+3;
$suma2 = 3*(2+3);

echo "<p> Suma 1 = $suma1 / Suma 2 = $suma2 </p>";

//EJERCICIO 2
$valor = "10";
if($valor > 5 && $valor < 10){
	echo "<p>$valor es mayor que 5 pero menor que 10. </p>";
}
if($valor >= 0 && $valor <=20 ){
	echo "<p>$valor es mayor o igual a 0 pero menor o igual a 20. </p>";
}
if($valor === "10"){
	echo "<p>$valor es igual a “10” asegurando que el tipo de dato sea cadena.</p>";
}
if(($valor >0 && $valor <5)|| ($valor > 10 && $valor < 15)){
	echo "<p>$valor es mayor a 0 pero menor a 5 o es mayor a 10 pero menor a 15.</p>";
}
?>