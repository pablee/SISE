USE sise_legal;
CREATE TABLE IF NOT EXISTS `rel_pers_cond_deta_tipo` 
(
	`cod_persona_condicion` INT(3) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`cod_detalle_tipo` INT(3) UNSIGNED COMMENT 'Clave foranea',
    `orden` SMALLINT UNSIGNED DEFAULT NULL COMMENT 'orden del detalle entre otros relacionados',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_persona_condicion`, `cod_detalle_tipo`),
	KEY `cod_persona_condicion` (`cod_persona_condicion`),
	CONSTRAINT `rel_pers_cond_deta_tipo_cod_persona_condicion_FK` FOREIGN KEY (`cod_persona_condicion`) REFERENCES `ref_persona_condicion`(`cod_persona_condicion`),
	KEY `cod_detalle_tipo` (`cod_detalle_tipo`),
	CONSTRAINT `rel_pers_cond_deta_tipo_cod_detalle_tipo_FK` FOREIGN KEY (`cod_detalle_tipo`) REFERENCES `ref_detalle_tipo`(`cod_detalle_tipo`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `rel_pers_cond_deta_tipo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla de detalles de la información de la persona';