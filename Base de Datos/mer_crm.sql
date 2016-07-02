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
-- Table `crm`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`roles` ;

CREATE TABLE IF NOT EXISTS `crm`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`distrito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`distrito` ;

CREATE TABLE IF NOT EXISTS `crm`.`distrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `latitud` VARCHAR(255) NULL,
  `longitud` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`zona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`zona` ;

CREATE TABLE IF NOT EXISTS `crm`.`zona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `distrito_id` INT NOT NULL,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_zona_distrito1_idx` (`distrito_id` ASC),
  CONSTRAINT `fk_zona_distrito1`
    FOREIGN KEY (`distrito_id`)
    REFERENCES `crm`.`distrito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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
-- Table `crm`.`tipo_relacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`tipo_relacion` ;

CREATE TABLE IF NOT EXISTS `crm`.`tipo_relacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`relacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`relacion` ;

CREATE TABLE IF NOT EXISTS `crm`.`relacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_relacion_id` INT NOT NULL,
  `interlocutor_comercial_id` INT NOT NULL,
  `interlocutor_comercial_id_alt` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_relacion_tipo_relacion1_idx` (`tipo_relacion_id` ASC),
  INDEX `fk_relacion_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  INDEX `fk_relacion_interlocutor_comercial2_idx` (`interlocutor_comercial_id_alt` ASC),
  CONSTRAINT `fk_relacion_tipo_relacion1`
    FOREIGN KEY (`tipo_relacion_id`)
    REFERENCES `crm`.`tipo_relacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_interlocutor_comercial2`
    FOREIGN KEY (`interlocutor_comercial_id_alt`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`familia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`familia` ;

CREATE TABLE IF NOT EXISTS `crm`.`familia` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: inactivo\n1: activo',
  PRIMARY KEY (`id`))
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
-- Table `crm`.`stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`stock` ;

CREATE TABLE IF NOT EXISTS `crm`.`stock` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `stock` INT NULL,
  `fecha_actualizacion` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_stock_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_stock_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`catalogo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`catalogo` ;

CREATE TABLE IF NOT EXISTS `crm`.`catalogo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(255) NULL,
  `mes` INT NULL,
  `anio` INT NULL,
  `estado` INT NULL COMMENT '0: INACTIVO\n1: ACTIVO',
  `codigo` CHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`campana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`campana` ;

CREATE TABLE IF NOT EXISTS `crm`.`campana` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: inactivo\n1: activo',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`catalogo_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`catalogo_producto` ;

CREATE TABLE IF NOT EXISTS `crm`.`catalogo_producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `catalogo_id` INT NOT NULL,
  `campana_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: INACTIVO\n1: ACTIVO',
  PRIMARY KEY (`id`),
  INDEX `fk_catalogo_producto_catalogo_idx` (`catalogo_id` ASC),
  INDEX `fk_catalogo_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_catalogo_producto_campana1_idx` (`campana_id` ASC),
  CONSTRAINT `fk_catalogo_producto_catalogo`
    FOREIGN KEY (`catalogo_id`)
    REFERENCES `crm`.`catalogo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_catalogo_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_catalogo_producto_campana1`
    FOREIGN KEY (`campana_id`)
    REFERENCES `crm`.`campana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`tipo_operacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`tipo_operacion` ;

CREATE TABLE IF NOT EXISTS `crm`.`tipo_operacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `detalle` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: INACTIVO\n1: ACTIIVO',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`tipo_pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`tipo_pedido` ;

CREATE TABLE IF NOT EXISTS `crm`.`tipo_pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`pedido` ;

CREATE TABLE IF NOT EXISTS `crm`.`pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_pedido_id` INT NOT NULL,
  `interlocutor_comercial_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pedido_tipo_pedido1_idx` (`tipo_pedido_id` ASC),
  INDEX `fk_pedido_interlocutor_comercial1_idx` (`interlocutor_comercial_id` ASC),
  CONSTRAINT `fk_pedido_tipo_pedido1`
    FOREIGN KEY (`tipo_pedido_id`)
    REFERENCES `crm`.`tipo_pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_interlocutor_comercial1`
    FOREIGN KEY (`interlocutor_comercial_id`)
    REFERENCES `crm`.`interlocutor_comercial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `crm`.`operacion_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`operacion_detalle` ;

CREATE TABLE IF NOT EXISTS `crm`.`operacion_detalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `producto_id_operacion` INT NULL,
  `operacion_id` INT NOT NULL,
  `zona_id` INT NOT NULL,
  `cantidad` INT NULL,
  `monto` DECIMAL(10,2) NULL,
  `secuencia` INT NULL,
  `estado` INT NULL COMMENT '0: ANULADO\n1: NO ANULADO',
  `fecha_operacion` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacion_detalle_producto1_idx` (`producto_id` ASC),
  INDEX `fk_operacion_detalle_operacion1_idx` (`operacion_id` ASC),
  INDEX `fk_operacion_detalle_zona1_idx` (`zona_id` ASC),
  INDEX `fk_operacion_detalle_producto2_idx` (`producto_id_operacion` ASC),
  CONSTRAINT `fk_operacion_detalle_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_detalle_operacion1`
    FOREIGN KEY (`operacion_id`)
    REFERENCES `crm`.`operacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_detalle_zona1`
    FOREIGN KEY (`zona_id`)
    REFERENCES `crm`.`zona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_detalle_producto2`
    FOREIGN KEY (`producto_id_operacion`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`mail_templates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`mail_templates` ;

CREATE TABLE IF NOT EXISTS `crm`.`mail_templates` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `template_type` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `subject` VARCHAR(150) CHARACTER SET 'utf8' NOT NULL,
  `template` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`migration`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`migration` ;

CREATE TABLE IF NOT EXISTS `crm`.`migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `crm`.`premio_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_producto` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campana_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: inactivo\n1: activo',
  `puntaje_con_caje` INT NULL,
  `puntaje_sin_canje` INT NULL,
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`auth_rule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`auth_rule` ;

CREATE TABLE IF NOT EXISTS `crm`.`auth_rule` (
  `name` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `data` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  `updated_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`auth_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`auth_item` ;

CREATE TABLE IF NOT EXISTS `crm`.`auth_item` (
  `name` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `type` INT(11) NOT NULL,
  `description` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `rule_name` VARCHAR(64) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `data` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  `updated_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`),
  INDEX `rule_name` (`rule_name` ASC),
  INDEX `idx-auth_item-type` (`type` ASC),
  CONSTRAINT `auth_item_ibfk_1`
    FOREIGN KEY (`rule_name`)
    REFERENCES `crm`.`auth_rule` (`name`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`auth_assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`auth_assignment` ;

CREATE TABLE IF NOT EXISTS `crm`.`auth_assignment` (
  `item_name` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `user_id` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  CONSTRAINT `auth_assignment_ibfk_1`
    FOREIGN KEY (`item_name`)
    REFERENCES `crm`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`auth_item_child`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`auth_item_child` ;

CREATE TABLE IF NOT EXISTS `crm`.`auth_item_child` (
  `parent` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `child` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  INDEX `child` (`child` ASC),
  CONSTRAINT `auth_item_child_ibfk_1`
    FOREIGN KEY (`parent`)
    REFERENCES `crm`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2`
    FOREIGN KEY (`child`)
    REFERENCES `crm`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`puntaje_campana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`puntaje_campana` ;

CREATE TABLE IF NOT EXISTS `crm`.`puntaje_campana` (
  `campana_id` INT NOT NULL,
  `interlocutor_comercial_id` INT NOT NULL,
  `puntaje_actual` INT NULL COMMENT 'Puntaje actual del cliente en la campania',
  `puntaje_acumulado` INT NULL,
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`premio_tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_tipo` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `estado` INT NULL COMMENT '0: inactivo\n1: activo',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`despacho`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`despacho` ;

CREATE TABLE IF NOT EXISTS `crm`.`despacho` (
  `id` INT NOT NULL,
  `operacion_id` INT NULL,
  `pedido_id` INT NULL,
  `estado` INT NULL COMMENT '0: INACTIVO\n1: ACTIVO',
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_despacho_operacion1_idx` (`operacion_id` ASC),
  INDEX `fk_despacho_pedido1_idx` (`pedido_id` ASC),
  CONSTRAINT `fk_despacho_operacion1`
    FOREIGN KEY (`operacion_id`)
    REFERENCES `crm`.`operacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_despacho_pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `crm`.`pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`venta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`venta` ;

CREATE TABLE IF NOT EXISTS `crm`.`venta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `despacho_id` INT NOT NULL,
  `pedido_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_venta_pedido1_idx` (`pedido_id` ASC),
  INDEX `fk_venta_despacho1_idx` (`despacho_id` ASC),
  CONSTRAINT `fk_venta_pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `crm`.`pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_despacho1`
    FOREIGN KEY (`despacho_id`)
    REFERENCES `crm`.`despacho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`venta_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`venta_detalle` ;

CREATE TABLE IF NOT EXISTS `crm`.`venta_detalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `venta_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_venta_detalle_venta1_idx` (`venta_id` ASC),
  CONSTRAINT `fk_venta_detalle_venta1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `crm`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`user` ;

CREATE TABLE IF NOT EXISTS `crm`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` CHAR(10) NULL,
  `name` VARCHAR(255) NULL,
  `surname` VARCHAR(255) NULL,
  `auth_key` VARCHAR(32) CHARACTER SET 'utf8' NOT NULL,
  `password_hash` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `password_reset_token` VARCHAR(255) CHARACTER SET 'utf8' NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `status` SMALLINT(6) NOT NULL DEFAULT '1',
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `role` VARCHAR(64) CHARACTER SET 'utf8' NOT NULL,
  `username` VARCHAR(64) CHARACTER SET 'utf8' NULL,
  `email_verification_status` TINYINT(1) NOT NULL DEFAULT '0',
  `email_verification_code` VARCHAR(256) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `crm`.`pedido_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`pedido_detalle` ;

CREATE TABLE IF NOT EXISTS `crm`.`pedido_detalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `pedido_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pedido_detalle_producto1_idx` (`producto_id` ASC),
  INDEX `fk_pedido_detalle_pedido1_idx` (`pedido_id` ASC),
  CONSTRAINT `fk_pedido_detalle_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `crm`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_detalle_pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `crm`.`pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`personal_despacho`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`personal_despacho` ;

CREATE TABLE IF NOT EXISTS `crm`.`personal_despacho` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `despacho_id` INT NOT NULL,
  `codigo` CHAR(10) NULL,
  `nombre` VARCHAR(255) NULL,
  `apellido` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `telefono` VARCHAR(45) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_personal_despacho_despacho1_idx` (`despacho_id` ASC),
  CONSTRAINT `fk_personal_despacho_despacho1`
    FOREIGN KEY (`despacho_id`)
    REFERENCES `crm`.`despacho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`ranking_anual`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`ranking_anual` ;

CREATE TABLE IF NOT EXISTS `crm`.`ranking_anual` (
  `anio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  `fecha_ranking` DATETIME NULL,
  PRIMARY KEY (`anio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`nivel_ranking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`nivel_ranking` ;

CREATE TABLE IF NOT EXISTS `crm`.`nivel_ranking` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`nivel_premio_anual`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`nivel_premio_anual` ;

CREATE TABLE IF NOT EXISTS `crm`.`nivel_premio_anual` (
  `ranking_anual_anio` INT NOT NULL,
  `nivel_ranking_id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `puntaje_minimo` INT NOT NULL,
  `puntaje_hasta` INT NOT NULL,
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crm`.`premio_ranking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crm`.`premio_ranking` ;

CREATE TABLE IF NOT EXISTS `crm`.`premio_ranking` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nivel_premio_anual_nivel_ranking_id` INT NOT NULL,
  `nivel_premio_anual_ranking_anual_anio` INT NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `estado` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_premio_ranking_nivel_premio_anual1_idx` (`nivel_premio_anual_ranking_anual_anio` ASC, `nivel_premio_anual_nivel_ranking_id` ASC),
  CONSTRAINT `fk_premio_ranking_nivel_premio_anual1`
    FOREIGN KEY (`nivel_premio_anual_ranking_anual_anio` , `nivel_premio_anual_nivel_ranking_id`)
    REFERENCES `crm`.`nivel_premio_anual` (`ranking_anual_anio` , `nivel_ranking_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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
ENGINE = InnoDB;


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
  `ranking_anual_anio` INT NOT NULL,
  `interlocutor_comercial_id` INT NOT NULL,
  `puntaje_acumulado` VARCHAR(45) NULL,
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
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
