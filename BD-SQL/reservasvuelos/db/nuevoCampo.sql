use reservas;

alter table reservas 
add (estado_pago varchar(9) default 'no pagado');