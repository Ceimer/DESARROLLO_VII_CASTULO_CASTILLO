<?php
class Estudiante {
    private $id;
    private $nombre;
    private $edad;
    private $carrera;
    private $materias;

    public function __construct($id, $nombre, $edad, $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = [];
    }

    // Agregar una materia con su calificación
    public function agregarMateria($materia, $calificacion) {
        $this->materias[$materia] = $calificacion;
    }

    // Obtener promedio de las calificaciones
    public function obtenerPromedio() {
        if (empty($this->materias)) return 0;
        return array_sum($this->materias) / count($this->materias);
    }

    // Obtener detalles completos del estudiante
    public function obtenerDetalles() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio()
        ];
    }

    // Método __toString para imprimir información del estudiante
    public function __toString() {
        return "{$this->nombre} (ID: {$this->id}, Carrera: {$this->carrera})";
    }
}

class SistemaGestionEstudiantes {
    private $estudiantes;
    private $graduados;

    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    // Agregar un estudiante al sistema
    public function agregarEstudiante(Estudiante $estudiante) {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    // Obtener un estudiante por su ID
    public function obtenerEstudiante($id) {
        return $this->estudiantes[$id] ?? null;
    }

    // Listar todos los estudiantes
    public function listarEstudiantes() {
        return $this->estudiantes;
    }

    // Calcular el promedio general de todos los estudiantes
    public function calcularPromedioGeneral() {
        if (empty($this->estudiantes)) return 0;
        $promedios = array_map(function($estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);
        return array_sum($promedios) / count($promedios);
    }

    // Obtener estudiantes por carrera
    public function obtenerEstudiantesPorCarrera($carrera) {
        return array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['carrera'] === $carrera;
        });
    }

    // Obtener el estudiante con el promedio más alto
    public function obtenerMejorEstudiante() {
        return array_reduce($this->estudiantes, function($mejor, $actual) {
            return $actual->obtenerPromedio() > ($mejor ? $mejor->obtenerPromedio() : 0) ? $actual : $mejor;
        });
    }

    // Generar un reporte de rendimiento por materia
    public function generarReporteRendimiento() {
        $reporte = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($reporte[$materia])) {
                    $reporte[$materia] = [
                        'total_calificaciones' => 0,
                        'conteo' => 0,
                        'max' => $calificacion,
                        'min' => $calificacion
                    ];
                }
                $reporte[$materia]['total_calificaciones'] += $calificacion;
                $reporte[$materia]['conteo']++;
                $reporte[$materia]['max'] = max($reporte[$materia]['max'], $calificacion);
                $reporte[$materia]['min'] = min($reporte[$materia]['min'], $calificacion);
            }
        }
        foreach ($reporte as $materia => &$datos) {
            $datos['promedio'] = $datos['total_calificaciones'] / $datos['conteo'];
        }
        return $reporte;
    }

    // Graduar a un estudiante
    public function graduarEstudiante($id) {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    // Generar un ranking basado en los promedios
    public function generarRanking() {
        $estudiantes = $this->estudiantes;
        usort($estudiantes, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return $estudiantes;
    }

    // Búsqueda de estudiantes por nombre o carrera
    public function buscarEstudiantes($termino) {
        $termino = strtolower($termino);
        return array_filter($this->estudiantes, function($estudiante) use ($termino) {
            $detalles = $estudiante->obtenerDetalles();
            return strpos(strtolower($detalles['nombre']), $termino) !== false || 
                   strpos(strtolower($detalles['carrera']), $termino) !== false;
        });
    }

    // Generar estadísticas por carrera
    public function generarEstadisticasPorCarrera() {
        $estadisticas = [];
        foreach ($this->estudiantes as $estudiante) {
            $detalles = $estudiante->obtenerDetalles();
            $carrera = $detalles['carrera'];
            if (!isset($estadisticas[$carrera])) {
                $estadisticas[$carrera] = [
                    'num_estudiantes' => 0,
                    'total_promedio' => 0,
                    'mejor_estudiante' => null
                ];
            }
            $estadisticas[$carrera]['num_estudiantes']++;
            $estadisticas[$carrera]['total_promedio'] += $detalles['promedio'];

            if (!$estadisticas[$carrera]['mejor_estudiante'] || $detalles['promedio'] > $estadisticas[$carrera]['mejor_estudiante']->obtenerPromedio()) {
                $estadisticas[$carrera]['mejor_estudiante'] = $estudiante;
            }
        }

        foreach ($estadisticas as &$datos) {
            $datos['promedio_general'] = $datos['total_promedio'] / $datos['num_estudiantes'];
        }

        return $estadisticas;
    }
}

// Instanciar el sistema
$sistema = new SistemaGestionEstudiantes();

// Crear estudiantes
$estudiantes = [
    new Estudiante(1, 'Juan Pérez', 20, 'Ingeniería'),
    new Estudiante(2, 'Ana Gómez', 21, 'Medicina'),
    new Estudiante(3, 'Luis Torres', 22, 'Derecho'),
    new Estudiante(4, 'María López', 23, 'Ingeniería'),
    new Estudiante(5, 'Carlos Sánchez', 24, 'Economía'),
    new Estudiante(6, 'Laura Martínez', 25, 'Medicina'),
    new Estudiante(7, 'David Fernández', 26, 'Derecho'),
    new Estudiante(8, 'Isabel Cruz', 27, 'Ingeniería'),
    new Estudiante(9, 'José Moreno', 28, 'Economía'),
    new Estudiante(10, 'Sofía Jiménez', 29, 'Medicina'),
];

// Añadir materias y calificaciones a los estudiantes
$estudiantes[0]->agregarMateria('Matemáticas', 85);
$estudiantes[0]->agregarMateria('Física', 90);
$estudiantes[1]->agregarMateria('Anatomía', 75);
$estudiantes[1]->agregarMateria('Química', 80);
$estudiantes[2]->agregarMateria('Derecho Penal', 70);
$estudiantes[2]->agregarMateria('Derecho Civil', 65);
// ...

// Añadir estudiantes al sistema
foreach ($estudiantes as $estudiante) {
    $sistema->agregarEstudiante($estudiante);
}

// Mostrar el ranking de estudiantes por promedio
$ranking = $sistema->generarRanking();
echo "Ranking de estudiantes por promedio:<br>";
foreach ($ranking as $estudiante) {
    echo $estudiante . " - Promedio: " . $estudiante->obtenerPromedio() . "<br>";
}

// Mostrar reporte de rendimiento por materia
$reporte = $sistema->generarReporteRendimiento();
echo "<br>Reporte de rendimiento por materia:<br>";
print_r($reporte);

// Generar estadísticas por carrera
$estadisticas = $sistema->generarEstadisticasPorCarrera();
echo "<br>Estadísticas por carrera:<br>";
print_r($estadisticas);
?>
