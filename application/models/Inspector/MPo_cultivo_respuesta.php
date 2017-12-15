<?php
class mPo_cultivo_respuesta extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->emetro_local = $this->load->database('default',TRUE);
		$this->emetro_online = $this->load->database('emetro_online',TRUE);
	}
	public function getRespuesta($idsolicitud,$idpo_cultivo_pregunta){
		$this->emetro_local->SELECT('respuesta, comentario ,implementacion , conformidad');
		$this->emetro_local->FROM('po_cultivo_respuesta');
		$this->emetro_local->WHERE('idsolicitud',$idsolicitud);
		$this->emetro_local->WHERE('idpo_cultivo_pregunta',$idpo_cultivo_pregunta);
		$r = $this->emetro_local->get();
		$result = $r->row_array();
		return $result;
	}
	public function getRespuesta_idSol($idsolicitud){
		$this->emetro_local->SELECT('*');
		$this->emetro_local->from('po_cultivo_respuesta');
		$this->emetro_local->where('idsolicitud',$idsolicitud);
		$r = $this->emetro_local->get();
		$result = $r->result();
		return $result;
	}
	public function EliminarResp_online($idsolicitud){
		$this->emetro_online->where('idsolicitud',$idsolicitud);
		$this->emetro_online->delete('po_cultivo_respuesta');
		return true;
	}
	public function insert_online($row_respuesta){
		$datos = array(
			'idpo_cultivo_pregunta' => $row_respuesta->idpo_cultivo_pregunta,
			'idsolicitud' => $row_respuesta->idsolicitud,
			'respuesta' => $row_respuesta->respuesta,
			'comentario' => $row_respuesta->comentario,
			'implementacion' => $row_respuesta->implementacion,
			'conformidad' => $row_respuesta->conformidad);
		$this->emetro_online->INSERT('po_cultivo_respuesta',$datos);
	}
	public function guardar_pregunta_pmo($idsolicitud,$idpregunta){
		$this->emetro_local->SELECT('*');
		$this->emetro_local->from('po_cultivo_respuesta');
		$this->emetro_local->where('idsolicitud',$idsolicitud);
		$this->emetro_local->where('idpo_cultivo_pregunta',$idpregunta);
		$r = $this->emetro_local->get();
		$result = $r->num_rows();
		return $result;
	}
	public function insertar_local($data){
		$datos = array(
			'idpo_cultivo_pregunta' => $data['idpregunta'],
			'idsolicitud' => $data['idsolicitud'],
			'implementacion' => $data['implementacion'],
			'conformidad' => $data['conformidad']
		);
		$this->emetro_local->INSERT('po_cultivo_respuesta',$datos);
	}
	public function update_local($data){
		$datos = array(
		'implementacion'=> $data['implementacion'],
		'conformidad'	=> $data['conformidad']
		);
		$this->emetro_local->where('idpo_cultivo_pregunta',$data['idpregunta']);
		$this->emetro_local->where('idsolicitud',$data['idsolicitud']);
		$this->emetro_local->update('po_cultivo_respuesta',$datos);
	}
}