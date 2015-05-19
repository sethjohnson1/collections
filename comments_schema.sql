/*
changes to use custom comments like in iScout. The data also needs to be moved from body to thoughts

also will need to change core functionality to use Model and foreign key instead of just template_id
*/
alter table comments
add column thoughts text after id,
add column rating int(11) after thoughts,
add column hidden tinyint(1) after rating,
add column flags int(11) after hidden,
add column upvotes int(11) after flags,
add column downvotes int(11) after upvotes,
add column diff int(11) after downvotes,
add column responded tinyint(1) after diff
;
