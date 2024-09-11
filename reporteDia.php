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
          <h1 class="h2">Reporte del dia</h1>  
        </div>
        <div class="d-flex flex-row g-3 align-items-center border-bottom">
          
          <div class="mb-3 col-md-3 d-flex flex-row">
            <label for="fechaInicio" class="col-form-label col-md-4">Fecha Reporte:</label>
            <input type="date" id="fechaInicio" class="form-control">
          </div>
          <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
            <button id="btnGenerar" class="btn btn-primary" onclick="generarReporte()">Generar</button>
            <button id="btnExportar" class="btn btn-success" onclick="ExportToExcel('xlsx')" style="margin-left:10px;">Exportar a Excel</button>
          </div>
        </div>         
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 ">
            <div id="divTabla">
                <table class="table">
                    <thead>
                    <tr>
                    <th scope="col">Fecha Reporte</th>
                    <th scope="col">Folio Corte</th>
                    <th scope="col">Total Vendido Efectivo</th>
                    <th scope="col">Total Vendido Electronico</th>
                    <th scope="col">Total Gastos </th>
                    <th scope="col">Total Entradas</th>
                    <th scope="col">Total Ingresos</th>
                    <th scope="col">Total Retiros</th>
                    </tr>
                    </thead>
                    <tbody>    
                    </tbody>
                </table>              
            </div>
        </div>  
        <div id="divPaginador" class="border-bottom " style = "display : flex; flex-direction : row; justify-content: flexflex-start  ; ">

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
        let datos = [];
        let datoBuscar = "" ; 
        let datoSeleccionado = null  ;
        let indexDato = null ;
        let datoSrc = "" ;
        let tipoEntrada = 0 ; 
        let limite = 5 ; 
        let pagina = 1 ;
        let idCorteActual = 0 ; 


        async function initComponents(){
         
          
        }

        
      async function renderTabla(){
        /*
        "totalVendidoEfectivo": "0.00",
		"totalVendidoElectronico": "0.00",
		"totalGastos": "0.00",
		"totalEntradas": "0.00",
		"totalIngresos": "1600.00",
		"totalRetiros": "1300.00"
        */
        console.log('Calling renderTabla');
        let tableSalida  = `<table id="tbl_exporttable_to_xls" class="table">
                <thead>
                    <tr>
                    <th scope="col">Fecha Reporte</th>
                    <th scope="col">Folio Corte</th>
                    <th scope="col">Total Vendido Efectivo</th>
                    <th scope="col">Total Vendido Electronico</th>
                    <th scope="col">Total Gastos </th>
                    <th scope="col">Total Entradas</th>
                    <th scope="col">Total Ingresos</th>
                    <th scope="col">Total Retiros</th>
                    </tr>
                </thead><tbody>`;
        datos.map((dato , indx) => {
          tableSalida += `<tr>
          <th scope="row">${dato.fecha}</th>
          <th>${dato.idCorte}</th>
          <th>${dato.totalVendidoEfectivo}</th>
          <th>${dato.totalVendidoElectronico}</th>
          <th>${dato.totalGastos}</th>
          <th>${dato.totalEntradas}</th>
          <th>${dato.totalIngresos}</th>
          <th>${dato.totalRetiros}</th>
          </tr>`; 
        });
        
        
        tableSalida += `</tbody></table>`;
        
        document.getElementById("divTabla").innerHTML = tableSalida ; 
      }

      
      async function generarReporte(){
        let fechaInicio = document.getElementById('fechaInicio').value ; 
        
        const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=6', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({fecha : fechaInicio})
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
