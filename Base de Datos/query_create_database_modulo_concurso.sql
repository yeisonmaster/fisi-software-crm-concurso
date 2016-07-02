-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema crm
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `crm` ;

-- -----------------------------------------------------
-- Schema crm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `crm` DEFAULT CHARACTER SET utf8 ;
USE `crm` ;

-- -----------------------------------------------------
-- Table `crm`.`interlocutor_comercial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`interlocutor_comercial` ;

CREATE TABLE IF NOT EXISTS `crm`.`interlocutor_comercial` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `zona_id` INT NOT NULL,
  `roles_id` INT NOT NULL,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `apellido` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `telefono` VARCHAR(45) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_interlocutor_comercial_zona1_idx` (`zona_id` ASC),
  INDEX `fk_interlocutor_comercial_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_interlocutor_comercial_zona1`
    FOREIGN KEY (`zona_id`)
    REFERENCES `crm`.`zona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_interlocutor_comercial_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `crm`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`producto` ;

CREATE TABLE IF NOT EXISTS `crm`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `familia_id` INT NOT NULL,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `unidad` INT NULL,
  `precio` DECIMAL(10,2) NULL,
  `precio_vta` DECIMAL(10,2) NULL,
  `descuento` INT NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_producto_familia1_idx` (`familia_id` ASC),
  CONSTRAINT `fk_producto_familia1`
    FOREIGN KEY (`familia_id`)
    REFERENCES `crm`.`familia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`campana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`campana` ;

CREATE TABLE IF NOT EXISTS `crm`.`campana` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: inactivo\n1: activo',
  `codigo_mes` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`operacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`operacion` ;

CREATE TABLE IF NOT EXISTS `crm`.`operacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_operacion_id` INT NOT NULL,
  `pedido_id` INT NOT NULL,
  `codigo_operacion` VARCHAR(255) NULL,
  `monto_operacion` DECIMAL(10,2) NULL,
  `estado` INT NULL COMMENT '0: INACTIVO\n1: ACTIVO',
  `observacion` VARCHAR(45) NOT NULL,
  `fecha_operacion` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacion_tipo_operacion2_idx` (`tipo_operacion_id` ASC),
  INDEX `fk_operacion_pedido1_idx` (`pedido_id` ASC),
  CONSTRAINT `fk_operacion_tipo_operacion2`
    FOREIGN KEY (`tipo_operacion_id`)
    REFERENCES `crm`.`tipo_operacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `crm`.`pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`premio_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_producto` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_producto` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador del premio que puede ser un producto',
  `campana_id` INT NOT NULL COMMENT 'Campaña a la que pertenece el premio',
  `producto_id` INT NOT NULL COMMENT 'Producto reverenciado que ahora será premio',
  `nombre` VARCHAR(255) NULL COMMENT 'Nombre del premio',
  `estado` INT NULL COMMENT 'Estado del premio\n0: inactivo\n1: activo',
  `puntaje_con_canje` INT NULL COMMENT 'Puntaje del premio a descontarse con el canje',
  `puntaje_sin_canje` INT NULL COMMENT 'Puntaje del premio como minimo para realizar el canje',
  INDEX `fk_premio_campana1_idx` (`campana_id` ASC),
  INDEX `fk_premio_producto1_idx` (`producto_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_premio_campana1`
    FOREIGN KEY (`campana_id`)
    REFERENCES `crm`.`campana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_premio_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Premio a ser canjeado en las campañas, puede ser utilizado con puntos o sin puntos';


-- -----------------------------------------------------
-- Table `crm`.`puntaje_campana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`puntaje_campana` ;

CREATE TABLE IF NOT EXISTS `crm`.`puntaje_campana` (
  `campana_id` INT NOT NULL COMMENT 'Identificador de la campaña',
  `interlocutor_comercial_id` INT NOT NULL COMMENT 'Identificador del interlocutor (colaborador)',
  `puntaje_actual` INT NULL COMMENT 'Puntaje actual del colaborador en la campaña (incluye descuentos por los premios ganados en la campaña)',
  `puntaje_acumulado` INT NULL COMMENT 'Puntaje acumulado del colaborador en la campaña (no incluye los descuentos por los premios ganados en la campaña)',
  INDEX `fk_puntaje_campana1_idx` (`campana_id` ASC),
  PRIMARY KEY (`campana_id`, `interlocutor_comercial_id`),
  INDEX `fk_puntaje_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  CONSTRAINT `fk_puntaje_campana1`
    FOREIGN KEY (`campana_id`)
    REFERENCES `crm`.`campana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntaje_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene los puntajes generados inmediatamente después de ocurrida una venta es decir una operación';


-- -----------------------------------------------------
-- Table `crm`.`premio_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_tipo` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_tipo` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador del tipo de premio a entregarse',
  `nombre` VARCHAR(255) NULL COMMENT 'Nombre del tipo del premio',
  `estado` INT NULL COMMENT 'Estados del tipo de premio\n0: inactivo\n1: activo',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Tipo de premio de la campaña';


-- -----------------------------------------------------
-- Table `crm`.`ranking_anual`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`ranking_anual` ;

CREATE TABLE IF NOT EXISTS `crm`.`ranking_anual` (
  `anio` INT NOT NULL AUTO_INCREMENT COMMENT 'Año del ranking anual',
  `nombre` VARCHAR(200) NULL COMMENT 'Nombre del ranking anual',
  `fecha_ranking` DATETIME NULL COMMENT 'Fecha referencial de inicio del ranking',
  PRIMARY KEY (`anio`))
ENGINE = InnoDB
COMMENT = 'Contiene los datos básicos del ranking anual de los colaboradores (interlocutores) a desarrollarse en la organización';


-- -----------------------------------------------------
-- Table `crm`.`nivel_ranking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`nivel_ranking` ;

CREATE TABLE IF NOT EXISTS `crm`.`nivel_ranking` (
  `id` INT NOT NULL COMMENT 'identificador del Nivel de Ranking',
  `nombre` VARCHAR(45) NULL COMMENT 'Nombre del Nivel de Ranking',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Contiene los niveles de ranking anuales';


-- -----------------------------------------------------
-- Table `crm`.`nivel_premio_anual`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`nivel_premio_anual` ;

CREATE TABLE IF NOT EXISTS `crm`.`nivel_premio_anual` (
  `ranking_anual_anio` INT NOT NULL COMMENT 'Año del ranking anual',
  `nivel_ranking_id` INT NOT NULL COMMENT 'NIvel del ranking',
  `puntaje_minimo` INT NOT NULL COMMENT 'Puntaje mínimo para llegar al nivel',
  `puntaje_hasta` INT NOT NULL COMMENT 'Puntaje máximo del nivel',
  INDEX `fk_nivel_premio_anual_ranking_anual1_idx` (`ranking_anual_anio` ASC),
  INDEX `fk_nivel_premio_anual_nivel_ranking1_idx` (`nivel_ranking_id` ASC),
  PRIMARY KEY (`ranking_anual_anio`, `nivel_ranking_id`),
  CONSTRAINT `fk_nivel_premio_anual_ranking_anual1`
    FOREIGN KEY (`ranking_anual_anio`)
    REFERENCES `crm`.`ranking_anual` (`anio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_nivel_premio_anual_nivel_ranking1`
    FOREIGN KEY (`nivel_ranking_id`)
    REFERENCES `crm`.`nivel_ranking` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene la asociación entre el nivel y el ranking, ademas de las reglas como los puntajes mínimos para pertenecer al ranking';


-- -----------------------------------------------------
-- Table `crm`.`premio_ranking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_ranking` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_ranking` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador del premio del ranking anual',
  `nivel_premio_anual_nivel_ranking_id` INT NOT NULL COMMENT 'Referencia al Nivel del Ranking solicitado para ganar el premio anual',
  `nivel_premio_anual_ranking_anual_anio` INT NOT NULL COMMENT 'Año a considerar en el ranking anual',
  `nombre` VARCHAR(200) NULL COMMENT 'Nombre del Premio del Ranking Anual',
  `estado` INT NULL DEFAULT 0 COMMENT 'Estado del Premio',
  PRIMARY KEY (`id`),
  INDEX `fk_premio_ranking_nivel_premio_anual1_idx` (`nivel_premio_anual_ranking_anual_anio` ASC, `nivel_premio_anual_nivel_ranking_id` ASC),
  CONSTRAINT `fk_premio_ranking_nivel_premio_anual1`
    FOREIGN KEY (`nivel_premio_anual_ranking_anual_anio` , `nivel_premio_anual_nivel_ranking_id`)
    REFERENCES `crm`.`nivel_premio_anual` (`ranking_anual_anio` , `nivel_ranking_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene los premios a regalarse en el ranking anual';


-- -----------------------------------------------------
-- Table `crm`.`entrega_premio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`entrega_premio` ;

CREATE TABLE IF NOT EXISTS `crm`.`entrega_premio` (
  `premio_producto_id` INT NOT NULL,
  `premio_tipo_id` INT NOT NULL,
  `interlocutor_comercial_id` INT NOT NULL,
  `campana_solicitud` INT NOT NULL,
  `campana_entrega` INT NOT NULL,
  `fecha_solicitud` DATETIME NULL,
  `fecha_entrega` DATETIME NULL,
  PRIMARY KEY (`interlocutor_comercial_id`, `premio_tipo_id`, `premio_producto_id`),
  INDEX `fk_entrega_premio_campana1_idx` (`campana_solicitud` ASC),
  INDEX `fk_entrega_premio_campana2_idx` (`campana_entrega` ASC),
  INDEX `fk_entrega_premio_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  INDEX `fk_entrega_premio_premio_producto1_idx` (`premio_producto_id` ASC),
  INDEX `fk_entrega_premio_premio_tipo1_idx` (`premio_tipo_id` ASC),
  CONSTRAINT `fk_entrega_premio_campana1`
    FOREIGN KEY (`campana_solicitud`)
    REFERENCES `crm`.`campana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrega_premio_campana2`
    FOREIGN KEY (`campana_entrega`)
    REFERENCES `crm`.`campana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrega_premio_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrega_premio_premio_producto1`
    FOREIGN KEY (`premio_producto_id`)
    REFERENCES `crm`.`premio_producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrega_premio_premio_tipo1`
    FOREIGN KEY (`premio_tipo_id`)
    REFERENCES `crm`.`premio_tipo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene las entregas de premios realizadas en las campañas es todos decir los canjes ';


-- -----------------------------------------------------
-- Table `crm`.`entrega_premio_ranking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`entrega_premio_ranking` ;

CREATE TABLE IF NOT EXISTS `crm`.`entrega_premio_ranking` (
  `interlocutor_comercial_id` INT NOT NULL,
  `premio_ranking_id` INT NOT NULL,
  `fecha_entrega` DATETIME NULL,
  INDEX `fk_entrega_premio_ranking_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  INDEX `fk_entrega_premio_ranking_premio_ranking1_idx` (`premio_ranking_id` ASC),
  PRIMARY KEY (`interlocutor_comercial_id`, `premio_ranking_id`),
  CONSTRAINT `fk_entrega_premio_ranking_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrega_premio_ranking_premio_ranking1`
    FOREIGN KEY (`premio_ranking_id`)
    REFERENCES `crm`.`premio_ranking` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`puntaje_anual`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`puntaje_anual` ;

CREATE TABLE IF NOT EXISTS `crm`.`puntaje_anual` (
  `ranking_anual_anio` INT NOT NULL COMMENT 'Identificador del ranking anual',
  `interlocutor_comercial_id` INT NOT NULL COMMENT 'Identificador del colaborador (interlocutor)',
  `puntaje_acumulado` VARCHAR(45) NULL COMMENT 'Puntaje acumulado en el año',
  INDEX `fk_puntaje_anual_ranking_anual1_idx` (`ranking_anual_anio` ASC),
  INDEX `fk_puntaje_anual_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  PRIMARY KEY (`interlocutor_comercial_id`, `ranking_anual_anio`),
  CONSTRAINT `fk_puntaje_anual_ranking_anual1`
    FOREIGN KEY (`ranking_anual_anio`)
    REFERENCES `crm`.`ranking_anual` (`anio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntaje_anual_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene los puntajes acumulados del año';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
