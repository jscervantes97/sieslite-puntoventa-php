<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="inicializarVenta()">
    
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
            <h1 class="h2">Punto de Venta</h1><br>  
        </div>
        <div class="row g-3 align-items-center border-bottom">
            <div class="col mb-3">
                <label for="codigoArticulo" class="col-form-label">Codigo Articulo</label>
            </div>
            <div class="col input-group mb-3" id="datalistArticulos">
                <input list="articulos" name="codigoArticulo" id="codigoArticulo" class="form-control" autocomplete="off" onkeyup="enterCodigoArticulo(event)">
                <datalist id="articulos">
                    
                </datalist>
            </div>
            <div class="col mb-3">
                <label for="codigoArticulo" class="col-form-label">Precio Unitario</label>
            </div>
            <div class="col mb-3">
                <input type="text" id="precioUnitario" class="form-control" readonly>
            </div>
            <div class="col mb-3">
                <label for="cantidad" class="col-form-label">Cantidad</label>
            </div>
            <div class="col mb-3">
                <input number="text" id="cantidad" class="form-control" readonly onkeyup="enterCantidad(event)">
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 border-bottom">
            <span id="spanFolio" class="h3">Folio venta: </span>
            <div id="divTabla">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Cantidad Articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>              
            </div>
            <div id="divTicket" style="display : none">
                aqui ira el ticket     
            </div>
           
        </div>  
      </main>
    </div>
  </div>
  <div class="modal fade" id="modalArticulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sieslite</h5>
                <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4><span>Busqueda de articulos</span></h4>
                <div class="d-flex flex-column">
                        <div class="d-flex flex-row g-3 align-items-center border-bottom">
                            <div class="mb-3 col-md-2">
                                <label for="codigoArticulo" class="col-form-label h1">Buscar articulo:</label>
                            </div>
                            <div class="input-group mb-3 ">
                                <input type="text" id="srcBuscarArticulo" onkeyup="buscarTeclado()" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom overflow-auto">
                            
                                <div id="divTablaModal">
                                    
                                </div>
                            
                        </div>  
                </div>
            </div>
            
        </div>
    </div>
  </div>
 

<!-- Modal modificar articulos en venta-->
    <div class="modal fade" id="modalArticulosEnVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modificar Articulo En Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 align-items-center border-bottom">
                        <div class="col mb-3">
                            <label for="codigoArticuloVenta" class="col-form-label">Codigo Articulo</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" id="codigoArticuloVenta" class="form-control" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="codigoArticuloVenta" class="col-form-label">Precio Unitario</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" id="precioUnitarioVenta" class="form-control" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="cantidad" class="col-form-label">Cantidad</label>
                        </div>
                        <div class="col mb-3">
                            <input number="text" id="cantidadVenta" class="form-control"  onkeyup="enterCantidadEditar(event)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onClick="enterCantidadEditar2()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
  <?php
    require_once 'components/logoutModal.php' 
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">

        document.onkeydown = async function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                //alert('Esc key pressed.');
                document.getElementById("codigoArticulo").value = "" ;
                document.getElementById("precioUnitario").value = "" ;
                document.getElementById("cantidad").value = "" ;
                document.getElementById("codigoArticulo").focus() ;
            }
            /*
            if(evt.shiftKey){
                alert("A QLERO te la andas jalando")
            }*/
           /*
            if (evt.keyCode == 115 && articulos.length > 0) {// F4
                //alert("A QLERO te la andas jalando")
                let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulosEnVenta'));
                let salida = '' ;
                
                articulos.map((art , indx)=>{
                    console.log(art)
                    salida += `<option value="${art.codigo}" style="width: 200px">${art.codigo} - ${art.nombreArticulo}</option>` ;
                })
                document.getElementById("articulosVenta").innerHTML  = salida ; 
                document.getElementById("codigoArticuloVenta").focus() ; 
                modal.show() 
                
                
                
               
                
            }
            if(evt.shiftKey){
                let ultimoArticuloAgregado = articulos[0];
                console.log(ultimoArticuloAgregado);
                document.getElementById("codigoArticuloVenta").focus() ; 
            }
            */
            if (evt.keyCode == 119) {// F8
                document.getElementById("codigoArticulo").focus() ;
                
            }

            if (evt.keyCode == 120) { // F9
                //alert('Ah qlero te la andas jalando');
                if(articulos.length > 0){
                    await realizarCobro();
                }
                
            }
        };
        let articulos = [];
        let idVenta = 0 ; 
        let idCorte = null ; 
        let articulosModal = [] ;
        let srcArticulo = "" ; 
        let articuloSeleccionado = null ; 
        let tipoPago = 0 ; 
        let objVenta = null ;
        let totalArticulos = 0.0 ;
        let totalVenta = 0 ; 
        

        async function inicializarVenta(){
            console.log('Calling inicializarVenta')
            articuloSeleccionado = null ; 
            const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const json1 = await responseCorte.json();
            console.log(json1) ;
            if(json1.data == null){
                document.getElementById("spanFolio").textContent = 'Favor de generar un corte en curso para poder vender';
                return ;
            }
            idCorte = json1.data.idCorte ;

            let objJson = {
                "status"  : 2,
                "totalArticulos" : 0,
                "totalVenta" : 0.0 ,
                "idUsuario" : <?php echo $_SESSION['idUsuario'] ?>,
                "idCorte" : idCorte
            } 
            console.log(objJson);
            const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=3', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(objJson)
            });
            const json = await response.json();
            console.log(json) ;
            idVenta = json.data ;
            document.getElementById("spanFolio").textContent = 'Folio venta: ' + idVenta.toString().padStart(5, '0');
            document.getElementById("codigoArticulo").focus();
            await cargarElementosDataList();
        }

        async function cargarElementosDataList(){
            const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=6', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({"codigo": srcArticulo , "nombre" : srcArticulo})
            });
            const json = await response.json();
            console.log(json);
            let salida = '' ;
            let artis = json.data ; 
            artis.map((art , indx)=>{
                salida += `<option value="${art.codigo}" style="width: 150px">${art.codigo} - ${art.nombre}</option>` ;
            })
            document.getElementById("articulos").innerHTML  = salida ; 
        }
        

        async function cargarDatosTablaArticulosModal(){
            const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=5', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({"codigo": srcArticulo , "nombre" : srcArticulo})
            });
            const json = await response.json();
            articulosModal = json.data ; 
            //console.log(articulosModal)
        }

        async function buscarTeclado(){
            srcArticulo = document.getElementById("srcBuscarArticulo").value ; 
            await cargarDatosTablaArticulosModal();
            await renderTablaModal();
        }

        async function renderTablaModal(){
            let tableSalida  = `<table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Codigo Articulo</th>
                            <th scope="col">Nombre Articulo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Existencia</th>
                        </tr>
                    </thead><tbody>`;
            articulosModal.map((articulo , index)=> {
                tableSalida += `<tr onClick="asignarArticuloDesdeModal(${index})">
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombre}</th>
                    <th>${articulo.precio}</th>
                    <th>${articulo.existencia}</th>
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            if(articulosModal.length == 0){
              tableSalida += `<h3><center>Sin Registros</center></h3>`;  
            }
            document.getElementById("divTablaModal").innerHTML = tableSalida ; 
            

        }

        function asignarArticuloDesdeModal(index){
            articuloSeleccionado = obtenerArticuloArrayIndice(index);
            document.getElementById("codigoArticulo").value = articuloSeleccionado.codigo ;
            abrirCerrarModal(1); 
            document.getElementById("codigoArticulo").focus() ;
        }

        async function abrirModalArticulos(){
            abrirCerrarModal(0);
        }

        async function enterCodigoArticulo(event){
            
            let keycode = event.keyCode;
            console.log(event)
            if(keycode == '13' && idCorte != null){
                let srcCodigo = document.getElementById("codigoArticulo").value ;
                //alert('You pressed a "enter" key in textbox'); 
                if(articuloSeleccionado != null){
                    document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                    document.getElementById("cantidad").focus() ;
                }else if(srcCodigo !== ""){
                    
                    const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=1', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({"codigo": srcCodigo , "nombre" : ""})
                    });
                    const json = await response.json();
                    
                    if(json.data.length == 0){
                        Swal.fire('No se encontro ningun articulo con ese codigo', '', 'info');
                        return ; 
                    }
                    articuloSeleccionado = json.data[0];
                    document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                    document.getElementById("cantidad").value = 1 ;
                    document.getElementById("cantidad").focus() ;
                    let total =parseFloat(1 *articuloSeleccionado.precio);
                    let objetoArticuloVenta = {
                        idArticulo : articuloSeleccionado.idArticulo ,
                        codigo : articuloSeleccionado.codigo,
                        nombreArticulo : articuloSeleccionado.nombre,
                        idVenta : idVenta ,
                        cantidad: 1 ,
                        precioUnitario : articuloSeleccionado.precio,
                        total : total,
                        status : 1 
                    };
                    articulos.push(objetoArticuloVenta);
                    articuloSeleccionado = null ; 
                    renderTabla();
                    document.getElementById("srcBuscarArticulo").value = "" ;
                    document.getElementById("codigoArticulo").value = "" ;
                    document.getElementById("cantidad").value = "" ;
                    document.getElementById("precioUnitario").value = "" ;
                    srcArticulo = "" ; 
                    document.getElementById("codigoArticulo").focus() ;
                }else{
                    Swal.fire('Favor de ingresar un codigo para su busqueda', '', 'info');
                }
            }
        }
        // se depreco de momento
        async function enterCantidad(event){
            
            let keycode = event.keyCode;
            let cantidadTxt =  parseFloat(document.getElementById("cantidad").value) ;
            if(keycode == '13' && articuloSeleccionado!= null && cantidadTxt > 0){
               
                //document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                
                let total =parseFloat(cantidadTxt *articuloSeleccionado.precio);
                let objetoArticuloVenta = {
                    idArticulo : articuloSeleccionado.idArticulo ,
                    codigo : articuloSeleccionado.codigo,
                    nombreArticulo : articuloSeleccionado.nombre,
                    idVenta : idVenta ,
                    cantidad: cantidadTxt ,
                    precioUnitario : articuloSeleccionado.precio,
                    total : total,
                    status : 1 
                };
                articulos.push(objetoArticuloVenta);
                articuloSeleccionado = null ; 
                renderTabla();
                document.getElementById("srcBuscarArticulo").value = "" ;
                document.getElementById("codigoArticulo").value = "" ;
                document.getElementById("cantidad").value = "" ;
                document.getElementById("precioUnitario").value = "" ;
                srcArticulo = "" ; 
                document.getElementById("codigoArticulo").focus() ;  
                
            }
        }

        async function realizarCobro(){
            const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const json1 = await responseCorte.json();
            console.log(json1) ;
            if(json1.data == null){
                document.getElementById("spanFolio").textContent = 'Favor de generar un corte en curso para poder vender';
                return ;
            }
            idCorte = json1.data.idCorte ;
            let objJson = {
                "status"  : 1,
                "totalArticulos" : totalArticulos,
                "totalVenta" : totalVenta ,
                "idUsuario" : <?php echo $_SESSION['idUsuario'] ?>,
                "idCorte" : idCorte ,
                "idVenta" :idVenta ,
                "articulos" : articulos ,
                "tipoPago" :tipoPago 
            } ;
            console.log(objJson);
            //let formValues = 0 ; 
            const formValues = await Swal.fire(
                {
                    title: "Realizando cobro de \n Total a pagar : " + totalVenta,
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: false,
                    confirmButtonText: "Aceptar",
                    showLoaderOnConfirm: true,
                    preConfirm: async (total) => {
                        /*
                        try {
                        const githubUrl = `
                            https://api.github.com/users/${login}
                        `;
                        const response = await fetch(githubUrl);
                        if (!response.ok) {
                            return Swal.showValidationMessage(`
                            ${JSON.stringify(await response.json())}
                            `);
                        }
                        return response.json();
                        } catch (error) {
                        Swal.showValidationMessage(`
                            Request failed: ${error}
                        `);
                        }
                        */
                        return parseFloat(total) ;
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }
            )
            /*
            const { value: formValues } = await Swal.fire({
            title: 'Realizar Cobro',
            html:
                `Total a pagar: $${totalVenta}<br>`+
                `Paga con: <input required type="number" id="swal-input2" class="swal2-input">`,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: () => document.getElementById('swal-input2').value 
                
                    
            });
            document.getElementById("swal-input2").focus();
           */
            console.log(formValues)
            if (!formValues.value) {
                Swal.fire('Favor de llenar el campo del pago', '', 'info');
                return ; 
            }
            if (formValues.value < 0) {
                Swal.fire('El monto a pagar debe ser mayor a 0', '', 'info');
                return ; 
            }

            if (formValues.value < totalVenta) {
                Swal.fire('Con esa cantidad no salda la cuenta', '', 'info');
                return ; 
            }
            
            const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=4', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(objJson)
            });
            const json = await response.json();
            console.log(json)
            console.log("A ver que pex")
            console.log(formValues , totalVenta )

            await Swal.fire('Venta Realizada con exito¡', 'Su cambio es $' + parseFloat(formValues.value - totalVenta), 'success');
            //let ficha = document.getElementById('divTicket');
            //let ventimp = window.open(' ', 'popimpr' , 'width=300,height=400');
            /*
            ventimp.document.write( ficha.innerHTML );
            ventimp.document.close();
            ventimp.print( );
            ventimp.close();
            */
            articulos =  [] ;
            await renderTabla();
            await inicializarVenta();
            
        }

        function renderTabla(){
            let totalArticulosR = 0.0 ;
            let totalVentaR = 0 ; 
            let tableSalida  = `<span id="spanFolio" class="h3"></span><table class="table" id="tablaVenta">
                    <thead>
                        <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Cantidad Articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead><tbody>`;
            let tableTicket  = `<span id="spanFolio" class="h3"></span><table class="table" id="tablaTicket">
                    <thead>
                        <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Cantidad Articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead><tbody>`;
            articulos.map((articulo , index)=> {
                //console.log(articulo);
                tableSalida += `<tr>
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombreArticulo}</th>
                    <th>${articulo.cantidad}</th>
                    <th>${articulo.precioUnitario}</th>
                    <th>${articulo.total}</th>
                    <th><button class="btn btn-primary" onClick="editarArticulo(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="removerArticulo(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button></th>  
                    </tr>`; 
                tableTicket += `<tr>
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombreArticulo}</th>
                    <th>${articulo.cantidad}</th>
                    <th>${articulo.precioUnitario}</th>
                    <th>${articulo.total}</th>
                    </tr>`; 
                totalArticulosR += articulo.cantidad ;
                totalVentaR +=articulo.total;
            });
            if(articulos.length > 0){
                tableSalida += `<tr>
                    <th></th>    
                    <th>Total Articulos</th>
                    <th>${totalArticulosR}</th>
                    <th>Total Venta: </th>
                    <th>$${totalVentaR}</th>   
                    <th></th>
                    <th></th>        
                </tr>`;
                tableSalida += `<tr>
                    <th colspan = 3></th>    
                    <th class="mb-3">Pago con: </th>
                    <th class="mb-3" colspan=2>
                        <select class="form-select" onChange="cambiarTipoPago()">
                            <option selected value = 0>Efectivo</option>
                            <option value=1>Tarjeta</option>
                        </select>
                    </th>
                    <th><button class="btn btn-primary" onClick="realizarCobro()">Realizar Cobro</th>       
                </tr>`;
                tableTicket += `<tr>
                    <th></th>    
                    <th>Total Articulos</th>
                    <th>${totalArticulosR}</th>
                    <th>Total Venta: </th>
                    <th>$${totalVentaR}</th>        
                </tr>`;
                let formaPago = tipoPago == 0 ? "Efectivo"  : "Tarjeta";
                tableTicket += `<tr>
                    <th></th>    
                    <th></th>
                    <th></th>
                    <th>Forma de pago: </th>
                    <th>${formaPago}</th>        
                </tr>`;
            }
            
            tableTicket += `</tbody></table>`;
            tableSalida += `</tbody></table>`;
            totalArticulos =totalArticulosR ;
            totalVenta =totalVentaR;
            document.getElementById("divTabla").innerHTML = tableSalida ; 
            document.getElementById("divTicket").innerHTML = tableTicket ; 
        }

        function removerArticulo(indice){
            artFiltered = articulos.filter((articulo  , index)=> index != indice);
            articulos = artFiltered ;
            renderTabla();
        }

        let articuloSeleccionadoEditar = null ;
        let indiceEditar = null;

        function editarArticulo(indice){
            articuloSeleccionadoEditar = articulos.find((a,indx) => indx == indice)
            indiceEditar = indice ; 
            //renderTabla();
            //
            console.log(articuloSeleccionadoEditar);
            document.getElementById("codigoArticuloVenta").value =articuloSeleccionadoEditar.codigo ;
            document.getElementById("precioUnitarioVenta").value =articuloSeleccionadoEditar.precioUnitario ;
            document.getElementById("cantidadVenta").value =articuloSeleccionadoEditar.cantidad ;
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulosEnVenta'));
            modal.show() 
            document.getElementById("cantidadVenta").focus() ; 
        }

        async function enterCantidadEditar(event){
            
            let keycode = event.keyCode;
            let cantidadTxt =  parseFloat(document.getElementById("cantidadVenta").value) ;
            if(keycode == '13' && cantidadTxt > 0){
               
                //document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                console.log(articuloSeleccionadoEditar)
                
                let total =parseFloat(cantidadTxt *articuloSeleccionadoEditar.precioUnitario);
                let objetoArticuloVenta = {
                    idArticulo : articuloSeleccionadoEditar.idArticulo ,
                    codigo : articuloSeleccionadoEditar.codigo,
                    nombreArticulo : articuloSeleccionadoEditar.nombreArticulo,
                    idVenta : articuloSeleccionadoEditar.idVenta ,
                    cantidad: cantidadTxt ,
                    precioUnitario : articuloSeleccionadoEditar.precioUnitario,
                    total : total,
                    status : 1 
                };
                articulos[indiceEditar] = objetoArticuloVenta;
                articuloSeleccionadoEditar = null ; 
                indiceEditar = null ;
                console.log(articulos)
                renderTabla();
                document.getElementById("srcBuscarArticulo").value = "" ;
                document.getElementById("codigoArticulo").value = "" ;
                document.getElementById("cantidad").value = "" ;
                document.getElementById("precioUnitario").value = "" ;
                srcArticulo = "" ; 
                let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulosEnVenta'));
                modal.hide() 
                document.getElementById("codigoArticulo").focus() ;  
                
            }
        }

        async function enterCantidadEditar2(){
            
            //let keycode = event.keyCode;
            let cantidadTxt =  parseFloat(document.getElementById("cantidadVenta").value) ;
            console.log(articuloSeleccionadoEditar)
                
            let total =parseFloat(cantidadTxt *articuloSeleccionadoEditar.precioUnitario);
            let objetoArticuloVenta = {
                idArticulo : articuloSeleccionadoEditar.idArticulo ,
                codigo : articuloSeleccionadoEditar.codigo,
                nombreArticulo : articuloSeleccionadoEditar.nombreArticulo,
                idVenta : articuloSeleccionadoEditar.idVenta ,
                cantidad: cantidadTxt ,
                precioUnitario : articuloSeleccionadoEditar.precioUnitario,
                total : total,
                status : 1 
            };
            articulos[indiceEditar] = objetoArticuloVenta;
            articuloSeleccionadoEditar = null ;     
            indiceEditar = null ;
            console.log(articulos)
            renderTabla();
            document.getElementById("srcBuscarArticulo").value = "" ;
            document.getElementById("codigoArticulo").value = "" ;
            document.getElementById("cantidad").value = "" ;
            document.getElementById("precioUnitario").value = "" ;
            srcArticulo = "" ; 
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulosEnVenta'));
            modal.hide() 
            document.getElementById("codigoArticulo").focus() ;  
        }

        function cambiarTipoPago(){
            tipoPago = tipoPago == 0 ? 1 : 0 ; 
            console.log(tipoPago)
        }

        function obtenerArticuloArrayIndice(indice){
           return articulosModal.filter((art , index) => indice == index)[0];
        }

        function abrirCerrarModal(opcion){
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulos'));
            if(opcion==0) 
            modal.show() 
            else 
            modal.hide();
        }

       

    </script>
</body>
</html>
