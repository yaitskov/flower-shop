-- заполняем словари
insert into price_type (name,constructor_enabled )
       values ( 'не определена', '0'),
              ( 'цена фиксированная', '0'),
              ( 'цена от состава букета', '1');
              
insert into sun_sense (name,love,hate)
       values ('тенелюбивое', 0.0, 1.0),
              ('солнцелюбивое', 1.0, 0.0),
              ('к солнцу безразлично', 0.0, 0.0);              
insert into sex (name) values ('мужчинам'), ('женщинам'), ('всем');
insert into season (name,sorder) values ('зима',1), ('весна',2),('лето',3),('осень',4);
insert into blossoming (name,period) values ('цветет раз в год', 1),
                                             ('не цветет', -1),
                                             ('цветет постоянно', 0);
insert into color (name, rgbvalue) values ('зеленый','00EE00'),
                                          ('черный','000000'),
                                          ('белый','FFFFFF'),
                                          ('синий','0000FF'),                                          
                                          ('красный','FF0000');
-- несколько пользователей для каждого типа
insert into site_user ( login, email, firstname,
                        lastname, patronymic, personal_phone,
                        employee_phone, is_blogger, password,
                        is_employee, is_client, is_root,
                        registered_at, last_login_at
                      )
       values ( 'toma', 'toma@yandex.ru', 'Тамара',
                'Глазырина', 'Николаевна', '+7-928-159-00-04',
                '+7-928-159-00-04', '1',  sha('1'),
                '1', '0', '0',
                '2010-11-11 10:11:11', '2011-03-18 20:11:11' ),
              ( 'dan', 'rtfm.rtfm.rtfm@gmail.com', 'Данил',
                'Яицков', 'Сергеевич', '+7-928-159-00-04',
                null, '1', sha('1'),
                '0', '0', '1',
                '2010-11-11 10:11:11', '2011-03-18 20:11:11' ),
              ( 'bree', 'eerda@inbox.ru', 'Ирина',
                'Балабай', 'Викторовна', '+7-928-159-00-04',
                null, '1', sha('1'),
                '0', '1', '0',
                '2010-11-11 10:11:11', '2011-03-18 20:11:11' );

insert into web_site ( support_email, birth_year, meta_keywords,
                       meta_description, meta_author, about,
                       name, yandex_map_key )
       values ( 'rtfm.rtfm.rtfm@gmail.com', 2003,
                'букет, заказ цветов, цветы, упаковка подарков, Ростов-на-Дону, Сельмаш,
                 розы, тюльпаны, лилии, открытки, удобрения, горшки, грунт,
                 Глазырина Тамара Николаевна',
                 
                'Заказ цветов и букетов онлайн и по телефону +7-928-159-00-04 без выходных.
                 Розы и тюльпаны, цветы, подарки, открытки, интернет-магазин цветов.',
                'Цветочный магазин donbuket.ru - заказ цветов в Ростове-на-Дону',
                'Мы настоящий цветочный магазин. Мы находимся на рынке ....',
                
                'Донской букет',
                'AKEBek0BAAAAoqNgFwIAEb1E-5QhBnFhJ2upm4kaXNcnanMAAAAAAAAAAACNxjxQHs2y4Ke4wS9S5iFbNHwh5g==' );

insert into product_category (name, catorder, is_flower, publisher_id)
       values ('искуственные цветы', 0, '0',1),
              ('открытки', 1,'0', 1),
              ('горшки', 2, '0',1),
              ('комнатные цветы', 3, '0',1),
              ('розы', 0, '1', 1),
              ('тюльпаны', 1, '1',1 );
              
--  о магазине
insert into flower_shop ( phone, start_work_at, end_work_at,
                          email_address, mail_address, outline_route,
                          map_center_x, map_center_y,
                          place_x, place_y, name )
       values ( '+7-928-159-00-04', '08:00', '11:00',
       
                'flowers@yandex.ru', 'Ростов-на-Дону, ул. Строителей, д. 3',
                'Из центра к нам можно добраться на маршрутке #3 или автобусе 3А',
                
                '39.76857',  '47.267104',
                '39.786857', '47.267104', 'Трансильвания');
-- о цветы
insert into flower (comment, howcare, legheight,
                    work_factor,  sex_id, publisher_id,
                    color_id, category_id, created_at,
                    last_entrance)
       values ( 'голанская', 'менять воду и подрезать на 2 см каждый день',  80, -- cm
       
                1.2, -- work factor
                3, -- all
                1, -- my aunt
                
                5, -- red
                5, -- rose
                '2010-11-11 10:11:11',
                
                '2011-03-18 20:11:11'), 
              ( 'месная', 'менять воду и подрезать на 1 см каждый день',  40, -- cm
              
                1.1, -- work factor
                3, -- all
                1, -- my aunt
                
                5, -- red
                5,  -- rose                
                '2010-11-11 10:11:11',
                '2011-03-18 20:11:11');
       
-- букеты
insert into posy ( name, description, price_type_id,
                   const_price, publisher_id, published_at )
       values ('Весна',  'Подойдет всем кому не лень', 1,
                0, 1, '2011-02-11 20:11:22'),
              ('Зима',  'Врятли кому подойдет',  2,
                100, 1, '2011-02-11 20:11:22');
insert into flower_posy ( amount, flower_id, posy_id )
       values ( 3, 1, 1), ( 2, 2, 1), ( 7, 1, 2);

-- категории букетов 
insert into posy_view ( name, description, grporder )
       values ( 'Свадебный', 'Для свадьбы', 1 ),
              ( '23 февраля', 'Для мужчин', 2 );
insert into posy_view_list ( itmorder, posy_id, posyview_id )
       values ( 1, 1, 1 ) , ( 2, 2, 1 ), ( 1, 2, 2 );
       
-- сообщения на форуме
insert into forum_theme ( name, pinned_order, freezed, author_id, created_at )
       values ( 'Правила формуа', '1', '1', 1, '2010-10-10 20:20:20' ),
              ( 'Как выбрать хороший букет', '1', '1', 1 , '2010-10-10 20:20:20' ),
              ( 'Какие цветы подходят женщинам', '1', '1', 1, '2010-10-10 20:20:20' ),
              ( 'Какие цветы подходят мужчинам', '1', '1', 1 , '2010-10-10 20:20:20'),
              ( 'Отзывы наших клиентов', '1', '1', 1 , '2010-10-10 20:20:20');
              
insert into forum_post ( body, author_id, theme_id, created_at )
       values ( 'П. 1 Администратор всега прав. П. 2 Если администратор не прав см. П. 1.',
                2, 1 , '2010-10-10 20:20:20' ),
              ( 'Чтобы выбрать хороший букет обращайтесь к нам',
                2, 2 , '2010-10-10 20:20:20'),
              ( 'Чтобы не выбрать плохой букет не обращайтесь к другим',
                2, 2, '2010-10-13 20:20:20' );

-- товары
insert into product ( name, vendor, amount, price, category_id , publisher_id)
       values ( 'венок', 'китай', 123, 111, 1 ,1),
              ( 'открытка', 'китай', 221, 44, 2 ,1 ),
              ( 'фикус', 'китай', 21, 140, 4 , 1),
              ( 'лимонное дерево', 'китай', 1, 340, 4, 1 );

