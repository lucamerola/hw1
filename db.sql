create database homework1;

use homework1;

create table utenti(
    id int not null auto_increment,
    nome varchar(50),
    cognome varchar(50),
    email varchar(50),
    password varchar(100),
    primary key(id)
);