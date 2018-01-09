<?php
class inspecciones extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Inspector/mSolicitud');
		$this->load->model('Inspector/mOperadores');
		$this->load->model('Inspector/mInspeccion');
		$this->load->model('Inspector/mInspector');
		$this->load->model('Inspector/mSolicitud_producto');
		$this->load->model('Inspector/mUnidad_produccion');
		$this->load->model('Inspector/mSolicitud_proceso');
		$this->load->model('Inspector/mProceso');
		$this->load->model('Inspector/mOrden_inspeccion');
		$this->load->model('Inspector/mInspeccion_indicacion');
		$this->load->model('Inspector/mInspeccion_accion_correctiva_previa');
		$this->load->model('Inspector/mPo_cultivo_respuesta');
		$this->load->model('Inspector/mInspeccion_reporte_respuesta');
		$this->load->model('Inspector/mFirmas_Inspector');

	}
	public function index(){
		$idsolicitud = $this->input->post('idsolicitud');
		$row_solicitud =  $this->mSolicitud->getSolicitud_Local_porId($idsolicitud);
		$row_inspeccion = $this->mInspeccion->getInspeccion($idsolicitud);
		$row_producto = $this->mSolicitud_producto->getSolicitud_producto($idsolicitud);
		$solicitud_categoria_certificacion = $this->mSolicitud->getSolicitud_categoria_certificacion();
		$row_procesos = $this->mSolicitud_proceso->getSolicitud_proceso($idsolicitud);

		foreach ($solicitud_categoria_certificacion as $s_c_certificacion) {
			$data['row_nombre_categoria'][$s_c_certificacion->idcategoria_certificacion] =  
			$this->mSolicitud->getnombre_categoria($s_c_certificacion->idcategoria_certificacion);
		}
		foreach ($row_producto as $producto) {	
			$data['row_unidades'][$producto->idunidad_produccion] = $this->mUnidad_produccion->getUnidadesPorProduccion($row_solicitud->idoperador,$producto->idunidad_produccion); 
		}
		foreach ($row_procesos as $procesos) {
			$data['row_proceso'][$procesos->idproceso] = $this->mProceso->getProceso($procesos->idproceso);
		}

		$data['row_inspeccion_accion_correctiva_previa'] = $this->mInspeccion_accion_correctiva_previa->getAcc_Cor_Prev($idsolicitud);
		$data['row_inspeccion_indicacion'] = $this->mInspeccion_indicacion->getIndicaciones($idsolicitud);
		$data['row_procesos']=$row_procesos;
		$data['row_producto']=$row_producto;
		$data['row_operador'] = $this->mOperadores->getOperador($row_solicitud->idoperador);
		$data['row_solicitud'] = $row_solicitud;
		$data['row_inspeccion'] = $row_inspeccion;
		$data['row_orden_inspeccion'] = $this->mOrden_inspeccion->getOrdenInspeccion($idsolicitud);
		$data['row_firma'] = $this->mFirmas_Inspector->getFirmasOrdenInspeccion($idsolicitud);

		foreach ($row_inspeccion as $inspeccion){
			$data['row_inspector'][$inspeccion->idinspeccion] = $this->mInspector->getInspector($inspeccion->idinspector);
		}
		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/vInspeccion',$data);
		$this->load->view('Inspector/vFooter');
	}
	public function Descargar($idsolicitud){
		$this->mSolicitud->Descargar($idsolicitud);
		$this->load->view('Inspector/vHeader');
		$this->load->view('Inspector/Inspeccion/vR_Descarga');
		$this->load->view('Inspector/vFooter');	
	}
	public function Enviar(){
		$idsolicitud = $this->input->post('idsolicitud');
	 // echo "<br>Inicio de envio de datos";
		$respuesta = $this->mPo_cultivo_respuesta->getRespuesta_idSol($idsolicitud);
		$this->mPo_cultivo_respuesta->EliminarResp_online($idsolicitud);
		foreach ($respuesta as $row_respuesta) {
			$this->mPo_cultivo_respuesta->insert_online($row_respuesta);
		}
	// echo "<br>Plan orgánico enviado";
		$respuesta_inspeccion = $this->mInspeccion_reporte_respuesta->getLocal_idSol($idsolicitud);
		$this->mInspeccion_reporte_respuesta->EliminarResp_online($idsolicitud);
		foreach ($respuesta_inspeccion as $row_resp_ins) {
			$this->mInspeccion_reporte_respuesta->insert_online($row_resp_ins);
		}
	// echo "<br>Reporte de inspección enviado";

	// echo "<br>Envio de datos terminado";
		return true;
	}
	public function autorizacion_orden(){
		$idsolicitud = $this->input->post('idsolicitud');
		$this->mOrden_inspeccion->autorizacion_orden($idsolicitud);
	}
	public function firmar_Inspeccion(){
		//Guardar imagen_Firma de las inspecciones{
		$fileName = $this->input->post('filename');
		$data = $this->input->post('base64data'); 
		$image = explode('base64,',$data); 
		file_put_contents($fileName.'.png', base64_decode($image[1]));
		// }
		$data = $_POST;
		$this->mFirmas_Inspector->firmar_Inspeccion($data);
	}
}