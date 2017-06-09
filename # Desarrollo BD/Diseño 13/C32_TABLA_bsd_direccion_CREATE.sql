USE `sise_legal`;
CREATE TABLE IF NOT EXISTS `bsd_direccion` 
(
	`cod_direccion` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`domicilio` VARCHAR(1000) NOT NULL COMMENT 'Descripción referencial del domicilio',
    `calle` VARCHAR(200) DEFAULT NULL COMMENT 'calle de la direccion',
    `numero` VARCHAR(10) DEFAULT NULL COMMENT 'numero de la direccion',
    `piso` VARCHAR(10) DEFAULT NULL COMMENT 'piso de la direccion',
    `departamento` VARCHAR(10) DEFAULT NULL COMMENT 'departamento de la direccion',
    `torre` VARCHAR(10) DEFAULT NULL COMMENT 'torre de la direccion',
    `cod_localidad` INT(11) UNSIGNED DEFAULT NULL COMMENT 'localidad de la direccion',
    `cod_partido` INT(11) UNSIGNED DEFAULT NULL COMMENT 'partido de la direccion',
    `cod_provincia` INT(11) UNSIGNED DEFAULT NULL COMMENT 'provincia del domicilio',
    `codigo postal` VARCHAR(20) DEFAULT NULL COMMENT 'Codigo postal de la direccion',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) unsigned DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_direccion`),
	KEY `cod_localidad` (`cod_localidad`),
	CONSTRAINT `bsd_direccion_cod_localidad_FK` FOREIGN KEY (`cod_localidad`) REFERENCES `ref_direccion_localidad`(`cod_localidad`),
	KEY `cod_partido` (`cod_partido`),
	CONSTRAINT `bsd_direccion_cod_partido_FK` FOREIGN KEY (`cod_partido`) REFERENCES `ref_direccion_partido`(`cod_partido`),
	KEY `cod_provincia` (`cod_provincia`),
	CONSTRAINT `bsd_direccion_cod_provincia_FK` FOREIGN KEY (`cod_provincia`) REFERENCES `ref_direccion_provincia`(`cod_provincia`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `bsd_domicilio_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE=InnoDB 
-- DEFAULT CHARSET=latin1 
-- COLLATE=latin1_spanish_ci 
COMMENT='tabla de direcciones';