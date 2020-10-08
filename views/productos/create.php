<?php
use Application\Router;
use Application\Session;
?>



<div class="card" style="">
  <div class="card-body">
    <h1 class="card-title"> <i class="fas fa-plus-circle"></i> Agregar Producto</h1>
  <hr>
  <br>
    <form enctype="multipart/form-data" id="formulario_producto" name="form2" method="post" action="<?= ROUTER::create_action_url("productos/create")?>">
        <div class="form-row">
                    <div class="form-group col-md-4">
                    <label ><b>Nombre</b></label>
                    <input type="text" name="nombre" class="form-control"  placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-4">
                    <label ><b>Código</b></label>
                    <input type="text" name="codigo" class="form-control"  placeholder="Código">
                    </div>
                    <div class="form-group col-md-4">
                    <label ><b>Costo</b></label>
                    <input type="text" name="costo" class="form-control" placeholder="Costo">
                    </div>
        </div>
                <br>
        <div class="form-row">
            <div class="form-group col-md-12">
            <label ><b>Descripción</b></label>
                <textarea id="descripcion" name="descripcion">
                   
                </textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
            <label ><b>Foto referencial</b></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name = 'foto_ref'>
                    <label class="custom-file-label" for="customFile">Seleccione un archivo</label>
                </div>
            </div>
        </div>
        <center><button id="submitButton" type="submit" class="btn btn-primary btn-lg btn-block" >Registrar</button></center>
    </form>
  </div>
</div>

<script>
  new FroalaEditor('textarea#descripcion', {
    // Set dark theme name.
    //toolbarInline: false,
    theme: 'dark',
    zIndex: 2003,
    // Set custom buttons.
    toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'insertHR']
      },
      'moreMisc': {
        'buttons': ['undo', 'redo', 'fullscreen', 'spellChecker', 'selectAll', 'html', 'help']
      }
    },

    // Change buttons for XS screen.
    toolbarButtonsXS: [['bold', 'italic', 'underline'], ['undo', 'redo']]
  })
  $('#submitButton').click(function(e){
    var helpHtml = $('textarea#descripcion').froalaEditor('html.get'); // Froala Editor Inhalt auslesen
    $.post( "<?= ROUTER::create_action_url("productos/create")?>", { helpHtml:helpHtml });
});
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<br>
<br>
<br>