alter table makers_treasures add index (maker_id);
alter table makers_treasures add index (treasure_id);
alter table tags_treasures add index (tag_id);
alter table tags_treasures add index (treasure_id);
alter table treasures_medvalues add index (medvalue_id);
alter table treasures_medvalues add index (treasure_id);
alter table treasures_usergals add index (treasure_id);
alter table treasures_usergals add index (usergal_id);
alter table comments_users add index (user_id);
alter table comments_users add index (comment_id);
-- for some reason this index was missing last DB change, causing all sorts of slowness and timeouts
alter table tags add index (id);
