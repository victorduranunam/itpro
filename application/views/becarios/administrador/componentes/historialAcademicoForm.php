<form 
  class="form-horizontal form-label-left"
  action="<?= base_url() ?>alumnos/<?= $id_alumno ?>/<?= $type ?>"
  id="actualizar-solicitud-alumno"
  method="post"
  enctype ="multipart/form-data"
  novalidate
>
    <div class="modal-header">
        <h5 class="modal-title"><?= $title ?></h5>
    </div>
    <div class="modal-body"> 
        <div class="row">
            <div class="field item form-group col-md-12">
                <label 
                  class="col-form-label col-md-3 col-sm-3  label-align"
                  for="semestre"
                >
                    Semestre en que se obtuvo
                </label>
                <div class="col-md-9 col-sm-9">
                    <input
                      class="form-control"
                      id="semestre"
                      name="semestre"
                      maxlength="6"
                      minlength="6"
                      data-inputmask="'mask': '9999-9'"
                      required
                    />
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="field item form-group col-md-12">
                <label 
                  class="col-form-label col-md-3 col-sm-3  label-align"
                  for="archivo"
                >
                    Archivo en formato PDF
                </label>
                <div class="col-md-9 col-sm-9">
                    <input
                      class="form-control"
                      id="archivo"
                      name="archivo"
                      type="file"
                      accept=".pdf"
                      autofocus="1"
                      required
                    />
                </div>
            </div>
        </div>                  
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Agregar</button>
        <button class="btn btn-primary" type="reset">Reiniciar</button>
    </div>
</form>