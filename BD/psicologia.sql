-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2023 a las 19:14:10
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psicologia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areafamiliar`
--

CREATE TABLE `areafamiliar` (
  `IdFamiliar` int(11) NOT NULL,
  `IdPaciente` int(11) DEFAULT NULL,
  `NomPadre` varchar(30) NOT NULL,
  `EstadoPadre` varchar(80) NOT NULL,
  `NomMadre` varchar(30) NOT NULL,
  `EstadoMadre` varchar(80) NOT NULL,
  `NomApoderado` varchar(30) NOT NULL,
  `EstadoApoderado` varchar(80) NOT NULL,
  `CantHermanos` int(11) DEFAULT NULL,
  `CantHijos` int(11) DEFAULT NULL,
  `IntegracionFamiliar` varchar(100) NOT NULL,
  `HistorialFamiliar` varchar(100) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areafamiliar`
--

INSERT INTO `areafamiliar` (`IdFamiliar`, `IdPaciente`, `NomPadre`, `EstadoPadre`, `NomMadre`, `EstadoMadre`, `NomApoderado`, `EstadoApoderado`, `CantHermanos`, `CantHijos`, `IntegracionFamiliar`, `HistorialFamiliar`, `FechaRegistro`) VALUES
(1, 1, 'dadadad', 'adad', 'asdad', 'adada', 'adad', 'adad', 2, 1, 'adasda', 'dada', '2023-06-21 16:14:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencionpaciente`
--

CREATE TABLE `atencionpaciente` (
  `IdAtencion` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdEnfermedad` int(11) DEFAULT NULL,
  `MotivoConsulta` varchar(100) NOT NULL,
  `FormaContacto` varchar(100) NOT NULL,
  `Diagnostico` varchar(500) NOT NULL,
  `Tratamiento` varchar(500) NOT NULL,
  `Observacion` varchar(500) NOT NULL,
  `UltimosObjetivos` varchar(500) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `IdCita` int(11) NOT NULL,
  `IdPaciente` int(11) DEFAULT NULL,
  `MotivoCita` varchar(500) NOT NULL,
  `EstadoCita` varchar(100) NOT NULL,
  `FechaInicioCita` datetime DEFAULT NULL,
  `DuracionCita` int(11) NOT NULL,
  `TipoCita` varchar(100) NOT NULL,
  `ColorFondo` varchar(10) NOT NULL,
  `IdPsicologo` int(11) NOT NULL,
  `CanalCita` varchar(100) NOT NULL,
  `EtiquetaCita` varchar(100) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`IdCita`, `IdPaciente`, `MotivoCita`, `EstadoCita`, `FechaInicioCita`, `DuracionCita`, `TipoCita`, `ColorFondo`, `IdPsicologo`, `CanalCita`, `EtiquetaCita`, `FechaRegistro`) VALUES
(36, 6, 'adad', 'Se requiere confirmacion', '2023-07-06 18:15:00', 20, 'Visita de control', '#f38238', 1, 'Cita Online', 'Prioridad', '2023-07-06 15:15:58'),
(37, 6, 'adad', 'Se requiere confirmacion', '2023-07-07 18:09:00', 30, 'Visita de control', '#b4d77b', 1, 'Cita Online', 'Familia Referida', '2023-07-06 16:09:05'),
(38, 6, 'adad', 'Se requiere confirmacion', '2023-07-13 18:09:00', 15, 'Primera Visita', '#b19a8b', 1, 'Cita Online', 'Consulta', '2023-07-06 16:09:51'),
(42, 6, 'adad', 'Se requiere confirmacion', '2023-07-14 18:22:00', 15, 'Primera Visita', '#f38238', 1, 'Cita Online', 'Consulta', '2023-07-06 16:22:29'),
(43, 6, 'adada', 'Se requiere confirmacion', '2023-07-14 20:24:00', 20, 'Visita de control', '#f38238', 1, 'Marketing Directo', 'Familia Referida', '2023-07-06 16:24:08'),
(44, 6, 'adad', 'Confirmado', '2023-07-06 18:27:00', 30, 'Primera Visita', '#9274b3', 1, 'Cita Online', 'Consulta', '2023-07-06 16:28:03'),
(45, 6, 'adad', 'Se requiere confirmacion', '2023-07-20 19:31:00', 5, 'Primera Visita', '#f38238', 1, 'Cita Online', 'Familia Referida', '2023-07-06 16:29:55'),
(46, 6, 'adad', 'Se requiere confirmacion', '2023-07-06 17:32:00', 20, 'Visita de control', '#9274b3', 1, 'Marketing Directo', 'Consulta', '2023-07-06 16:32:28'),
(47, 6, 'adda', 'Ausencia del paciente', '2023-06-30 17:33:00', 15, 'Primera Visita', '#9274b3', 1, 'Cita Online', 'Familia Referida', '2023-07-06 16:33:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `IdEnfermedad` int(11) NOT NULL,
  `CEA10` char(11) NOT NULL,
  `Clasificacion` varchar(70) DEFAULT NULL,
  `Gravedad` varchar(70) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `DSM5` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`IdEnfermedad`, `CEA10`, `Clasificacion`, `Gravedad`, `FechaRegistro`, `DSM5`) VALUES
(1, 'F70', 'Discapacidad intelectual', 'Leve', '2023-06-23 13:57:51', '317.00'),
(2, 'F71', 'Discapacidad intelectual', 'Moderado', '2023-06-23 13:57:51', '318.00'),
(3, 'F72', 'Discapacidad intelectual', 'Grave', '2023-06-23 13:57:51', '318.10'),
(4, 'F73', 'Discapacidad intelectual', 'Profundo', '2023-06-23 13:57:51', '318.20'),
(5, 'F88', 'Retraso general del desarrollo', 'nulo', '2023-06-23 13:57:51', '315.80'),
(6, 'F79', 'Discapacidad intelectual no especificada', 'nulo', '2023-06-23 13:57:51', '319.00'),
(7, 'F80.2', 'Trastorno del lenguaje', 'nulo', '2023-06-23 13:58:04', '315.32'),
(8, 'F80.0', 'Trastorno fonológico', 'nulo', '2023-06-23 13:58:04', '315.39'),
(9, 'F80.81', 'Trastorno de fluidez de inicio en la infancia', 'nulo', '2023-06-23 13:58:04', '315.35'),
(10, 'F80.81', 'Trastorno de fluidez de inicio en la infancia', 'nulo', '2023-06-23 13:58:04', '315.35'),
(11, 'F98.5', 'Trastorno de fluidez de inicio en el adulto', 'nulo', '2023-06-23 13:58:04', '307.00'),
(12, 'F80.89', 'Trastorno de la comunicación social', 'nulo', '2023-06-23 13:58:04', '315.39'),
(13, 'F80.9', 'Trastorno de la comunicación no especificado', 'nulo', '2023-06-23 13:58:04', '307.90'),
(14, 'F84.0', 'Trastorno del espectro del autismo', 'nulo', '2023-06-23 13:58:04', '299.00'),
(15, 'F06.1', 'Trastorno del espectro del autismo con especificación', 'nulo', '2023-06-23 13:58:04', '293.89'),
(16, 'F90.2', 'Trastorno por déficit de atención por hiperactividad', 'nulo', '2023-06-23 13:58:14', '314.01'),
(17, 'F90.0', 'Trastorno por déficit de atención por hiperactividad', 'nulo', '2023-06-23 13:58:14', '314.00'),
(18, 'F90.1', 'Trastorno por déficit de atención por hiperactividad', 'nulo', '2023-06-23 13:58:14', '314.01'),
(19, 'F90.08', 'Otro trastorno por déficit de atención con hiperactividad especificado', 'nulo', '2023-06-23 13:58:14', '314.01'),
(20, 'F90.09', 'Trastorno por déficit de atención con hiperactividad no especificado', 'nulo', '2023-06-23 13:58:14', '314.01'),
(21, 'F81.0', 'Trastorno específico del aprendizaje', 'nulo', '2023-06-23 13:58:14', '315.00'),
(22, 'F81.81', 'Trastorno específico del aprendizaje', 'nulo', '2023-06-23 13:58:14', '315.20'),
(23, 'F81.2', 'Trastorno específico del aprendizaje', 'nulo', '2023-06-23 13:58:14', '315.10'),
(24, 'F82', 'Trastorno del desarrollo de la coordinación', 'nulo', '2023-06-23 13:58:25', '315.40'),
(25, 'F98.4', 'Trastorno de movimientos estereotipados', 'nulo', '2023-06-23 13:58:25', '307.30'),
(26, 'F95.2', 'Trastorno de la Tourette', 'nulo', '2023-06-23 13:58:25', '307.23'),
(27, 'F95.1', 'Trastorno de tics motores o vocales persistente', 'nulo', '2023-06-23 13:58:25', '307.22'),
(28, 'F95.0', 'Trastorno de tics transitorio', 'nulo', '2023-06-23 13:58:25', '307.21'),
(29, 'F95.8', 'Otro trastorno de tics especificado', 'nulo', '2023-06-23 13:58:25', '307.20'),
(30, 'F95.9', 'Trastorno de tics no especificado', 'nulo', '2023-06-23 13:58:25', '307.20'),
(31, 'F88', 'Otro trastorno del desarrollo neurológico especificado', 'nulo', '2023-06-23 13:58:25', '315.80'),
(32, 'F89', 'Trastorno del desarrollo neurológico no especificado', 'nulo', '2023-06-23 13:58:25', '315.90'),
(33, 'F21', 'Trastorno esquizotípico', 'nulo', '2023-06-23 14:31:54', '301.22'),
(34, 'F22', 'Trastorno de delirios', 'nulo', '2023-06-23 14:31:54', '297.10'),
(35, 'F23', 'Trastorno psicótico breve', 'nulo', '2023-06-23 14:31:54', '298.80'),
(36, 'F20.81', 'Trastorno esquizofreniforme', 'nulo', '2023-06-23 14:31:54', '295.40'),
(37, 'F20.9', 'Esquizofrenia', 'nulo', '2023-06-23 14:31:54', '295.90'),
(38, 'F25', 'Trastorno esquizotípico bipolar', 'nulo', '2023-06-26 10:50:01', '295.70'),
(39, 'F25.1', 'Trastorno esquizotípico depresivo', 'nulo', '2023-06-26 10:50:01', '295.70'),
(40, 'F06.2', 'Trastorno psicótico debido a otra afección médica con delirios', 'nulo', '2023-06-26 10:50:01', '293.81'),
(41, 'F06.0', 'Trastorno psicótico debido a otra afección médica con alucinaciones', 'nulo', '2023-06-26 10:50:01', '293.82'),
(42, 'F06.1', 'Catatonía asociada a otro trastorno mental', 'nulo', '2023-06-26 10:50:01', '293.89'),
(43, 'F28', 'Otro trastorno del espectro de la esquizofrenia especificado y otro tr', 'nulo', '2023-06-26 10:50:01', '298.80'),
(44, 'F29', 'Trastorno del espectro de la esquizofrenia no especificado y otro tras', 'nulo', '2023-06-26 10:50:01', '298.90'),
(45, 'F31.11', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'leve', '2023-06-26 11:26:55', '296.41'),
(46, 'F31.12', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'moderado', '2023-06-26 11:26:55', '296.42'),
(47, 'F31.13', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'grave', '2023-06-26 11:26:55', '296.43'),
(48, 'F31.2', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'con características psicóticas', '2023-06-26 11:26:55', '296.44'),
(49, 'F31.73', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'en remisión parcial', '2023-06-26 11:26:55', '296.45'),
(50, 'F31.74', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'en remisión total', '2023-06-26 11:26:55', '296.46'),
(51, 'F31.9', 'Trastorno bipolar - Episodio maníaco actual o más reciente', 'no especificado', '2023-06-26 11:26:55', '296.40'),
(52, 'F31.0', 'Trastorno bipolar - Episodio hipomaníaco actual o más reciente', 'nulo', '2023-06-26 11:26:55', '296.40'),
(53, 'F31.71', 'Trastorno bipolar - Episodio hipomaníaco actual o más reciente', 'en remisión parcial', '2023-06-26 11:26:55', '296.45'),
(54, 'F31.72', 'Trastorno bipolar - Episodio hipomaníaco actual o más reciente', 'en remisión total', '2023-06-26 11:26:55', '296.46'),
(55, 'F31.9', 'Trastorno bipolar - Episodio hipomaníaco actual o más reciente', 'no especificado', '2023-06-26 11:26:55', '296.40'),
(56, 'F31.31', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'leve', '2023-06-26 11:26:55', '296.51'),
(57, 'F31.32', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'moderado', '2023-06-26 11:26:55', '296.52'),
(58, 'F31.4', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'grave', '2023-06-26 11:26:55', '296.53'),
(59, 'F31.5', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'con características psicóticas', '2023-06-26 11:26:55', '296.54'),
(60, 'F31.75', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'en remisión parcial', '2023-06-26 11:26:55', '296.55'),
(61, 'F31.76', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'en remisión total', '2023-06-26 11:26:55', '296.56'),
(62, 'F31.9', 'Trastorno bipolar - Episodio depresivo actual o más reciente', 'no especificado', '2023-06-26 11:26:55', '296.50'),
(63, 'F31.81', 'Trastorno bipolar 2', 'nulo', '2023-06-26 11:26:55', '296.89'),
(64, 'F34.0', 'Trastorno ciclotímico', 'nulo', '2023-06-26 11:26:55', '301.13'),
(65, 'F06.33', 'Trastorno bipolar y trastorno relacionado debidos a otra afección médi', 'nulo', '2023-06-26 11:26:55', '293.83'),
(66, 'F06.34', 'Trastorno bipolar y trastorno relacionado debidos a otra afección médi', 'nulo', '2023-06-26 11:26:55', '293.83'),
(67, 'F31.89', 'Otro trastorno bipolar y trastorno relacionado especificados', 'nulo', '2023-06-26 11:26:55', '296.89'),
(68, 'F31.9', 'Trastorno bipolar y trastorno relacionado no especificadoss', 'nulo', '2023-06-26 11:26:55', '296.80'),
(69, 'F34.8', 'Trastorno de desregulación perturbador del estado de ánimo', 'nulo', '2023-06-26 12:10:25', '296.99'),
(70, 'F32.0', 'Trastorno de depreción mayor - Episodio único', 'leve', '2023-06-26 12:10:25', '296.21'),
(71, 'F32.1', 'Trastorno de depreción mayor - Episodio único', 'moderado', '2023-06-26 12:10:25', '296.22'),
(72, 'F32.2', 'Trastorno de depreción mayor - Episodio único', 'grave', '2023-06-26 12:10:25', '296.23'),
(73, 'F32.3', 'Trastorno de depreción mayor - Episodio único', 'con características psicóticas', '2023-06-26 12:10:25', '296.24'),
(74, 'F32.4', 'Trastorno de depreción mayor - Episodio único', 'en remisión parcial', '2023-06-26 12:10:25', '296.25'),
(75, 'F32.5', 'Trastorno de depreción mayor - Episodio único', 'en remisión total', '2023-06-26 12:10:25', '296.26'),
(76, 'F32.9', 'Trastorno de depreción mayor - Episodio único', 'no especificado', '2023-06-26 12:10:25', '296.20'),
(77, 'F33.0', 'Trastorno de depreción mayor - Episodio recurrente', 'leve', '2023-06-26 12:10:25', '296.31'),
(78, 'F33.1', 'Trastorno de depreción mayor - Episodio recurrente', 'moderado', '2023-06-26 12:10:25', '296.32'),
(79, 'F33.2', 'Trastorno de depreción mayor - Episodio recurrente', 'grave', '2023-06-26 12:10:25', '296.33'),
(80, 'F33.3', 'Trastorno de depreción mayor - Episodio recurrente', 'con características psicóticas', '2023-06-26 12:10:25', '296.34'),
(81, 'F33.41', 'Trastorno de depreción mayor - Episodio recurrente', 'en remisión parcial', '2023-06-26 12:10:25', '296.35'),
(82, 'F33.42', 'Trastorno de depreción mayor - Episodio recurrente', 'en remisión total', '2023-06-26 12:10:25', '296.36'),
(83, 'F33.9', 'Trastorno de depreción mayor - Episodio recurrente', 'no especificado', '2023-06-26 12:10:25', '296.30'),
(84, 'F34.1', 'Trastorno depresivo persistente', 'nulo', '2023-06-26 12:10:25', '300.40'),
(85, 'N94.3', 'Trastorno disfórico premenstrual', 'nulo', '2023-06-26 12:10:25', '625.40'),
(86, 'F06.31', 'Trastorno depresivo debido a otra afección médica - con característica', 'nulo', '2023-06-26 12:10:25', '293.83'),
(87, 'F06.32', 'Trastorno depresivo debido a otra afección médica - con episodio de ti', 'nulo', '2023-06-26 12:10:25', '293.83'),
(88, 'F06.34', 'Trastorno depresivo debido a otra afección médica - con característica', 'nulo', '2023-06-26 12:10:25', '293.83'),
(89, 'F32.8', 'Otro trastorno depresivo especificado', 'nulo', '2023-06-26 12:10:25', '311.00'),
(90, 'F32.9', 'Trastorno depresivo no especificado', 'nulo', '2023-06-26 12:10:25', '311.00'),
(91, 'F93.0', 'Trastorno de ansiedad por separación', 'nulo', '2023-06-26 12:36:08', '309.21'),
(92, 'F94.0', 'Mutismo selectivo', 'nulo', '2023-06-26 12:36:08', '313.23'),
(93, 'F40.218', 'Fobia específica - Animal', 'nulo', '2023-06-26 12:36:08', '300.29'),
(94, 'F40.228', 'Fobia específica - Entorno natural', 'nulo', '2023-06-26 12:36:08', '300.29'),
(95, 'F40.230', 'Sangre-inyección-lesión - Miedo a la sangre', 'nulo', '2023-06-26 12:36:08', '300.29'),
(96, 'F40.231', 'Sangre-inyección-lesión - Miedo a las inyecciones y transfusiones', 'nulo', '2023-06-26 12:36:08', '300.29'),
(97, 'F40.232', 'Sangre-inyección-lesión - Miedo a otra atención médica', 'nulo', '2023-06-26 12:36:08', '300.29'),
(98, 'F40.233', 'Sangre-inyección-lesión - Miedo a una lesión', 'nulo', '2023-06-26 12:36:08', '300.29'),
(99, 'F40.248', 'Sangre-inyección-lesión - Situacional', 'nulo', '2023-06-26 12:36:08', '300.29'),
(100, 'F40.298', 'Sangre-inyección-lesión - Otra', 'nulo', '2023-06-26 12:36:08', '300.29'),
(101, 'F40.10', 'Trastorno de ansiedad social', 'nulo', '2023-06-26 12:36:08', '300.23'),
(102, 'F41.0', 'Trastorno de pánico', 'nulo', '2023-06-26 12:36:08', '300.01'),
(103, 'F40.00', 'Agorafobia', 'nulo', '2023-06-26 12:36:08', '300.22'),
(104, 'F41.1', 'Trastorno de ansiedad generalizada', 'nulo', '2023-06-26 12:36:08', '300.02'),
(105, 'F06.4', 'Trastorno de ansiedad debido a otra afección médica', 'nulo', '2023-06-26 12:36:08', '293.84'),
(106, 'F41.8', 'Otro trastorno de ansiedad especificado', 'nulo', '2023-06-26 12:36:08', '300.09'),
(107, 'F41.9', 'Trastorno de ansiedad no especificado', 'nulo', '2023-06-26 12:36:08', '300.00'),
(108, 'F42', 'Trastorno obsesivo-compulsivo', 'nulo', '2023-06-26 15:32:44', '300.30'),
(109, 'F45.22', 'Trastorno dismórfico corporal', 'nulo', '2023-06-26 15:32:44', '300.70'),
(110, 'F63.3', 'Tricotilomanía', 'nulo', '2023-06-26 15:32:44', '312.39'),
(111, 'L98.1', 'Trastorno de excoriación', 'nulo', '2023-06-26 15:32:44', '698.40'),
(112, 'F06.8', 'Trastorno obsesivo-compulsivo y trastorno relacionado debidos a otra a', 'nulo', '2023-06-26 15:32:44', '294.80'),
(113, 'F42', 'Otro trastorno obsesivo-compulsivo y trastorno relacionado especificad', 'nulo', '2023-06-26 15:32:44', '300.30'),
(114, 'F94.1', 'Trastorno de apego reactivo', 'nulo', '2023-06-26 15:32:44', '313.89'),
(115, 'F94.2', 'Trastorno de relación social desinhibida', 'nulo', '2023-06-26 15:32:44', '313.89'),
(116, 'F43.10', 'Trastorno de estrés postraumático', 'nulo', '2023-06-26 15:32:44', '309.81'),
(117, 'F43.0', 'Trastorno de estrés agudo', 'nulo', '2023-06-26 15:32:44', '308.30'),
(118, 'F43.21', 'Trastornos de adaptación - Con estado de ánimo deprimido', 'nulo', '2023-06-26 15:32:44', '309.00'),
(119, 'F43.22', 'Trastornos de adaptación - Con ansiedad', 'nulo', '2023-06-26 15:32:44', '309.24'),
(120, 'F43.23', 'Trastornos de adaptación - Con ansiedad mixta y estado de ánimo deprim', 'nulo', '2023-06-26 15:32:44', '309.28'),
(121, 'F43.24', 'Trastornos de adaptación - Con alteración de la conducta', 'nulo', '2023-06-26 15:32:44', '309.30'),
(122, 'F43.25', 'Trastornos de adaptación - Con alteración mixta de las emociones o la ', 'nulo', '2023-06-26 15:32:44', '309.40'),
(123, 'F43.20', 'Trastornos de adaptación - Sin especificar', 'nulo', '2023-06-26 15:32:44', '309.90'),
(124, 'F43.8', 'Otro trastorno relacionado con traumas y factores \r\nde estrés especifi', 'nulo', '2023-06-26 15:32:44', '309.89'),
(125, 'F43.9', 'Trastorno relacionado con traumas y factores de estrés no especificado', 'nulo', '2023-06-26 15:32:44', '309.90'),
(126, 'F44.81', 'Trastorno de identidad disociativo', 'nulo', '2023-06-26 16:04:44', '300.14'),
(127, 'F44.0', 'Amnesia disociativa', 'nulo', '2023-06-26 16:04:44', '300.12'),
(128, 'F44.1', 'Amnesia disociativa - Con fuga disociativa', 'nulo', '2023-06-26 16:04:44', '300.13'),
(129, 'F48.1', 'Trastorno de despersonalización/desrealización', 'nulo', '2023-06-26 16:04:44', '300.60'),
(130, 'F44.89', 'Otro trastorno disociativo especificado', 'nulo', '2023-06-26 16:04:44', '300.15'),
(131, 'F44.9', 'Trastorno disociativo no especificado', 'nulo', '2023-06-26 16:04:44', '300.15'),
(132, 'F45.1', 'Trastorno de síntomas somáticos', 'nulo', '2023-06-26 16:04:44', '300.82'),
(133, 'F45.21', 'Trastorno de ansiedad por enfermedad', 'nulo', '2023-06-26 16:04:44', '300.70'),
(134, 'F44.4', 'Trastorno de conversión - Con debilidad o parálisis', 'nulo', '2023-06-26 16:04:44', '300.11'),
(135, 'F44.5', 'Trastorno de conversión - Con ataques o convulsiones', 'nulo', '2023-06-26 16:04:44', '300.11'),
(136, 'F44.6', 'Trastorno de conversión - Con anestesia o pérdida sensitiva', 'nulo', '2023-06-26 16:04:44', '300.11'),
(137, 'F44.7', 'Trastorno de conversión - Con síntomas mixtos', 'nulo', '2023-06-26 16:04:44', '300.11'),
(138, 'F54', 'Factores psicológicos que afectan a otras afecciones médicas', 'nulo', '2023-06-26 16:04:44', '316.00'),
(139, 'F68.10', 'Trastorno facticio', 'nulo', '2023-06-26 16:04:44', '300.19'),
(140, 'F45.8', 'Otro trastorno de síntomas somáticos y trastorno relacionado especific', 'nulo', '2023-06-26 16:04:44', '300.89'),
(141, 'F45.9', 'Trastorno de síntomas somáticos y trastorno relacionado no especificad', 'nulo', '2023-06-26 16:04:44', '300.82'),
(142, 'F98.3', 'Pica - En niños', 'nulo', '2023-06-27 09:14:48', '307.52'),
(143, 'F50.8', 'Pica - En adultos', 'nulo', '2023-06-27 09:14:48', '307.52'),
(144, 'F98.21', 'Trastorno de rumiación', 'nulo', '2023-06-27 09:14:48', '307.53'),
(145, 'F50.8', 'Trastorno de evitación/restricción de la ingestión de alimentos', 'nulo', '2023-06-27 09:14:48', '307.59'),
(146, 'F50.01', 'Anorexia nerviosa - Tipo restrictivo', 'nulo', '2023-06-27 09:14:48', '307.10'),
(147, 'F50.02', 'Anorexia nerviosa - Tipo por atracón/purgas', 'nulo', '2023-06-27 09:14:48', '307.10'),
(148, 'F50.2', 'Bulimia nerviosa', 'nulo', '2023-06-27 09:14:48', '307.51'),
(149, 'F50.8', 'Trastorno por atracón', 'nulo', '2023-06-27 09:14:48', '307.51'),
(150, 'F50.8', 'Otro trastorno alimentario o de la ingestión de alimentos especificado', 'nulo', '2023-06-27 09:14:48', '307.59'),
(151, 'F50.9', 'Trastorno alimentario o de la ingestión de alimentos no especificado', 'nulo', '2023-06-27 09:14:48', '307.50'),
(152, 'F98.0', 'Enuresis', 'nulo', '2023-06-27 10:41:08', '307.60'),
(153, 'F98.1', 'Encopresis', 'nulo', '2023-06-27 10:41:08', '307.70'),
(154, 'N39.498', 'Otro trastorno de la excreción especificado - Con síntomas urinarios', 'nulo', '2023-06-27 10:41:08', '788.39'),
(155, 'R15.9', 'Otro trastorno de la excreción especificado - Con síntomas urinarios', 'nulo', '2023-06-27 10:41:08', '787.60'),
(156, 'R32', 'Trastorno de la excreción no especificado - Con síntomas urinarios', 'nulo', '2023-06-27 10:41:08', '788.30'),
(157, 'R15.9', 'Trastorno de la excreción no especificado - Con síntomas fecales', 'nulo', '2023-06-27 10:41:08', '787.60'),
(158, 'F51.01', 'Trastorno de insomnio', 'nulo', '2023-06-27 10:41:08', '307.42'),
(159, 'F51.11', ' Trastorno por hipersomnia', 'nulo', '2023-06-27 10:41:08', '307.44'),
(160, 'G47.419', ' Narcolepsia sin cataplejía pero con deficiencia de hipocretina', 'nulo', '2023-06-27 10:41:08', '347.00'),
(161, 'G47.411', ' Narcolepsia con cataplejía pero sin deficiencia de hipocretina ', 'nulo', '2023-06-27 10:41:08', '347.01'),
(162, 'G47.429', ' Narcolepsia secundaria a otra afección médica', 'nulo', '2023-06-27 10:41:08', '347.10'),
(163, 'G47.33', 'Apnea e hipopnea obstructiva del sueño', 'nulo', '2023-06-27 11:24:43', '327.23'),
(164, 'G47.31', 'Apnea central del sueño idiopática', 'nulo', '2023-06-27 11:24:43', '327.21'),
(165, 'R06.3', 'Respiración de Cheyne-Stokes', 'nulo', '2023-06-27 11:24:43', '786.04'),
(166, 'G47.37', 'Apnea central del sueño con consumo concurrente de opiáceos', 'nulo', '2023-06-27 11:24:43', '780.57'),
(167, 'G47.34', 'Hipoventilación idiopática', 'nulo', '2023-06-27 11:24:43', '327.24'),
(168, 'G47.35', 'Hipoventilación alveolar central congénita', 'nulo', '2023-06-27 11:24:43', '327.25'),
(169, 'G47.36', 'Hipoventilación concurrente relacionada con el sueño', 'nulo', '2023-06-27 11:24:43', '327.26'),
(170, 'G47.21', 'Trastornos del ritmo circadiano de sueño-vigilia - Tipo de fases de su', 'nulo', '2023-06-27 11:24:43', '307.45'),
(171, 'G47.22', 'Trastornos del ritmo circadiano de sueño-vigilia - Tipo de fases de su', 'nulo', '2023-06-27 11:24:43', '307.45'),
(172, 'G47.23', 'Tipo de sueño-vigilia irregular', 'nulo', '2023-06-27 11:24:43', '307.45'),
(173, 'G47.24', 'Trastornos del ritmo circadiano de sueño-vigilia - Tipo de sueño-vigil', 'nulo', '2023-06-27 11:24:43', '307.45'),
(174, 'G47.26', 'Trastornos del ritmo circadiano de sueño-vigilia - Tipo asociado a tur', 'nulo', '2023-06-27 11:24:43', '307.45'),
(175, 'G47.20', 'Trastornos del ritmo circadiano de sueño-vigilia - Tipo no especificad', 'nulo', '2023-06-27 11:24:43', '307.45'),
(176, 'F51.3', 'Trastornos del despertar del sueño no REM - Tipo con sonambulismo', 'nulo', '2023-06-27 11:24:43', '307.46'),
(177, 'F51.4', 'Trastornos del despertar del sueño no REM - Tipo con terrores nocturno', 'nulo', '2023-06-27 11:24:43', '307.46'),
(178, 'F51.5', 'Trastorno de pesadillas', 'nulo', '2023-06-27 11:24:43', '307.47'),
(179, 'G47.52', 'Trastorno del comportamiento del sueño REM', 'nulo', '2023-06-27 11:24:43', '327.42'),
(180, 'G25.81', 'Síndrome de las piernas inquietas', 'nulo', '2023-06-27 11:24:43', '333.94'),
(181, 'G47.09', 'Otro trastorno de insomnio especificado', 'nulo', '2023-06-27 11:24:43', '780.52'),
(182, 'G47.00', 'Trastorno de insomnio no especificado', 'nulo', '2023-06-27 11:24:43', '780.52'),
(183, 'G47.19', 'Otro trastorno de hipersomnia especificado', 'nulo', '2023-06-27 11:24:43', '780.54'),
(184, 'G47.10', 'Trastorno de hipersomnia no especificado', 'nulo', '2023-06-27 11:24:43', '780.54'),
(185, 'G47.8', 'Otro trastorno del sueño-vigilia especificado', 'nulo', '2023-06-27 11:24:43', '780.59'),
(186, 'G47.9', 'Trastorno del sueño-vigilia no especificado', 'nulo', '2023-06-27 11:24:43', '780.59'),
(187, 'F52.32', 'Eyaculación retardada', 'nulo', '2023-06-27 11:59:38', '302.74'),
(188, 'F52.21', 'Trastorno eréctil', 'nulo', '2023-06-27 11:59:38', '302.72'),
(189, 'F52.21', 'Trastorno orgásmico femenino', 'nulo', '2023-06-27 11:59:38', '302.73'),
(190, 'F52.22', 'Trastorno del interés/excitación sexual femenino', 'nulo', '2023-06-27 11:59:38', '302.72'),
(191, 'F52.6', 'Trastorno de dolor genito-pélvico/penetración', 'nulo', '2023-06-27 11:59:38', '302.76'),
(192, 'F52.0', 'Trastorno de deseo sexual hipoactivo en el varón', 'nulo', '2023-06-27 11:59:38', '302.71'),
(193, 'F52.4', 'Eyaculación prematura', 'nulo', '2023-06-27 11:59:38', '302.75'),
(194, 'F52.8', 'Otra disfunción sexual especificada', 'nulo', '2023-06-27 11:59:38', '302.79'),
(195, 'F52.9', 'Disfunción sexual no especificada', 'nulo', '2023-06-27 11:59:38', '302.70'),
(196, 'F64.2', 'Disforia de género en niños', 'nulo', '2023-06-27 11:59:38', '302.60'),
(197, 'F64.1', 'Disforia de género en adolescentes y adultos', 'nulo', '2023-06-27 11:59:38', '302.85'),
(198, 'F64.8', 'Otra disforia de género especificada', 'nulo', '2023-06-27 11:59:38', '302.60'),
(199, 'F64.9', 'Disforia de género no especificada', 'nulo', '2023-06-27 11:59:38', '302.60'),
(200, 'F91.3', 'Trastorno negativista desafiante', 'nulo', '2023-06-27 11:59:38', '313.81'),
(201, 'F63.81', 'Trastorno explosivo intermitente', 'nulo', '2023-06-27 11:59:38', '312.34'),
(202, 'F91.1', 'Trastorno de la conducta - Tipo de inicio infantil', 'nulo', '2023-06-27 11:59:38', '312.81'),
(203, 'F91.2', 'Trastorno de la conducta - Tipo de inicio adolescente', 'nulo', '2023-06-27 11:59:38', '312.82'),
(204, 'F91.9', 'Trastorno de la conducta - Tipo de inicio no especificado', 'nulo', '2023-06-27 11:59:38', '312.89'),
(205, 'F60.2', 'Trastorno de la personalidad antisocial', 'nulo', '2023-06-27 11:59:38', '301.70'),
(206, 'F63.1', 'Piromanía', 'nulo', '2023-06-27 11:59:38', '312.33'),
(207, 'F63.2', 'Cleptomanía', 'nulo', '2023-06-27 11:59:38', '312.32'),
(208, 'F91.8', 'Otro trastorno destructivo, del control de los impulsos y de la conduc', 'nulo', '2023-06-27 11:59:38', '312.89'),
(209, 'F91.9', 'Trastorno destructivo, del control de los impulsos y de la conducta no', 'nulo', '2023-06-27 11:59:38', '312.90'),
(210, 'F10.10', 'Trastorno por consumo de alcohol', 'leve', '2023-06-27 12:59:59', '305.00'),
(211, 'F10.20', 'Trastorno por consumo de alcohol', 'moderado', '2023-06-27 12:59:59', '303.90'),
(212, 'F10.20.1', 'Trastorno por consumo de alcohol', 'grave', '2023-06-27 12:59:59', '303.90'),
(213, 'F10.129', 'Intoxicación por alcohol - Con trastorno por consumo, leve', 'nulo', '2023-06-27 12:59:59', '303.00'),
(214, 'F10.229', 'Intoxicación por alcohol - Con trastorno por consumo, moderado o grave', 'nulo', '2023-06-27 12:59:59', '303.00'),
(215, 'F10.929', 'Intoxicación por alcohol - Sin trastorno por consumo', 'nulo', '2023-06-27 12:59:59', '303.00'),
(216, 'F10.239', 'Abstinencia de alcohol - Sin alteraciones de la percepción', 'nulo', '2023-06-27 12:59:59', '291.81'),
(217, 'F10.232', 'Abstinencia de alcohol - Con alteraciones de la percepción', 'nulo', '2023-06-27 12:59:59', '291.81'),
(218, 'F10.99', 'Trastorno relacionado con el alcohol no especificado', 'nulo', '2023-06-27 12:59:59', '291.90'),
(219, 'F15.929', 'Intoxicación por cafeína', 'nulo', '2023-06-27 12:59:59', '305.90'),
(220, 'F15.93', 'Abstinencia de cafeína', 'nulo', '2023-06-27 12:59:59', '292.00'),
(221, 'F15.99', 'Trastorno relacionado con la cafeína no especificado', 'nulo', '2023-06-27 12:59:59', '292.90'),
(222, 'F12.10', 'Trastorno por consumo de cannabis', 'leve', '2023-06-27 12:59:59', '305.20'),
(223, 'F12.20', 'Trastorno por consumo de cannabis', 'moderado', '2023-06-27 12:59:59', '304.30'),
(224, 'F12.20.1', 'Trastorno por consumo de cannabis', 'grave', '2023-06-27 12:59:59', '304.30'),
(225, 'F12.129', 'Intoxicación por cannabis - Sin alteraciones de la percepción - Con tr', 'leve', '2023-06-27 12:59:59', '292.89'),
(226, 'F12.229', 'Intoxicación por cannabis - Sin alteraciones de la percepción - Con tr', 'moderado', '2023-06-27 12:59:59', '292.89'),
(227, 'F12.929', 'Intoxicación por cannabis - Sin alteraciones de la percepción - Sin tr', 'nulo', '2023-06-27 12:59:59', '292.89'),
(228, 'F12.122', 'Intoxicación por cannabis - Con alteraciones de la percepción - Con tr', 'leve', '2023-06-27 12:59:59', '292.89'),
(229, 'F12.222', 'Intoxicación por cannabis - Con alteraciones de la percepción - Con tr', 'moderado', '2023-06-27 12:59:59', '292.89'),
(230, 'F12.922', 'Intoxicación por cannabis - Con alteraciones de la percepción - Sin tr', 'nulo', '2023-06-27 12:59:59', '292.89'),
(231, 'F12.288', 'Abstinencia de cannabis', 'nulo', '2023-06-27 12:59:59', '292.00'),
(232, 'F12.99', 'Trastorno relacionado con el cannabis no especificado', 'nulo', '2023-06-27 12:59:59', '292.90'),
(233, 'F16.10', 'Trastorno por consumo de fenciclidina', 'leve', '2023-06-27 13:30:13', '305.90'),
(234, 'F16.20', 'Trastorno por consumo de fenciclidina', 'moderado', '2023-06-27 13:30:13', '304.60'),
(235, 'F16.20.1', 'Trastorno por consumo de fenciclidina', 'grave', '2023-06-27 13:30:13', '304.60'),
(236, 'F16.10', 'Trastorno por consumo de otros alucinógenos', 'leve', '2023-06-27 13:30:13', '305.30'),
(237, 'F16.20', 'Trastorno por consumo de otros alucinógenos', 'moderado', '2023-06-27 13:30:13', '304.50'),
(238, 'F16.20.2', 'Trastorno por consumo de otros alucinógenos', 'grave', '2023-06-27 13:30:13', '304.50'),
(239, 'F16.129', 'Intoxicación por fenciclidina - Con trastorno por consumo', 'leve', '2023-06-27 13:30:13', '292.89'),
(240, 'F16.229', 'Intoxicación por fenciclidina - Con trastorno por consumo', 'moderado', '2023-06-27 13:30:13', '292.89'),
(241, 'F16.929', 'Intoxicación por fenciclidina - Sin trastorno por consumo', 'nulo', '2023-06-27 13:30:13', '292.89'),
(242, 'F16.129', 'Intoxicación por otro alucinógeno - Con trastorno por consumo', 'leve', '2023-06-27 13:30:13', '292.89'),
(243, 'F16.229', 'Intoxicación por otro alucinógeno - Con trastorno por consumo', 'moderado', '2023-06-27 13:30:13', '292.89'),
(244, 'F16.929', 'Intoxicación por otro alucinógeno - Sin trastorno por consumo', 'nulo', '2023-06-27 13:30:13', '292.89'),
(245, 'F16.983', 'Trastorno de percepción persistente por \r\nalucinógenos', 'nulo', '2023-06-27 13:30:13', '292.89'),
(246, 'F16.99', 'Trastorno relacionado con la fenciclidina no \r\nespecificado', 'nulo', '2023-06-27 13:30:13', '292.90'),
(247, 'F16.99.1', 'Trastorno relacionado con los alucinógenos no \r\nespecificado', 'nulo', '2023-06-27 13:30:13', '292.90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `IdPaciente` int(11) NOT NULL,
  `NomPaciente` varchar(30) NOT NULL,
  `ApPaterno` varchar(30) NOT NULL,
  `ApMaterno` varchar(30) NOT NULL,
  `Dni` char(8) NOT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Edad` char(3) NOT NULL,
  `GradoInstruccion` varchar(50) NOT NULL,
  `Ocupacion` varchar(50) NOT NULL,
  `EstadoCivil` varchar(50) NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `Telefono` char(9) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Direccion` varchar(30) NOT NULL,
  `AntecedentesMedicos` varchar(50) NOT NULL,
  `IdPsicologo` int(11) NOT NULL,
  `MedicamentosPrescritos` varchar(50) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`IdPaciente`, `NomPaciente`, `ApPaterno`, `ApMaterno`, `Dni`, `FechaNacimiento`, `Edad`, `GradoInstruccion`, `Ocupacion`, `EstadoCivil`, `Genero`, `Telefono`, `Email`, `Direccion`, `AntecedentesMedicos`, `IdPsicologo`, `MedicamentosPrescritos`, `FechaRegistro`) VALUES
(1, 'Juan', 'López', 'García', '12345678', '1990-01-01', '30', 'Universitario', 'Estudiante', 'Soltero', 'Masculino', '987654321', 'juan@example.com', 'Calle 123', 'Ninguno', 1, 'Ninguno', '2023-06-21 13:30:09'),
(2, 'María', 'González', 'Hernández', '87654321', '1992-05-10', '28', 'Universitario', 'Profesional', 'Casado', 'Femenino', '654321987', 'maria@example.com', 'Avenida 456', 'Ninguno', 1, 'Ninguno', '2023-06-21 13:30:09'),
(3, 'Pedro', 'Ramírez', 'Sánchez', '45678912', '1985-09-15', '36', 'Técnico', 'Empleado', 'Soltero', 'Masculino', '321987654', 'pedro@example.com', 'Calle 789', 'Ninguno', 1, 'Ninguno', '2023-06-21 13:30:09'),
(4, 'Ana', 'Pérez', 'Rodríguez', '78912345', '1998-03-20', '23', 'Secundario', 'Estudiante', 'Soltero', 'Femenino', '456123789', 'ana@example.com', 'Avenida 1234', 'Ninguno', 1, 'Ninguno', '2023-06-21 13:30:09'),
(6, 'Cielo', 'Venegas', 'Francia', '76467291', '2001-02-02', '22', 'Barbero', 'Barbero', 'soltero', 'Femenina', '969445007', 'mariano.venegas.francia@gmail.com', 'Ancon', 'Vicio', 1, 'Jarabe', '2023-06-28 09:55:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `psicologo`
--

CREATE TABLE `psicologo` (
  `IdPsicologo` int(11) NOT NULL,
  `NombrePsicologo` varchar(30) NOT NULL,
  `Passwords` varchar(50) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Usuario` varchar(59) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `psicologo`
--

INSERT INTO `psicologo` (`IdPsicologo`, `NombrePsicologo`, `Passwords`, `FechaRegistro`, `Usuario`) VALUES
(1, 'jorge', '123456', '2023-06-21 09:22:39', 'Jorge Venegas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areafamiliar`
--
ALTER TABLE `areafamiliar`
  ADD PRIMARY KEY (`IdFamiliar`),
  ADD KEY `fk_paciente_familiar` (`IdPaciente`);

--
-- Indices de la tabla `atencionpaciente`
--
ALTER TABLE `atencionpaciente`
  ADD PRIMARY KEY (`IdAtencion`),
  ADD KEY `fk_paciente` (`IdPaciente`),
  ADD KEY `fk_enfermedadd` (`IdEnfermedad`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`IdCita`),
  ADD KEY `fk_paciente_cita` (`IdPaciente`),
  ADD KEY `fk_cita_psicologo` (`IdPsicologo`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`IdEnfermedad`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`IdPaciente`),
  ADD KEY `fk_paciente_psicologo` (`IdPsicologo`);

--
-- Indices de la tabla `psicologo`
--
ALTER TABLE `psicologo`
  ADD PRIMARY KEY (`IdPsicologo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areafamiliar`
--
ALTER TABLE `areafamiliar`
  MODIFY `IdFamiliar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `atencionpaciente`
--
ALTER TABLE `atencionpaciente`
  MODIFY `IdAtencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `IdCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `IdEnfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `psicologo`
--
ALTER TABLE `psicologo`
  MODIFY `IdPsicologo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areafamiliar`
--
ALTER TABLE `areafamiliar`
  ADD CONSTRAINT `fk_paciente_familiar` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `atencionpaciente`
--
ALTER TABLE `atencionpaciente`
  ADD CONSTRAINT `fk_enfermedad` FOREIGN KEY (`IdEnfermedad`) REFERENCES `enfermedad` (`IdEnfermedad`),
  ADD CONSTRAINT `fk_enfermedadd` FOREIGN KEY (`IdEnfermedad`) REFERENCES `enfermedad` (`IdEnfermedad`),
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_psicologo` FOREIGN KEY (`IdPsicologo`) REFERENCES `psicologo` (`IdPsicologo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_paciente_cita` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_psicologo` FOREIGN KEY (`IdPsicologo`) REFERENCES `psicologo` (`IdPsicologo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
