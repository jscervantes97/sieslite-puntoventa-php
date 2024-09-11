<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="cargarDatosInicio()">
    
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
          <h1 class="h2">Pedidos</h1>
        
        </div>
        <div class="d-flex flex-row g-3 align-items-center border-bottom">
            <div class="mb-3 col-md-2">
                <label for="srcBuscarArticulo" class="col-form-label h1">Nombre cliente:</label>
            </div>
            <div class="input-group mb-3 ">
                <input type="text" id="srcBuscarArticulo" class="form-control">
            </div>
            <div class="mb-3 col-md-3 d-flex flex-row">
              <label for="fechaInicio" class="col-form-label col-md-4">Fecha Pedido:</label>
              <input type="date" id="fechaInicio" class="form-control">
            </div>
            <div class="mb-3 col-md-3 d-flex flex-row">
              <Button class="btn btn-primary" onClick="buscar()">Buscar</Button>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div id="divTabla">
                
            </div>
        </div>  
        
      </main>
    </div>
  </div>
  <?php
    require_once 'components/logoutModal.php' 
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
        let pedidos = [] ;
        async function cargarDatosInicio(){
          const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=1', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                "idPedido" : 0,
                "nombreCliente" : "",
                "fechaPedido" : ""
              })
          });
          const json = await response.json();
          pedidos = json.data ; 
          
          await renderTabla();
        }

        async function buscar(){
          let nombreCliente =document.getElementById('srcBuscarArticulo').value ;
          let fecha = document.getElementById('fechaInicio').value;
          const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=1', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                "idPedido" : 0,
                "nombreCliente" : nombreCliente,
                "fechaPedido" : fecha
              })
          });
          const json = await response.json();
          pedidos = json.data ; 
          
          await renderTabla();
        }

        async function renderTabla(){
          let tableSalida  = `<table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Folio Pedido</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Total Articulos</th>
                        <th scope="col">Monto Pedido</th>
                        <th scope="col">Fecha Creacion Pedido</th>
                        <th scope="col">Fecha Vencimiento Pedido</th>
                        <th scope="col">Estatus Pedido</th>
                        <th>Editar</th>
                        <th>Cancelar</th>
                        <th>Abonos</th>
                        <th scope="col"><a href="http://localhost/sieslite/pedidoNuevo.php" class="btn btn-primary" onclick="editarCrearArticulo(null)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M7.75 2a.75.75 0 0 1 .75.75V7h4.25a.75.75 0 0 1 0 1.5H8.5v4.25a.75.75 0 0 1-1.5 0V8.5H2.75a.75.75 0 0 1 0-1.5H7V2.75A.75.75 0 0 1 7.75 2Z"></path></svg></a></th>
                      </tr>
                    </thead><tbody>`;
            pedidos.map((pedido , index)=> {
                tableSalida += `<tr class="align-middle">
                    <th scope="row">${pedido.idPedido}</th>
                    <th>${pedido.nombreCliente}</th>
                    <th>${pedido.totalArticulos}</th>
                    <th>${pedido.totalPedido}</th>
                    <th>${pedido.fechaCreacionPedido}</th>
                    <th>${pedido.fechaVencimiento}</th>
                    <th>${renderSelectList(pedido.idPedido,pedido.statusPedido)}</th>
                    <th><a href="http://localhost/sieslite/editarPedido.php?idPedido=${pedido.idPedido}" class="btn btn-primary" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="removerPedido(${pedido.idPedido})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></a></th>  
                    <th><a href="http://localhost/sieslite/abonosPedido.php?idPedido=${pedido.idPedido}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="12" height="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /></svg></th>  
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            if(pedidos.length == 0){
              tableSalida += `<h3><center>Sin Registros</center></h3>`;  
            }

            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }

        function renderSelectList(idPedido, status){
          
          //console.log("Rendering select list " , status , status == 1 ? 'Selected' : '' );

          let salida = `<select id="select${idPedido}" class="form-select" onChange="actualizarEstatus(${idPedido})">
                            <option ${status == 1 ? 'Selected' : '' } value = 1>En Espera</option>
                            <option ${status == 2 ? 'Selected' : '' } value = 2>Entregado</option>
                        </select>`;
          return salida ;
        }

        async function actualizarEstatus(idPedido){
          //console.log("idPedido : " , idPedido)
          var e = document.getElementById(`select${idPedido}`);
          var status = e.value;
          const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=5', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({  idPedido , status  })
            });
        }

        async function removerPedido(idPedido){
          
          //await Swal.fire('Funcionalidad por definir' , 'Disculpe las molestias' , 'info');
          let respuestaDialog = await Swal.fire({
            title: 'Desea Cancelar el pedido?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
          }); 
          if(respuestaDialog.isConfirmed){
            //const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=4', {
            const response = await fetch('http://localhost/sieslite/api/pedidosImagenes.php?opc=4', { 
              method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({  idPedido })
            });
            const json = await response.json();
            await Swal.fire('Pedido Cancelado con exito' , '' , 'info');
            await cargarDatosInicio();
          }
        }
    </script>
  </body>
</html>
