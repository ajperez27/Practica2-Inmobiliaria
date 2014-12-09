CREATE TABLE IF NOT EXISTS `casa` (
`id` int NOT NULL primary key auto_increment,
`precio` float NOT NULL,
`localidad` varchar(30) NOT NULL,
`metros` int NOT NULL,
`numHabitaciones` int NOT NULL,
`direccion` varchar(200) NOT NULL,
) ENGINE=InnoDB;

CREATE TABLE foto (
idFoto int NOT NULL auto_increment,
idCasa int not null,    
url varchar(250)NOT NULL,
CONSTRAINT PK_id_fotos PRIMARY KEY(idFoto),
CONSTRAINT FK_id_casa FOREIGN KEY (idCasa) REFERENCES casa(idCasa) ON DELETE CASCADE ON UPDATE CASCADE
)