<?php 

class pmo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Inspector/mPo_cultivo_pregunta');
		$this->load->model('Inspector/mPo_cultivo_respuesta');
		$this->load->model('Inspector/mPo_cultivo_subpregunta');
		$this->load->model('Inspector/mFirmas_Inspector');
	}
	public function index(){
		$idsolicitud = $this->input->post('id');
		$row_po_cultivo_pregunta = $this->mPo_cultivo_pregunta->getPo_cultivo_pregunta();
		foreach ($row_po_cultivo_pregunta as $po_cultivo_pregunta) {
			$data['row_resp'][$po_cultivo_pregunta->idpo_cultivo_pregunta]= $this->mPo_cultivo_respuesta->getRespuesta($idsolicitud,$po_cultivo_pregunta->idpo_cultivo_pregunta);
			$data['row_po_cultivo_subpregunta'][$po_cultivo_pregunta->idpo_cultivo_pregunta] = $this->mPo_cultivo_subpregunta->getPo_cultivo_subpregunta($po_cultivo_pregunta->idpo_cultivo_pregunta);
		}

		$data['row_po_cultivo_pregunta'] = $row_po_cultivo_pregunta;
		$data['idsolicitud']= $idsolicitud;
		$data['row_firma'] = $this->mFirmas_Inspector->getFirmasPmo($idsolicitud);



		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/vPmo',$data);
		$this->load->view('Inspector/vFooter');
	}
	public function guardar_pregunta_pmo(){
		$idsolicitud = $this->input->post('idsolicitud');
		$idpregunta = $this->input->post('idpregunta');
		$num_preguntas = $this->mPo_cultivo_respuesta->guardar_pregunta_pmo($idsolicitud,$idpregunta);
		if ($num_preguntas==0) {	
			$data['idpregunta'] = $this->input->post('idpregunta');
			$data['idsolicitud'] = $this->input->post('idsolicitud');
			$data['implementacion'] = $this->input->post('implementacion');
			$data['conformidad'] = $this->input->post('conformidad');
		$this->mPo_cultivo_respuesta->insertar_local($data);
		}else{
			$data['idpregunta'] = $this->input->post('idpregunta');
			$data['idsolicitud'] = $this->input->post('idsolicitud');
			$data['implementacion'] = $this->input->post('implementacion');
			$data['conformidad'] = $this->input->post('conformidad');
			$this->mPo_cultivo_respuesta->update_local($data);
		}
	}
	public function firmar_Pmo(){
		//Guardar imagen_Firma de los PMO{
		$fileName = $this->input->post('filename');
		$data = $this->input->post('base64data'); 
		$image = explode('base64,',$data); 
		file_put_contents($fileName.'.png', base64_decode($image[1]));
		// }
		$data = $_POST;
		$this->mFirmas_Inspector->firmar_Pmo($data);
	}
}