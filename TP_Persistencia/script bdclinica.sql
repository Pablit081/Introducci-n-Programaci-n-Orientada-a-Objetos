-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `bdclinica` 
USE `bdclinica`;

CREATE TABLE IF NOT EXISTS `medicos` (
  `idmedico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `matricula` int(11) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  PRIMARY KEY (`idmedico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `pacientes` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(11) NOT NULL,
  `obrasocial` varchar(50) NOT NULL,
  PRIMARY KEY (`idpaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `estudios` (
  `idestudio` int(11) NOT NULL AUTO_INCREMENT,
  `idpaciente` int(11) DEFAULT NULL,
  `idmedico` int(11) DEFAULT NULL,
  `nombreestudio` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idestudio`),
  KEY `FK__medicos` (`idmedico`),
  KEY `FK__pacientes` (`idpaciente`),
  CONSTRAINT `FK__medicos` FOREIGN KEY (`idmedico`) REFERENCES `medicos` (`idmedico`),
  CONSTRAINT `FK__pacientes` FOREIGN KEY (`idpaciente`) REFERENCES `pacientes` (`idpaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
