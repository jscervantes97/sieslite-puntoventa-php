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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Generar Codigos de Barras/QR</h1><br>  
        </div>
        <div class="d-flex flex-row g-3 align-items-center border-bottom">
            <div class="mb-3 col-md-2">
                <label for="codigoArticulo" class="col-form-label h1">Buscar articulos:</label>
            </div>
            <div class="input-group mb-3 ">
                <input type="text" id="srcBuscarArticulo" onkeyup="buscarTeclado()" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div id="divTabla" style="width : 100%">
                
            </div>
        </div>  
        <div class="pt-3 pb-2 mb-3 border-bottom" style="display : flex ; flex-direction : column ; ">
            <div id="divButtonImprimir" style="display : flex; flex-direction: row;  align-items : flex-end ; justify-content : flex-end; width:100%">
              <button id="btnImprimir" style="display : none" class="btn btn-danger" onclick="descargarArchivo()">Descargar<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 15V18C20 19.1046 19.1046 20 18 20H6C4.89543 20 4 19.1046 4 18L4 15M8 11L12 15M12 15L16 11M12 15V3" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
            </div>
            <div id="divCodigos" style="display : flex; flex-direction: column;  align-items : center ; justify-content : center; width:100%">
                
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
                <label for="codigoBarras" class="col-form-label col-md-4">Codigo de Articulo/Barras :</label>
                <input type="text" id="codigoBarras" class="form-control">      
                <label for="nombreArticulo" class="col-form-label col-md-4">Nombre Articulo :</label>
                <input type="text" id="nombreArticulo" class="form-control">      
                <label for="precio" class="col-form-label col-md-4"  min="0" oninput="validity.valid||(value='');">Precio:</label>
                <input type="number" id="precio" class="form-control">      
                <label for="existencia" class="col-form-label col-md-4"  min="0" oninput="validity.valid||(value='');">Existencia :</label>
                <input type="number" id="existencia" class="form-control">             
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
    <script src="js/JsBarcode.all.min.js"></script>
    <script src="js/qrcode.min.js"></script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
        let articulos = [];
        let articuloSeleccionado = null ;
        let tipoPago = 0 ; 
        let srcArticulo = "" ; 
        
        function generarCodigo(){
          //divCodigos
          let output = document.getElementById("divCodigos");
          let par  =document.createElement("div")
          par.innerHTML = "Codigos Generados"; 
          //output.insertBefore(par, null);
          articulos.map((articulo, index) => {
            let div = document.createElement("div");
            let salida = `<br><p>${articulo.nombre} Precio: $${articulo.precio}</p><div id="contenedorQR${index}"></div><br>
                          <svg id="barcode${index}"></svg>
                          <br>` ; 
            div.innerHTML = salida ;
            output.insertBefore(div, null);
            const contenedorQR = document.getElementById(`contenedorQR${index}`);
            JsBarcode("#barcode"+index, articulo.codigo);
            const QR = new QRCode(contenedorQR);
            //QR.makeCode(`${articulo.nombre} Precio: $${articulo.precio}`);
            QR.makeCode(`https://www.youtube.com/watch?v=ZHdqwgsjY68`);

          });
          document.getElementById("btnImprimir").style.display = "block";
        }

        function descargarArchivo(){
          //let htmlElement = document.getElementById('divCodigos');

          //html2pdf().from(htmlElement).save('CodigosGenerados.pdf');
          let ficha = document.getElementById('divCodigos');
          let ventimp = window.open(' ', 'popimpr' , 'width=1000,height=1000');
          ventimp.document.write( ficha.innerHTML );
          ventimp.document.close();
          ventimp.print( );
          ventimp.close();
          
        }

        async function initComponents(){
          await cargaArticulos();
          await renderTabla();
        }

        async function buscarTeclado(){
          srcArticulo = document.getElementById("srcBuscarArticulo").value ; 
          initComponents();
        }

        async function cargaArticulos(){
          console.log("srcArticulo " ,srcArticulo);
          const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=5', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({"codigo": srcArticulo , "nombre" : srcArticulo})
          });
          const json = await response.json();
          articulos = json.data ; 
          console.log(json)
        }

        function renderTabla(){
            let tableSalida  = `<table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Precio</th>
                        <th scope="col" colspan=2><button class="btn btn-primary" onclick="generarCodigo()">Generar Codigos</button></th>
                      </tr>
                    </thead><tbody>`;
            articulos.map((articulo , index)=> {
                tableSalida += `<tr>
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombre}</th>
                    <th>${articulo.precio}</th>
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            if(articulos.length == 0){
              tableSalida += `<h3><center>Sin Registros</center></h3>`;  
            }

            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }

        function editarCrearArticulo(indice){
          console.log(articuloSeleccionado);
          if(indice == null){
            articuloSeleccionado = null ;
            document.getElementById("tituloModal").textContent = 'Nuevo Articulo';
            document.getElementById("nombreArticulo").value = '' ; 
            document.getElementById("codigoBarras").value = '' ; 
            document.getElementById("precio").value = '' ; 
            document.getElementById("existencia").value = '' ; 
          }else{
            document.getElementById("tituloModal").textContent = 'Editar Articulo';
            articuloSeleccionado = obtenerArticuloArrayIndice(indice);
            console.log(articuloSeleccionado);
            document.getElementById("nombreArticulo").value = articuloSeleccionado.nombre ; 
            document.getElementById("codigoBarras").value = articuloSeleccionado.codigo ; 
            document.getElementById("precio").value = articuloSeleccionado.precio ; 
            document.getElementById("existencia").value = articuloSeleccionado.existencia ; 
          }
          let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
          modal.show();
           //modal.hide();
        }

        async function guardarDatos(){
          let nombre = document.getElementById("nombreArticulo").value ; 
          let codigo = document.getElementById("codigoBarras").value ; 
          let precio = document.getElementById("precio").value  ; 
          let existencia = document.getElementById("existencia").value ; 
          if(nombre === "" ||codigo === "" ||precio === "" ||existencia === ""){
            Swal.fire('Faltan datos por llenar... verifique el formulario¡', '', 'info');
            return ; 
          }
          if(precio < 0 || existencia < 0){
            Swal.fire('El precio y la existencia deben de ser solo valores positivos   ', '', 'info');
            return ;
          }
          let articuloJson = {
            "idArticulo": articuloSeleccionado == null ? 0 : articuloSeleccionado.idArticulo,
            "codigo" :codigo,
            "nombre": nombre,
            "precio": precio,
            "existencia": existencia,
            "status": 1
          }
          const opcionApi = articuloSeleccionado == null ? 2 : 3 ;  
          console.log('opcion del api a mandar a llamar' + opcionApi)
          let respuestaDialog = await Swal.fire({
            title: 'Datos Correctos?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
          }) ; 
          if(respuestaDialog.isConfirmed){
            const response = await fetch('http://localhost/sieslite/api/articulos.php?opc='+opcionApi, {
            method: 'POST',
            headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(articuloJson)
            });
            const json = await response.json();
           

            if(json.msg.toLowerCase().includes("duplicate")){
              Swal.fire('Error, ya existe un articulo con ese codigo de barras dado de alta,  intente con otro¡', '', 'info');
            }
            else{
              Swal.fire(json.msg, '', 'success');
              usuarioSeleccionado = null ;
              let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
              modal.hide();
              await initComponents();
            }
          }
        }

        async function removerArticulo(indice){
          articuloBorrar =obtenerArticuloArrayIndice(indice);
          let respuestaDialog = await Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger',
              denyButton: 'btn btn-danger'
            },
            buttonsStyling: false
          }).fire({
            title: 'Dese eliminar el articulo seleccionado?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
            cancelButtonText : 'Cancelar'
          }) ; 
          if(respuestaDialog.isConfirmed){
            let usuarioJson = {
            "idArticulo": articuloBorrar.idArticulo,
            }
            const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=4', {
              method: 'POST',
              headers: {
                    'Content-Type': 'application/json'
                },
              body: JSON.stringify({"idArticulo" : articuloBorrar.idArticulo})
            });
            const json = await response.json();
            

            if(json.msg.toLowerCase().includes("error")){
              Swal.fire('Ocurrio el siguiente error ' + json.msg, '', 'danger');
            }
            else{
              Swal.fire(json.msg, '', 'success');
              await initComponents();
            }
          }
        }

        function cambiarTipoPago(){
            tipoPago = tipoPago == 0 ? 1 : 0 ; 
            console.log(tipoPago)
        }

        function obtenerArticuloArrayIndice(indice){
           return articulos.filter((user , index) => indice == index)[0];
        }

    </script>
  </body>
</html>
