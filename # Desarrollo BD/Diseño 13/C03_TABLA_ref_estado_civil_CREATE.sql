USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_estado_civil` 
(
	`cod_estado_civil` INT(3) UNSIGNED NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`estado_civil` VARCHAR(45) NOT NULL COMMENT 'descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_estado_civil`),
	UNIQUE KEY `estado_civil` (`estado_civil`),
	KEY `usr_ult_modif` (`usr_ult_modif`), 
	CONSTRAINT `ref_estado_civil_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para estado civil';