/*
this is an example of how to populate a virtual gallery of new items, assuming you're bringing over a fresh DB from argus and want to do this

 183 is the id of the virtual gallery! I usually make a new, blank one, and then run this */

insert into treasures_usergals (treasure_id, usergal_id, created)
select id, 183, now()
from treasures_new;
