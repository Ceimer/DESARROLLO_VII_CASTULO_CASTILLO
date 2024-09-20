<?php
// Paso 4: Ordenamiento y Filtrado Avanzado de Arreglos

// 1. Definir el arreglo de libros
$biblioteca = [
    [
        "titulo" => "Cien años de soledad",
        "autor" => "Gabriel García Márquez",
        "año" => 1967,
        "genero" => "Realismo mágico",
        "prestado" => true
    ],
    [
        "titulo" => "1984",
        "autor" => "George Orwell",
        "año" => 1949,
        "genero" => "Ciencia ficción",
        "prestado" => false
    ],
    [
        "titulo" => "El principito",
        "autor" => "Antoine de Saint-Exupéry",
        "año" => 1943,
        "genero" => "Literatura infantil",
        "prestado" => true
    ],
    [
        "titulo" => "Don Quijote de la Mancha",
        "autor" => "Miguel de Cervantes",
        "año" => 1605,
        "genero" => "Novela",
        "prestado" => false
    ],
    [
        "titulo" => "Orgullo y prejuicio",
        "autor" => "Jane Austen",
        "año" => 1813,
        "genero" => "Novela romántica",
        "prestado" => true
    ]
];

// 2. Función para imprimir la biblioteca
function imprimirBiblioteca($libros) {
    foreach ($libros as $libro) {
        echo "{$libro['titulo']} - {$libro['autor']} ({$libro['año']}) - {$libro['genero']} - " . 
             ($libro['prestado'] ? "Prestado" : "Disponible") . "<br>";
    }
    echo "\n";
}

echo "Biblioteca original:<br>";
imprimirBiblioteca($biblioteca);

// 3. Ordenar libros por año de publicación (del más antiguo al más reciente)
usort($biblioteca, function($a, $b) {
    return $a['año'] - $b['año'];
});

echo "Libros ordenados por año de publicación:\n";
imprimirBiblioteca($biblioteca);

// 4. Ordenar libros alfabéticamente por título
usort($biblioteca, function($a, $b) {
    return strcmp($a['titulo'], $b['titulo']);
});

echo "Libros ordenados alfabéticamente por título:<br>";
imprimirBiblioteca($biblioteca);

// 5. Filtrar libros disponibles (no prestados)
$librosDisponibles = array_filter($biblioteca, function($libro) {
    return !$libro['prestado'];
});

echo "Libros disponibles:<br>";
imprimirBiblioteca($librosDisponibles);

// 6. Filtrar libros por género
function filtrarPorGenero($libros, $genero) {
    return array_filter($libros, function($libro) use ($genero) {
        return strcasecmp($libro['genero'], $genero) === 0;
    });
}

$librosCienciaFiccion = filtrarPorGenero($biblioteca, "Ciencia ficción");
echo "Libros de Ciencia ficción:<br>";
imprimirBiblioteca($librosCienciaFiccion);

// 7. Obtener lista de autores únicos
$autores = array_unique(array_column($biblioteca, 'autor'));
sort($autores);

echo "Lista de autores:<br>";
foreach ($autores as $autor) {
    echo "- $autor<br>";
}
echo "<br>";

// 8. Calcular el año promedio de publicación
$añoPromedio = array_sum(array_column($biblioteca, 'año')) / count($biblioteca);
echo "Año promedio de publicación: " . round($añoPromedio, 2) . "<br><br>";

// 9. Encontrar el libro más antiguo y el más reciente
$libroMasAntiguo = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] < $carry['año']) ? $libro : $carry;
});

$libroMasReciente = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] > $carry['año']) ? $libro : $carry;
});

echo "Libro más antiguo: {$libroMasAntiguo['titulo']} ({$libroMasAntiguo['año']})<br>";
echo "Libro más reciente: {$libroMasReciente['titulo']} ({$libroMasReciente['año']})<br><br>";

// 10. TAREA: Implementa una función de búsqueda que permita buscar libros por título o autor
// La función debe ser capaz de manejar búsquedas parciales y no debe ser sensible a mayúsculas/minúsculas
function buscarLibros($biblioteca, $termino) {
    $termino = strtolower($termino); // Convertir a minúsculas para búsqueda no sensible a mayúsculas/minúsculas
    return array_filter($biblioteca, function($libro) use ($termino) {
        return strpos(strtolower($libro['titulo']), $termino) !== false || 
               strpos(strtolower($libro['autor']), $termino) !== false;
    });
}

// Ejemplo de uso
$resultadosBusqueda = buscarLibros($biblioteca, "quijote");
echo "Resultados de búsqueda para 'quijote':<br>";
imprimirBiblioteca($resultadosBusqueda);


// Ejemplo de uso de la función de búsqueda (descomenta para probar)
// $resultadosBusqueda = buscarLibros($biblioteca, "quijote");
// echo "Resultados de búsqueda para 'quijote':\n";
// imprimirBiblioteca($resultadosBusqueda);

// 11. TAREA: Crea una función que genere un reporte de la biblioteca
// El reporte debe incluir: número total de libros, número de libros prestados,
// número de libros por género, y el autor con más libros en la biblioteca
function generarReporteBiblioteca($biblioteca) {
    $reporte = [];
    
    // Número total de libros
    $reporte['total_libros'] = count($biblioteca);
    
    // Número de libros prestados
    $reporte['libros_prestados'] = count(array_filter($biblioteca, function($libro) {
        return $libro['prestado'];
    }));
    
    // Número de libros por género
    $generos = array_column($biblioteca, 'genero');
    $reporte['libros_por_genero'] = array_count_values($generos);
    
    // Autor con más libros
    $autores = array_column($biblioteca, 'autor');
    $autoresFrecuencia = array_count_values($autores);
    arsort($autoresFrecuencia); // Ordenar por número de libros
    $reporte['autor_mas_libros'] = array_key_first($autoresFrecuencia);
    
    return $reporte;
}

// Ejemplo de uso
echo "Reporte de la Biblioteca:<br>";
print_r(generarReporteBiblioteca($biblioteca));


// Ejemplo de uso de la función de reporte (descomenta para probar)
// echo "Reporte de la Biblioteca:\n";
// print_r(generarReporteBiblioteca($biblioteca));

?>
        