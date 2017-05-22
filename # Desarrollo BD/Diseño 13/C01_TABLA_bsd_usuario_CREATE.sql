USE sise_legal;
CREATE TABLE IF NOT EXISTS `bsd_usuario` 
(
	`cod_usuario` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`usuario` VARCHAR(20) NOT NULL COMMENT 'descripcion de referencia',
	`password` VARCHAR(15) NOT NULL COMMENT 'clave de usuario de la aplicacion',
	`nombre` VARCHAR(50) NULL DEFAULT NULL COMMENT 'nombre del usuario',
	`apellido` VARCHAR(50) NULL DEFAULT NULL COMMENT 'apellido del usuario',
	`correo_electronico` VARCHAR(100) NULL DEFAULT NULL COMMENT 'correo electronico del usuario del sistema',
    `cod_rol` INT(3) UNSIGNED NOT NULL COMMENT 'rol asignado al usuario para utilizar el sistema',
	`usr_ult_modif` INT(3) NULL DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_usuario`),
	UNIQUE KEY `usuario` (`usuario`),
	KEY `cod_rol` (`cod_rol`),
	CONSTRAINT `bsd_usuario_cod_rol_FK` FOREIGN KEY (`cod_rol`) REFERENCES `bsd_rol`(`cod_rol`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci
COMMENT = 'Usuarios del sistema';