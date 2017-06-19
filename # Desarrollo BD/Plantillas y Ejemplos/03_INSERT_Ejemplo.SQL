INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) 
VALUES ('NOMBRE 1', 'APELLIDO 1', '4', '12345678', '27123456780', '1984-01-01', 'f', '2', '2', '12345678', '1234', 'PROFESION 1', '1', '1');
INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) 
VALUES ('NOMBRE 2', 'APELLIDO 2', '4', '87654321', '20876543210', '1985-01-01', 'm', '2', '2', '87654321', '4321', 'PROFESION 2', '1', '1');

INSERT INTO `sise_legal`.`bsd_proceso` (`proceso`, `cod_proceso_tipo`, `observaciones`, `usr_ult_modif`) 
VALUES ('PERSONA 1 VS. PERSONA 2', '2', 'OBSERVACIONES DE PERSONA 1 VS. PERSONA 2', '1');

INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),2,1);
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),3,1);
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),4,5);
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),5,1);
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),9,'cobertura completa');
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),10,'01/05/2017');
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),11,'a la vuelta de mi casa');
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),12,'rotura de tibia y peroné');
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),13,'El hospital posadas');
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`)
VALUES((SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),(SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),14,'Estuve mariado durante varios dias');

INSERT INTO `sise_legal`.`rel_pers_cond_proc`(`cod_proceso`,`cod_persona`,`cod_persona_condicion`,`orden`,`observaciones`)
VALUES((SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),(SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 1'),2,1,'EJEMPLO GENERICO PARA NOMBRE 1');
INSERT INTO `sise_legal`.`rel_pers_cond_proc`(`cod_proceso`,`cod_persona`,`cod_persona_condicion`,`orden`,`observaciones`)
VALUES((SELECT COD_PROCESO FROM sise_legal.bsd_proceso WHERE PROCESO LIKE 'PERSONA 1 VS. PERSONA 2'),(SELECT COD_PERSONA FROM sise_legal.bsd_persona WHERE NOMBRES LIKE 'NOMBRE 2'),3,2,'EJEMPLO GENERICO PARA NOMBRE 2');