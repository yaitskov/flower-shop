-- триггеры
delimiter |
create trigger forum_post_counter_inc after insert on forum_post
       for each row begin
           update forum_theme set numposts = numposts + 1 where id = new.theme_id ;
       end |
create trigger forum_post_counter_dec after delete on forum_post
       for each row begin
           update forum_theme set numposts = numposts - 1 where id = old.theme_id ;
       end |

create trigger posy_counter_dec after delete on posy_view_list
       for each row begin
           update posy set numlinks = numlinks - 1 where id = old.posy_id ;
       end |
       
create trigger posy_counter_inc after insert on posy_view_list
       for each row begin
           update posy set numlinks = numlinks + 1 where id = new.posy_id ;
       end |

create trigger site_user_ins after insert on site_user
       for each row
       begin call inc_photo_counter ( new.face_id );
       end |
create trigger site_user_del after delete on site_user
       for each row
       begin call dec_photo_counter ( old.face_id );
       end | 
create trigger site_user_upd after update on site_user
       for each row
       begin
        call upd_photo_counter ( old.face_id, new.face_id );
       end |
create trigger album_element_ins after insert on album_element
       for each row
       begin
        call inc_photo_counter ( new.photo_id );
       end |
create trigger album_element_del after delete on album_element
       for each row
       begin
        call dec_photo_counter ( old.photo_id );
       end |
create trigger album_element_upd after update on album_element
       for each row
       begin
        call upd_photo_counter (old.photo_id,new.photo_id);
       end |
create trigger flower_ins after insert on flower
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger flower_del after delete on flower
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger flower_upd after update on flower
       for each row
       begin
        call upd_photo_counter ( old.icon_id, new.icon_id );
       end |
create trigger payment_type_ins after insert on payment_type
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger payment_type_del after delete on payment_type
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger payment_type_upd after update on payment_type
       for each row
       begin
        call upd_photo_counter ( old.icon_id, new.icon_id );
       end |
create trigger posy_ins after insert on posy
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger posy_del after delete on posy
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger posy_upd after update on posy
       for each row
       begin
        call upd_photo_counter ( old.icon_id, new.icon_id );
       end |
create trigger posy_view_ins after insert on posy_view
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger posy_view_del after delete on posy_view
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger posy_view_upd after update on posy_view
       for each row
       begin
        call upd_photo_counter ( old.icon_id, new.icon_id );
       end |
create trigger product_ins after insert on product
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger product_del after delete on product
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger product_upd after update on product
       for each row
       begin
        call upd_photo_counter ( old.icon_id, new.icon_id );
       end |
create trigger product_category_ins after insert on product_category
       for each row
       begin
        call inc_photo_counter ( new.icon_id );
       end |
create trigger product_category_del after delete on product_category
       for each row
       begin
        call dec_photo_counter ( old.icon_id );
       end |
create trigger product_category_upd after update on product_category
       for each row
       begin
        call upd_photo_counter (old.icon_id,new.icon_id );
       end |
       

delimiter ;