<?php 
class mLogin extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->emetro_local = $this->load->database('default',TRUE);
	}
	public function login($us=null,$pas=null){
		$this->emetro_local->select('idinspector,usuario,password,clase');
		$this->emetro_local->from('inspector');
		$this->emetro_local->WHERE('usuario',$us);
		$this->emetro_local->WHERE('password',$pas);
		$resultado = $this->emetro_local->get();

		if($resultado->num_rows() == 1){

			$r = $resultado->row();
			$s_inspector = array(
				'MM_Username' => $us,
				'MM_UserGroup' => $r->clase,
				'idinspector' => $r->idinspector,
				's_session' => 'Active'
				);
			$this->session->set_userdata($s_inspector);
			return 1;
		}else{
			return 0;
		}
	}
}