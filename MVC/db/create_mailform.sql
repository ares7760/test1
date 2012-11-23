create database mailform;

use mailform;

create table cities
(
	city_id int unsigned auto_increment primary key,
	city_name varchar(100)
);

create table mails
(
	mail_id int unsigned auto_increment primary key,
	cust_name varchar(200) not null,
	cust_add varchar(200) not null,
	comment varchar(500),
	send_date date
);

create table mail_city
(
	mail_id int unsigned,
	city_id int unsigned,
	primary key (mail_id,city_id),
	foreign key (mail_id) references mails(mail_id),
	foreign key (city_id) references cities(city_id)
);
