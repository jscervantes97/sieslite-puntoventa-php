<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="cargarDatosInicialesPedido()">
    
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
          <div id="divButtonImprimir" style="display : flex; flex-direction: row;  align-items : flex-end ; justify-content : flex-end; width:100%">
            <h1 class="h2">Abonos del Pedido con folio : <?php echo $_GET['idPedido'] ?></h1>
          </div>
          <div id="divButtonImprimir" style="display : flex; flex-direction: row;  align-items : flex-end ; justify-content : flex-end; width:100%">
            <a href="/sieslite/pedidos.php" id="btnImprimir" class="btn btn-danger" >Regresar<svg width="24px" height="24px" viewBox="0 0 32 32" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs2"></defs> <g id="layer1" transform="translate(-348,-244)"> <path d="m 357,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5331" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 371,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5333" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 372,246.00586 c -3.30186,0 -6,2.69814 -6,6 0,3.30186 2.69814,6 6,6 3.30186,0 6,-2.69814 6,-6 0,-3.30186 -2.69814,-6 -6,-6 z m 0,2 c 2.22098,0 4,1.77902 4,4 0,2.22098 -1.77902,4 -4,4 -2.22098,0 -4,-1.77902 -4,-4 0,-2.22098 1.77902,-4 4,-4 z" id="circle5337" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 370.58594,249.5918 a 1,1 0 0 0 -0.70703,0.29297 1,1 0 0 0 0,1.41406 l 0.70703,0.70703 -0.70703,0.70703 a 1,1 0 0 0 0,1.41406 1,1 0 0 0 1.41406,0 L 372,253.41992 l 0.70703,0.70703 a 1,1 0 0 0 1.41406,0 1,1 0 0 0 0,-1.41406 l -0.70703,-0.70703 0.70703,-0.70703 a 1,1 0 0 0 0,-1.41406 1,1 0 0 0 -0.70703,-0.29297 1,1 0 0 0 -0.70703,0.29297 L 372,250.5918 l -0.70703,-0.70703 a 1,1 0 0 0 -0.70703,-0.29297 z" id="path5339" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 351.01758,246.00586 a 1,1 0 0 0 -1,1 1,1 0 0 0 1,1 h 1.17969 l 2.65039,13.24219 c -1.07078,0.46018 -1.83008,1.52737 -1.83008,2.75781 0,1.6447 1.3553,3 3,3 h 17 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -17 c -0.5713,0 -1,-0.4287 -1,-1 0,-0.5713 0.4287,-1 1,-1 h 15 a 1,1 0 0 0 0.0293,-0.006 h 2.9707 a 1.0001,1.0001 0 0 0 0.98828,-0.84375 l 0.93945,-5.96875 a 1,1 0 0 0 -0.83203,-1.14453 1,1 0 0 0 -1.14453,0.83398 L 373.16211,261 h -16.32422 l -1.80078,-8.99414 h 12.08399 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -12.48438 l -0.63867,-3.19531 a 1.0001,1.0001 0 0 0 -0.98047,-0.80469 z" id="path21235" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> </g> </g></svg></a>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 border-bottom">
            <div style="display : flex ; flex-direction : column" class="border-bottom" >
              <h2>Datos del pedido</h2>
              <div class="row g-3 align-items-center ">
                  <div class="col mb-3">
                      <label for="nombreCliente" class="col-form-label">Nombre Cliente: </label>
                  </div>
                  <div class="col-md-3  mb-3">
                      <input type="text" id="nombreCliente" class="form-control" readonly>
                  </div>
                  <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
                    <label for="fechaCreacionPedido" class="col-form-label col-md-4">Fecha Creacion:</label>
                    <input type="date" id="fechaCreacionPedido" class="form-control" readonly>
                  </div>
                  <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
                    <label for="fechaVencimiento" class="col-form-label col-md-4">Fecha Vencimiento:</label>
                    <input type="date" id="fechaVencimiento" class="form-control" readonly>
                  </div>
              </div>
              <div class="row g-3 align-items-center ">
                <div class="col-md-2 mb-3">
                    <label for="totalPedido" class="col-form-label">Total Pedido: </label>
                </div>
                <div class="col-md-2  mb-3">
                    <input type="text" id="totalPedido" class="form-control" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="montoAbonado" class="col-form-label">Total Abonado: </label>
                </div>
                <div class="col-md-2  mb-3">
                    <input type="text" id="montoAbonado" class="form-control" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="montoRestante" class="col-form-label">Restante: </label>
                </div>
                <div class="col-md-2  mb-3">
                    <input type="text" id="montoRestante" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div id="divTabla">
              <h3>Abonos Realizados</h3>
              <table class="table">
                  <thead>
                      <tr>
                      <th scope="col">Folio Abono</th>
                      <th scope="col">Fecha Abono</th>
                      <th scope="col">Monto Abono</th>
                      <th scope="col">Forma Pago</th>
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
                <label for="monto" class="col-form-label col-md-4"  min="0" oninput="validity.valid||(value='');">Monto Abono :</label>
                <input type="number" id="monto" class="form-control"> 
                <label for="slcFormaPago" class="col-form-label col-md-4">Forma de Pago :</label>
                <select id="slcFormaPago" class="form-select">
                  <option value = 0>Efectivo</option>
                  <option value = 1>Electronico/Transferencia</option>
                </select>     
                <label for="fechaAbono" class="col-form-label col-md-4">Fecha de Abono :</label>
                <input type="date" id="fechaAbono" class="form-control">    
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
    require_once 'components/logoutModal.php' ;
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
    const dt = new DataTransfer(); 
    let indiceEditar = -1 ; 
    let idPedido = <?php echo $_GET['idPedido']; ?> ;
    let idCorte = 0 ; 
    let abonos = [] ; 
    let abonoSeleccionado = null ;
    let idCorteActual = null ;

    async function cargarDatosInicialesPedido(){
      console.log("calling cargarDatosInicialesPedido");
     
      const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=6', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                "idPedido" : idPedido,
                "nombreCliente" : "",
                "fechaPedido" : ""
              })
          });
      const json = await response.json();
      console.log(json)
      idCorte = json.data.idCorte; 

      document.getElementById("nombreCliente").value = json.data.nombreCliente;
      
      document.getElementById("fechaCreacionPedido").value = json.data.fechaCreacionPedido; //fechaVencimiento
      document.getElementById("fechaVencimiento").value = json.data.fechaVencimiento;
      document.getElementById("totalPedido").value = json.data.totalPedido;
      document.getElementById("montoAbonado").value = json.data.abonado;
      document.getElementById("montoRestante").value = json.data.montoRestante;
      //document.getElementById("folioCorte").value = idCorte ;
      idCorte = json.data.idCorte ;
      abonos = json.data.abonos ;
      await renderTabla();
      const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          }
      });
      const json1 = await responseCorte.json();
      console.log(json1) ;
      if(json1.data == null){
        //document.getElementById("spanFolio").textContent = 'Favor de generar un corte en curso para poder vender';
        console.log("no hay ningun corte en curso, se tendria que generar uno para poder abonar")
        return ;
      }
      idCorteActual = json1.data.idCorte ;
          
    }

    async function cargarIdCorteActual(){

    }

    
    window.onload = async function() {
      await cargarDatosInicialesPedido();
    }

    
    



    

    

    async function abrirModalArticulos(){
        abrirCerrarModal(0);
    }

    

function renderTabla(){
    console.log("Rendering table")
    console.log(abonos);
    let totalArticulosR = 0.0 ;
    let totalVentaR = 0 ; 
    let tableSalida  = `<h2>Abonos Realizados:</h2><table class="table" id="tablaVenta">
            <thead>
                <tr>
                <th scope="col">Numero de Abono</th>
                <th scope="col">Folio Abono</th>
                <th scope="col">Fecha Abono</th>
                <th scope="col">Monto Abono</th>
                <th scope="col">Forma Pago</th>
                <th scope="col">Editar</th>
                <th scope="col">Cancelar</th>
                <th scope="col"><button class="btn btn-primary" onClick="modificarAbono(null)"><svg height="24px" width="24px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M198.745,439.889c-5.698-3.854-12.636-6.128-20.013-6.119c-4.921,0-9.659,1-13.943,2.82 c-6.434,2.721-11.875,7.244-15.737,12.958c-3.862,5.698-6.128,12.636-6.112,20.012c-0.008,4.912,0.993,9.651,2.812,13.934 c2.728,6.443,7.244,11.884,12.95,15.737c5.706,3.871,12.652,6.128,20.029,6.128c4.912,0,9.643-1.001,13.926-2.82 c6.442-2.721,11.883-7.253,15.746-12.958c3.854-5.698,6.12-12.645,6.12-20.022c0-4.911-1.009-9.642-2.82-13.934 C208.975,449.184,204.451,443.743,198.745,439.889z M192.03,475.176c-1.092,2.58-2.936,4.805-5.243,6.359 c-2.316,1.555-5.028,2.456-8.055,2.464c-2.026-0.008-3.903-0.405-5.615-1.142c-2.572-1.074-4.805-2.927-6.36-5.226 c-1.555-2.324-2.456-5.044-2.464-8.072c0.009-2.018,0.413-3.887,1.133-5.615c1.083-2.572,2.936-4.796,5.242-6.358 c2.316-1.555,5.037-2.448,8.064-2.457c2.018,0,3.887,0.406,5.607,1.133c2.58,1.083,4.796,2.927,6.351,5.243 c1.563,2.315,2.464,5.028,2.464,8.054C193.154,471.587,192.75,473.456,192.03,475.176z"></path> <path class="st0" d="M216.525,283.808c7.278-2.117,11.462-9.75,9.328-17.036l-35.576-121.796 c-2.117-7.286-9.742-11.462-17.028-9.337c-7.285,2.126-11.453,9.75-9.336,17.028l35.576,121.812 C201.622,281.757,209.247,285.941,216.525,283.808z"></path> <path class="st0" d="M256.98,265.416c2.134,7.286,9.759,11.462,17.035,9.336c7.278-2.125,11.463-9.749,9.329-17.035 l-32.996-112.972c-2.117-7.285-9.742-11.462-17.027-9.344c-7.286,2.133-11.462,9.758-9.337,17.035L256.98,265.416z"></path> <path class="st0" d="M314.554,256.625c2.125,7.286,9.758,11.462,17.035,9.337c7.278-2.126,11.462-9.759,9.328-17.036 l-30.49-104.412c-2.126-7.286-9.75-11.462-17.028-9.328c-7.285,2.117-11.462,9.75-9.336,17.027L314.554,256.625z"></path> <path class="st0" d="M371.945,247.248c2.134,7.286,9.758,11.462,17.035,9.336c7.278-2.133,11.462-9.749,9.337-17.035 l-27.828-95.275c-2.117-7.285-9.75-11.453-17.036-9.336c-7.277,2.134-11.453,9.758-9.328,17.035L371.945,247.248z"></path> <path class="st0" d="M168.726,392.844c-3.871,0-7.492-0.778-10.817-2.176c-4.97-2.1-9.246-5.64-12.239-10.089 c-2.878-4.276-4.582-9.312-4.714-14.836c0.148-6.592,2.249-12.313,5.937-16.887c1.91-2.357,4.267-4.424,7.128-6.136 c2.828-1.687,6.161-3.027,10.073-3.87l244.335-39.769c15.961-2.605,28.663-14.81,31.888-30.664l29.887-146.928v-0.016 c0.347-1.704,0.513-3.44,0.513-5.16c0-5.938-2.035-11.743-5.855-16.424c-4.93-6.02-12.306-9.518-20.088-9.518h-338.32 L94.928,50.769v0.008c-5.293-17.705-19.814-31.118-37.875-34.988L15.688,6.931C8.691,5.426,1.795,9.892,0.289,16.896 c-1.496,7.004,2.96,13.901,9.974,15.398l41.348,8.865c8.798,1.885,15.878,8.418,18.458,17.052l75.584,259.634 c-1.703,0.794-3.349,1.654-4.937,2.605c-8.146,4.855-14.679,11.669-19.061,19.624c-4.194,7.558-6.418,16.126-6.632,24.966h-0.033 v1.348h0.033c0.165,6.906,1.637,13.529,4.192,19.575c4.094,9.667,10.891,17.846,19.458,23.634 c8.56,5.796,18.971,9.196,30.052,9.187h137.272c-0.042-1.281-0.194-2.53-0.194-3.82c0-7.567,0.781-14.952,2.174-22.121H168.726z M113.998,116.314h330.778h0.009l-29.887,146.935c-1.076,5.293-5.31,9.362-10.635,10.222L170.81,311.478L113.998,116.314z"></path> <path class="st0" d="M421.604,324.569c-49.924,0-90.396,40.472-90.396,90.396s40.472,90.396,90.396,90.396 c49.932,0,90.396-40.472,90.396-90.396S471.536,324.569,421.604,324.569z M473.264,430.032h-36.593v36.585h-30.127v-36.585h-36.594 v-30.134h36.594v-36.594h30.127v36.594h36.593V430.032z"></path> </g> </g></svg></button></th>
                <th scope="col"> </th>
                </tr>
            </thead><tbody>`;
    abonos.map((abono , index)=> {
        //console.log(articulo);
        tableSalida += `<tr>
            <th scope="row">${(index+1)}</th>
            <th >${abono.idAbono}</th>
            <th>${abono.fechaAbono}</th>
            <th>${abono.montoAbono}</th>
            <th>${renderTipoPago(abono.tipoPago)}</th>
            
            <th><button class="btn btn-primary" onClick="modificarAbono(${index})"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V7C19 7.55228 19.4477 8 20 8C20.5523 8 21 7.55228 21 7V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM22.1213 10.7071C20.9497 9.53553 19.0503 9.53553 17.8787 10.7071L16.1989 12.3869L11.2929 17.2929C11.1647 17.4211 11.0738 17.5816 11.0299 17.7575L10.0299 21.7575C9.94466 22.0982 10.0445 22.4587 10.2929 22.7071C10.5413 22.9555 10.9018 23.0553 11.2425 22.9701L15.2425 21.9701C15.4184 21.9262 15.5789 21.8353 15.7071 21.7071L20.5556 16.8586L22.2929 15.1213C23.4645 13.9497 23.4645 12.0503 22.2929 10.8787L22.1213 10.7071ZM18.3068 13.1074L19.2929 12.1213C19.6834 11.7308 20.3166 11.7308 20.7071 12.1213L20.8787 12.2929C21.2692 12.6834 21.2692 13.3166 20.8787 13.7071L19.8622 14.7236L18.3068 13.1074ZM16.8923 14.5219L18.4477 16.1381L14.4888 20.097L12.3744 20.6256L12.903 18.5112L16.8923 14.5219Z" fill="#ffffff"></path> </g></svg></th>
            <th><button class="btn btn-danger" onClick="removerAbono(${index})"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H10M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V10.8125" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14.0251 15.0251C13.3918 15.6585 13 16.5335 13 17.5C13 19.433 14.567 21 16.5 21C17.4665 21 18.3415 20.6082 18.9749 19.9749M14.0251 15.0251C14.6585 14.3918 15.5335 14 16.5 14C18.433 14 20 15.567 20 17.5C20 18.4665 19.6082 19.3415 18.9749 19.9749M14.0251 15.0251L16.5 17.5L18.9749 19.9749" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> </g></svg></button></th>  
            </tr>`; 
        //totalArticulosR += parseFloat(articulo.cantidad) ;
        //totalVentaR +=parseFloat(articulo.total);
    });
    
    tableSalida += `</tbody></table>`;
    totalArticulos =totalArticulosR ;
    totalVenta =totalVentaR;
    document.getElementById("divTabla").innerHTML = tableSalida ; 
    //document.getElementById("divTicket").innerHTML = tableTicket ; 
}

function renderTipoPago(tipo){
  return tipo == 1 ? 'Electronico/Transferencia' : 'Efectivo' ;
}

async function removerAbono(indice){
  let respuestaDialog = await Swal.fire({
      title: 'Desea Cancelar este abono? ?',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      denyButtonText: `Cancelar`,
    }); 

    if(respuestaDialog.isConfirmed){
      abonoRemover = abonos.filter((abono  , index)=> index == indice)[0];
      let jsonRequest = {
          idAbono :abonoRemover.idAbono,
          idPedido :abonoRemover.idPedido,
          idCorte : abonoRemover.idCorte
      }
      console.log(jsonRequest);
      const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=8', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(jsonRequest)
          });
      const json = await response.json();
      //console.log(json);
      Swal.fire({
        title: "Abono cancelado con exito",
        
        icon: "success",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: 'Aceptar'
      })
      await cargarDatosInicialesPedido();
    }
}

function obtenerAbonoArrayIndice(indice){
  return abonos.filter((user , index) => indice == index)[0];
}

function modificarAbono(indice){
  console.log(abonoSeleccionado);
  if(indice == null){
    abonoSeleccionado = null ;
    document.getElementById("tituloModal").textContent = 'Nuevo Abono';
    document.getElementById("monto").value = '' ; 
    document.getElementById('slcFormaPago').value = '0'
    document.getElementById('fechaAbono').valueAsDate = new Date();
  }else{
    document.getElementById("tituloModal").textContent = 'Editar Abono';
    abonoSeleccionado = obtenerAbonoArrayIndice(indice);
    console.log(abonoSeleccionado);
    document.getElementById("monto").value = abonoSeleccionado.montoAbono ; 
    document.getElementById("fechaAbono").value = abonoSeleccionado.fechaAbono ; 
    document.getElementById('slcFormaPago').value = abonoSeleccionado.tipoPago ;
  }
  let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
  modal.show();
    //modal.hide();
}

async function guardarDatos(indice){
  //let titleSwal =abonoSeleccionado == null ? "D"
  let montoAbonado = document.getElementById("monto").value ; 
  let tipoPago = document.getElementById('slcFormaPago').value ;
  let fechaAbono = document.getElementById('fechaAbono').value ;

  if(montoAbonado == ''){
    Swal.fire('Favor de ingresar un monto valido', '', 'info');
    return ; 
  }

  if(montoAbonado <= 0 ){
    Swal.fire('El monto del abono debe de ser mayor de 0', '', 'info');
    return ; 
  }
  let respuestaDialog = await Swal.fire({
    title: 'Datos Correctos? ?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Aceptar',
    denyButtonText: `Cancelar`,
  }); 
  let opcionRequest = 0 ; 
  let jsonRequest = {}  ;
  if(respuestaDialog.isConfirmed){
    if(abonoSeleccionado == null){// es un nuevo abono
      jsonRequest = {
        "idPedido" : idPedido , 
        "montoAbono" : montoAbonado , 
        "fechaAbono" : fechaAbono,
        "tipoPago" : tipoPago,
        "statusAbono" : 1 ,
        "idCorte" : idCorteActual
      }
      opcionRequest = 7 ;
    }else{
      jsonRequest = {
        "idAbono" :abonoSeleccionado.idAbono ,
        "idPedido" : abonoSeleccionado.idPedido , 
        "montoAbono" : montoAbonado , 
        "fechaAbono" : fechaAbono,
        "tipoPago" : tipoPago,
        "statusAbono" : abonoSeleccionado.statusAbono ,
        "idCorte" : abonoSeleccionado.idCorte
      }
      opcionRequest = 9 ;
    }
    
    console.log(jsonRequest);
    //return ;
    const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc='+opcionRequest, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonRequest)
        });
    const json = await response.json();
    console.log(json);
    Swal.fire({
      title: "Datos guardados con exito",
      
      icon: "success",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: 'Aceptar'
    })
    await cargarDatosInicialesPedido();
    let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
    //modal.show();
    modal.hide();
  }
}



    
    </script>
  </body>
</html>
