USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_tipo_dato` 
(
	`cod_tipo_dato` INT(3) UNSIGNED AUTO_INCREMENT COMMENT 'Clave primaria',
	`tipo_dato` VARCHAR(45) NOT NULL COMMENT 'descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_tipo_dato`),
	UNIQUE KEY `tipo_dato` (`tipo_dato`),
    KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_tipo_dato_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para tipos de dato que se usarán para almacenar valores';