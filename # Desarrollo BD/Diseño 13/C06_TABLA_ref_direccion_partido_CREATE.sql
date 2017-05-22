USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_direccion_partido` 
(
	`cod_partido` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`partido` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
    `cod_provincia` INT(11) UNSIGNED DEFAULT NULL COMMENT 'codigo de la provincia a la cual pertenece el partido',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_partido`),
	UNIQUE KEY `partido` (`partido`),
	KEY `cod_provincia` (`cod_provincia`), 
	CONSTRAINT `ref_direccion_partido_cod_provincia_FK` FOREIGN KEY (`cod_provincia`) REFERENCES `ref_direccion_provincia`(`cod_provincia`),
	KEY `usr_ult_modif` (`usr_ult_modif`), 
	CONSTRAINT `ref_direccion_partido_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT='tabla de partidos';