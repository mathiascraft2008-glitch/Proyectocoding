<?php
require_once "../modelo/torneoModelo.php";
require_once "../modelo/conexion.php";
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/Torneo.php";
require_once "../modelo/Registro.php";
require_once "../modelo/registroModelo.php";
require_once "../modelo/Ronda.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/Partidos.php";
require_once "../modelo/partidosModelo.php";
require_once "../modelo/competidorModelo.php";
require_once "../modelo/Competidor.php";
$action = $_POST['action'];

if ($action == 'formularioTorneo') {
    crearTorneo($conexion);
}
if ($action == 'actualizarEmparejamiento') {
    actualizarEmparejamiento($conexion);
}

if ($action == 'generarRonda') {
    generarRonda($conexion);
}

if ($action == 'generarLiga') {
    generarLiga($conexion);
}

if ($action == 'actualizarEmparejamientoLiga'){
    actualizarEmparejamientoLiga($conexion);
}

if ($action == 'generarSuizo') {
    generarSuizo($conexion);
}

if ($action == 'actualizarEmparejamientoSuizo'){
    actualizarEmparejamientoSuizo($conexion);
}





function crearTorneo($conexion) {

    session_start();

    $idOrganizador = $_SESSION['id'];

    $nombre = $_POST['nom'];
    $fecha = $_POST['fecha-inicio'];
    $formato = $_POST['format'];
    $disciplina = $_POST['disciplina'];
    $lugar = $_POST['lugar'];
    $participacion = $_POST['modo'];
    $contraseña = $_POST['pass'];
    $maxInscripciones = $_POST['maxInscripciones'];
    $maxEquipos=null;
    if($participacion=="equipo"){
        $maxEquipos=$_POST['max-equipos'];
    }

    $torneoModelo = new torneoModelo($conexion);
    // Validaciones
    $formatoBD = $torneoModelo->formatoActivo($formato);

    if (!$formatoBD['ACTIVO']) {
        echo "<script>
                alert('El formato elegido está deshabilitado.');
                window.history.back();
            </script>";
        exit;
    }
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    
    $registroModelo = new registroModelo($conexion);
    $torneo = new Torneo(null,$idOrganizador,$nombre,$fecha,$formato,$disciplina,$lugar,
                        $participacion,$contraseñaHash,$maxInscripciones,$maxEquipos);

    $resultado = $torneoModelo->crear($torneo);
    $registro=new Registro(null,"Se creó un nuevo torneo, id organizador: ",$idOrganizador,null);
    if ($resultado) {
        $rol="";
        //ver si la sesion ya esta abierta para que no salga un error por abrir 2 veces la sesion
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['rol'] == 'administrador') {
                $rol="mainAdministrador.php";
            }else{
                $rol="mainUsuario.php";
            }
        $registroModelo->registroAuditoria($registro);
        header("Location: ../vista/$rol"); 
        exit;
    } else {
        echo "<script> alert('Error al crear el torneo.');
                    window.history.back(); </script>";
        exit;
    }
}




//para emparejamientos.php
function actualizarEmparejamiento($conexion) {

    $idPartido = $_POST['idPartido'];
    $idTorneo = $_POST['idTorneo'];
    $ganador = $_POST['ganador'];

    //obtener la ronda del partido
    $partidosModelo = new partidosModelo($conexion);
    $partidoActual = $partidosModelo->obtenerPartidoPorId($idPartido);
    $idRonda = $partidoActual->getIdRonda();

    // Obtener la ronda
    $rondaModelo = new rondaModelo($conexion);
    $ronda = $rondaModelo->obtenerRondaPorId($idRonda);

    //ver que ronda es para obtener competidores del form o del partido 
    if ($ronda->getNumero() == 1) {

            //en la ronda 1, el usuario elije a los competidores
            $competidor1 = $_POST['competidor1'];
            $competidor2 = $_POST['competidor2'];
            if ($competidor1 == $competidor2) {
                echo "<script>
                        alert('Un competidor no puede enfrentarse contra sí mismo.');
                        window.history.back();
                    </script>";
                exit;
            }

            if ($ganador != $competidor1 && $ganador != $competidor2) {
                echo "<script>
                        alert('El ganador debe ser uno de los dos competidores.');
                        window.history.back();
                    </script>";
                exit;
            }

            
            //verificar que competidor 1 no este en otro partido
            $dato=$partidosModelo->competidorEstaEnOtraPartido($idRonda,$idPartido,$competidor1);
            $dato2=$partidosModelo->competidorEstaEnOtraPartido($idRonda,$idPartido,$competidor2);
            if ($dato['cantidad']>0){
                echo "<script>
                        alert('El competidor 1 ya está participando en otro partido de esta ronda');
                        window.history.back();
                    </script>";
                exit;
            }

            //verificar que competidor 2 no este en otro partido
            if ($dato2['cantidad']>0){
                echo "<script>
                        alert('El competidor 2 ya está participando en otro partido de esta ronda');
                        window.history.back();
                    </script>";
                exit;
            }
            
    } else {
            //a partir de la ronda 2, los competidores ya están definidos
            $competidor1 = $partidoActual->getCompetidor1();
            $competidor2 = $partidoActual->getCompetidor2();
    }


    $resultado = $partidosModelo->actualizarEmparejamiento($idPartido,$competidor1,$competidor2,$ganador);

    if ($resultado) {
        header("Location: ../vista/TorneoEliminacionDirecta.php?id=$idTorneo");
        exit;
    } else {
        echo "<script>
                alert('Error al actualizar el emparejamiento.');
                window.history.back();
              </script>";
        exit;
    }
}









function generarRonda($conexion) {

    $idTorneo = $_POST['idTorneo'];

    $torneoModelo = new torneoModelo($conexion);
    $rondaModelo = new rondaModelo($conexion);
    $partidosModelo = new partidosModelo($conexion);
    $fechaInicio = $_POST['fechaInicio'];
    $torneo = $torneoModelo->obtenerTorneo($idTorneo);

    // ver si ya existe una ronda 
    if ($torneoModelo->rondaCreada($idTorneo)==false) {

        //primera ronda

        $nuevaRonda = new Ronda(null,1,$idTorneo,$fechaInicio);
        $rondaModelo->crearRonda($nuevaRonda);
        $idRonda = $conexion->lastInsertId();
        // Obtener cantidad máxima del torneo
        if ($torneo->getParticipacion() === 'solo') {
            $cantidadCompetidores = $torneo->getMaxInscripciones();
        } else {
            $cantidadCompetidores = $torneo->getMaxEquipos();
        }

        $cantidadPartidos = $cantidadCompetidores / 2;
            //crear partidos---------------------------------------------------------------------------------------------------------------
        
        for ($i = 1; $i <= $cantidadPartidos; $i++) {
            $partidosModelo->crearPartido($i,$idRonda);
        }

    } else {

        //siquiente ronda-------------------------

        $ultimaRonda = $rondaModelo->obtenerUltimaRonda($idTorneo);

        // Ver si quedaron partidos sin ganador
        $pendientes = $rondaModelo->rondaAnteriorTerminada($ultimaRonda->getId());
        if ($pendientes['partidosPendientes'] > 0) {
            echo "<script>
                    alert('No se puede generar una nueva ronda, todavía hay partidos pendientes de la ronda anterior.');
                    window.history.back();
                  </script>";
            exit;
        }

        // Cantidad de partidos de la ronda anterior
        $cantidadPartidosAnterior =$partidosModelo->cantidadPartidosPorRonda($ultimaRonda->getId());
        //obteenr ganadores de la ultima ronda-------------------------------------------------------------------------
        $ganadores = $partidosModelo->obtenerGanadoresPorRonda($ultimaRonda->getId());
        // Si solo queda un partido, esa era la final---------------------------------------------------------------------
        if ($cantidadPartidosAnterior == 1) {

            echo "<script>
                    alert('El torneo ya finalizó.');
                    window.history.back();
                  </script>";
            exit;
        }

        $numeroNuevaRonda = $ultimaRonda->getNumero() + 1;
        $nuevaRonda = new Ronda(null,$numeroNuevaRonda,$idTorneo,$fechaInicio);
        $rondaModelo->crearRonda($nuevaRonda);
        $idRonda = $conexion->lastInsertId();

        //se crea la mitad de partidos de la ronda anterior viendo la cantidad de ganadores
        //se recorre de a dos para poner en un mismo partido a los dos ganadores de partidos anteriores
        $numeroPartido = 1;
        for ($i = 0; $i < count($ganadores); $i=$i+2) {
            $partidosModelo->crearPartido($numeroPartido,$idRonda,$ganadores[$i],$ganadores[$i+1]);
            $numeroPartido++;
        }
    }

    header("Location: ../vista/TorneoEliminacionDirecta.php?id=$idTorneo");
    exit;
}











function generarLiga($conexion){
    
    $idTorneo = $_POST['idTorneo'];

    $torneoModelo = new torneoModelo($conexion);
    $rondaModelo = new rondaModelo($conexion);
    $partidosModelo = new partidosModelo($conexion);

    $torneo = $torneoModelo->obtenerTorneo($idTorneo);

    //ver cuantos participantes o equipos maximos eligió para saber cuantas jornadas hacer
    if ($torneo->getParticipacion() == 'solo') {
        $maximo = $torneo->getMaxInscripciones();
    } else {
        $maximo = $torneo->getMaxEquipos();
    }

    $competidorModelo = new CompetidorModelo($conexion);
    $cantCompetidores = $competidorModelo->CantidadCompetidores($idTorneo);

    //se necesita el maximo de competidores para crear los partidos
    if ($cantCompetidores['cantidad'] != $maximo) {
        echo "<script>
                alert('No se puede generar la liga porque todavía no se alcanzó el máximo de competidores');
                window.history.back();
            </script>";
        exit;
    }

    //crear jornadas
    for ($i = 1; $i <= ($maximo-1); $i++) {
        $nuevaRonda = new Ronda(null,$i,$idTorneo,null);
        $rondaModelo->crearRonda($nuevaRonda);
        $idRonda = $conexion->lastInsertId();

    }

    $competidores = $competidorModelo->obtenerCompetidoresPorTorneo($idTorneo);

    $rondas=$rondaModelo->obtenerRondasPorTorneo($idTorneo);
    //ahora, generar los partidos de cada jornada,
    //  en cada jornada hay emparejamientos nuevos hasta que ya no se puedan hacer más

    $mitad = $maximo / 2;

    foreach ($rondas as $ronda) {
        // Crear los partidos de esta jornada
        for ($i = 0; $i < $mitad; $i++) {
            $competidor1 = $competidores[$i];
            $competidor2 = $competidores[$maximo-1-$i];
            $partidosModelo->crearPartido($i+1,$ronda->getId(),$competidor1->getId(),$competidor2->getId());
        }

        // Preparar el orden de los competidores para la siguiente jornada
        $nuevosCompetidores = [];

        $nuevosCompetidores[0] = $competidores[0];
        $nuevosCompetidores[1] = $competidores[$maximo - 1];

        for ($i = 2; $i < $maximo; $i++){
            $nuevosCompetidores[$i] = $competidores[$i - 1];
        }

        $competidores = $nuevosCompetidores;
    }





    header("Location: ../vista/TorneoModuloLiga.php?id=$idTorneo");
    exit;

    }



    function actualizarEmparejamientoLiga($conexion){

        $idPartido = $_POST['idPartido'];
        $idTorneo = $_POST['idTorneo'];
        $ganador = $_POST['ganador'];

        $partidosModelo = new partidosModelo($conexion);
        $competidorModelo = new CompetidorModelo($conexion);

        //obtyener partido
        $partido = $partidosModelo->obtenerPartidoPorId($idPartido);

        $competidor1 = $partido->getCompetidor1();
        $competidor2 = $partido->getCompetidor2();

        if ($ganador == "empate") {

            //si es empete ambos reciben un punto
            $competidorModelo->sumarPuntos($competidor1, 1);
            $competidorModelo->sumarPuntos($competidor2, 1);

            $partidosModelo->actualizarResultadoLiga($idPartido,null,1);

        } else {
            // El ganador recibe 3 puntos
            $competidorModelo->sumarPuntos($ganador, 3);

            $partidosModelo->actualizarResultadoLiga($idPartido,$ganador,0);
        }

        header("Location: ../vista/TorneoModuloLiga.php?id=$idTorneo");
        exit;
    }
    


















function generarSuizo($conexion) {
    $idTorneo = $_POST['idTorneo'];
    $fechaInicio = $_POST['fechaInicio'];
    $torneoModelo = new torneoModelo($conexion);
    $rondaModelo = new rondaModelo($conexion);
    $partidosModelo = new partidosModelo($conexion);
    $competidorModelo = new CompetidorModelo($conexion);
    $torneo = $torneoModelo->obtenerTorneo($idTorneo);
    

    //cantidad maxima de competidores
    if ($torneo->getParticipacion() == 'solo') {
        $maximo = $torneo->getMaxInscripciones();
    } else {
        $maximo = $torneo->getMaxEquipos();
    }
    

    //ver si están todos los competidores
    $cantidad = $competidorModelo->CantidadCompetidores($idTorneo);
    if ($cantidad['cantidad'] != $maximo) {
        echo "<script>
                alert('Todavía no se alcanzó el máximo de competidores.');
                window.history.back();
              </script>";
        exit;
    }

    //maximo de rondas es logaritmo en base 2 de el maximo de competidores------------------------------------------------------
    $maxRondas= log($maximo, 2);

    //si ya existe una ronda:--------------------------------------
    if ($torneoModelo->rondaCreada($idTorneo) == false) {

        //primera ronda
        $nuevaRonda = new Ronda(null, 1, $idTorneo,$fechaInicio);
        $rondaModelo->crearRonda($nuevaRonda);
        $idRonda = $conexion->lastInsertId();

        //obtener competidores
        $competidores =$competidorModelo->obtenerCompetidoresPorTorneo($idTorneo);

        //crear partidos
        $numeroPartido = 1;
        for ($i = 0; $i < count($competidores); $i += 2) {

            $competidor1 = $competidores[$i];
            $competidor2 = $competidores[$i + 1];
            $partidosModelo->crearPartido($numeroPartido,$idRonda,$competidor1->getId(),$competidor2->getId());
            $numeroPartido++;
        }



//si ya se jugó la primera ronda:-----------------------------------------------------------------
    } else {
        $cantRondas=$rondaModelo->cantidadRondas($idTorneo);
        if($maxRondas==$cantRondas['cantidad']){
            echo "<script>
                    alert('Se alanzó el límite de rondas máximas a generar.');
                    window.history.back();
                  </script>";
            exit;
        }
        //si ya se jugó la primera ronda:---------------------------
        $ultimaRonda = $rondaModelo->obtenerUltimaRonda($idTorneo);

        $pendientes=$rondaModelo->rondaSuizaTerminada($ultimaRonda->getId());

        if ($pendientes['partidosPendientes'] > 0) {
            echo "<script>
                    alert('Todavía hay partidos pendientes de la ronda anterior.');
                    window.history.back();
                  </script>";
            exit;
        }

        //obtener competidores ordenados por los puntos de mayor a menor
        $competidores = $competidorModelo->ranking($idTorneo);

        $numeroNuevaRonda = $ultimaRonda->getNumero() + 1;
        $nuevaRonda=new Ronda(null, $numeroNuevaRonda, $idTorneo,$fechaInicio);
        $rondaModelo->crearRonda($nuevaRonda);
        $idRonda = $conexion->lastInsertId();

        
        //crear partidos
        $numeroPartido = 1;
        for ($i = 0; $i < count($competidores); $i += 2) {
            $competidor1 = $competidores[$i];
            $competidor2 = $competidores[$i + 1];
            $id1 = $competidor1->getId();
            $id2 = $competidor2->getId();

            //ver si ya se enfrentaron
            $dato=$partidosModelo->yaSeEnfrentaron($id1, $id2);
            if ($dato['cantidad'] > 0) {
                //cambiar el rival por el siguiente
                
                    $competidor2 = $competidores[$i + 2];
                    $id2 = $competidor2->getId();
                    //intercambiar competidores
                    $temporal = $competidores[$i + 1];
                    $competidores[$i + 1] = $competidores[$i + 2];
                    $competidores[$i + 2] = $temporal;
                
            }
            $partidosModelo->crearPartido($numeroPartido,$idRonda,$competidor1->getId(),$competidor2->getId());
            $numeroPartido++;
        }
    }

    header("Location: ../vista/TorneoSistemaSuizo.php?id=$idTorneo");
    exit;
}









    function actualizarEmparejamientoSuizo($conexion){

        $idPartido = $_POST['idPartido'];
        $idTorneo = $_POST['idTorneo'];
        $ganador = $_POST['ganador'];

        $partidosModelo = new partidosModelo($conexion);
        $competidorModelo = new CompetidorModelo($conexion);

        //obtyener partido
        $partido = $partidosModelo->obtenerPartidoPorId($idPartido);

        $competidor1 = $partido->getCompetidor1();
        $competidor2 = $partido->getCompetidor2();

        if ($ganador == "empate") {

            //si es empete ambos reciben un punto
            $competidorModelo->sumarPuntos($competidor1, 1);
            $competidorModelo->sumarPuntos($competidor2, 1);

            $partidosModelo->actualizarResultadoLiga($idPartido,null,1);

        } else {
            // El ganador recibe 3 puntos
            $competidorModelo->sumarPuntos($ganador, 3);

            $partidosModelo->actualizarResultadoLiga($idPartido,$ganador,0);
        }

        header("Location: ../vista/TorneoSistemaSuizo.php?id=$idTorneo");
        exit;
    }