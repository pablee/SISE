USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_tipo_dni` 
(
	`cod_tipo_dni` INT(3) UNSIGNED AUTO_INCREMENT COMMENT 'Clave primaria',
	`tipo_dni` VARCHAR(45) NOT NULL COMMENT 'descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_tipo_dni`),
	UNIQUE KEY `tipo_dni` (`tipo_dni`),
    KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_tipo_dni_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para tipos de DNI';