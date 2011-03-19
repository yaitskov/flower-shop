-- схема данных цветочного магазина


-- объект хранить ссылку на одно изображение
-- фотографии используются во многих сущностях
-- например о фотографиях нужно знать их высоту и ширину
-- чтобы правильно растягивать

-- одна и таже фотография может использоваться во многих местах ( подсчет ссылок )
-- вместо хранения полного имени файла можно хранить только ключ
CREATE TABLE album_element (
       id BIGINT AUTO_INCREMENT,
       -- ссылка на фотографию
       photo_id BIGINT NOT NULL,
       -- альбок к которому принадлежит элемент
       album_id BIGINT NOT NULL,
       -- порядок фотографий в альбоме
       itmorder BIGINT NOT NULL,
       INDEX photo_id_idx (photo_id),
       INDEX album_id_idx (album_id),
       PRIMARY KEY(id)
       ) ENGINE = INNODB;
       
CREATE TABLE blossoming (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) NOT NULL UNIQUE,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE color (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(255) NOT NULL UNIQUE,
       rgbvalue VARCHAR(6) NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE color_list (
       id BIGINT AUTO_INCREMENT,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE color_list_element (
       id BIGINT AUTO_INCREMENT,
       color_id BIGINT NOT NULL,
       list_id BIGINT NOT NULL,
       INDEX color_id_idx (color_id),
       INDEX list_id_idx (list_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
-- статистика за сутки по часам  
CREATE TABLE day_statistic (
       id BIGINT AUTO_INCREMENT,
       -- номер часа в сутка от 0 до 23       
       hour BIGINT UNIQUE NOT NULL,
       -- кол-во посещений сайта - те сколько разных людей посетило его
       -- учитывается загрузка только первой страницы
       visits BIGINT NOT NULL,
       -- кол-во заказов
       orders BIGINT NOT NULL,
       -- кол-во сообщений
       messages BIGINT NOT NULL,
       -- кол-во посещений зарегистрированных пользователей
       authenticated_visits BIGINT NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;

-- среднее время товарного вида цветка
CREATE TABLE face_uptime (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) NOT NULL UNIQUE,
       PRIMARY KEY(id)) ENGINE = INNODB;

-- отношение цветы ( для букетов )
CREATE TABLE flower (
       id BIGINT AUTO_INCREMENT,
       -- полей название не допустимо
       -- происхождение ( голанская / месная )       
       comment VARCHAR(100),
       -- как ухаживать ( с какими цветами не переносимость )    
       howcare TEXT,
       created_at DATETIME NOT NULL,
       -- время последнего поступления
       updated_at DATETIME NOT NULL,
       -- высота ноги ( см )
       legheight BIGINT,
       -- цена штуки
       price FLOAT(18,2),
       -- коэф-ет сложности за работу 
       work_factor FLOAT(18,2) DEFAULT 1 NOT NULL,
       -- кому дариться м/ж/ всем
       sex_id BIGINT,
       -- возрастная категория
       start_age BIGINT,
       end_age BIGINT,
       -- кол-во штук
       amount BIGINT DEFAULT 0 NOT NULL,
       -- температурный диапазон ( градусы )
       lowest_temperature BIGINT,
       highest_temperature BIGINT,
       -- среднее время товарного вида      
       uptime_measure BIGINT,
       uptime BIGINT,
       season_start BIGINT,
       season_end BIGINT,
       album_id BIGINT,
       icon_id BIGINT,
       publisher_id BIGINT NOT NULL,
       color_id BIGINT,
       category_id BIGINT NOT NULL,
       INDEX uptime_measure_idx (uptime_measure),
       INDEX category_id_idx (category_id),
       INDEX sex_idx (sex_id),
       INDEX season_end_idx (season_end),
       INDEX album_id_idx (album_id),
       INDEX icon_id_idx (icon_id),
       INDEX publisher_id_idx (publisher_id),
       INDEX color_id_idx (color_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE flower_posy (
       id BIGINT AUTO_INCREMENT,
       amount BIGINT,
       flower_id BIGINT NOT NULL,
       posy_id BIGINT NOT NULL,
       INDEX flower_id_idx (flower_id),
       INDEX posy_id_idx (posy_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
-- цветочный магазин
-- хранить общие параметры       
CREATE TABLE flower_shop (
       id BIGINT AUTO_INCREMENT,
       -- телефон магазина, также у каждого сотрудника есть опция
       -- считать его телефон телефоном магазина ( например когда он дежурный )
       phone VARCHAR(255),
       -- часы работы
       start_work_at TIME,
       end_work_at TIME,
       -- официальное название
       name VARCHAR(255) NOT NULL,
       -- адрес электронной почты
       email_address VARCHAR(100) DEFAULT NULL,
       -- точный почтовый адрес
       mail_address TEXT,
       -- доходчивое описание как легче все добраться до нас
       outline_route TEXT,
       -- координаты магазина для яднекс карты
       -- точка на карте описывается двумя вещественными числами       
       map_x DECIMAL(6,6),
       map_y DECIMAL(6,6),
       -- центр объекта 39.786857, 47.267104
       place_x DECIMAL(6,6),
       place_y DECIMAL(6,6),
       -- масштаб карты от 0 до 17
       map_scale BIGINT DEFAULT 13 NOT NULL,
       -- размеры окна в пикселях
       map_width BIGINT DEFAULT 600 NOT NULL,
       map_heigth BIGINT DEFAULT 400 NOT NULL,
       -- виды магазина с улициы ( альбом фоток )
       views BIGINT NOT NULL,
       INDEX views_idx (views),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE forum_post (
       id BIGINT AUTO_INCREMENT,
       body TEXT NOT NULL,
       created_at DATETIME NOT NULL,
       author_id BIGINT NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX author_id_idx (author_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE forum_theme (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(255) NOT NULL,
       created_at DATETIME NOT NULL,
       pinned_order BIGINT,
       freezed TINYINT(1) DEFAULT '0' NOT NULL,
       author_id BIGINT NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX author_id_idx (author_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE measure (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) NOT NULL UNIQUE,
       logname VARCHAR(255) NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE orders (
       id BIGINT AUTO_INCREMENT,
       number VARCHAR(40) NOT NULL UNIQUE,
       ordered_at DATETIME NOT NULL,
       deadline DATETIME NOT NULL,
       accepted_at DATETIME,
       completed_at DATETIME,
       canceled_at DATETIME,
       cancel_description VARCHAR(255),
       client_requirements TEXT,
       client_phone VARCHAR(50) NOT NULL,
       client_name VARCHAR(100) NOT NULL,
       client_email VARCHAR(100),
       order_amount FLOAT(18,2) NOT NULL,
       client_id BIGINT,
       responsible_id BIGINT,
       posy_id BIGINT NOT NULL,
       created_at DATETIME NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX responsible_id_idx (responsible_id),
       INDEX posy_id_idx (posy_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE photo (
       id BIGINT AUTO_INCREMENT,
       -- кол-во ссылко на сущность
       numlinks BIGINT DEFAULT 0 NOT NULL,
       -- путь к файлу
       path VARCHAR(255) NOT NULL,
       -- формат файла ( расширение )
       extention VARCHAR(10) NOT NULL,
       -- размеры в писелях
       width BIGINT,
       height BIGINT,
       PRIMARY KEY(id)) ENGINE = INNODB;

-- альбом фотографий       
CREATE TABLE photo_album (
       id BIGINT AUTO_INCREMENT,
       created_at DATETIME NOT NULL default current_timestamp,
       updated_at DATETIME NOT NULL default current_timestamp,
       PRIMARY KEY(id)) ENGINE = INNODB;
       
-- букет цветов ( в общем какой то товар который
-- делается под заказ по некоторому шаблону )       
CREATE TABLE posy (
       id BIGINT AUTO_INCREMENT,
       client_made TINYINT(1) DEFAULT '0' NOT NULL,
       numlinks BIGINT DEFAULT 0 NOT NULL,
       name VARCHAR(100) NOT NULL UNIQUE,
       description TEXT,
       published_at DATETIME NOT NULL,
       created_at DATETIME NOT NULL,
       price_type VARCHAR(255) NOT NULL,
       const_price FLOAT(18,2) DEFAULT 0 NOT NULL,
       icon VARCHAR(255),
       publisher_id BIGINT NOT NULL,
       author_id BIGINT NOT NULL,
       album_id BIGINT NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX author_id_idx (author_id),
       INDEX album_id_idx (album_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE posy_view (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(100) NOT NULL UNIQUE,
       description TEXT,
       grporder BIGINT NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE posy_view_list (
       id BIGINT AUTO_INCREMENT,
       itmorder BIGINT NOT NULL,
       posy_id BIGINT NOT NULL,
       posyview_id BIGINT NOT NULL,
       INDEX posy_id_idx (posy_id),
       INDEX posyview_id_idx (posyview_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE product (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(255) NOT NULL,
       description TEXT,
       vendor VARCHAR(255),
       amount BIGINT DEFAULT 0 NOT NULL,
       price FLOAT(18,2),
       last_entrance DATETIME NOT NULL,
       is_home_plant TINYINT(1) NOT NULL,
       temperature_range VARCHAR(20),
       blossoming_id BIGINT,
       blossoming_start DATE,
       blossoming_end DATE,
       sun BIGINT,
       sprinkling_period VARCHAR(100),
       size VARCHAR(30),
       weight FLOAT(18,2),
       category_id BIGINT NOT NULL,
       icon_id BIGINT,
       album_id BIGINT,
       color_id BIGINT,
       publisher_id BIGINT NOT NULL,
       created_at DATETIME NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX publisher_id_idx (publisher_id),
       INDEX sun_idx (sun),
       INDEX blossoming_id_idx (blossoming_id),
       INDEX category_id_idx (category_id),
       INDEX album_id_idx (album_id),
       INDEX icon_id_idx (icon_id),
       INDEX color_id_idx (color_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE product_category (
       id BIGINT AUTO_INCREMENT,
       is_flower TINYINT(1) DEFAULT '0' NOT NULL,
       name VARCHAR(100) NOT NULL UNIQUE,
       description TEXT,
       catorder BIGINT UNIQUE NOT NULL,
       created_at DATETIME NOT NULL,
       measure_id BIGINT,
       icon_id BIGINT,
       publisher_id BIGINT NOT NULL,
       updated_at DATETIME NOT NULL,
       INDEX measure_id_idx (measure_id),
       INDEX icon_id_idx (icon_id),
       INDEX publisher_id_idx (publisher_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE season (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(40) NOT NULL UNIQUE,
       sorder BIGINT UNIQUE NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sex (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) NOT NULL UNIQUE,
       PRIMARY KEY(id)) ENGINE = INNODB;
-- пользователь сайта может блогером, работником, администратором и клиентом       
CREATE TABLE site_user (
       id BIGINT AUTO_INCREMENT,
       login VARCHAR(30) NOT NULL UNIQUE,
       -- у каждого пользователя должен быть уникальный почтовый ящик
       -- так как он будет использоваться для восстановления пароля       
       email VARCHAR(100) NOT NULL UNIQUE,
       -- имя
       firstname VARCHAR(100) NOT NULL,
       -- фамилия
       lastname VARCHAR(100) NOT NULL,
       -- отчество
       patronymic VARCHAR(100) NOT NULL,
       -- личный телефон 
       personal_phone VARCHAR(50),
       -- рабочий телефон только для для сотрудников
       employee_phone VARCHAR(50),
       -- может писать сообщения на форуме ( блогер )
       is_blogger TINYINT(1) DEFAULT '0' NOT NULL,
       -- подпись после каждого сообщения
       signature VARCHAR(255),
       -- может делать авторизованные заказы ( клиент )
       is_client TINYINT(1) DEFAULT '0' NOT NULL,
       -- скидка клиенту
       discount FLOAT(18,6) DEFAULT 0 NOT NULL,
       -- хэш пароля
       password VARCHAR(255) NOT NULL,
       -- администратор - самые широкие полномочия
       is_root TINYINT(1) DEFAULT '0' NOT NULL,
       -- дата и время регистрации в системе
       registered_at DATETIME NOT NULL,
       -- работник
       is_employee TINYINT(1) DEFAULT '0' NOT NULL,
       -- дата последнего посещения сайта ( последня активность ) 
       last_login_at DATETIME NOT NULL,
       -- ссылка на фотографию
       face_id BIGINT,
       INDEX face_id_idx (face_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
       
CREATE TABLE sun_sense (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) NOT NULL UNIQUE,
       PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE used_products (
       id BIGINT AUTO_INCREMENT,
       amount BIGINT,
       product_id BIGINT,
       posy_id BIGINT,
       INDEX product_id_idx (product_id),
       INDEX posy_id_idx (posy_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
-- о самом веб сайте ( сущность в единственном экземпляре )         
CREATE TABLE web_site (
       id BIGINT AUTO_INCREMENT,
       -- кол-во посещений сайта за час
       visitors_a_hour BIGINT DEFAULT 0 NOT NULL,
       -- кол-во посещений сайта за сутки
       visitors_a_day BIGINT DEFAULT 0 NOT NULL,
       support_email VARCHAR(100),
       -- год основания сайта / магазина
       birth_year BIGINT,
       -- о веб сайте
       about TEXT,
       PRIMARY KEY(id)) ENGINE = INNODB;
       
-- статистика за год по дням       
CREATE TABLE year_statistic (
       id BIGINT AUTO_INCREMENT,
       -- день к которому относится запись       
       created_at DATE NOT NULL UNIQUE,
       visits BIGINT NOT NULL,
       -- кол-во заказов
       orders BIGINT NOT NULL,
       -- кол-во сообщений
       messages BIGINT NOT NULL,
       -- кол-во посещений зарегистрированных пользователей
       authenticated_visits BIGINT NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;

-- добавляем ограничения на внешние ключи
ALTER TABLE album_element
      ADD CONSTRAINT album_element_photo_id_photo_id
      FOREIGN KEY (photo_id)
      REFERENCES photo(id) ON DELETE CASCADE;
      
ALTER TABLE album_element ADD CONSTRAINT album_element_album_id_photo_album_id FOREIGN KEY (album_id) REFERENCES photo_album(id) ON DELETE CASCADE;
ALTER TABLE color_list_element ADD CONSTRAINT color_list_element_list_id_color_list_id FOREIGN KEY (list_id) REFERENCES color_list(id) ON DELETE CASCADE;
ALTER TABLE color_list_element ADD CONSTRAINT color_list_element_color_id_color_id FOREIGN KEY (color_id) REFERENCES color(id) ON DELETE CASCADE;
ALTER TABLE flower ADD CONSTRAINT flower_uptime_measure_face_uptime_id FOREIGN KEY (uptime_measure) REFERENCES face_uptime(id);
ALTER TABLE flower ADD CONSTRAINT flower_sex_sex_id FOREIGN KEY (sex_id) REFERENCES sex(id);
ALTER TABLE flower ADD CONSTRAINT flower_season_end_season_id FOREIGN KEY (season_end) REFERENCES season(id) ON DELETE CASCADE;
ALTER TABLE flower ADD CONSTRAINT flower_publisher_id_site_user_id FOREIGN KEY (publisher_id) REFERENCES site_user(id) ON DELETE CASCADE;
ALTER TABLE flower ADD CONSTRAINT flower_icon_id_photo_id FOREIGN KEY (icon_id) REFERENCES photo(id) ON DELETE CASCADE;
ALTER TABLE flower ADD CONSTRAINT flower_color_id_color_id FOREIGN KEY (color_id) REFERENCES color(id) ON DELETE CASCADE;
ALTER TABLE flower ADD CONSTRAINT flower_category_id_product_category_id FOREIGN KEY (category_id) REFERENCES product_category(id);
ALTER TABLE flower ADD CONSTRAINT flower_album_id_photo_album_id FOREIGN KEY (album_id) REFERENCES photo_album(id) ON DELETE CASCADE;
ALTER TABLE flower_posy ADD CONSTRAINT flower_posy_posy_id_posy_id FOREIGN KEY (posy_id) REFERENCES posy(id) ON DELETE CASCADE;
ALTER TABLE flower_posy ADD CONSTRAINT flower_posy_flower_id_flower_id FOREIGN KEY (flower_id) REFERENCES flower(id) ON DELETE CASCADE;
ALTER TABLE flower_shop ADD CONSTRAINT flower_shop_views_photo_album_id FOREIGN KEY (views) REFERENCES photo_album(id) ON DELETE RESTRICT;
ALTER TABLE forum_post ADD CONSTRAINT forum_post_author_id_site_user_id FOREIGN KEY (author_id) REFERENCES site_user(id) ON DELETE CASCADE;
ALTER TABLE forum_theme ADD CONSTRAINT forum_theme_author_id_site_user_id FOREIGN KEY (author_id) REFERENCES site_user(id) ON DELETE CASCADE;
ALTER TABLE orders ADD CONSTRAINT orders_responsible_id_site_user_id FOREIGN KEY (responsible_id) REFERENCES site_user(id) ON DELETE CASCADE;
ALTER TABLE orders ADD CONSTRAINT orders_posy_id_posy_id FOREIGN KEY (posy_id) REFERENCES posy(id) ON DELETE CASCADE;
ALTER TABLE posy ADD CONSTRAINT posy_author_id_site_user_id FOREIGN KEY (author_id) REFERENCES site_user(id) ON DELETE CASCADE;
ALTER TABLE posy ADD CONSTRAINT posy_album_id_photo_album_id FOREIGN KEY (album_id) REFERENCES photo_album(id) ON DELETE CASCADE;
ALTER TABLE posy_view_list ADD CONSTRAINT posy_view_list_posyview_id_posy_view_id FOREIGN KEY (posyview_id) REFERENCES posy_view(id) ON DELETE CASCADE;
ALTER TABLE posy_view_list ADD CONSTRAINT posy_view_list_posy_id_posy_id FOREIGN KEY (posy_id) REFERENCES posy(id) ON DELETE CASCADE;
ALTER TABLE product ADD CONSTRAINT product_sun_sun_sense_id FOREIGN KEY (sun) REFERENCES sun_sense(id);
ALTER TABLE product ADD CONSTRAINT product_publisher_id_site_user_id FOREIGN KEY (publisher_id) REFERENCES site_user(id);
ALTER TABLE product ADD CONSTRAINT product_icon_id_photo_id FOREIGN KEY (icon_id) REFERENCES photo(id) ON DELETE CASCADE;
ALTER TABLE product ADD CONSTRAINT product_color_id_color_id FOREIGN KEY (color_id) REFERENCES color(id) ON DELETE CASCADE;
ALTER TABLE product ADD CONSTRAINT product_category_id_product_category_id FOREIGN KEY (category_id) REFERENCES product_category(id) ON DELETE CASCADE;
ALTER TABLE product ADD CONSTRAINT product_blossoming_id_blossoming_id FOREIGN KEY (blossoming_id) REFERENCES blossoming(id);
ALTER TABLE product ADD CONSTRAINT product_album_id_photo_album_id FOREIGN KEY (album_id) REFERENCES photo_album(id) ON DELETE CASCADE;
ALTER TABLE product_category ADD CONSTRAINT product_category_publisher_id_site_user_id FOREIGN KEY (publisher_id) REFERENCES site_user(id);
ALTER TABLE product_category ADD CONSTRAINT product_category_measure_id_measure_id FOREIGN KEY (measure_id) REFERENCES measure(id) ON DELETE CASCADE;
ALTER TABLE product_category ADD CONSTRAINT product_category_icon_id_photo_id FOREIGN KEY (icon_id) REFERENCES photo(id) ON DELETE SET NULL;
ALTER TABLE site_user ADD CONSTRAINT site_user_face_id_photo_id FOREIGN KEY (face_id) REFERENCES photo(id) ON DELETE SET NULL;
ALTER TABLE used_products ADD CONSTRAINT used_products_product_id_product_id FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE;
ALTER TABLE used_products ADD CONSTRAINT used_products_posy_id_posy_id FOREIGN KEY (posy_id) REFERENCES posy(id) ON DELETE CASCADE;


-- заполняем словари

-- заполянем тестовые данные 