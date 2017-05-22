INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) VALUES ('NOMBRE 1', 'APELLIDO 1', '4', '12345678', '00123456780', '1984-01-01', 'f', '2', '2', '12345678', '1234', 'PROFESION 1', '1', '1');
INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) VALUES ('NOMBRE 2', 'APELLIDO 2', '4', '87654321', '00876543210', '1985-01-01', 'm', '2', '2', '87654321', '4321', 'PROFESION 2', '1', '1');

INSERT INTO `sise_legal`.`bsd_proceso` (`proceso`, `cod_proceso_tipo`, `observaciones`, `usr_ult_modif`, `fec_ult_modif`) VALUES ('PERSONA 1 VS. PERSONA 2', '2', 'OBSERVACIONES DE PERSONA 1 VS. PERSONA 2', '1', 'SYSDATE');

INSERT INTO `sise_legal`.`bsd_detalle`
(
`cod_persona`,
`cod_proceso`,
`cod_detalle_tipo`,
`valor`)
VALUES
(
(SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),
(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),
2,
1);
