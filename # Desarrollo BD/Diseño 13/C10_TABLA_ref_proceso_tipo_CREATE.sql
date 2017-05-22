USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_proceso_tipo` 
(
	`cod_proceso_tipo` INT(3) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Clave primaria',
	`proceso_tipo` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_proceso_tipo`),
	UNIQUE KEY `proceso_tipo` (`proceso_tipo`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_proceso_tipo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para tipos de proceso';