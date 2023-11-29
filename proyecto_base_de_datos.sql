CREATE DATABASE proyecto;
USE proyecto;
CREATE TABLE `usuarios` (
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(50),
  `contraseña` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` VARCHAR(25),
  `localidad` varchar(255),
  `codigo_postal` varchar(10),
  `sexo` varchar(20),
  `direccion` text,
  PRIMARY KEY (`email`)
);