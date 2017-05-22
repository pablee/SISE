USE sise_legal;
CREATE TABLE IF NOT EXISTS `rel_pers_cond_proc` 
(
	`cod_proceso` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`cod_persona` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`cod_persona_condicion` INT(3) UNSIGNED NOT NULL COMMENT 'Clave primaria',
    `orden` SMALLINT UNSIGNED DEFAULT NULL COMMENT 'orden del detalle entre otros relacionados',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_proceso`, `cod_persona`, `cod_persona_condicion`),
	KEY `cod_proceso` (`cod_proceso`),
	CONSTRAINT `rel_pers_cond_proc_cod_proceso_FK` FOREIGN KEY (`cod_proceso`) REFERENCES `bsd_proceso`(`cod_proceso`),
	KEY `cod_persona` (`cod_persona`),
	CONSTRAINT `rel_pers_cond_proc_cod_persona_FK` FOREIGN KEY (`cod_persona`) REFERENCES `bsd_persona`(`cod_persona`),
	KEY `cod_persona_condicion` (`cod_persona_condicion`),
	CONSTRAINT `rel_pers_cond_proc_cod_persona_condicion_FK` FOREIGN KEY (`cod_persona_condicion`) REFERENCES `ref_persona_condicion`(`cod_persona_condicion`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `rel_pers_cond_proc_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla de relacion entre proceso, persona y la condicion de dicha persona';