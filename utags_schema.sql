
create table utags(
	id int not null auto_increment,
	primary key(id),
	name varchar(255), -- this is the tag
	tag_count int(11),
	created datetime,
	modified datetime,
	upvotes int,
	downvotes int,
	flags int
);

create table treasures_utags(
	id int not null auto_increment,
	primary key(id),
	treasure_id varchar(36),
	utag_id int
);

-- for keeping which tags the user added, can be used for more stuff later
create table treasures_users(
	id int not null auto_increment,
	primary key(id),
	treasure_id varchar(36),
	user_id varchar(36),
	utags text,
	created datetime,
	modified datetime
);