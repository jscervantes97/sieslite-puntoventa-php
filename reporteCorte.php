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
          <h1 class="h2">Reportes de Cortes</h1>
        </div>
        <h3>Filtros</h3>
        
        <div class="d-flex flex-row g-3 align-items-center">
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
    <script src="js/xlsx.full.min.js"></script>
    <script type="text/javascript">
      let registros = [] ;
      let tipoPago = 0 ; 

      async function initComponents(){
        let objJson = { opciones : [] , fechaInicio : ""  , fechaFin : "" , idCorte : "" , tipoPago : ""} ;
        const response = await fetch('http://localhost/sieslite/api/corte.php?opc=4', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(objJson)
        });
        const json = await response.json();
        console.log('reporte generado');
        console.log(json);
        registros = json.data ; 
        await renderTabla();
      }

      async function generarReporte(){
        let fechaInicio = document.getElementById('fechaInicio').value ; 
        let fechaFin = document.getElementById('fechaFin').value ; 
        //let folioCorte = document.getElementById('txtFolio').value ; 
        //let checkboxes = document.querySelectorAll('input[name="filtro"]:checked');
        let output= [];
        let checkboxes = document.querySelectorAll('input[name="filtro"]:checked');
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
       
        //alert(fechaInicio + " v "+ fechaFin)
        let objJson = { opciones : output , fechaInicio : ""  , fechaFin : "" , idCorte : "" , tipoPago : ""} ;
        /*
        console.log(output);
        if(output.includes('1')){
          objJson.idCorte = folioCorte.toString() ; 
        }
        if(output.includes('2')){
          objJson.tipoPago = tipoPago.toString() ; 
        }
        */
        if(output.includes('3')){
          objJson.fechaInicio =fechaInicio ;
          objJson.fechaFin  = fechaFin ; 
        }
        //console.log(folioCorte + " " + tipoPago)
        console.log(objJson); 
        const response = await fetch('http://localhost/sieslite/api/corte.php?opc=4', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(objJson)
        });
        const json = await response.json();
        console.log('reporte generado');
        console.log(json);
        registros = json.data ; 
        await renderTabla();
      }
/*

status
: 
1
totalGastosEntradas
: 
"0.00"
totalVendido
: 
"0.00"
totalVentas
: 
0 */
      async function renderTabla(){
        let tableSalida  = `<table id="tbl_exporttable_to_xls" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Folio corte</th>
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Fecha Fin</th>
                            <th scope="col">Folio Primera Venta</th>
                            <th scope="col">Folio Ultima Venta</th>
                            <th scope="col">Ventas Realizadas</th>
                            <th scope="col">Total Vendido</th>
                            <th scope="col">Efectivo</th>
                            <th scope="col">Electronico</th>
                            <th scope="col">Total Gastos Entradas</th>
                            <th scope="col">Ganancia Neta</th>
                            <th scope="col">Estatus Corte</th>
                        </tr>
                    </thead><tbody>`;
          registros.map((reg , index)=> {
              let statusString = reg.status == 0 ? "En Curso" : reg.status == 1 ? "Terminado" : "Cancelado" ; 
              let folioPrimerVentaString = reg.idPrimerVenta == null ? "Sin Primer Venta" : reg.idPrimerVenta ; 
              let folioUltimaVentaString = reg.idUltimaVenta == null ? "Sin Ultima Venta" : reg.idUltimaVenta ; 
              let fechaFinString = reg.fechaFin == null ? "En Curso" : reg.fechaFin ; 
              tableSalida += `<tr>
                  <th scope="row">${reg.idCorte}</th>
                  <th>${reg.fechaInicio}</th>
                  <th>${fechaFinString}</th>
                  <th>${folioPrimerVentaString}</th>
                  <th>${folioUltimaVentaString}</th>
                  <th>${reg.totalVentas}</th>
                  <th>${reg.totalVendido}</th>
                  <th>${reg.totalVendidoEfectivo}</th>
                  <th>${reg.totalVendidoElectronico}</th>
                  <th>${reg.totalGastosEntradas}</th>
                  <th>${reg.gananciaNeta}</th>
                  <th>${statusString}</th>
                  </tr>`; 
          });
          
          tableSalida += `</tbody></table>`;
          if(registros.length == 0){
            tableSalida += `<h3><center>Sin Registros</center></h3>`;  
          }
          document.getElementById("divTabla").innerHTML = tableSalida ; 
      }

      function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "reporte" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Reporte de Ventas.' + (type || 'xlsx')));
    }

      function cambiarTipoPago(){
        tipoPago = tipoPago == 0 ? 1 : 0 ; 
        console.log(tipoPago)
      }

    </script>
  </body>
</html>
