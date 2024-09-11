
function generateTable(dataArray, btnOptions){


let tableSalida  = `<table id="tbl_exporttable_to_xls" class="table">
                    <thead>
                        <tr>
                        <th scope="col">Gasto/Entrada</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Costo Total</th>
                        <th scope="col">Fecha Alta</th>
                        <th scope="col">Folio Corte</th>
                        <th scope="col"></th>
                        <th scope="col"><button class="btn btn-primary" onclick="editarCrear(null)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M7.75 2a.75.75 0 0 1 .75.75V7h4.25a.75.75 0 0 1 0 1.5H8.5v4.25a.75.75 0 0 1-1.5 0V8.5H2.75a.75.75 0 0 1 0-1.5H7V2.75A.75.75 0 0 1 7.75 2Z"></path></svg></button></th>

                        </tr>
                    </thead><tbody>`;
dataArray.map((dato , index)=> {
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
}

