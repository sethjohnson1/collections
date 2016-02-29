/*
changes to use custom comments like in iScout. The data also needs to be moved from body to thoughts
this also adds user_id to usergals
*/
alter table comments
add column thoughts text after id,
add column rating int(11) after thoughts,
add column hidden tinyint(1) after rating,
add column flags int(11) default 0 after hidden,
add column upvotes int(11) default 0 after flags,
add column downvotes int(11) default 0 after upvotes,
add column diff int(11) after downvotes,
add column responded tinyint(1) after diff
;

alter table usergals
add column user_id varchar(36) after editcode;
