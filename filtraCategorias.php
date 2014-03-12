<?php
include "funciones.php";
$categoria = $_GET['categoria'];
 
$db = conectaDb();
$consulta = "SELECT enunciado, fcreacion, idRespuesta, idPregunta
                        FROM Preguntas, Categorias, RPC
                        WHERE Categorias.nombre LIKE  :categoria
                        AND Categorias.id = RPC.idCategoria
                        AND RPC.idPregunta = Preguntas.id";
 
$result = $db->prepare($consulta);
$result->execute(array(":categoria"=>"%$categoria%"));
 
if($result){
        foreach ($result as $value) {
                $consultaV = "SELECT * FROM Respuestas WHERE id='".$value['idRespuesta']."'";
                $resultV = $db->query($consultaV);
                if($resultV){
                        foreach ($resultV as $valueV) {
                                echo "<div class='divPregunta'>
                                        <h4>" . $value['enunciado'] . " <strong>(" . $value['fcreacion'] . ")</strong></h4>
                                        <ul>
                                                <li class='respV'>" . $valueV['texto'] . "</li>";
                                                $consultaRPRF = "SELECT * FROM RPRF WHERE idPregunta='" . $value['idPregunta'] . "'";
                                                $resultRPRF = $db->query($consultaRPRF);
                                                if($resultRPRF){
                                                        foreach ($resultRPRF as $valueRPRF) {
                                                                $consultaF = "SELECT * FROM Respuestas WHERE id='" . $valueRPRF['idRespuesta'] . "'";
                                                                $resultF = $db->query($consultaF);
                                                                if($resultF){
                                                                        foreach ($resultF as $valueF) {
                                                                                echo "<li>" . $valueF['texto'] . "</li>";
                                                                        }
                                                                }
                                                        }
                                                }
                                        echo "</ul>
                                </div>";
                        }      
                }
        }
 
}
 
$db=null;