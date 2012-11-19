create table city(
    cityID int unsigned auto_increment primary key,
    cityName varchar(100)
);

create table mail(
    mailID int unsigned auto_increment primary key,
    cust_name varchar(200) not null,
    cust_add varchar(200) not null,
    comment varchar(500)
);

create table mail_city(
    mailID int unsigned,
    cityID int unsigned,
    primary key (mailID,cityID),
    foreign key (mailID) references mail(mailID),
    foreign key (cityID) references city(cityID)
);
