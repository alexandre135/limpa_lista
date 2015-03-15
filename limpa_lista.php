<?php
$diretorio = "upload/";

if (!is_dir($diretorio)){ echo "Pasta $diretorio nao existe";} 

else { 


				$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
				
					for ($k = 0; $k < count($arquivo['name']); $k++)
						{
						   $destino = $diretorio.$arquivo['name'][$k];

						    if (move_uploaded_file($arquivo['tmp_name'][$k], $destino)) { 

						    $lines[$k] = file ($diretorio.$arquivo['name'][$k]);
						   
						}
						    
									
						    else {echo "não foi possivel mover o arquivo".$arquivo['name'][$k];}
						}		


}
$arquivo_1 = $lines[0];
$arquivo_2 = $lines[1];

$result = array_diff($arquivo_1, $arquivo_2);

$resultado = implode('', $result);
$resultado1 = implode('<br>', $result);
$email = "email"."\n";
$filename = $diretorio.'filtrado.txt';
if ($filename){
	unlink($filename);
};
unlink($diretorio.$arquivo['name'][0]);
unlink($diretorio.$arquivo['name'][1]);
$handle = fopen($filename, 'a');
fwrite($handle, $email);
fwrite($handle, $resultado);
fclose($handle);

echo '<a href="'.$filename.'" download="filtrado">Download do arquivo</a><br>';
echo 'email<br>'.$resultado1;
?>