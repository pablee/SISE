USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_direccion_localidad` 
(
	`cod_localidad` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`localidad` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
    `cod_partido` INT(11) UNSIGNED DEFAULT NULL COMMENT 'codigo del partido a la cual pertenece la localidad',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_localidad`),
	KEY `cod_partido` (`cod_partido`), 
	CONSTRAINT `ref_direccion_localidad_cod_partido_FK` FOREIGN KEY (`cod_partido`) REFERENCES `ref_direccion_partido`(`cod_partido`),
	KEY `usr_ult_modif` (`usr_ult_modif`), 
	CONSTRAINT `ref_direccion_localidad_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT='tabla auxiliar de localidad';