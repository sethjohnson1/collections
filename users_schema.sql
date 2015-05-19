alter table users
add column given_name varchar(255) after id,
add column	family_name varchar(255) after given_name,
add column	ip varchar(20) after active,
add column provider varchar(100) after ip,
add column oid varchar(200) after provider,
add column user_identity varchar(255) after oid,
add column gender varchar(10) after username,
add column locale varchar(10) after gender,
add column picture varchar(255) after locale,
add column flags int after picture,
add column upvotes int after flags,
add column downvotes int after upvotes,
add column avgrating int after downvotes, -- long way off, but calculate their average rating of stuff
add column engaged tinyint(1) after avgrating
;
