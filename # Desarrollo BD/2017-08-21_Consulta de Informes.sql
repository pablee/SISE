SELECT 	  PRO.cod_proceso, PRO.proceso, PRO.ultimas_novedades
		, PRO.cod_proceso_tipo, PRO_T.proceso_tipo
		, PCP_CLI.cod_persona
        , PER_CLI.nombres, PER_CLI.apellidos, PER_CLI.razon_social, PER_CLI.dni, PER_CLI.celular
        , PCP_CLI.cod_persona_condicion, COND_CLI.persona_condicion
        , PCP_OPO.cod_persona
        , PER_OPO.nombres, PER_OPO.apellidos, PER_OPO.razon_social, PER_OPO.dni, PER_OPO.celular
        , PCP_OPO.cod_persona_condicion, COND_OPO.persona_condicion
FROM 	  bsd_proceso AS PRO 
LEFT JOIN rel_pers_cond_proc AS PCP_CLI 
	ON (PRO.cod_proceso = PCP_CLI.cod_proceso AND PCP_CLI.cod_persona_condicion = 2)
LEFT JOIN rel_pers_cond_proc AS PCP_OPO 
	ON (PRO.cod_proceso = PCP_OPO.cod_proceso AND (PCP_OPO.cod_persona_condicion = 3 OR PCP_OPO.cod_persona_condicion = 4))
LEFT JOIN bsd_persona AS PER_CLI 
	ON (PCP_CLI.cod_persona = PER_CLI.cod_persona)
LEFT JOIN bsd_persona AS PER_OPO
	ON (PCP_OPO.cod_persona = PER_OPO.cod_persona)
LEFT JOIN ref_persona_condicion AS COND_CLI
	ON (PCP_CLI.cod_persona_condicion = COND_CLI.cod_persona_condicion)
LEFT JOIN ref_persona_condicion AS COND_OPO
	ON (PCP_OPO.cod_persona_condicion = COND_OPO.cod_persona_condicion)
		, ref_proceso_tipo AS PRO_T
WHERE PRO.cod_proceso_tipo = PRO_T.cod_proceso_tipo
  AND (PRO.cod_proceso IN 
						(
						SELECT cod_proceso
						FROM bsd_detalle
						WHERE 	(	
								cod_detalle_tipo = 1/*$filtroDetalleTipoBoolean*/
								AND 
                                valor = 1/*'$respuestaBoolean'*/
                                )
						   OR 	(
								cod_detalle_tipo = 1/*$filtroDetalleTipo*/
                                AND
                                valor = 1 /*'$respuestaTexto'*/
                                )
						)
	   OR (1=1 /*$filtroDetalleTipoBoolean == null*/)
	   OR (1=1 /*$filtroDetalleTipo == null*/)
       )
