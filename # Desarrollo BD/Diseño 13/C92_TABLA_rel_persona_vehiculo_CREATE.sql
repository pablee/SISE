USE sise_legal;
CREATE TABLE IF NOT EXISTS `rel_persona_vehiculo` 
(
	`cod_persona` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`cod_vehiculo` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
    `dominio` VARCHAR(12) NOT NULL COMMENT 'Dominio por el cual se relaciona un tipo de vehiculo con una persona',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_persona`, `cod_vehiculo`, `dominio`),
	KEY `cod_persona` (`cod_persona`),
	CONSTRAINT `rel_persona_vehiculo_cod_persona_FK` FOREIGN KEY (`cod_persona`) REFERENCES `bsd_persona`(`cod_persona`),
    KEY `cod_vehiculo` (`cod_vehiculo`),
	CONSTRAINT `rel_persona_vehiculo_cod_vehiculo_FK` FOREIGN KEY (`cod_vehiculo`) REFERENCES `bsd_vehiculo`(`cod_vehiculo`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `rel_persona_vehiculo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla de relacion entre una o mas personas y uno o mas vehiculos';