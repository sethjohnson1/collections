/*
***************** The actual sample DB file is oc_test.sql, it can be run directly from mysql in an empty DB

This file is not meant to be run as a script and won't work
First off, Select Into doesn't seem to work across different DB, so dump the structure only and import to new DB
Table by table explanation:
badwords - shameful I was forced to do this, so deliver empty and let folks know they can fill it out with whatever they want to forbid
collections - not used so leave it out
comments, users, usergals, user_details - deliver empty
homeflags - include the whole thing
images, locations, makers, medvalues, tags - create the table with JOIN, so only the ones used in sample treasures are in DB
relations - whole thing
treasures - make a new boolean for "sample", then do an update of however many decided - some from each gallery. all the 
			JOINS for the other tables can then rely on this as well with SELECT INTO
junction tables - keep in mind you'll need to fill these in before the others probably



*/

alter table treasures add column sample int
create database oc_test
-- then I imported the schema only
-- start testing with trucker hat
update oc_dl.treasures set sample=1 where accnum like 'NA.202.394'
update oc_dl.treasures set sample=1 where accnum like '2002.1.1'

-- now all the inserts!
insert into oc_test.treasures select * from oc_dl.treasures where sample=1
insert into oc_test.images select i.* from oc_dl.treasures t join oc_dl.images i on t.id=i.treasure_id where sample=1
insert into oc_test.relations select i.* from oc_dl.treasures t join oc_dl.relations i on t.id=i.treasure_id where sample=1
insert into oc_test.locations select l.* from oc_dl.locations l join oc_dl.treasures t on l.id=t.location_id where t.sample=1

insert into oc_test.makers
select m.* from oc_dl.treasures t
join oc_dl.makers_treasures mt on t.id=mt.treasure_id
join oc_dl.makers m on m.id=mt.maker_id
where t.sample=1

insert into oc_test.medvalues
select m.* from oc_dl.treasures t
join oc_dl.treasures_medvalues mt on t.id=mt.treasure_id
join oc_dl.medvalues m on m.id=mt.medvalue_id
where t.sample=1

insert into oc_test.tags
select m.* from oc_dl.treasures t
join oc_dl.tags_treasures mt on t.id=mt.treasure_id
join oc_dl.tags m on m.id=mt.tag_id
where t.sample=1

insert into oc_test.makers_treasures
select mt.* from oc_dl.treasures t
join oc_dl.makers_treasures mt on t.id=mt.treasure_id
where t.sample=1

insert into oc_test.treasures_medvalues
select mt.* from oc_dl.treasures t
join oc_dl.treasures_medvalues mt on t.id=mt.treasure_id
where t.sample=1

insert into oc_test.tags_treasures
select mt.* from oc_dl.treasures t
join oc_dl.tags_treasures mt on t.id=mt.treasure_id
where t.sample=1

-- all other tables are empty! Done!