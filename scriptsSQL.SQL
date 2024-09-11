INSERT INTO venta_tiene_articulos (idArticulo, idVenta, cantidad, precioUnitario, total, status) VALUES(0, 0, 0.00, 0.00, NULL, 1);

SELECT idVenta, status, totalArticulos, totalVenta, fechaVenta, idUsuario, metodoPago, idCorte FROM ventas v 
inner join usuarios u on v.idUsuario  = u.idUsuario ;


select * from gasto_entrada  ge where ge.idCorte = 1  ; 

select sum(ge.montoTotal) from gasto_entrada ge where ge.idCorte = 1  and status = 1 ; 

select * from cortes c ; 

update cortes c set c.totalGastosEntradas = (select if(sum(ge.montoTotal) is null, 0 ,sum(ge.montoTotal) ) from gasto_entrada ge where ge.idCorte =c.idCorte  and status = 1 ) where c.idCorte in (1 ,2 ) ; 

ALTER TABLE sieslitedb.cortes ADD montoFondo Decimal(10,2) DEFAULT 0.0 NULL;
ALTER TABLE sieslitedb.cortes ADD totalVendidoEfectivo decimal(10,2) DEFAULT 0.0 NULL;
ALTER TABLE sieslitedb.cortes ADD totalVendidoElectronico decimal(10,2) DEFAULT 0.0 NULL;


select sum(v.totalVenta) from ventas v where v.metodoPago = 0 ; 
-- 0 efectivo 1 tarjeta
select * from ventas v ;

update cortes c 
set c.totalVendidoEfectivo = (select if(sum(v.totalVenta) is null , 0, sum(v.totalVenta)) from ventas v where v.metodoPago = 0  and v.idCorte = c.idCorte),
c.totalVendidoElectronico = (select if(sum(v.totalVenta) is null , 0, sum(v.totalVenta)) from ventas v where v.metodoPago = 1  and v.idCorte = c.idCorte);