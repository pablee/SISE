USE sise_legal;
CREATE TABLE IF NOT EXISTS `bsd_rol` 
(
	`cod_rol` INT(3) UNSIGNED AUTO_INCREMENT COMMENT 'Clave primaria',
	`rol` VARCHAR(45) NULL DEFAULT NULL COMMENT 'descripcion de referencia',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_rol`),
	UNIQUE KEY `rol` (`rol`),
	KEY `usr_ult_modif` (`usr_ult_modif`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = utf8
-- COLLATE = utf8_spanish2_ci
COMMENT = 'Tabla de roles de usuario del sistema';

