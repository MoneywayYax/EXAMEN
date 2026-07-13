CREATE DATABASE IF NOT EXISTS sistema_laboratorio
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sistema_laboratorio;

-- Eliminación de la tabla si existe para garantizar la idempotencia del script
DROP TABLE IF EXISTS usuarios;

-- Creación de la tabla con especificaciones técnicas rigurosas
CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Definición de Restricciones (Constraints) e Índices
    PRIMARY KEY (id),
    UNIQUE KEY uk_username (username),
    UNIQUE KEY uk_email (email)
) 
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;
