use practica;
select * from usuario;

drop table usuario;

create table usuario(
    id int auto_increment primary key,
    correo varchar(45),
    contrasena varchar(45),
    info text (300)
);