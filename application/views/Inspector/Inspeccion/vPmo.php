<iframe name="destino" width="100" height="2" frameborder="0" ></iframe>
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12  col-md-12 main">
        <form method="post" action="<?php  echo base_url('inspector'); ?>">
          <button type="submit" class="btn btn-success">INICIO</button>
        </form>
          <h1 class="page-header">Metrocert Movil</h1>
          <h3 class="col-lg-12">Captura tu reporte de inspección</h3>


<div id="contenido" class="container col-lg-12">
  <div class="row">
      <!--derecha col-lg-8-->
      <table class="table table-condensed table-bordered table-hover">
       
<?php 
foreach ($row_po_cultivo_pregunta as $po_cultivo_pregunta) {
?>

<?php   if($po_cultivo_pregunta->tipo==1){ ?> 

<tr class="success">
<td colspan="2" align="center">
<h4><?php  echo $po_cultivo_pregunta->texto1;?></h4>
</td>	 
</tr>

<?php  } else if($po_cultivo_pregunta->tipo==2){  ?> 

<tr class="info">
<td colspan="1"><?php  echo $po_cultivo_pregunta->texto1;?></td>	 
<td colspan="1">Conformidad</td>   
</tr>
     

<?php  } elseif($po_cultivo_pregunta->tipo==3){  ?> 
<form target="destino" action="<?php echo base_url('Inspector/Pmo/guardar_pregunta_pmo'); ?>" method="post" name="form_GuardarPregunta" id="form_GuardarPregunta">
<tr>
<td colspan="2"> <?php  echo utf8_decode($po_cultivo_pregunta->texto1);?><br />
<strong>Resp</strong>: <?php echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['respuesta']; ?><br />
<strong>Com</strong>: <?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['comentario']; ?>
</td>
</tr>
<tr>
<td>
Implementación:
<input class="form-control"type="text" name="implementacion" value="<?php echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['implementacion']; ?>" onchange="this.form.submit();"/>
</td>
<td>
Conformidad:<br />
<select name="conformidad"  onchange="this.form.submit();">
  <option value="" >Selecciona</option>
  <option value="CUMPLE" <?php  if (!(strcmp("CUMPLE", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>CUMPLE</option>
  <option value="NO CUMPLE" <?php  if (!(strcmp("NO CUMPLE", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>NO CUMPLE</option>
  <option value="NO APLICA" <?php if (!(strcmp("NO APLICA", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>NO APLICA</option>
</select>
</td>
</tr>
<input type="hidden" name="respuesta" value="<?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['respuesta']; ?>" />
<input type="hidden" name="comentario" value="<?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['comentario']; ?>" />
<input type="hidden" name="idsolicitud" value="<?php  echo $idsolicitud ?>" />
<input type="hidden" name="idpregunta" value="<?php  echo $po_cultivo_pregunta->idpo_cultivo_pregunta; ?>" />
<input type="hidden" name="MM_insertb" value="form1b" />
</form>
<?php  } else if($po_cultivo_pregunta->tipo==4){  ?> 
<form target="destino" action="<?php echo base_url('Inspector/Pmo/guardar_pregunta_pmo'); ?>" method="post" name="form_GuardarPregunta" id="form_GuardarPregunta">
<tr>     
<td colspan="2" align="left">
<b><?php  echo utf8_decode($po_cultivo_pregunta->texto1);?></b>
</td>	 
</tr>
	
<?php   }else if($po_cultivo_pregunta->tipo==6){?>
<form target="destino" action="<?php echo base_url('Inspector/Pmo/guardar_pregunta_pmo'); ?>" method="post" name="form_GuardarPregunta" id="form_GuardarPregunta">
<tr>
<td colspan="1"> <?php echo utf8_decode($po_cultivo_pregunta->texto1);?><br />
Resp:123
<?php
$row_po_cultivo_subpregunta;
$var7 = utf8_decode($row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['respuesta']); 

foreach ($row_po_cultivo_subpregunta[$po_cultivo_pregunta->idpo_cultivo_pregunta] as $cultivo_subpregunta) {
$var8 = utf8_decode($cultivo_subpregunta->texto1);

if($var7==$var8){
?>
<?php echo utf8_decode($cultivo_subpregunta->texto1);
}
}
?>

<br />
Com: <?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['comentario']; ?>
</td>  
</tr>
<tr>
<td>
Implementación:
<input class="form-control"type="text" name="implementacion" value="<?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['implementacion']; ?>" onchange="this.form.submit();"/>
</td>
<td>
Conformidad:<br />
<select name="conformidad" onchange="this.form.submit();">
  <option value="" >Selecciona</option>
  <option value="CUMPLE" <?php  if (!(strcmp("CUMPLE", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>CUMPLE</option>
  <option value="NO CUMPLE" <?php  if (!(strcmp("NO CUMPLE", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>NO CUMPLE</option>
  <option value="NO APLICA" <?php  if (!(strcmp("NO APLICA", $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['conformidad']))) {echo "selected=\"selected\"";} ?>>NO APLICA</option>
</select>
</td>
</tr>
<input type="hidden" name="respuesta" value="<?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['respuesta']; ?>" />
<input type="hidden" name="comentario" value="<?php  echo $row_resp[$po_cultivo_pregunta->idpo_cultivo_pregunta]['comentario']; ?>" />
<input type="hidden" name="idsolicitud" value="<?php  echo $idsolicitud?>" />
<input type="hidden" name="idpregunta" value="<?php  echo $po_cultivo_pregunta->idpo_cultivo_pregunta; ?>" />
<input type="hidden" name="MM_insertb" value="form1b" />
</form>
         
<?php } 
} ?>  
<tr><td colspan="3">
  <div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">FIRMAR SOLICITUD - INSPECTOR</h3>
    </div>
    <div class="panel-body">
    <table class="table lead">
    <form id="form_firma_img" action="<?php echo base_url('Inspector/Inspecciones/firmar_Inspeccion') ?>" method="post" enctype="multipart/form-data">
    <tr>
      
      <td>
        <input <?php  if($row_firma!==null){ ?> disabled="disabled" <?php } ?> placeholder="Escriba el nombre de la persona que envía la solicitud" class="form-control" type="text" id="firma_nombre" name="firma_nombre" value="<?php  echo $_SESSION['MM_Username'];?>" />
      </td>
      <td>
        <input disabled="disabled" class="form-control" type="text" id="firma_fecha" name="firma_fecha" value="<?php   if($row_firma!==null){echo date("Y-m-d",$row_firma->fecha_firma);}  ?>" /> 
      </td>
      <td>
        <input type="hidden" name="idsolicitud" id="idsolicitud" value="<?php   echo $idsolicitud; ?>" />
        <input type="hidden" name="section_post" value="update" />
        <input type="hidden" name="firmar_solicitud" value="1" />
        <input type="hidden" name="id_inspector" id="id_inspector" value="<?php echo $_SESSION['idinspector']; ?>">
<!--         <input class="form-control btn btn-success" type="submit" <?php  if(strlen($row_solicitud->firma_nombre)>0){?> disabled="disabled" <?php  }?> value="Firmar" />
 -->      </td>
    </tr>
    <tr>
      <td colspan="3"> 
        <?php if ($row_firma!==null){?>
          <img class="img-responsive" src="<?php echo base_url($row_firma->url_firma);?>.png" alt="imagen-firma">
        <?php }?>
        <!-- canvas -->
      <div id="page-content-wrapper" style="padding: 0px; margin: 0px" class="<?php if($row_firma!==null){ echo 'hidden'; } ?>">
        <div id="page-content">
          <div id="signature-pad" class="signature-pad">
            <div class="signature-pad--body col-md-10">
              <canvas id="canvas" class="col-md-12" height="300px" style="border:solid #d9edf7 1px"></canvas>
            </div>
            <div class="signature-pad--footer col-md-2">
              <div class="description"></div>
              <div class="signature-pad--actions">
                <div class="col-md-12">
                  <button id="btn_limpiar" type="button" class=" clear btn-sm btn-info col-md-12" data-action="clear">Limpiar</button>
                  <button type="hidden" class="hidden disabled btn-sm btn-outline-info col-md-12" data-action="change-color">Cambiar color</button>
                  <button type="button" class="hidden btn-sm btn-info col-md-12" data-action="undo">Deshacer</button>
                </div>
                <div class="col-md-12">
                  <button id="btn_form_firma" <?php if($row_firma) {?> disabled="disabled" <?php  } ?> type="button" class="btn-sm btn-success col-md-12" data-action="save-png">Firmar</button>
                  <button type="button" class=" hidden btn-sm btn-outline-success col-md-4" data-action="save-jpg" >Guardar como JPG</button>
                  <button type="button" class="hidden btn-sm btn-outline-success col-md-4" data-action="save-svg" >Guardar como SVG</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- fin canvas-->
      </td> 
    </tr>
  </form>
</table>
    </div>
    </div>
</td></tr>


</table>
</div>

</div>
		</div>
	</div>
</div>
<script type="text/javascript"> var base_url = "<?php echo base_url(); ?>";</script>
<script type="text/javascript"> var segment2 = "<?php echo $this->uri->segment(2);?>";</script>
<script src="<?php echo base_url('assets/js/signature_pad.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
