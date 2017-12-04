<?php

class login extends CI_Controller
{
	public  $mensaje='';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Inspector/mLogin');
		$this->load->model('Inspector/mSolicitud');
		$this->load->model('Inspector/mOrden_Inspeccion');
		$this->load->model('Inspector/mOperadores');

	}
	public function index()
	{
		if (isset($_SESSION['s_session'])){
			if (isset($_POST['online'])) {
				$this->inspecciones_Asignadas_online();
				}
				else{
					$this->inspecciones_Asignadas_local();
				}
			}
			else{
			if ($this->login()=='1') {
				$this->inspecciones_Asignadas_local();
			}if ($this->login()=='0') {
			$data['mensaje'] = $this->mensaje;
			$this->load->view('Inspector/vLogin',$data);
			}
		}
	}
	public function login()
	{
		$us=null;
		$pas=null;
		if (null!==$this->input->post('usuario')) {
			$us = $this->input->post('usuario');
			$this->mensaje='Usuario o contraseña incorrecto';	
		}
		if (null!==$this->input->post('password')) {
			$pas = $this->input->post('password');
		}
		return $this->mLogin->login($us,$pas);
	}

	public function inspecciones_Asignadas_online(){
		$solicitudes_online = $this->mSolicitud->getSolicitudes_online();
		$data['row_Solicitudes_online'] = $solicitudes_online;


		foreach ($solicitudes_online as $solicitud_online) {
			$orden_inspeccion_online = $this->mOrden_Inspeccion->getOrden_Inspeccion_Online($solicitud_online->idsolicitud);
			$data['row_orden_inspeccion_online'][$solicitud_online->idsolicitud] = $orden_inspeccion_online;

			if ($orden_inspeccion_online->autorizacion_fecha >1) {
				$row_operador_online = $this->mOperadores->getOperador_online($solicitud_online->idoperador);
				$data['row_operador_online'][$solicitud_online->idsolicitud] = $row_operador_online;
			}
		}
		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/view_online',$data);
		$this->load->view('Inspector/vFooter');
		return false;
	}
	public function inspecciones_Asignadas_local(){
		$solicitudes =$this->mSolicitud->getSolicitudes();

		foreach ($solicitudes as $solicitud) {
		$orden_inspeccion = $this->mOrden_Inspeccion->getOrden_Inspeccion($solicitud->idsolicitud);
		$data['row_orden_inspeccion'][$solicitud->idsolicitud] = $orden_inspeccion;

			if ($orden_inspeccion['autorizacion_fecha'] > 1) {
				$row_operador = $this->mOperadores->getOperador($solicitud->idoperador);
				$data['row_operador'][$solicitud->idsolicitud] = $row_operador;
			}
		}
		$data['row_Solicitudes'] = $solicitudes;
		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/view_local',$data);
		$this->load->view('Inspector/vFooter');
		return false;
	}

}