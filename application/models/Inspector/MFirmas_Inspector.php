<?php 
class mFirmas_Inspector extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->emetro_local = $this->load->database('default',TRUE);
	}
	public function firmar_Inspeccion($data){
		$datos = array(
			'id_operador'=> $_SESSION['idinspector'],
			'nombre_firma' => $_SESSION['MM_Username'],
			'fecha_firma' => time(),
			'id_orden' => $data['idsolicitud'],
			'url_firma' => $data['filename']
		);
		$this->emetro_local->insert('firmas_inspector',$datos);
	}
	public function getFirmasOrdenInspeccion($idsolicitud){
		$this->emetro_local->select('*');
		$this->emetro_local->from('firmas_inspector');
		$this->emetro_local->where('id_orden',$idsolicitud);
		$r = $this->emetro_local->get();
		$result = $r->row();
		return $result;

	}
	public function getFirmasPmo($idsolicitud){
		$this->emetro_local->select('*');
		$this->emetro_local->from('firmas_inspector');
		$this->emetro_local->where('id_pmo',$idsolicitud);
		$r = $this->emetro_local->get();
		$result = $r->row();
		return $result;
	}
	public function firmar_Pmo($data){
		$datos = array(
			'id_operador' => $_SESSION['idinspector'],
			'nombre_firma' => $_SESSION['MM_Username'],
			'fecha_firma' => time(),
			'id_pmo' => $data['idsolicitud'],
			'url_firma' => $data['filename']
		);
		$this->emetro_local->insert('firmas_inspector',$datos);
	}
	public function getFirmasR_ins($idsolicitud){
		$this->emetro_local->select('*');
		$this->emetro_local->from('firmas_inspector');
		$this->emetro_local->where('id_ins',$idsolicitud);
		$r = $this->emetro_local->get();
		$result = $r->row();
		return $result;
	}
	public function firmar_Rins($data){
		$datos = array(
			'id_operador' => $_SESSION['idinspector'],
			'nombre_firma' => $_SESSION['MM_Username'],
			'fecha_firma' => time(),
			'id_ins' => $data['idsolicitud'],
			'url_firma' => $data['filename']
		);
		$this->emetro_local->insert('firmas_inspector',$datos);
	}
}