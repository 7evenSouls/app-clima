SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `esp8266`
--
CREATE DATABASE IF NOT EXISTS `esp8266` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `esp8266`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `idLectura` int(11) NOT NULL,
  `chipid` int(11) NOT NULL,
  `analogico` float NOT NULL,
  `digital` tinyint(1) NOT NULL,
  `led` tinyint(1) NOT NULL,
  `fechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`idLectura`);

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `idLectura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;