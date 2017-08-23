/*Combo para los valores del tipo si o no. Además hay que hacer otro combo al lado con el valor si o no para traducir a 1 o 0*/
SELECT * 
FROM ref_detalle_tipo AS DET_T
WHERE DET_T.cod_tipo_dato IN (1);

/*Combo para los valores del tipo texto libre, fecha, y valores numéricos. Además hay que hacer un textbox al lado para que el usuario escriba el texto buscado.*/
/*Se podrían llegar a separar en fechas para agregar el calendario, a futuro*/
SELECT * 
FROM ref_detalle_tipo AS DET_T
WHERE DET_T.cod_tipo_dato IN (2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 20, 21, 22, 23, 24);

/*Consulta de busqueda de los valores ingresados entre los detalles cargados*/
SELECT * 
FROM bsd_detalle
WHERE (cod_detalle_tipo = $COMBO_DETALLE_TIPO_1
  AND  valor = $COMBO_SI_NO)
   OR (cod_detalle_tipo = $COMBO_DETALLE_TIPO_2
  AND  valor = $TEXTBOX_VALOR);