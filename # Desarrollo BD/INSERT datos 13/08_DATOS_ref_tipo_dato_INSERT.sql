INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (1, 'BIT', '(BOOL, BOOLEAN): Número entero con valor 0 o 1.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (2, 'TINYINT', 'Ocupación de 1 bytes con valores entre -128 y 127 o entre 0 y 255.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (3, 'SMALLINT', 'Ocupación de 2 bytes con valores entre -32.768 y 32.767 o entre 0 y 65.535.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (4, 'MEDIUMINT', 'Ocupación de 3 bytes con valores entre -8.388.608 y 8.388.607 o entre 0 y 16.777.215.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (5, 'INT', 'Ocupación de 4 bytes con valores entre -2.147.483.648 y 2.147.483.647 o entre 0 y 4.294.967.295.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (6, 'BIGINT', 'Ocupación de 8 bytes con valores entre -8.388.608 y 8.388.607 o entre 0 y 16.777.215.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (7, 'FLOAT', '(m,d): Almacena números de coma flotante, donde m es el número de dígitos de la parte entera y d el número de decimales.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (8, 'DOUBLE', 'Almacena número de coma flotante con precisión doble. Igual que FLOAT, la diferencia es el rango de valores posibles.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (9, 'DECIMAL', 'Almacena los números de coma flotante como cadenas o string.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (10, 'CHAR', ' Ocupación fija cuya longitud comprende de 1 a 255 caracteres.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (11, 'VARCHAR', 'Ocupación variable cuya longitud comprende de 1 a 255 caracteres.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (12, 'TINYTEXT', 'Una longitud máxima de 255 caracteres. Sirve para almecenar texto plano sin formato. Distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (13, 'MEDIUMTEXT', 'Una longitud máxima de 16.777.215 caracteres. Sirve para almecenar texto plano sin formato. Distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (14, 'TEXT', 'Una longitud máxima de 65.535 caracteres. Sirve para almecenar texto plano sin formato. Distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (15, 'LONGTEXT', 'Una longitud máxima de 4.294.967.298 caracteres. Sirve para almecenar texto plano sin formato. Distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (16, 'TINYBLOB', 'Una longitud máxima de 255 caracteres. Válido para objetos binarios como son un fichero de texto, imágenes, ficheros de audio o vídeo. No distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (17, 'MEDIUMBLOB', 'Una longitud máxima de 16.777.215 caracteres. Válido para objetos binarios como son un fichero de texto, imágenes, ficheros de audio o vídeo. No distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (18, 'BLOB', 'Una longitud máxima de 65.535 caracteres. Válido para objetos binarios como son un fichero de texto, imágenes, ficheros de audio o vídeo. No distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (19, 'LONGBLOB', 'Una longitud máxima de 4.294.967.298 caracteres. Válido para objetos binarios como son un fichero de texto, imágenes, ficheros de audio o vídeo. No distingue entre minúculas y mayúsculas.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (20, 'DATE', 'Válido para almacenar una fecha con año, mes y día, su rango oscila entre  #1000-01-01# y #9999-12-31#.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (21, 'DATETIME', 'Almacena una fecha (año-mes-día) y una hora (horas-minutos-segundos), su rango oscila entre  #1000-01-01 00:00:00# y #9999-12-31 23:59:59#.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (22, 'TIME', 'Válido para almacenar una hora (horas-minutos-segundos). Su rango de horas oscila entre -838-59-59 y 838-59-59. El formato almacenado es #HH:MM:SS#.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (23, 'TIMESTAMP', 'Almacena una fecha y hora UTC. El rango de valores oscila entre #1970-01-01 00:00:01# y #2038-01-19 03:14:07#.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (24, 'YEAR', 'Almacena un año dado con 2 o 4 dígitos de longitud, por defecto son 4. El rango de valores oscila entre 1901 y 2155 con 4 dígitos. Mientras que con 2 dígitos el rango es desde 1970 a 2069  (70-69).');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (25, 'SET', 'Almacena 0, uno o varios valores una lista con un máximo de 64 posibles valores.');
INSERT INTO `sise_legal`.`ref_tipo_dato` (`cod_tipo_dato`,`tipo_dato`, `observaciones`) VALUES (26, 'ENUM', 'Igual que SET pero solo puede almacenar un valor.');