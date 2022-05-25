create database homework1;

use homework1;

create table utenti(
    id int not null auto_increment,
    nome varchar(50),
    cognome varchar(50),
    email varchar(50),
    password varchar(100),
    primary key(id)
)Engine=InnoDB;

create table like_drink(
    cod_utente int not null,
    cod_drink int not null,
    index cod_utente_idx(cod_utente),
    index cod_drink_idx(cod_drink),
    foreign key (cod_utente) REFERENCES utenti(id)
        on update cascade
        on delete cascade,
    primary key(cod_utente, cod_drink)
)Engine=InnoDB;