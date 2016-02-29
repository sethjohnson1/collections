/*
this is an example of how to populate a virtual gallery of new items, assuming you're bringing over a fresh DB from argus and want to do this */

-- first make a new record. Be sure to assign your editcode and then blank it back out before committing to git, you can also add the image back later after you fill it in
 INSERT INTO `usergals` (`name`, `creator`, `img`, `email`, `editcode`, `user_id`, `gloss`, `flagged`, `listed`,created) VALUES
('New Items',	'Seth J',	'nh.304.75.2.jpg',	'sethj@centerofthewest.org',	'EDITCODE_HERE',	'533509aa-ee1c-4bfd-ba6f-1d03ac1001cc',	'Latest items harvested from our collections database!',	NULL,	1, now());
 
 /* 216 is the id of the virtual gallery made above, so replace with your value. After this the new vGal is complete! */
insert into treasures_usergals (treasure_id, usergal_id, created)
select id, 216, now()
from treasures_new;


/* now to get homeflags from other DB, you could also re-shuffle from ocmod but this is faster */

update oc20.treasures, oc18.treasures
set oc20.treasures.homeflag=oc18.treasures.homeflag
where oc20.treasures.id=oc18.treasures.id;
