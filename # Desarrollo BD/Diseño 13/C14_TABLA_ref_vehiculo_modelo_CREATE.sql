USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_vehiculo_modelo` 
(
	`cod_modelo` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`modelo` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
    `cod_marca` INT(3) UNSIGNED NOT NULL COMMENT 'clave foranea para identificar la marca del modelo',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_modelo`),
	UNIQUE KEY `modelo` (`modelo`),
	KEY `cod_marca` (`cod_marca`),
	CONSTRAINT `ref_vehiculo_modelo_cod_marca_FK` FOREIGN KEY (`cod_marca`) REFERENCES `ref_vehiculo_marca`(`cod_marca`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_vehiculo_modelo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para modelos de vehiculos';