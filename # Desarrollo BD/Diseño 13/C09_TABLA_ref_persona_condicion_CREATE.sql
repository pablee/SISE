USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_persona_condicion` 
(
	`cod_persona_condicion` INT(3) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Clave primaria',
	`persona_condicion` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_persona_condicion`),
	UNIQUE KEY `persona_condicion` (`persona_condicion`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_persona_condicion_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para las condiciones de una persona, tiene relación por medio del proceso';