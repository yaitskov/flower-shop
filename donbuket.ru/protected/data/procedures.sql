delimiter |
-- ссылки на фотографии используется почти во всех таблицах поэтому
-- чтобы не дублировать код тригера вынес его в процедуры
-- site_user, album_element, flower, payment_type, posy, posy_view, product, product_category
create procedure inc_photo_counter ( photo_id bigint )
       begin
          update photo set numlinks = numlinks + 1 where id = photo_id ;
       end |
create procedure dec_photo_counter ( photo_id bigint )
       begin
          update photo set numlinks = numlinks - 1 where id = photo_id ;
       end |
       
create procedure upd_photo_counter ( old_photo_id bigint, new_photo_id bigint)
       begin
        if old_photo_id <> new_photo_id then
          call dec_photo_counter ( old_photo_id );
          call inc_photo_counter ( new_photo_id );          
        end if;
       end |


delimiter ;
