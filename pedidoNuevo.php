<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body>
    
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
          <div style="display : flex; flex-direction: row;  align-items : flex-start ; justify-content : flex-start; width:100%">
            <h1 class="h2">Nuevo Pedido</h1>
          </div>
          <div style="display : flex; flex-direction: row;  align-items : flex-end ; justify-content : flex-end; width:100%">
            <a href="/sieslite/pedidos.php" id="btnImprimir" class="btn btn-danger" >Cancelar<svg width="24px" height="24px" viewBox="0 0 32 32" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs2"></defs> <g id="layer1" transform="translate(-348,-244)"> <path d="m 357,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5331" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 371,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5333" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 372,246.00586 c -3.30186,0 -6,2.69814 -6,6 0,3.30186 2.69814,6 6,6 3.30186,0 6,-2.69814 6,-6 0,-3.30186 -2.69814,-6 -6,-6 z m 0,2 c 2.22098,0 4,1.77902 4,4 0,2.22098 -1.77902,4 -4,4 -2.22098,0 -4,-1.77902 -4,-4 0,-2.22098 1.77902,-4 4,-4 z" id="circle5337" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 370.58594,249.5918 a 1,1 0 0 0 -0.70703,0.29297 1,1 0 0 0 0,1.41406 l 0.70703,0.70703 -0.70703,0.70703 a 1,1 0 0 0 0,1.41406 1,1 0 0 0 1.41406,0 L 372,253.41992 l 0.70703,0.70703 a 1,1 0 0 0 1.41406,0 1,1 0 0 0 0,-1.41406 l -0.70703,-0.70703 0.70703,-0.70703 a 1,1 0 0 0 0,-1.41406 1,1 0 0 0 -0.70703,-0.29297 1,1 0 0 0 -0.70703,0.29297 L 372,250.5918 l -0.70703,-0.70703 a 1,1 0 0 0 -0.70703,-0.29297 z" id="path5339" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 351.01758,246.00586 a 1,1 0 0 0 -1,1 1,1 0 0 0 1,1 h 1.17969 l 2.65039,13.24219 c -1.07078,0.46018 -1.83008,1.52737 -1.83008,2.75781 0,1.6447 1.3553,3 3,3 h 17 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -17 c -0.5713,0 -1,-0.4287 -1,-1 0,-0.5713 0.4287,-1 1,-1 h 15 a 1,1 0 0 0 0.0293,-0.006 h 2.9707 a 1.0001,1.0001 0 0 0 0.98828,-0.84375 l 0.93945,-5.96875 a 1,1 0 0 0 -0.83203,-1.14453 1,1 0 0 0 -1.14453,0.83398 L 373.16211,261 h -16.32422 l -1.80078,-8.99414 h 12.08399 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -12.48438 l -0.63867,-3.19531 a 1.0001,1.0001 0 0 0 -0.98047,-0.80469 z" id="path21235" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> </g> </g></svg></a>
          </div>
        </div>
        <div id="divAnadir" style="display : none">
          <div style="display : flex ; flex-direction : column" class="border-bottom" >
            <h6>Añadir articulo a pedido</h6>
            <div class="row g-3 align-items-center ">
                <div class="col mb-3">
                    <label for="codigoArticulo" class="col-form-label">Codigo Articulo</label>
                </div>
                <div class="col input-group mb-3">
                    <input type="text" id="codigoArticulo" class="form-control" onkeyup="enterCodigoArticulo(event)">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="abrirModalArticulos()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                    </div>
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
                    <input number="text" id="cantidad" class="form-control" onkeyup="enterCantidad(event)">
                </div>
                <div class="col mb-3">
                    <label for="cantidad" class="col-form-label" >Total</label>
                </div>
                <div class="col mb-3">
                    <input number="text" id="totalText" class="form-control" readonly>
                </div>
            </div>
            <div class="row g-3 align-items-center ">
                <div class="col mb-3">
                    <label for="descripcionArticulo" class="col-form-label">Descripcion del articulo</label>
                    <textarea number="text" id="descripcionArticulo" class="form-control"></textarea>
                </div>
                
            </div>
            <div class="row g-3 align-items-center ">
                <div class="col mb-3">
                  <button class="btn btn-primary" onclick="document.getElementById('uploadImage').click()">Seleccionar imagenes <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C14.7614 18 17 15.7614 17 13C17 10.2386 14.7614 8 12 8C9.23858 8 7 10.2386 7 13C7 15.7614 9.23858 18 12 18ZM12 16.0071C10.3392 16.0071 8.9929 14.6608 8.9929 13C8.9929 11.3392 10.3392 9.9929 12 9.9929C13.6608 9.9929 15.0071 11.3392 15.0071 13C15.0071 14.6608 13.6608 16.0071 12 16.0071Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.56155 2C8.18495 2 6.985 2.93689 6.65112 4.27239L6.21922 6H4C2.34315 6 1 7.34315 1 9V19C1 20.6569 2.34315 22 4 22H20C21.6569 22 23 20.6569 23 19V9C23 7.34315 21.6569 6 20 6H17.7808L17.3489 4.27239C17.015 2.93689 15.8151 2 14.4384 2H9.56155ZM8.59141 4.75746C8.7027 4.3123 9.10268 4 9.56155 4H14.4384C14.8973 4 15.2973 4.3123 15.4086 4.75746L15.8405 6.48507C16.0631 7.37541 16.863 8 17.7808 8H20C20.5523 8 21 8.44772 21 9V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V9C3 8.44772 3.44772 8 4 8H6.21922C7.13696 8 7.93692 7.37541 8.15951 6.48507L8.59141 4.75746Z" fill="#ffffff"></path> </g></svg></button>
                  <input accept="image/*" type="file" id="uploadImage" name="termek_file" class="file_input" multiple style="display: none"/>
                  <div id="result" class="row g-3 align-items-center">
                    
                  </div>
                </div>
            </div>
            <div class="row g-3 align-items-center" style="margin-top:5px;">
                <div class="col mb-3">
                  <Button class="btn btn-primary"  onClick="agregarDatos()">Agregar Articulo<svg width="24px" height="24px" viewBox="0 0 32 32" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs2"></defs> <g id="layer1" transform="translate(36,-292)"> <path d="m -27,316.00586 c -1.645008,0 -3,1.35499 -3,3 0,1.64501 1.354992,3 3,3 1.645008,0 3,-1.35499 3,-3 0,-1.64501 -1.354992,-3 -3,-3 z m 0,2 c 0.564129,0 1,0.43587 1,1 0,0.56413 -0.435871,1 -1,1 -0.564129,0 -1,-0.43587 -1,-1 0,-0.56413 0.435871,-1 1,-1 z" id="circle5359" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m -13,316.00586 c -1.645008,0 -3,1.35499 -3,3 0,1.64501 1.354992,3 3,3 1.645008,0 3,-1.35499 3,-3 0,-1.64501 -1.354992,-3 -3,-3 z m 0,2 c 0.564129,0 1,0.43587 1,1 0,0.56413 -0.435871,1 -1,1 -0.564129,0 -1,-0.43587 -1,-1 0,-0.56413 0.435871,-1 1,-1 z" id="circle5361" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m -12,294.00586 c -3.30186,0 -6,2.69814 -6,6 0,3.30186 2.69814,6 6,6 3.30186,0 6,-2.69814 6,-6 0,-3.30186 -2.69814,-6 -6,-6 z m 0,2 c 2.2209809,0 4,1.77902 4,4 0,2.22098 -1.7790191,4 -4,4 -2.220981,0 -4,-1.77902 -4,-4 0,-2.22098 1.779019,-4 4,-4 z" id="circle43373-3" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m -9.8984375,298.01172 a 1,1 0 0 0 -0.7343755,0.21875 l -2.029296,1.65625 -0.65625,-0.61133 a 1,1 0 0 0 -1.41211,0.0488 1,1 0 0 0 0.04883,1.41211 l 1.292969,1.20898 a 1.0001,1.0001 0 0 0 1.3125,0.043 l 2.7089845,-2.20703 a 1,1 0 0 0 0.1425781,-1.40625 1,1 0 0 0 -0.6738281,-0.36328 z" id="path43375-6" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m -32.95117,294 a 1,1 0 0 0 -1,1 1,1 0 0 0 1,1 h 1.17969 l 2.65039,13.24219 c -1.07078,0.46018 -1.83008,1.52737 -1.83008,2.75781 0,1.6447 1.3553,3 3,3 h 17 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -17 c -0.5713,0 -1,-0.4287 -1,-1 0,-0.5713 0.4287,-1 1,-1 h 15 a 1,1 0 0 0 0.0293,-0.006 h 2.9707 a 1.0001,1.0001 0 0 0 0.98828,-0.84375 l 0.93945,-5.96875 A 1,1 0 0 0 -8.85547,303.03697 1,1 0 0 0 -10,303.87095 l -0.80664,5.12319 H -27.13086 L -28.93164,300 h 12.08399 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -12.48438 l -0.63867,-3.19531 A 1.0001,1.0001 0 0 0 -30.95117,294 Z" id="path21288" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> </g> </g></svg></Button>
                  <Button class="btn btn-primary"  onClick="cancelar()">Cancelar<svg width="24px" height="24px" viewBox="0 0 32 32" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs2"></defs> <g id="layer1" transform="translate(-348,-244)"> <path d="m 357,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5331" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 371,268.00586 c -1.64501,0 -3,1.35499 -3,3 0,1.64501 1.35499,3 3,3 1.64501,0 3,-1.35499 3,-3 0,-1.64501 -1.35499,-3 -3,-3 z m 0,2 c 0.56413,0 1,0.43587 1,1 0,0.56413 -0.43587,1 -1,1 -0.56413,0 -1,-0.43587 -1,-1 0,-0.56413 0.43587,-1 1,-1 z" id="circle5333" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 372,246.00586 c -3.30186,0 -6,2.69814 -6,6 0,3.30186 2.69814,6 6,6 3.30186,0 6,-2.69814 6,-6 0,-3.30186 -2.69814,-6 -6,-6 z m 0,2 c 2.22098,0 4,1.77902 4,4 0,2.22098 -1.77902,4 -4,4 -2.22098,0 -4,-1.77902 -4,-4 0,-2.22098 1.77902,-4 4,-4 z" id="circle5337" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 370.58594,249.5918 a 1,1 0 0 0 -0.70703,0.29297 1,1 0 0 0 0,1.41406 l 0.70703,0.70703 -0.70703,0.70703 a 1,1 0 0 0 0,1.41406 1,1 0 0 0 1.41406,0 L 372,253.41992 l 0.70703,0.70703 a 1,1 0 0 0 1.41406,0 1,1 0 0 0 0,-1.41406 l -0.70703,-0.70703 0.70703,-0.70703 a 1,1 0 0 0 0,-1.41406 1,1 0 0 0 -0.70703,-0.29297 1,1 0 0 0 -0.70703,0.29297 L 372,250.5918 l -0.70703,-0.70703 a 1,1 0 0 0 -0.70703,-0.29297 z" id="path5339" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> <path d="m 351.01758,246.00586 a 1,1 0 0 0 -1,1 1,1 0 0 0 1,1 h 1.17969 l 2.65039,13.24219 c -1.07078,0.46018 -1.83008,1.52737 -1.83008,2.75781 0,1.6447 1.3553,3 3,3 h 17 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -17 c -0.5713,0 -1,-0.4287 -1,-1 0,-0.5713 0.4287,-1 1,-1 h 15 a 1,1 0 0 0 0.0293,-0.006 h 2.9707 a 1.0001,1.0001 0 0 0 0.98828,-0.84375 l 0.93945,-5.96875 a 1,1 0 0 0 -0.83203,-1.14453 1,1 0 0 0 -1.14453,0.83398 L 373.16211,261 h -16.32422 l -1.80078,-8.99414 h 12.08399 a 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 h -12.48438 l -0.63867,-3.19531 a 1.0001,1.0001 0 0 0 -0.98047,-0.80469 z" id="path21235" style="color:#ffffff;fill:#ffffff;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none"></path> </g> </g></svg></Button>

                </div>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 border-bottom">
            <div style="display : flex ; flex-direction : column" class="border-bottom" >
              <h3>Datos del cliente</h3>
              <div class="row g-3 align-items-center ">
                  <div class="col mb-3">
                      <label for="nombreCliente" class="col-form-label">Nombre: </label>
                  </div>
                  <div class="col input-group mb-3">
                      <input type="text" id="nombreCliente" class="form-control">
                  </div>
                  <div class="col mb-3">
                      <label for="numeroCliente" class="col-form-label">Numero Celular: </label>
                  </div>
                  <div class="col mb-3">
                      <input type="text" id="numeroCliente" class="form-control">
                  </div>
                  <div class="mb-3 col-md-4 d-flex flex-row" style= "margin-left:10px">
                    <label for="fechaPedido" class="col-form-label col-md-4">Fecha Vencimiento pedido:</label>
                    <input type="date" id="fechaPedido" class="form-control">
                  </div>
              </div>
            </div>
            <div id="divTabla">
              <h3>Articulos en el pedido</h3>
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
                      <th scope="col"><button class="btn btn-primary" onClick="mostrarAnadir()"><svg height="24px" width="24px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M198.745,439.889c-5.698-3.854-12.636-6.128-20.013-6.119c-4.921,0-9.659,1-13.943,2.82 c-6.434,2.721-11.875,7.244-15.737,12.958c-3.862,5.698-6.128,12.636-6.112,20.012c-0.008,4.912,0.993,9.651,2.812,13.934 c2.728,6.443,7.244,11.884,12.95,15.737c5.706,3.871,12.652,6.128,20.029,6.128c4.912,0,9.643-1.001,13.926-2.82 c6.442-2.721,11.883-7.253,15.746-12.958c3.854-5.698,6.12-12.645,6.12-20.022c0-4.911-1.009-9.642-2.82-13.934 C208.975,449.184,204.451,443.743,198.745,439.889z M192.03,475.176c-1.092,2.58-2.936,4.805-5.243,6.359 c-2.316,1.555-5.028,2.456-8.055,2.464c-2.026-0.008-3.903-0.405-5.615-1.142c-2.572-1.074-4.805-2.927-6.36-5.226 c-1.555-2.324-2.456-5.044-2.464-8.072c0.009-2.018,0.413-3.887,1.133-5.615c1.083-2.572,2.936-4.796,5.242-6.358 c2.316-1.555,5.037-2.448,8.064-2.457c2.018,0,3.887,0.406,5.607,1.133c2.58,1.083,4.796,2.927,6.351,5.243 c1.563,2.315,2.464,5.028,2.464,8.054C193.154,471.587,192.75,473.456,192.03,475.176z"></path> <path class="st0" d="M216.525,283.808c7.278-2.117,11.462-9.75,9.328-17.036l-35.576-121.796 c-2.117-7.286-9.742-11.462-17.028-9.337c-7.285,2.126-11.453,9.75-9.336,17.028l35.576,121.812 C201.622,281.757,209.247,285.941,216.525,283.808z"></path> <path class="st0" d="M256.98,265.416c2.134,7.286,9.759,11.462,17.035,9.336c7.278-2.125,11.463-9.749,9.329-17.035 l-32.996-112.972c-2.117-7.285-9.742-11.462-17.027-9.344c-7.286,2.133-11.462,9.758-9.337,17.035L256.98,265.416z"></path> <path class="st0" d="M314.554,256.625c2.125,7.286,9.758,11.462,17.035,9.337c7.278-2.126,11.462-9.759,9.328-17.036 l-30.49-104.412c-2.126-7.286-9.75-11.462-17.028-9.328c-7.285,2.117-11.462,9.75-9.336,17.027L314.554,256.625z"></path> <path class="st0" d="M371.945,247.248c2.134,7.286,9.758,11.462,17.035,9.336c7.278-2.133,11.462-9.749,9.337-17.035 l-27.828-95.275c-2.117-7.285-9.75-11.453-17.036-9.336c-7.277,2.134-11.453,9.758-9.328,17.035L371.945,247.248z"></path> <path class="st0" d="M168.726,392.844c-3.871,0-7.492-0.778-10.817-2.176c-4.97-2.1-9.246-5.64-12.239-10.089 c-2.878-4.276-4.582-9.312-4.714-14.836c0.148-6.592,2.249-12.313,5.937-16.887c1.91-2.357,4.267-4.424,7.128-6.136 c2.828-1.687,6.161-3.027,10.073-3.87l244.335-39.769c15.961-2.605,28.663-14.81,31.888-30.664l29.887-146.928v-0.016 c0.347-1.704,0.513-3.44,0.513-5.16c0-5.938-2.035-11.743-5.855-16.424c-4.93-6.02-12.306-9.518-20.088-9.518h-338.32 L94.928,50.769v0.008c-5.293-17.705-19.814-31.118-37.875-34.988L15.688,6.931C8.691,5.426,1.795,9.892,0.289,16.896 c-1.496,7.004,2.96,13.901,9.974,15.398l41.348,8.865c8.798,1.885,15.878,8.418,18.458,17.052l75.584,259.634 c-1.703,0.794-3.349,1.654-4.937,2.605c-8.146,4.855-14.679,11.669-19.061,19.624c-4.194,7.558-6.418,16.126-6.632,24.966h-0.033 v1.348h0.033c0.165,6.906,1.637,13.529,4.192,19.575c4.094,9.667,10.891,17.846,19.458,23.634 c8.56,5.796,18.971,9.196,30.052,9.187h137.272c-0.042-1.281-0.194-2.53-0.194-3.82c0-7.567,0.781-14.952,2.174-22.121H168.726z M113.998,116.314h330.778h0.009l-29.887,146.935c-1.076,5.293-5.31,9.362-10.635,10.222L170.81,311.478L113.998,116.314z"></path> <path class="st0" d="M421.604,324.569c-49.924,0-90.396,40.472-90.396,90.396s40.472,90.396,90.396,90.396 c49.932,0,90.396-40.472,90.396-90.396S471.536,324.569,421.604,324.569z M473.264,430.032h-36.593v36.585h-30.127v-36.585h-36.594 v-30.134h36.594v-36.594h30.127v36.594h36.593V430.032z"></path> </g> </g></svg></button></th>
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
            <input type="text" id="srcBuscarArticulo" onkeyup="buscarTeclado()" class="form-control">
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
  <?php
    require_once 'components/logoutModal.php' ;
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
    const dt = new DataTransfer(); 
    let files = [] ;
    let imagenes = [] ;
    let articulosPedido = [] ;
    let articuloSeleccionado = null ; 
    let articulosModal = [] ;
    let srcArticulo = "" ; 
    let tipoPago = 0 ; 
    let carruselSalida = ``;
    let estaEditando = 0 ; 
    let articuloEditar = null ; 
    let indiceEditar = -1 ; 
    let totalArticulos = 0 ;
    let totalVenta = 0 ;
    let idCorte = 0 ;

    function renderImagenes(event, output){
      
    }
    window.onload = async function() {
      const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });
      const json1 = await responseCorte.json();
      console.log(json1) ;
      idCorte = json1.data.idCorte ;
      if (window.File && window.FileList && window.FileReader) {
        let filesInput = document.getElementById("uploadImage");
        filesInput.addEventListener("change", function(event) {
          let files = event.target.files;
          //this.files =event.target.files ;
          imagenes = event.target.files ; 
          //console.log("Log Files ")
          //console.log(files);
          let output = document.getElementById("result");
          for (let i = 0; i < files.length; i++) {
            let file = files[i];
            dt.items.add(file);
            if (!file.type.match('image'))
              continue;
            let picReader = new FileReader();
            picReader.addEventListener("load", function(event) {
              let picFile = event.target; 
              let div = document.createElement("div");
              div.classList.add("col");
              let salida = `<div class="card" style="width:400px; height:400px" id="cde${i}">
                              <img class="card-img-top" <img src='${picFile.result}' style="width:400px; height:400px" alt="Card image" title="${picFile.name}">
                              <div class="card-img-overlay">
                                <div style="witdh:100%; display : flex; flex-direction : row; justify-content: end;">
                                  <button class="btn btn-danger" onClick="remover(${i})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button>
                                </div>
                              </div>
                            </div>` ; 
              
              div.innerHTML = salida ;
              output.insertBefore(div, null);
            });        
            picReader.readAsDataURL(file);
            //console.log(file);
          }//

        });
      }
    }

    function remover(index){
      //let filesInput = document.getElementById("uploadImage").value;
      document.getElementById('cde' + index).remove();
      dt.items.remove(index);
      //console.log(dt.items);
      /*
      dt.items.forEach(element => {
        console.log(element)
      });
      */
      //console.log(dt);
    }

    async function enviarDatosImagenes(){
      //console.log(imagenes) ;
      //console.log(dt.files);
      let formData = new FormData();
      formData.append('idPedido' ,"1");
      formData.append('cveArticulo' , "NA")
      for(let index = 0 ; index < imagenes.length ; index++){
        formData.append('imagen[]', imagenes[index]);
      }
      
      //console.log(formData.get("imagen")); // Returns "Chris";
      const response = await fetch('http://localhost/sieslite-ropa/api/pedidos.php?opc=1', {
          method: 'POST',
          body: formData
      });
      //const json = await response.json();
      //console.log(json)
      const result = await response.json() ;
      //console.log(result);

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
      //console.log(event)
      if(keycode == '13'){
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
              document.getElementById("descripcionArticulo").value = articuloSeleccionado.nombre ;
              document.getElementById("cantidad").focus() ;
          }else{
              Swal.fire('Favor de ingresar un codigo para su busqueda', '', 'info');
          }
      }
    }

    function abrirCerrarModal(opcion){
      let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulos'));
      if(opcion==0) 
      modal.show() 
      else 
      modal.hide();
    }

    function obtenerArticuloArrayIndice(indice){
      return articulosModal.filter((art , index) => indice == index)[0];
    }

    function mostrarAnadir(){
      document.getElementById('divAnadir').style.display = 'Block' ;
    }

async function enterCantidad(event){
  let keycode = event.keyCode;
  let cantidadTxt =  parseFloat(document.getElementById("cantidad").value) ;
  if(keycode == '13' && articuloSeleccionado!= null && cantidadTxt > 0){
      
    document.getElementById("totalText").value = (articuloSeleccionado.precio * cantidadTxt) ;
    
    
    document.getElementById("descripcionArticulo").focus() ;  
      
  }else if(keycode == '13' && indiceEditar != -1 && articuloSeleccionado == null && cantidadTxt > 0){// parte de editar y agarrar objeto de editar
    //console.log(articuloEditar);
    document.getElementById("totalText").value = (articuloEditar.precioUnitario * cantidadTxt) ;
    document.getElementById("descripcionArticulo").focus() ;  
  }
}
  
function agregarDatos(){
  let codigoArticulo = document.getElementById("codigoArticulo").value;
  let precioUnitario = parseFloat(document.getElementById("precioUnitario").value);
  let cantidadTxt =  parseFloat(document.getElementById("cantidad").value) ;
  let total = parseFloat(document.getElementById("totalText").value) ;
  let descripcion = document.getElementById("descripcionArticulo").value ; 
  
 
  if(indiceEditar == -1){// agregar articulo al pedido
    //console.log("imagenes antes de pushear ")
    //console.log(imagenes);
    //console.log("dt de imagenes antes de pushear")
    //console.log(dt.items)
    let auxImagenes =  [] ; 
    //console.log("length de dt" ,dt.items.length);
    for(let i = 0 ; i < dt.items.length ; i++){
      auxImagenes[i] = dt.items[i];
    }
    //console.log(auxImagenes)
    //console.log("--------");
    //imagenes :dt.items
    let articuloPedido = {
      idArticulo :articuloSeleccionado.idArticulo,
      claveArticulo :codigoArticulo,
      nombreArticulo :articuloSeleccionado.nombre,
      precioUnitario :precioUnitario ,
      cantidad :  cantidadTxt , 
      total : total,
      descripcionArticulo : descripcion,
      imagenes : auxImagenes
    } ;
    //console.log(articuloPedido);
    //console.log("--------");
    articulosPedido.push(articuloPedido);
    articuloSeleccionado = null ; 
  }else{
    //articuloEditar
    //console.log("------ parte de editar --------")
    //console.log(articuloEditar);
    let auxImagenes =  [] ; 
    //console.log("length de dt" ,dt.items.length);
    for(let i = 0 ; i < dt.items.length ; i++){
      auxImagenes[i] = dt.items[i];
    }
    let auxArt = articuloSeleccionado == null ? articuloEditar : articuloSeleccionado ; // con esto se si se ah seleccionado un articulo nuevo distinto 
    console.log(auxArt)
    let articuloPedido = {
      idArticulo : auxArt.idArticulo,
      claveArticulo :codigoArticulo,
      nombreArticulo : auxArt.nombre,
      precioUnitario : precioUnitario ,
      cantidad :  cantidadTxt , 
      total : total,
      descripcionArticulo : descripcion,
      imagenes : auxImagenes
    } ;

    articulosPedido[indiceEditar] =articuloPedido ; 
    indiceEditar = -1 ;
    estaEditando = 0 ;
  }
  
  renderTabla();
  document.getElementById("srcBuscarArticulo").value = "" ;
  document.getElementById("codigoArticulo").value = "" ;
  document.getElementById("cantidad").value = "" ;
  document.getElementById("precioUnitario").value = "" ;
  document.getElementById("descripcionArticulo").value = "" ;
  srcArticulo = "" ; 
  imagenes = [] ;
  dt.items.clear();
  //document.getElementById("codigoArticulo").focus() ;  
  document.getElementById('divAnadir').style.display = 'None' ;
  document.getElementById("result").innerHTML = "" ;
  document.getElementById("uploadImage").value = "";

}

function renderTabla(){
    let totalArticulosR = 0.0 ;
    let totalVentaR = 0 ; 
    let tableSalida  = `<h2>Articulos en el pedido</h2><table class="table" id="tablaVenta">
            <thead>
                <tr>
                <th scope="col">Codigo Articulo</th>
                <th scope="col">Nombre Articulo</th>
                <th scope="col">Cantidad Articulos</th>
                <th scope="col">Precio</th>
                <th scope="col">Total</th>
                <th scope="col"></th>

                <th scope="col"><button class="btn btn-primary" onClick="mostrarAnadir()"><svg height="24px" width="24px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M198.745,439.889c-5.698-3.854-12.636-6.128-20.013-6.119c-4.921,0-9.659,1-13.943,2.82 c-6.434,2.721-11.875,7.244-15.737,12.958c-3.862,5.698-6.128,12.636-6.112,20.012c-0.008,4.912,0.993,9.651,2.812,13.934 c2.728,6.443,7.244,11.884,12.95,15.737c5.706,3.871,12.652,6.128,20.029,6.128c4.912,0,9.643-1.001,13.926-2.82 c6.442-2.721,11.883-7.253,15.746-12.958c3.854-5.698,6.12-12.645,6.12-20.022c0-4.911-1.009-9.642-2.82-13.934 C208.975,449.184,204.451,443.743,198.745,439.889z M192.03,475.176c-1.092,2.58-2.936,4.805-5.243,6.359 c-2.316,1.555-5.028,2.456-8.055,2.464c-2.026-0.008-3.903-0.405-5.615-1.142c-2.572-1.074-4.805-2.927-6.36-5.226 c-1.555-2.324-2.456-5.044-2.464-8.072c0.009-2.018,0.413-3.887,1.133-5.615c1.083-2.572,2.936-4.796,5.242-6.358 c2.316-1.555,5.037-2.448,8.064-2.457c2.018,0,3.887,0.406,5.607,1.133c2.58,1.083,4.796,2.927,6.351,5.243 c1.563,2.315,2.464,5.028,2.464,8.054C193.154,471.587,192.75,473.456,192.03,475.176z"></path> <path class="st0" d="M216.525,283.808c7.278-2.117,11.462-9.75,9.328-17.036l-35.576-121.796 c-2.117-7.286-9.742-11.462-17.028-9.337c-7.285,2.126-11.453,9.75-9.336,17.028l35.576,121.812 C201.622,281.757,209.247,285.941,216.525,283.808z"></path> <path class="st0" d="M256.98,265.416c2.134,7.286,9.759,11.462,17.035,9.336c7.278-2.125,11.463-9.749,9.329-17.035 l-32.996-112.972c-2.117-7.285-9.742-11.462-17.027-9.344c-7.286,2.133-11.462,9.758-9.337,17.035L256.98,265.416z"></path> <path class="st0" d="M314.554,256.625c2.125,7.286,9.758,11.462,17.035,9.337c7.278-2.126,11.462-9.759,9.328-17.036 l-30.49-104.412c-2.126-7.286-9.75-11.462-17.028-9.328c-7.285,2.117-11.462,9.75-9.336,17.027L314.554,256.625z"></path> <path class="st0" d="M371.945,247.248c2.134,7.286,9.758,11.462,17.035,9.336c7.278-2.133,11.462-9.749,9.337-17.035 l-27.828-95.275c-2.117-7.285-9.75-11.453-17.036-9.336c-7.277,2.134-11.453,9.758-9.328,17.035L371.945,247.248z"></path> <path class="st0" d="M168.726,392.844c-3.871,0-7.492-0.778-10.817-2.176c-4.97-2.1-9.246-5.64-12.239-10.089 c-2.878-4.276-4.582-9.312-4.714-14.836c0.148-6.592,2.249-12.313,5.937-16.887c1.91-2.357,4.267-4.424,7.128-6.136 c2.828-1.687,6.161-3.027,10.073-3.87l244.335-39.769c15.961-2.605,28.663-14.81,31.888-30.664l29.887-146.928v-0.016 c0.347-1.704,0.513-3.44,0.513-5.16c0-5.938-2.035-11.743-5.855-16.424c-4.93-6.02-12.306-9.518-20.088-9.518h-338.32 L94.928,50.769v0.008c-5.293-17.705-19.814-31.118-37.875-34.988L15.688,6.931C8.691,5.426,1.795,9.892,0.289,16.896 c-1.496,7.004,2.96,13.901,9.974,15.398l41.348,8.865c8.798,1.885,15.878,8.418,18.458,17.052l75.584,259.634 c-1.703,0.794-3.349,1.654-4.937,2.605c-8.146,4.855-14.679,11.669-19.061,19.624c-4.194,7.558-6.418,16.126-6.632,24.966h-0.033 v1.348h0.033c0.165,6.906,1.637,13.529,4.192,19.575c4.094,9.667,10.891,17.846,19.458,23.634 c8.56,5.796,18.971,9.196,30.052,9.187h137.272c-0.042-1.281-0.194-2.53-0.194-3.82c0-7.567,0.781-14.952,2.174-22.121H168.726z M113.998,116.314h330.778h0.009l-29.887,146.935c-1.076,5.293-5.31,9.362-10.635,10.222L170.81,311.478L113.998,116.314z"></path> <path class="st0" d="M421.604,324.569c-49.924,0-90.396,40.472-90.396,90.396s40.472,90.396,90.396,90.396 c49.932,0,90.396-40.472,90.396-90.396S471.536,324.569,421.604,324.569z M473.264,430.032h-36.593v36.585h-30.127v-36.585h-36.594 v-30.134h36.594v-36.594h30.127v36.594h36.593V430.032z"></path> </g> </g></svg></button></th>
                </tr>
            </thead><tbody>`;
    articulosPedido.map((articulo , index)=> {
        //console.log(articulo);
        tableSalida += `<tr>
            <th scope="row">${articulo.claveArticulo}</th>
            <th>${articulo.nombreArticulo}</th>
            <th>${articulo.cantidad}</th>
            <th>${articulo.precioUnitario}</th>
            <th>${articulo.total}</th>
            <th><button class="btn btn-primary" onClick="editarArticulo(${index})"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V7C19 7.55228 19.4477 8 20 8C20.5523 8 21 7.55228 21 7V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM22.1213 10.7071C20.9497 9.53553 19.0503 9.53553 17.8787 10.7071L16.1989 12.3869L11.2929 17.2929C11.1647 17.4211 11.0738 17.5816 11.0299 17.7575L10.0299 21.7575C9.94466 22.0982 10.0445 22.4587 10.2929 22.7071C10.5413 22.9555 10.9018 23.0553 11.2425 22.9701L15.2425 21.9701C15.4184 21.9262 15.5789 21.8353 15.7071 21.7071L20.5556 16.8586L22.2929 15.1213C23.4645 13.9497 23.4645 12.0503 22.2929 10.8787L22.1213 10.7071ZM18.3068 13.1074L19.2929 12.1213C19.6834 11.7308 20.3166 11.7308 20.7071 12.1213L20.8787 12.2929C21.2692 12.6834 21.2692 13.3166 20.8787 13.7071L19.8622 14.7236L18.3068 13.1074ZM16.8923 14.5219L18.4477 16.1381L14.4888 20.097L12.3744 20.6256L12.903 18.5112L16.8923 14.5219Z" fill="#ffffff"></path> </g></svg></th>
            <th><button class="btn btn-danger" onClick="removerArticulo(${index})"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H10M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V10.8125" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14.0251 15.0251C13.3918 15.6585 13 16.5335 13 17.5C13 19.433 14.567 21 16.5 21C17.4665 21 18.3415 20.6082 18.9749 19.9749M14.0251 15.0251C14.6585 14.3918 15.5335 14 16.5 14C18.433 14 20 15.567 20 17.5C20 18.4665 19.6082 19.3415 18.9749 19.9749M14.0251 15.0251L16.5 17.5L18.9749 19.9749" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> </g></svg></button></th>  
            </tr>`; 
        totalArticulosR += articulo.cantidad ;
        totalVentaR +=articulo.total;
    });
    if(articulosPedido.length > 0){
        tableSalida += `<tr>
            <th></th>    
            <th>Total Articulos</th>
            <th>${totalArticulosR}</th>
            <th>Total Pedido: </th>
            <th>$${totalVentaR}</th>   
            <th></th>
            <th></th>        
        </tr>`;
        tableSalida += `<tr>
            <th></th>    
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><button class="btn btn-primary" onClick="guardarPedido()">Guardar Pedido</th>       
        </tr>`;
        let formaPago = tipoPago == 0 ? "Efectivo"  : "Tarjeta";
    }
    
    
    tableSalida += `</tbody></table>`;
    totalArticulos =totalArticulosR ;
    totalVenta =totalVentaR;
    document.getElementById("divTabla").innerHTML = tableSalida ; 
    //document.getElementById("divTicket").innerHTML = tableTicket ; 
}

function removerArticulo(indice){
    if(estaEditando == 1) // esto es para prevenir que vuelva a mandar a llamar otra vaina en lo que hace una 
    {
      Swal.fire('Se encuentra editando un articulo, favor de terminar la edicion actual antes de remover un articulo de la lista', '', 'info');
      return ; 
    }
    artFiltered = articulosPedido.filter((articulo  , index)=> index != indice);
    articulosPedido = artFiltered ;
    renderTabla();
}

function editarArticulo(indice){
  console.log(estaEditando)
    if(estaEditando == 1) // esto es para prevenir que vuelva a mandar a llamar otra vaina en lo que hace una 
    {
      Swal.fire('ya se encuentra editando un articulo, favor de terminar la edicion actual', '', 'info');
      return ; 
    }
    estaEditando = 1 ; 
    //console.log(indice);
    //console.log(articulosPedido);
    articuloEditar = articulosPedido.filter((articulo  , index)=> index == indice)[0];
    indiceEditar =indice;
    //console.log("method editar");
    //console.log(articuloEditar);
    document.getElementById('divAnadir').style.display = 'Block' ;
    document.getElementById("codigoArticulo").value = articuloEditar.claveArticulo ;
    document.getElementById("cantidad").value = articuloEditar.cantidad ;
    document.getElementById("precioUnitario").value = articuloEditar.precioUnitario ;
    document.getElementById("descripcionArticulo").value = articuloEditar.descripcionArticulo ;
    let output = document.getElementById("result");
    //console.log(articuloEditar.imagenes);
    for (let i = 0; i < articuloEditar.imagenes.length; i++) {
      //console.log("For in editar imagenes");
      //console.log(articuloEditar.imagenes[i])
      let file = articuloEditar.imagenes[i];
      dt.items.add(file.getAsFile());
      //imagenes[i] =file ;
      //dt.items.add(file);
      if (!file.type.match('image'))
        continue;
      let picReader = new FileReader();
      picReader.addEventListener("load", function(event) {
        let picFile = event.target; 
        //console.log(picFile);
        let div = document.createElement("div");
        div.classList.add("col");
        let salida = `<div class="card hoverable" style="width:400px; height:400px" id="cde${i}">
                        <img class="card-img-top" <img src='${picFile.result}' style="width:400px; height:400px" alt="Card image" title="${picFile.name}">
                        <div class="card-img-overlay">
                          <div style="witdh:100%; display : flex; flex-direction : row; justify-content: end;">
                            <button class="btn btn-danger" onClick="remover(${i})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button>
                          </div>
                        </div>
                      </div>` ; 
        
        div.innerHTML = salida ;
        output.insertBefore(div, null);
      });        
      picReader.readAsDataURL(file.getAsFile());
    }
}

async function guardarPedido(){
// aqui ira la parte de peticion de los objetos 
  try{
    let nombreCliente = document.getElementById("nombreCliente").value ;
    let numeroCliente = document.getElementById("numeroCliente").value ;
    let fechaPedido = document.getElementById("fechaPedido").value
      //totalArticulos
      //totalPedido
      /*
      let totalArticulos = 0 ;
      let totalVenta = 0 ; 
      */
    
    //console.log(articulosPedido)
    if (nombreCliente == "") {
      Swal.fire('Favor de ingresar el nombre del cliente', '', 'info');
      return ; 
    }
    if (numeroCliente == "") {
      Swal.fire('Favor de ingresar el numero del cliente', '', 'info');
      return ; 
    }
    if (fechaPedido == "") {
      Swal.fire('Favor de ingresar la fecha del pedido', '', 'info');
      return ; 
    }
    let respuestaDialog = await Swal.fire({
      title: 'Desea Guardar el pedido?',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      denyButtonText: `Cancelar`,
    }); 

    if(respuestaDialog.isConfirmed){
      let jsonRequest = {
          "idUsuario" : <?php echo $_SESSION['idUsuario'] ?>, 
          "idCorte":idCorte,
          "nombreCliente" : nombreCliente,  
          "numeroCliente" : numeroCliente , 
          "totalArticulos" : totalArticulos, 
          "totalPedido": totalVenta ,  
          "fechaVencimiento" : fechaPedido, 
          "articulos" : articulosPedido
      }
      console.log(jsonRequest);
      const response = await fetch('http://localhost/sieslite/api/pedidos.php?opc=2', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify(jsonRequest)
      });
      const json = await response.json();
      let idPedido = json.data.idPedido ;
      let articulosRecibidos = json.data.articulos ; 
      console.log("idPedido " , idPedido);
      console.log(articulosRecibidos);
      console.log(articulosPedido);
      for(const indx in articulosPedido){
        console.log("Articulo en articulosPedido")
        let auxArt =articulosPedido[indx]; 
        console.log(auxArt);
        let articuloRecibido = articulosRecibidos.filter((art) => art.idArticulo == auxArt.idArticulo)[0];
        console.log("articulo recibido ");
        console.log(articuloRecibido);
        let formData = new FormData();
        formData.append('idPedido' , idPedido);
        formData.append('idPedidoArticulo' , articuloRecibido.idPedidoArticulo);
        for(let idx = 0 ; idx < auxArt.imagenes.length ; idx++){
          formData.append('imagen[]', auxArt.imagenes[idx].getAsFile());
        }
        const response = await fetch('http://localhost/sieslite/api/pedidosImagenes.php?opc=1', {
            method: 'POST',
            body: formData
        });
        const result = await response.json() ;
        console.log(result);
      }
      
      Swal.fire({
        title: "Pedido realizado con exito",
        text: "Folio del pedido generado: " + idPedido,
        icon: "success",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: '<a style="color :white" href="/sieslite/pedidos.php">Aceptar</a>'
      })
    }
  }catch(err){
    console.log(err)
  }
}

function cancelar(){
  articuloSeleccionado = null ; 
  renderTabla();
  document.getElementById("srcBuscarArticulo").value = "" ;
  document.getElementById("codigoArticulo").value = "" ;
  document.getElementById("cantidad").value = "" ;
  document.getElementById("precioUnitario").value = "" ;
  document.getElementById("descripcionArticulo").value = "" ;
  srcArticulo = "" ; 
  imagenes = [] ;
  dt.items.clear();
  //document.getElementById("codigoArticulo").focus() ;  
  document.getElementById('divAnadir').style.display = 'None' ;
  document.getElementById("result").innerHTML = "" ;
  document.getElementById("uploadImage").value = "";
  estaEditando = 0 ;  
}
    
    </script>
  </body>
</html>
