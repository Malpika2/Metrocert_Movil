<!-- //SIn uso//SIn uso//SIn uso//SIn uso//SIn uso//SIn uso//SIn uso -->
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12  col-md-12 main">
        <form method="post" action="<?php echo base_url('inspector'); ?>">
          <button type="submit" class="btn btn-success">INICIO</button>
        </form>
          <h1 class="page-header">Metrocert Movil</h1>
        <form method="post" action="<?php echo base_url('inspector'); ?>">
          <input type="hidden" name="online" id="online" value="1">
          <button type="submit" class="btn btn-primary">INSPECCIONES ASIGNADAS</button>
        </form>
        <br>
        <table class="table table-bordered table-striped table-hover table-condensed" >
          <thead>
            <tr>
              <thead>
                <th colspan="6">Inspecciónes descargadas</th>
              </thead>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
</div>
