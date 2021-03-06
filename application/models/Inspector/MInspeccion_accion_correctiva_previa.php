<?php 

class mInspeccion_accion_correctiva_previa extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->emetro_local = $this->load->database('default',TRUE);
	}
	public function getAcc_Cor_Prev($idSolicitud){
		$this->emetro_local->SELECT('*');
		$this->emetro_local->FROM('inspeccion_accion_correctiva_previa');
		$this->emetro_local->where('idsolicitud',$idSolicitud);
		$r = $this->emetro_local->get();
		$result = $r->result();
		return $result;
	}
	public function update_local($data){
		$datos = array(
			'situacion_encontrada' => $data['situacion_encontrada']
		);
		$this->emetro_local->where('idinspeccion_accion_correctiva_previa',$data['idinspeccion_accion_correctiva_previa']);
		$this->emetro_local->update('inspeccion_accion_correctiva_previa',$datos);
	}
}