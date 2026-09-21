<?php
include_once 'Partidos.php';
class PartidosModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    function obtenerPartidosPorRonda($idRonda) {
        $sql = "SELECT * FROM partido WHERE IDRONDA = :idRonda";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idRonda', $idRonda);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $partidos = [];

        foreach ($datos as $dato) {
            $partidos[] = new Partidos(
                $dato['ID'],
                $dato['NUMERO'],
                $dato['IDRONDA'],
                $dato['IDCOMPETIDOR_1'],
                $dato['IDCOMPETIDOR_2'],
                $dato['IDGANADOR'],
                $dato['EMPATE']
            );
        }

        return $partidos;
    }

    function crearPartido($numero,$idRonda,$competidor1=null,$competidor2=null){
    $sql = "INSERT INTO partido (NUMERO, IDRONDA, IDCOMPETIDOR_1, IDCOMPETIDOR_2)
            VALUES (:numero, :idRonda, :competidor1, :competidor2)";
    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(':numero', $numero);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->bindValue(':competidor1', $competidor1);
    $stmt->bindValue(':competidor2', $competidor2);
    return $stmt->execute();
}

    function obtenerPartidoPorId($idPartido) {
        $sql = "SELECT * FROM partido WHERE ID = :idPartido";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idPartido', $idPartido);
        $stmt->execute();
        $dato = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dato) {
            return new Partidos(
                $dato['ID'],
                $dato['NUMERO'],
                $dato['IDRONDA'],
                $dato['IDCOMPETIDOR_1'],
                $dato['IDCOMPETIDOR_2'],
                $dato['IDGANADOR'],
                $dato['EMPATE']
            );
        } else {
            return null;
        }
    }

    function cantidadPartidosPorRonda($idRonda) {

    $sql = "SELECT COUNT(*) AS cantidad FROM partido WHERE IDRONDA = :idRonda";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->execute();

    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    return $datos['cantidad'];
}

//para cada vez que edite un enfrentamiento en emparejamientos.php para eliminacion directa
function actualizarEmparejamiento($idPartido, $competidor1, $competidor2, $ganador) {
    $sql = "UPDATE partido SET IDCOMPETIDOR_1 = :competidor1, IDCOMPETIDOR_2 = :competidor2, IDGANADOR = :ganador WHERE ID = :idPartido";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':competidor1', $competidor1);
    $stmt->bindValue(':competidor2', $competidor2);
    $stmt->bindValue(':ganador', $ganador);
    $stmt->bindValue(':idPartido', $idPartido);
    return $stmt->execute();
}

//para cada vez que edite un enfrentamiento en emparejamientos.php para liga
function actualizarResultadoLiga($idPartido, $ganador, $empate) {
    $sql = "UPDATE partido SET IDGANADOR = :ganador, EMPATE = :empate WHERE ID = :idPartido";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':ganador', $ganador);
    $stmt->bindValue(':empate', $empate);
    $stmt->bindValue(':idPartido', $idPartido);
    return $stmt->execute();
}




//ver la cantidad de partidos, sin ser este, que tienen al mismo competidor que estas eligiendp
function competidorEstaEnOtraPartido($idRonda, $idPartido, $idCompetidor) {

    $sql = "SELECT COUNT(*) AS cantidad FROM partido WHERE IDRONDA = :idRonda AND ID != :idPartido
            AND (IDCOMPETIDOR_1 = :idCompetidor OR IDCOMPETIDOR_2 = :idCompetidor)";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->bindValue(':idPartido', $idPartido);
    $stmt->bindValue(':idCompetidor', $idCompetidor);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//obtener los ganadores de cada partido y ordenar los numeros de los aprtidos para saber quienes se enfrenten en los siguientes
function obtenerGanadoresPorRonda($idRonda) {
    $sql = "SELECT IDGANADOR FROM partido WHERE IDRONDA = :idRonda ORDER BY NUMERO";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}



//ver si dos competidores ya se enfrentaron en alguna ronda anterior del torneo (para el sistema suizo)
function yaSeEnfrentaron($idCompetidor1, $idCompetidor2) {
    $sql = "SELECT COUNT(*) AS cantidad FROM partido
            where (IDCOMPETIDOR_1 = :c1 AND IDCOMPETIDOR_2 = :c2)
            OR (IDCOMPETIDOR_1 = :c2 AND IDCOMPETIDOR_2 = :c1)";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':c1', $idCompetidor1);
    $stmt->bindValue(':c2', $idCompetidor2);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

    
}

}
?>