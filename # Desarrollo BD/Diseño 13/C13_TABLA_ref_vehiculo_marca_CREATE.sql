USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_vehiculo_marca` 
(
	`cod_marca` INT(3) UNSIGNED AUTO_INCREMENT COMMENT 'Clave primaria',
	`marca` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_marca`),
	UNIQUE KEY `marca` (`marca`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_vehiculo_marca_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para marcas de vehiculos';