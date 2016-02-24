/*
this is an example of how to populate a virtual gallery of new items, assuming you're bringing over a fresh DB from argus and want to do this

 183 is the id of the virtual gallery! I usually make a new, blank one, and then run this */

 INSERT INTO `usergals` (`name`, `creator`, `img`, `email`, `editcode`, `user_id`, `gloss`, `flagged`, `listed`) VALUES
('New Items',	'Seth J',	'nh.304.75.2.jpg',	'sethj@centerofthewest.org',	'ree61ujg',	'sethj@centerofthewest.org',	'Latest items harvested from our collections database!',	NULL,	1);
 
insert into treasures_usergals (treasure_id, usergal_id, created)
select id, 216, now()
from treasures_new;


/* now to get homeflags from other DB */

update oc20.treasures, oc18.treasures
set oc20.treasures.homeflag=oc18.treasures.homeflag
where oc20.treasures.id=oc18.treasures.id;