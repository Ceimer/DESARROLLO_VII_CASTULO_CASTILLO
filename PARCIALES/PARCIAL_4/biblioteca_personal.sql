-- Crear la base de datos
CREATE DATABASE biblioteca_personal;

-- Usar la base de datos
USE biblioteca_personal;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- ID único del usuario
    google_id VARCHAR(255) NOT NULL UNIQUE,     -- ID de Google (único para cada usuario)
    email VARCHAR(255) NOT NULL,                -- Correo electrónico del usuario
    nombre VARCHAR(255),                        -- Nombre del usuario
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de registro
);

-- Crear la tabla de libros guardados
CREATE TABLE libros_guardados (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- ID único del libro guardado
    user_id INT NOT NULL,                       -- ID del usuario (relación con tabla usuarios)
    google_books_id VARCHAR(255) NOT NULL,      -- ID único del libro en Google Books
    titulo VARCHAR(255) NOT NULL,               -- Título del libro
    autor VARCHAR(255),                         -- Autor del libro
    imagen_portada VARCHAR(255),                -- URL de la imagen de portada
    reseña_personal TEXT,                       -- Reseña personal del usuario
    fecha_guardado TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha en que el libro fue guardado
    FOREIGN KEY (user_id) REFERENCES usuarios(id) -- Relación con la tabla usuarios
);


-- Insertar datos de los usuarios
INSERT INTO usuarios (google_id, email, nombre)
VALUES 
('Jon', 'cjonthecrack773@gmail.com', 'Jonathan Cabrera');

-- Insertar libros guardados para los usuarios
INSERT INTO libros_guardados (user_id, google_books_id, titulo, autor, imagen_portada, reseña_personal)
VALUES 
('Jon', 'El Gran Libro', 'Jonathan Cabrera', 'https://imagen.com/portada1.jpg', 'Este libro es una gran aventura.');
