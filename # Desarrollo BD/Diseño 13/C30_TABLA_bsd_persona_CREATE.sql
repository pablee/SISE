USE sise_legal;
CREATE TABLE IF NOT EXISTS `bsd_persona` 
(
	`cod_persona` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`nombres` VARCHAR(100) DEFAULT NULL COMMENT 'Nombres de la persona o razon social',
	`apellidos` VARCHAR(100) DEFAULT NULL COMMENT 'Apellidos de la persona',
	`cod_tipo_dni` INT(3) UNSIGNED DEFAULT NULL COMMENT '1-DNI 2-LC 3-LE 4-OTRO',
	`dni` INT(10) UNSIGNED DEFAULT NULL COMMENT 'numero de DNI',
	`cuil` INT(11) UNSIGNED DEFAULT NULL COMMENT 'CUIL 20-30789385-2 11 lugares',
	`fec_nacimiento` DATE COMMENT 'FECHA DE NACIMIENTO',
	`sexo` CHAR(1) DEFAULT NULL COMMENT 'M-Masculino F-Femenino',
	`cod_nacionalidad` INT(3) UNSIGNED DEFAULT NULL COMMENT 'nacionalidad de la persona',
	`cod_estado_civil` INT(3) UNSIGNED DEFAULT NULL COMMENT 'estado civil de la persona',
	`telefono` INT(12) UNSIGNED DEFAULT NULL COMMENT 'Celular',
	`codigo_postal` VARCHAR(5) DEFAULT NULL COMMENT 'telefono',
	`profesion` TEXT DEFAULT NULL COMMENT 'REVISAR SI ES NECESARIO 65.535',
	`cod_categoria` INT(3) UNSIGNED DEFAULT NULL COMMENT '1-persona física, 2-persona juridica',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre65.635',
	`usr_ult_modif` INT(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_persona`),
	KEY `nombres` (`nombres`),
	KEY `apellidos` (`apellidos`),
	KEY `cod_tipo_dni` (`cod_tipo_dni`),
	CONSTRAINT `bsd_persona_cod_tipo_dni_FK` FOREIGN KEY (`cod_tipo_dni`) REFERENCES `ref_tipo_dni`(`cod_tipo_dni`),
	UNIQUE KEY (`dni`),
	KEY `cod_nacionalidad` (`cod_nacionalidad`),
	CONSTRAINT `bsd_persona_cod_nacionalidad_FK` FOREIGN KEY (`cod_nacionalidad`) REFERENCES `ref_nacionalidad`(`cod_nacionalidad`),
	KEY `cod_estado_civil` (`cod_estado_civil`),
	CONSTRAINT `bsd_persona_cod_estado_civil_FK` FOREIGN KEY (`cod_estado_civil`) REFERENCES `ref_estado_civil`(`cod_estado_civil`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `bsd_persona_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT='tabla de personas';