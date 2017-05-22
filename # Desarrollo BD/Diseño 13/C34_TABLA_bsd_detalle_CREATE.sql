USE sise_legal;
CREATE TABLE IF NOT EXISTS `bsd_detalle` 
(
	`cod_detalle` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Clave primaria',
	`cod_persona` INT(11) UNSIGNED COMMENT 'Clave foranea',
	`cod_proceso` INT(11) UNSIGNED COMMENT 'Clave foranea',
	`cod_detalle_tipo` INT(3) UNSIGNED COMMENT 'Clave foranea',
	`valor` LONGTEXT DEFAULT NULL COMMENT 'texto acorde al tipo',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_detalle`),
	KEY `cod_persona` (`cod_persona`),
	CONSTRAINT `bsd_detalle_cod_persona_FK` FOREIGN KEY (`cod_persona`) REFERENCES `bsd_persona`(`cod_persona`),
	KEY `cod_proceso` (`cod_proceso`),
	CONSTRAINT `bsd_detalle_cod_proceso_FK` FOREIGN KEY (`cod_proceso`) REFERENCES `bsd_proceso`(`cod_proceso`),
	KEY `cod_detalle_tipo` (`cod_detalle_tipo`),
	CONSTRAINT `bsd_detalle_cod_detalle_tipo_FK` FOREIGN KEY (`cod_detalle_tipo`) REFERENCES `ref_detalle_tipo`(`cod_detalle_tipo`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `bsd_detalle_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla de detalles de la información de la persona';