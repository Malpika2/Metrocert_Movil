<?php
class inspecciones extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Inspector/mSolicitud');
	}
	public function index(){
	}
	public function Descargar($idsolicitud){
		$this->mSolicitud->Descargar($idsolicitud);
		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/vR_Descarga');
		$this->load->view('Inspector/vFooter');
		
	}
}