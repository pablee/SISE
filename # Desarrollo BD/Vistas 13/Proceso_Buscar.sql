SELECT PRO.cod_proceso, 
		PRO.proceso, 
		PER.cod_persona, 
		PER.nombres, 
		PER.apellidos, 
		PER.dni 

FROM rel_pers_cond_proc PCP 
JOIN bsd_persona PER ON PCP.cod_persona = PER.cod_persona 
JOIN bsd_proceso PRO ON PCP.cod_proceso = PRO.cod_proceso 

WHERE PER.nombres LIKE '%$buscar%'
   OR PER.apellidos LIKE '%$buscar%'
   OR PER.dni = '$buscar';