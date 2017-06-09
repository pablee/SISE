USE sise_legal;
CREATE TABLE IF NOT EXISTS `rel_persona_direccion` 
(
	`cod_persona` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`cod_direccion` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_persona`, `cod_direccion`),
	KEY `cod_persona` (`cod_persona`),
	CONSTRAINT `rel_persona_direccion_cod_persona_FK` FOREIGN KEY (`cod_persona`) REFERENCES `bsd_persona`(`cod_persona`),
	KEY `cod_direccion` (`cod_direccion`),
	CONSTRAINT `rel_persona_direccion_cod_direccion_FK` FOREIGN KEY (`cod_direccion`) REFERENCES `bsd_direccion`(`cod_direccion`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `rel_persona_direccion_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla de relacion entre la persona y sus direcciones';