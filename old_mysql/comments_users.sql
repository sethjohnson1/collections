create table comments_users(
	id int not null auto_increment,
	primary key(id),
	user_id varchar(36),
	comment_id varchar(40),
	created datetime,
	modified datetime,
	upvoted tinyint(1),
	downvoted tinyint(1),
	flagged tinyint(1)
);