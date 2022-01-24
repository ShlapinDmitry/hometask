create table if not exists my_module_catalog_auto_brends (
    ID int(18) not null auto_increment,
    NAME varchar(100) null default '',
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_brends ( ID, NAME ) values 
(1, 'Ford'),
(2, 'Audi'),
(3, 'BMV');

create table if not exists my_module_catalog_auto_models (
    ID int(18) not null auto_increment,
    ID_BREND int(18) not null default 0,
    NAME varchar(100) null default '',
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_models ( ID, ID_BREND, NAME ) values 
(1, 1, 'Focus'),
(2, 1, 'Mondeo'),
(3, 2, 'A3'),
(4, 2, 'A4'),
(5, 3, 'X7');

create table if not exists my_module_catalog_auto_complectations (
    ID int(18) not null auto_increment,
    ID_MODEL int(18) not null default 0,
    NAME varchar(100) null default '',
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_complectations ( ID, ID_MODEL, NAME ) values 
(1, 1, 'Start'),
(2, 1, 'Luxe'),
(3, 2, 'Comfort'),
(4, 2, 'Lux'),
(5, 3, 'Start'),
(6, 3, 'Comfort'),
(7, 4, 'Start'),
(8, 5, 'Comfort');

create table if not exists my_module_catalog_auto_autos (
    ID int(18) not null auto_increment,
    ID_COMPLECTATION int(18) not null default 0,
    ID_MODEL int(18) not null default 0,
    NAME varchar(100) null default '',
    YEAR int(4) null default 2022,
    PRICE int(10) null default 0,
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_autos ( ID, ID_COMPLECTATION, ID_MODEL, NAME, YEAR, PRICE ) values 
(1, 1, 1, 'Ford Focus', 2021, 1500000),
(2, 1, 1, 'Ford Focus', 2022, 1600000),
(3, 2, 1, 'Ford Focus', 2022, 1700000),
(4, 1, 2, 'Ford Mondeo', 2021, 1500000),
(5, 2, 2, 'Ford Mondeo', 2021, 1500000),
(6, 1, 3, 'Audi A3', 2021, 1400000),
(7, 2, 3, 'Audi A3', 2021, 1450000),
(8, 1, 4, 'Audi A4', 2022, 1800000),
(9, 1, 5, 'BMV X7', 2020, 1900000),
(10, 1, 5, 'BMV X7', 2021, 2000000),
(11, 1, 5, 'BMV X7', 2020, 2200000);

create table if not exists my_module_catalog_auto_options (
    ID int(18) not null auto_increment,
    NAME varchar(100) null default '',
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_options ( ID, NAME ) values 
(1, 'Подушка безопасности'),
(2, 'Аудиосистема'),
(3, 'Коврики'),
(4, 'Литые диски'),
(5, 'Кондиционер'),
(6, 'Катапульта');

create table if not exists my_module_catalog_auto_options_to_complectations (
    ID int(18) not null auto_increment,
    ID_OPTION int(18) not null default 0,
    ID_COMPLECTATION int(18) not null default 0,
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_options_to_complectations ( ID, ID_OPTION, ID_COMPLECTATION ) values 
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 6),
(13, 2, 8),
(14, 4, 2),
(15, 4, 4),
(16, 5, 2),
(17, 5, 3),
(18, 5, 4),
(19, 5, 6),
(20, 5, 8),
(21, 6, 8);

create table if not exists my_module_catalog_auto_options_to_autos (
    ID int(18) not null auto_increment,
    ID_OPTION int(18) not null default 0,
    ID_AUTO int(18) not null default 0,
    PRIMARY KEY (ID)
);
INSERT INTO my_module_catalog_auto_options_to_autos ( ID, ID_OPTION, ID_AUTO ) values 
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11);