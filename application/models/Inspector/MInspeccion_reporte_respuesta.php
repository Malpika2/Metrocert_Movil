<?php

class mInspeccion_reporte_respuesta extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->emetro_local = $this->load->database('default',TRUE);
		$this->emetro_online = $this->load->database('emetro_online',TRUE);
	}
	public function getinspeccion_reporte_repuesta($idsolicitud,$idIns_Preg){
		$this->emetro_local->SELECT('*');
		$this->emetro_local->FROM('inspeccion_reporte_respuesta');
		$this->emetro_local->WHERE('idsolicitud',$idsolicitud);
		$this->emetro_local->WHERE('idinspeccion_reporte_pregunta',$idIns_Preg);
		$r = $this->emetro_local->get();
		$result = $r->row_array();
		return $result;
	}
	public function getLocal_idSol($idsolicitud){
		$this->emetro_local->SELECT('*');
		$this->emetro_local->from('inspeccion_reporte_respuesta');
		$this->emetro_local->where('idsolicitud',$idsolicitud);
		$r = $this->emetro_local->get();
		$result = $r->result();
		return $result;
	}
	public function EliminarResp_online($idsolicitud){
		$this->emetro_online->where('idsolicitud',$idsolicitud);
		$this->emetro_online->delete('inspeccion_reporte_respuesta');
		return true;
	}
	public function insert_online($row_resp_ins){
		$datos = array(
			'idinspeccion_reporte_pregunta' => $row_resp_ins->idinspeccion_reporte_pregunta,
			'idsolicitud' => $row_resp_ins->idsolicitud,
			'respuesta' => $row_resp_ins->respuesta,
			'observacion' => $row_resp_ins->observacion);
		$this->emetro_online->INSERT('inspeccion_reporte_respuesta',$datos);
		return true;
	}
}