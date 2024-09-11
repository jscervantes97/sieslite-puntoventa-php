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
          <h1 class="h2">Ventas</h1>
        </div>
        <div class="d-flex flex-row g-3 align-items-center">
          <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" name="filtro" value="1" id="checkCorte">
          </div>
          <div class="mb-3 col-md-3 d-flex flex-row">
            <label for="txtFolio" class="col-form-label col-md-4">Folio Corte:</label>
            <input type="text" id="txtFolio" class="form-control">
          </div>
          <div class="mb-3 form-check" style="margin-left:10px;">
            <input class="form-check-input" type="radio" name="filtro" value="2" id="checkTipoPago">
          </div>
          <div class="mb-3 col-md-3 d-flex flex-row">
            <label for="txtFolio" class="col-form-label col-md-4">Folio Venta:</label>
            <input type="text" id="txtFolioVenta" class="form-control">
          </div>
        </div>
        <div class="d-flex flex-row g-3 align-items-center">
          <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" name="filtro" value="3" id="checkFecha">
          </div>
          <div class="mb-3 col-md-3 d-flex flex-row">
            <label for="fechaInicio" class="col-form-label col-md-4">Fecha Inicio:</label>
            <input type="date" id="fechaInicio" class="form-control">
          </div>
          
          <div class="mb-3 col-md-3 d-flex flex-row" style= "margin-left:10px">
            <label for="fechaFin" class="col-form-label col-md-4">Fecha fin:</label>
            <input type="date" id="fechaFin" class="form-control " style="margin-left:20px;">
          </div>
          <div class="mb-3 col-md-3 d-flex flex-row" style= "margin-left:10px">
            <button id="btnGenerar" class="btn btn-primary" onclick="initComponents()">Buscar</button>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 border-bottom">
          
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
        let registros = [] ;
        let opcFiltro = 0 ;
        let start = 0 ; 
        
        async function initComponents(){
            await buscar();
            await renderTabla();
        }

        async function buscar(){
            var ele = document.getElementsByName('filtro');
            let fechaInicio = document.getElementById('fechaInicio').value ; 
            let fechaFin = document.getElementById('fechaFin').value ; 
            let folioCorte = document.getElementById('txtFolio').value ; 
            let folioVenta = document.getElementById('txtFolioVenta').value ; 
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    opcFiltro = ele[i].value; 
            }
            let objJson = { opcFiltro : opcFiltro , fechaInicio : fechaInicio , fechaFin : fechaFin , idCorte : folioCorte , idVenta : folioVenta} ;
            console.log(objJson); 
            const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=5', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(objJson)
            });
            const json = await response.json();
            registros = json.data; 
            console.log(registros);
            if(start > 0){
              await Swal.fire(
                'Reporte Generado ',
                '',
                'success'
              );
            }
            start = 1 ;
            
        }

        async function renderTabla(){
            let tableSalida  = `<table id="tbl_exporttable_to_xls" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Folio corte</th>
                                <th scope="col">Folio venta</th>
                                <th scope="col">Fecha venta</th>
                                <th scope="col">Total venta</th>
                                <th scope="col">Total articulos</th>
                                <th scope="col">Metodo de pago</th>
                                <th scope="col">Estatus venta</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead><tbody>`;
            registros.map((reg , index)=> {
                let statusString = reg.status == 0 ? "Cancelada" : reg.status == 1 ? "Terminada" : reg.status == 2 ? "En Curso" : reg.status == 3 ? "Cancelada" : "Sin status" ; 
                let tipoPagoString = reg.metodoPago == 0 ? "Efectivo" :"Tarjeta" ; 
                tableSalida += `<tr>
                    <th scope="row">${reg.idCorte}</th>
                    <th>${reg.idVenta}</th>
                    <th>${reg.fechaVenta}</th>
                    <th>${reg.totalVenta}</th>
                    <th>${reg.totalArticulos}</th>
                    <th>${tipoPagoString}</th>
                    <th>${statusString}</th>
                    <th><button class="btn btn-primary" onClick="imprimir(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M5 8.25a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4A.75.75 0 0 1 5 8.25ZM4 10.5A.75.75 0 0 0 4 12h4a.75.75 0 0 0 0-1.5H4Z"></path><path d="M13-.005c1.654 0 3 1.328 3 3 0 .982-.338 1.933-.783 2.818-.443.879-1.028 1.758-1.582 2.588l-.011.017c-.568.853-1.104 1.659-1.501 2.446-.398.789-.623 1.494-.623 2.136a1.5 1.5 0 1 0 2.333-1.248.75.75 0 0 1 .834-1.246A3 3 0 0 1 13 16H3a3 3 0 0 1-3-3c0-1.582.891-3.135 1.777-4.506.209-.322.418-.637.623-.946.473-.709.923-1.386 1.287-2.048H2.51c-.576 0-1.381-.133-1.907-.783A2.68 2.68 0 0 1 0 2.995a3 3 0 0 1 3-3Zm0 1.5a1.5 1.5 0 0 0-1.5 1.5c0 .476.223.834.667 1.132A.75.75 0 0 1 11.75 5.5H5.368c-.467 1.003-1.141 2.015-1.773 2.963-.192.289-.381.571-.558.845C2.13 10.711 1.5 11.916 1.5 13A1.5 1.5 0 0 0 3 14.5h7.401A2.989 2.989 0 0 1 10 13c0-.979.338-1.928.784-2.812.441-.874 1.023-1.748 1.575-2.576l.017-.026c.568-.853 1.103-1.658 1.501-2.448.398-.79.623-1.497.623-2.143 0-.838-.669-1.5-1.5-1.5Zm-10 0a1.5 1.5 0 0 0-1.5 1.5c0 .321.1.569.27.778.097.12.325.227.74.227h7.674A2.737 2.737 0 0 1 10 2.995c0-.546.146-1.059.401-1.5Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="remover(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button></th>  
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            if(registros.length == 0){
                tableSalida += `<h3><center>Sin Registros</center></h3>`;  
            }
            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }
    </script>
</body>
</html>
