<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="initComponents()">
    
  <?php
    require_once 'components/header.php' 
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
        require_once 'components/sidebarMenu.php'
      ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 class="h2">Reportes de Gastos y Entradas</h1>  
        </div>
            <div class="d-flex flex-row g-3 align-items-center border-top" style="padding-top:10px">
              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="filtro" value="1" id="checkCorte">
              </div>
              <div class="mb-3 col-md-3 d-flex flex-row">
                <label for="txtFolio" class="col-form-label col-md-4">Folio Corte:</label>
                <input type="text" id="txtFolio" class="form-control">
              </div>
              <div class="mb-3 form-check" style="margin-left:10px;">
                <input class="form-check-input" type="checkbox" name="filtro" value="2" id="checkTipoPago">
              </div>
              <div class="mb-3 col-md-3 d-flex flex-row" >
                <label class="col-form-label col-md-4">Tipo de Gasto:</label>
                <select class="form-select" id="selectTipoGasto">
                  <option selected value = 0 id="tipoGasto2">Gasto</option>
                  <option value=1 id="tipoEntrada2">Entrada</option>
                  <option value=2 id="tipoOtros2">Otros</option>
                </select>
              </div>
            </div>
            <div class="d-flex flex-row g-3 align-items-center border-bottom">
              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="filtro" value="3" id="checkFecha">
              </div>
              <div class="mb-3 col-md-3 d-flex flex-row">
                <label for="fechaInicio" class="col-form-label col-md-4">Fecha Inicio:</label>
                <input type="date" id="fechaInicio" class="form-control">
              </div>
              <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
                <label for="fechaFin" class="col-form-label col-md-4">Fecha fin:</label>
                <input type="date" id="fechaFin" class="form-control">
              </div>
              <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
                <button id="btnGenerar" class="btn btn-primary" onclick="generarReporte()">Generar</button>
                <button id="btnExportar" class="btn btn-success" onclick="ExportToExcel('xlsx')" style="margin-left:10px;">Exportar a Excel</button>
              </div>
            </div>       
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div id="divTabla">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Gasto/Entrada</th>
                              <th scope="col">Tipo</th>
                              <th scope="col">Fecha alta</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>    
                        </tbody>
                    </table>              
                </div>
            </div>  
      </main>
    </div>
  </div>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sieslite</h5>
                <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <h4><span id="tituloModal"></span></h4>
              <div class="d-flex flex-column">
                <label for="titulo" class="col-form-label col-md-4">Nombre :</label>
                <input type="text" id="titulo" class="form-control">      
                <label for="descripcion" class="col-form-label col-md-4">Descripcion :</label>
                <textarea  type="text" id="descripcion" class="form-control" rows=6></textarea>
                <label for="costo" class="col-form-label col-md-4"  min="0" oninput="validity.valid||(value='');">Costo total:</label>
                <input type="number" id="costo" class="form-control">      
                <label for="selectTipo" class="col-form-label col-md-4">Tipo :</label>
                <select class="form-select" id="selectTipo">
                  <option selected value = 0 id="tipoGasto">Gasto</option>
                  <option value=1 id="tipoEntrada">Entrada</option>
                  <option value=2 id="tipoEntrada">Otros</option>
                </select>        
                <label for="fecha" class="col-form-label col-md-4">Fecha:</label>
                <input type="date" id="fecha" class="form-control" value="<?php date('Y-m-d') ?>"> 
                <label for="titulo" class="col-form-label col-md-4">Folio Corte :</label>
                <input type="text" id="folioCorte" class="form-control">      
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" onclick="guardarDatos()">Guardar</button>
            </div>
        </div>
    </div>
  </div>
  <?php
    require_once 'components/logoutModal.php' 
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/xlsx.full.min.js"></script>
    <script type="text/javascript">
        let datos = [];
        let datoBuscar = "" ; 
        let datoSeleccionado = null  ;
        let indexDato = null ;
        let datoSrc = "" ;
        let tipoEntrada = 0 ; 


        async function initComponents(){
          await cargarDatos();
          await renderTabla();
        }

        async function buscarTeclado(){
          datoSrc = document.getElementById("srcDato").value ; 
          initComponents();
        }

        async function cargarDatos(){
          const response = await fetch('http://localhost/sieslite/api/gastos.php?opc=1', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({"idGastoEntrada" : null,"buscar" :datoSrc  })
          });
          const json = await response.json();
          datos = json.data ; 
        }
        async function renderTabla(){
          console.log('Calling renderTabla');
          
            let tableSalida  = `<table id="tbl_exporttable_to_xls" class="table">
                    <thead>
                        <tr>
                        <th scope="col">Gasto/Entrada</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Costo Total</th>
                        <th scope="col">Fecha Alta</th>
                        <th scope="col">Folio Corte</th>
                        <th scope="col"></th>
                        
                        </tr>
                    </thead><tbody>`;
            datos.map((dato , index)=> {
                let tipo = dato.tipo == 0 ? "Gasto" : dato.tipo == 1 ? "Entrada" : "Otros"  ; 
                tableSalida += `<tr>
                    <th scope="row">${dato.titulo}</th>
                    <th>${tipo}</th>
                    <th>${dato.montoTotal}</th>
                    <th>${dato.fechaCreacion}</th>
                    <th>${dato.idCorte}</th>
                    <th><button class="btn btn-primary" onClick="editarCrear(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="remover(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button></th>  
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }

        function editarCrear(indice){
          let dnd = document.querySelector('#selectTipo');
          let fec = document.querySelector('#fecha');
          if(indice == null){
            datoSeleccionado = null ;
            document.getElementById("tituloModal").textContent = 'Nuev@ Entrada/Gasto';
            document.getElementById("titulo").value = '' ; 
            document.getElementById("descripcion").value = '' ; 
            document.getElementById("costo").value = 0 ; 
            document.getElementById("folioCorte").value = 0 ; 
            dnd.value = 0 ; 
            fec.value = new Date().toISOString().split('T')[0]; 
          }else{
            document.getElementById("tituloModal").textContent = 'Editar Registro';
            datoSeleccionado = obtenerDatoArrayIndice(indice);
            dnd.value = datoSeleccionado.tipo; 
            document.getElementById("titulo").value = datoSeleccionado.titulo ; 
            document.getElementById("descripcion").value = datoSeleccionado.descripcion ; 
            document.getElementById("costo").value = datoSeleccionado.montoTotal ; 
            document.getElementById("folioCorte").value = datoSeleccionado.idCorte ; 
            fec.value = datoSeleccionado.fechaCreacion ; 
          }
          let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
          modal.show();
           //modal.hide();
        }

        async function guardarDatos(){
          let dnd = document.querySelector('#selectTipo').value ;
          let titulo = document.getElementById("titulo").value ;
          let descripcion = document.getElementById("descripcion").value ;
          let montoTotal =document.getElementById("costo").value ; 
          let idCorte = document.getElementById("folioCorte").value ;
          let fec = document.querySelector('#fecha').value;
          if(titulo === "" || descripcion === "" ){
            Swal.fire('Faltan datos por llenar... verifique el formulario¡', '', 'info');
            return ; 
          }
          let datoJson = {
            "idGastoEntrada"  :datoSeleccionado == null ? 0 : datoSeleccionado.idGastoEntrada,
            "tipo" : dnd,
            "titulo"  : titulo,
            "descripcion" : descripcion , 
            "fechaCreacion": fec,
            "idUsuarioCreo" : <?php echo $_SESSION['idUsuario'] ?> ,
            "montoTotal" : montoTotal,
            "status" : 1 ,
            "idCorte" :idCorte
          }
          const opcionApi = datoSeleccionado == null ? 2 : 3 ;  
          console.log('opcion del api a mandar a llamar' + opcionApi); 
          console.log(datoJson);
          let respuestaDialog = await Swal.fire({
            title: 'Datos Correctos?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
          }) ; 
          if(respuestaDialog.isConfirmed){
            const response = await fetch('http://localhost/sieslite/api/gastos.php?opc='+opcionApi, {
            method: 'POST',
            headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(datoJson)
            });
            console.log(response)
            const json = await response.json();
           

            if(json.msg.toLowerCase().includes("duplicate")){
              Swal.fire('Error, ya existe un usuario con ese nombre dado de alta,  intente con otro¡', '', 'info');
            }
            else{
              Swal.fire(json.msg, '', 'success');
              datoSeleccionado = null ;
              let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
              modal.hide();
              await initComponents();
            }
          }
        }

      async function remover(indice){
        datoBorrar =obtenerDatoArrayIndice(indice);
        console.log(datoBorrar);
        let respuestaDialog = await Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
            denyButton: 'btn btn-danger'
          },
          buttonsStyling: false
        }).fire({
          title: 'Dese eliminar el registro seleccionado?',
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Aceptar',
          denyButtonText: `Cancelar`,
          cancelButtonText : 'Cancelar'
        }) ; 
        
        if(respuestaDialog.isConfirmed){
          let datoJson = {
          "idGastoEntrada": datoBorrar.idGastoEntrada,
          "idCorte" :datoBorrar.idCorte 
          }
          const response = await fetch('http://localhost/sieslite/api/gastos.php?opc=4', {
          method: 'POST',
          headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datoJson)
          });
          const json = await response.json();
          console.log(json);
          

          if(json.msg.toLowerCase().includes("error")){
            Swal.fire('Ocurrio el siguiente error ' + json.msg, '', 'danger');
          }
          else{
            Swal.fire(json.msg, '', 'success');
            await initComponents();
          }
        }
      }

      function obtenerDatoArrayIndice(indice){
          return datos.filter((user , index) => indice == index)[0];
      }

      async function generarReporte(){
        let fechaInicio = document.getElementById('fechaInicio').value ; 
        let fechaFin = document.getElementById('fechaFin').value ; 
        let folioCorte = document.getElementById('txtFolio').value ; 
        let checkboxes = document.querySelectorAll('input[name="filtro"]:checked');
        let dnd = document.querySelector('#selectTipoGasto').value ;

        let output= [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
       
        //alert(fechaInicio + " v "+ fechaFin)
        let objJson = { opciones : output , fechaInicio : ""  , fechaFin : "" , idCorte : "" , tipoGasto : ""} ;
        console.log(output);
        if(output.includes('1')){
          objJson.idCorte = folioCorte.toString() ; 
        }
        if(output.includes('2')){
          objJson.tipoGasto = dnd ; 
        }
        if(output.includes('3')){
          objJson.fechaInicio =fechaInicio ;
          objJson.fechaFin  = fechaFin ; 
        }
        console.log(folioCorte + " " + dnd)
        console.log(objJson); 
        const response = await fetch('http://localhost/sieslite/api/gastos.php?opc=5', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(objJson)
        });
        const json = await response.json();
        console.log('reporte generado');
        console.log(json);
        datos = json.data ; 
        await renderTabla();
        await Swal.fire(
          'Reporte Generado ',
          '',
          'success'
        )
      }

      function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_exporttable_to_xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "reporte" });
        return dl ?
          XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
          XLSX.writeFile(wb, fn || ('Reporte de Gastos y Entradas.' + (type || 'xlsx')));
      }

      

    </script>
  </body>
</html>
