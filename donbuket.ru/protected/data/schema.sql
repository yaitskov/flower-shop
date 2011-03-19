charset utf8;
drop trigger if exists site_user_ins;
drop trigger if exists site_user_del;
drop trigger if exists site_user_upd;
drop trigger if exists album_element_ins;
drop trigger if exists album_element_del;
drop trigger if exists album_element_upd;
drop trigger if exists flower_ins;
drop trigger if exists flower_del;
drop trigger if exists flower_upd;
drop trigger if exists payment_type_ins;
drop trigger if exists payment_type_del;
drop trigger if exists payment_type_upd;
drop trigger if exists posy_ins;
drop trigger if exists posy_del;
drop trigger if exists posy_upd;
drop trigger if exists posy_view_ins;
drop trigger if exists posy_view_del;
drop trigger if exists posy_view_upd;
drop trigger if exists product_ins;
drop trigger if exists product_del;
drop trigger if exists product_upd;
drop trigger if exists product_category_ins;
drop trigger if exists product_category_del;
drop trigger if exists product_category_upd;

drop trigger if exists posy_counter_inc ;
drop trigger if exists posy_counter_dec ;
drop trigger if exists forum_post_counter_inc ;
drop trigger if exists forum_post_counter_dec ;
drop table if exists album_element cascade;
drop table if exists blossoming cascade;
drop table if exists color cascade;
drop table if exists color_list cascade;
drop table if exists color_list_element cascade;
drop table if exists day_statistic cascade;
drop table if exists flower cascade;
drop table if exists flower_posy cascade;
drop table if exists flower_shop cascade;
drop table if exists forum_post cascade;
drop table if exists forum_theme cascade;
drop table if exists measure cascade;
drop table if exists payment_type cascade;
drop table if exists orders cascade;
drop table if exists photo cascade;
drop table if exists photo_album cascade;
drop table if exists posy cascade;
drop table if exists posy_view cascade;
drop table if exists posy_view_list cascade;
drop table if exists product cascade;
drop table if exists product_category cascade;
drop table if exists season cascade;
drop table if exists sex cascade;
drop table if exists site_user cascade;
drop table if exists sun_sense cascade;
drop table if exists used_products cascade;
drop table if exists web_site cascade;
drop table if exists year_statistic cascade;

-- схема данных цветочного магазина
-- объект хранить ссылку на одно изображение
-- фотографии используются во многих сущностях
-- например о фотографиях нужно знать их высоту и ширину
-- чтобы правильно растягивать

-- одна и таже фотография может использоваться во многих местах ( подсчет ссылок )
-- вместо хранения полного имени файла можно хранить только ключ
CREATE TABLE album_element (
       id BIGINT AUTO_INCREMENT,
       photo_id BIGINT NOT NULL comment 'ссылка на фотографию',
       album_id BIGINT NOT NULL comment 'альбок к которому принадлежит элемент',
       itmorder BIGINT NOT NULL comment 'порядок фотографий в альбоме',
       is_visible TINYINT(1) DEFAULT '1' NOT NULL comment 'фотография доступна для просмотра',
       INDEX photo_id_idx (photo_id),
       INDEX album_id_idx (album_id),
       PRIMARY KEY(id)
       ) ENGINE = INNODB;


CREATE TABLE blossoming (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       period integer not null comment 'числовая характеристика 0 > не цветет; 0 цветет постоянно
                                       1 цветет каждый год',
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'справочник цветения - не цветет, цветет постоянно, раз в год ';
       
CREATE TABLE color (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       rgbvalue VARCHAR(6) character set utf8 collate utf8_unicode_ci  NOT NULL
                comment 'значение цвета в rgb 00FF00',
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'запись о цвете например для горшка или бутона цветка';
       
CREATE TABLE color_list (
       id BIGINT AUTO_INCREMENT,
       PRIMARY KEY(id)) ENGINE = INNODB;
       
CREATE TABLE color_list_element (
       id BIGINT AUTO_INCREMENT,
       color_id BIGINT NOT NULL,
       list_id BIGINT NOT NULL,
       INDEX color_id_idx (color_id),
       INDEX list_id_idx (list_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'набор цветов';
       
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
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'статистика за сутки по часам';

-- отношение цветы ( для букетов )
CREATE TABLE flower (
       id BIGINT AUTO_INCREMENT,
       -- доступен для просмотра
       is_visible TINYINT(1) DEFAULT '1' NOT NULL,              
       -- название цветка не допустимо
       -- происхождение ( голанская / месная )       
       comment VARCHAR(100) character set utf8 collate utf8_unicode_ci ,
       -- как ухаживать ( с какими цветами не переносимость )    
       howcare TEXT,
       created_at DATETIME NOT NULL default current_timestamp,
       last_entrance DATETIME NOT NULL comment 'время последнего поступления',
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
       uptime BIGINT comment 'среднее время товарного вида в секундах',
       -- сезон цветения / когда есть в продаже       
       season_start BIGINT, -- начало 
       season_end BIGINT, -- конец
       album_id BIGINT,
       icon_id BIGINT,
       publisher_id BIGINT NOT NULL,
       color_id BIGINT,
       -- данная запись не содержит название цветка
       -- название содержится в категории
       category_id BIGINT NOT NULL,
       INDEX category_id_idx (category_id),
       INDEX sex_idx (sex_id),
       INDEX season_end_idx (season_end),
       INDEX season_start_idx (season_start),       
       INDEX album_id_idx (album_id),
       INDEX icon_id_idx (icon_id),
       INDEX publisher_id_idx (publisher_id),
       INDEX color_id_idx (color_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
       

CREATE TABLE flower_posy (
       id BIGINT AUTO_INCREMENT,
       amount BIGINT comment 'кол-во цветка в букете',
       flower_id BIGINT NOT NULL,
       posy_id BIGINT NOT NULL,
       INDEX flower_id_idx (flower_id),
       INDEX posy_id_idx (posy_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'состав букета; здесь перечислены только цветы остальное в used_product' ;

CREATE TABLE flower_shop (
       id BIGINT AUTO_INCREMENT,
       -- телефон магазина, также у каждого сотрудника есть опция
       -- считать его телефон телефоном магазина ( например когда он дежурный )
       phone VARCHAR(255) character set utf8 collate utf8_unicode_ci ,
       -- часы работы
       start_work_at TIME,
       end_work_at TIME,
       name VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL
            comment 'официальное название',
       email_address VARCHAR(100) character set utf8 collate utf8_unicode_ci  DEFAULT NULL
                     comment 'адрес электронной почты',
       mail_address TEXT comment 'точный почтовый адрес',
       outline_route TEXT comment 'доходчивое описание как легче все добраться до нас',
       map_x DECIMAL(6,6) comment 'координаты магазина для яднекс карты',
       map_y DECIMAL(6,6) comment 'точка на карте описывается двумя вещественными числами',
       -- центр объекта 39.786857, 47.267104
       place_x DECIMAL(6,6),
       place_y DECIMAL(6,6),
       map_scale BIGINT DEFAULT 13 NOT NULL comment 'масштаб карты от 0 до 17',
       -- размеры окна в пикселях
       map_width BIGINT DEFAULT 600 NOT NULL,
       map_heigth BIGINT DEFAULT 400 NOT NULL,
       -- виды магазина с улициы ( альбом фоток )
       views BIGINT,
       INDEX views_idx (views),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'цветочный магазин; хранит общие параметры';

       
CREATE TABLE forum_post (
       id BIGINT AUTO_INCREMENT,
       body TEXT NOT NULL,
       created_at DATETIME NOT NULL default current_timestamp,
       author_id BIGINT NOT NULL,
       theme_id BIGINT not null,
       INDEX theme_id_idx ( theme_id ),
       INDEX author_id_idx (author_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
       
CREATE TABLE forum_theme (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL
            comment 'заголовок темы / вопроса',
       created_at DATETIME NOT NULL default current_timestamp,
       pinned_order BIGINT comment 'тема важная и постоянная всегда весит вышие обычных тем     
                                    если не null. Если не null значит порядок среди таких же тем',
       freezed TINYINT(1) DEFAULT '0' NOT NULL comment 'тема заморожена и
                                                       в нее нельзя добавлять сообщения
                                                       всем кроме администраторов',
       author_id BIGINT NOT NULL,
       updated_at DATETIME NOT NULL default current_timestamp
                  comment 'время добавления последнего сообщения',
       numviews integer not null default 0 comment 'кол-во просмотров',
       numposts integer not null default 0 comment 'кол-во сообщений по теме',
       INDEX author_id_idx (author_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'для форума темы, сообщения, прикрепленные документы';
       
CREATE TABLE measure (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       logname VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL,
       is_option TINYINT(1) DEFAULT '0' NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'единицы измерения метры, килограммы, граммы, опция ( может быть использована один раз
       при изготовлении букета - посыпать блестяшками букет';

create table payment_type (
       id BIGint auto_increment,
       name varchar (128) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       itmorder integer not null unique,
       icon_id bigint,
       primary key(id) 
) engine=innodb comment 'тип платежа те как им образом клент расплатился:
                         яндек деньги, webmoney или наличный расчет';
                         
CREATE TABLE orders (
       id BIGINT AUTO_INCREMENT,
       number VARCHAR(40) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE
              comment 'номер заказа',
       ordered_at DATETIME NOT NULL comment 'когда заказ принят ( клиент только что заказал )',
       deadline DATETIME NOT NULL comment 'срок к котору требуется выполнить заказ',
       accepted_at DATETIME comment 'время принятия заказа',
       completed_at DATETIME comment 'время когда заказ стал готов',
       canceled_at DATETIME comment 'заказ отменен',
       cancel_description VARCHAR(255) character set utf8 collate utf8_unicode_ci ,
       client_requirements TEXT comment 'информация о заказе требования клиента',
       -- информация о клиенте       
       client_phone VARCHAR(50) character set utf8 collate utf8_unicode_ci  NOT NULL
                    comment 'телефон',
       client_name VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL
                   comment 'фамилия имя отчество',
       client_email VARCHAR(100) character set utf8 collate utf8_unicode_ci ,
       order_amount FLOAT(18,2) NOT NULL comment 'сумма заказа без учета скидок в рублях',
       client_id BIGINT comment 'not null если зарегистрированный клиент',
       responsible_id BIGINT comment 'ответственный за выполение заказа тот кто его принял и начал вязать букет',
       posy_id BIGINT NOT NULL comment 'готовый букет либо букет собранный в конструкторе самим клиентом',
       client_grade integer comment 'оценка качеста выполненного заказа клиентов от 1 5',
       client_response text comment 'отзыв клиента о выполнении заказа',       
       payment_type_id bigint,
       INDEX responsible_id_idx (responsible_id),
       INDEX posy_id_idx (posy_id),
       index payment_type_id_idx (payment_type_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'заказы клиентов';
       
CREATE TABLE photo (
       id BIGINT AUTO_INCREMENT,
       -- кол-во ссылко на сущность
       numlinks BIGINT DEFAULT 0 NOT NULL,
       -- путь к файлу
       path VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL,
       -- формат файла ( расширение )
       extention VARCHAR(10) character set utf8 collate utf8_unicode_ci  NOT NULL,
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

create table price_type (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       constructor_enabled tinyint(1) not null comment 'кленты могут менять состав букета',
       primary key (id )
  ) engine=innodb comment 'тип цены цена может быть не указана, постоянная, постоянная + переменная от кол-ва цветов
             если тип цены постоянный то букет не доступен для конструктора букетов так как его состав нельзя
             изменять ';
             
-- букет цветов ( в общем какой то товар который
-- делается под заказ по некоторому шаблону )       
CREATE TABLE posy (
       id BIGINT AUTO_INCREMENT,
       sale_rating float(6,6) not null default 0.0
              comment 'популярность букета за последний период от 0 до 1 вычисляется на основе продаж',
       view_rating integer not null default 0
                   comment 'популярность букета просмотров букета за последний период',
       -- 1 -> это описание букета созданное клиентом и заказанное хотябы один раз
       -- поэтому оно храниться в базе так как может понравить еще кому нибудь
       client_made TINYINT(1) DEFAULT '0' NOT NULL,
       -- доступен для просмотра
       is_visible TINYINT(1) DEFAULT '1' NOT NULL,       
       -- счетчик ссылок на букет из видов букетов       
       numlinks BIGINT DEFAULT 0 NOT NULL,
       -- название букета
       name VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       -- пояснение, описание
       description TEXT,
       -- время размещения материала
       published_at DATETIME NOT NULL default current_timestamp,
       -- время создания работы автором
       created_at DATETIME NOT NULL default current_timestamp,
       -- метод формирования цены ( цена не указана, цена постоянная, переменная )
       price_type_id bigint not null, 
       -- постоянная составляющая цены
       -- переменная состовляющая для каждого компонента своя
       const_price FLOAT(18,2) DEFAULT 0 NOT NULL,
       icon_id bigint,
       -- автор материала тот кто его выложил на сайт        
       publisher_id BIGINT NOT NULL,
       -- автор работы
       author_id BIGINT NOT NULL,
       -- альбом фотографий букета
       album_id BIGINT,
       index icon_id_idx( icon_id ),
       INDEX author_id_idx (author_id),
       INDEX album_id_idx (album_id),
       index price_type_id_idx ( price_type_id ),
       PRIMARY KEY(id)) ENGINE = INNODB;
       
CREATE TABLE posy_view (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       description TEXT,
       icon_id bigint,
       grporder BIGINT NOT NULL comment 'порядок группы в списке видов букетов',
       index icon_id_idx ( icon_id ),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'вид букета ( из роз, свадебный )
                один букет может быть в нескольких';
       
CREATE TABLE posy_view_list (
       id BIGINT AUTO_INCREMENT,
       itmorder BIGINT NOT NULL comment 'порядок букетов в группе',
       posy_id BIGINT NOT NULL,
       posyview_id BIGINT NOT NULL,
       INDEX posy_id_idx (posy_id),
       INDEX posyview_id_idx (posyview_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'таблица связка нужна потому что один и тот же букет
                може быть в разных категориях';
       
CREATE TABLE product (
       id BIGINT AUTO_INCREMENT,
       sale_rating float(6,6) not null default 0.0
              comment 'популярность  за последний период от 0 до 1 вычисляется на основе продаж',
       view_rating integer not null default 0
                   comment 'популярность кол-во просмотров  за последний период',       
       is_visible TINYINT(1) DEFAULT '1' NOT NULL
                  comment 'доступен для просмотра',              
       name VARCHAR(255) character set utf8 collate utf8_unicode_ci  NOT NULL
            comment 'название товара ( горшок )',
       description TEXT comment 'описание',
       vendor VARCHAR(255) character set utf8 collate utf8_unicode_ci
              comment 'производитель',
       amount BIGINT DEFAULT 0 NOT NULL
              comment 'кол-во товара',
       price FLOAT(18,2) comment 'цена за ед. если null значит не извесна',
       last_entrance DATETIME NOT NULL default current_timestamp comment 'дата последнего поступления',
       is_home_plant TINYINT(1) NOT NULL default '0' comment 'здесь могу быть комнатные растения',
       temperature_range VARCHAR(20) character set utf8 collate utf8_unicode_ci
                         comment 'требования к хранению ( дипазон температур, влажности, освещенность )',
       blossoming_id BIGINT comment 'время цветения постоянно, не цветет и диапазон',
       blossoming_start DATE,
       blossoming_end DATE,
       sun BIGINT comment 'чуствительность к солнцу люби/нелюбит',
       sprinkling_period VARCHAR(100) character set utf8 collate utf8_unicode_ci
                         comment 'переодичность полива',
       size VARCHAR(30) character set utf8 collate utf8_unicode_ci
            comment 'размеры ( у открыток a4 a5 ... )',
       weight FLOAT(18,2) comment 'вес',
       category_id BIGINT NOT NULL,
       icon_id BIGINT,
       album_id BIGINT,
       color_id BIGINT comment 'основной цвет',
       publisher_id BIGINT NOT NULL,
       INDEX publisher_id_idx (publisher_id),
       INDEX sun_idx (sun),
       INDEX blossoming_id_idx (blossoming_id),
       INDEX category_id_idx (category_id),
       INDEX album_id_idx (album_id),
       INDEX icon_id_idx (icon_id),
       INDEX color_id_idx (color_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'конкретный вид товара напирмер горшики пластмассовые китайские на 2 литра';
       
CREATE TABLE product_category (
       id BIGINT AUTO_INCREMENT,
       is_visible TINYINT(1) DEFAULT '1' NOT NULL comment 'доступен для просмотра',
       is_flower TINYINT(1) DEFAULT '0' NOT NULL comment 'это не категория товара а вид цветка',
       name VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       description TEXT,
       catorder BIGINT NOT NULL,
       measure_id BIGINT comment 'единица измерения',
       icon_id BIGINT comment 'иконка категории товаров',
       publisher_id BIGINT NOT NULL default current_timestamp,
       updated_at DATETIME NOT NULL default current_timestamp,
       INDEX measure_id_idx (measure_id),
       INDEX icon_id_idx (icon_id),
       INDEX publisher_id_idx (publisher_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'категораия товара ( искуственные цветы, открытки, горшки, почва, удобрения );
       также записи могут представлять вид цветка например роза или тюльпан';
       
-- времена года когда есть в продаже определенные виды цветов
CREATE TABLE season (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(40) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       -- отношение порядка зима, весна, лето, осень
       sorder BIGINT UNIQUE NOT NULL,
       PRIMARY KEY(id)) ENGINE = INNODB;
       
-- пол человека (м/ж/ любой )
CREATE TABLE sex (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       PRIMARY KEY(id)) ENGINE = INNODB;
       
-- пользователь сайта может блогером, работником, администратором и клиентом       
CREATE TABLE site_user (
       id BIGINT AUTO_INCREMENT,
       login VARCHAR(30) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       -- у каждого пользователя должен быть уникальный почтовый ящик
       -- так как он будет использоваться для восстановления пароля       
       email VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       -- имя
       firstname VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL,
       -- фамилия
       lastname VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL,
       -- отчество
       patronymic VARCHAR(100) character set utf8 collate utf8_unicode_ci  NOT NULL,
       -- личный телефон 
       personal_phone VARCHAR(50) character set utf8 collate utf8_unicode_ci ,
       -- рабочий телефон только для для сотрудников
       employee_phone VARCHAR(50) character set utf8 collate utf8_unicode_ci ,
       -- может писать сообщения на форуме ( блогер )
       is_blogger TINYINT(1) DEFAULT '0' NOT NULL,
       -- подпись после каждого сообщения
       signature VARCHAR(255) character set utf8 collate utf8_unicode_ci ,
       -- может делать авторизованные заказы ( клиент )
       is_client TINYINT(1) DEFAULT '0' NOT NULL,
       -- скидка клиенту
       discount FLOAT(18,6) DEFAULT 0 NOT NULL,
       -- хэш пароля ( 64 символа хватит для sha256
       password VARCHAR(64) character set utf8 collate utf8_unicode_ci  NOT NULL,
       -- администратор - самые широкие полномочия
       is_root TINYINT(1) DEFAULT '0' NOT NULL,
       -- дата и время регистрации в системе
       registered_at DATETIME NOT NULL default current_timestamp,
       -- работник
       is_employee TINYINT(1) DEFAULT '0' NOT NULL,
       -- дата последнего посещения сайта ( последня активность ) 
       last_login_at DATETIME NOT NULL default current_timestamp,
       -- ссылка на фотографию
       face_id BIGINT,
       INDEX face_id_idx (face_id),
       PRIMARY KEY(id)) ENGINE = INNODB;
       
CREATE TABLE sun_sense (
       id BIGINT AUTO_INCREMENT,
       name VARCHAR(10) character set utf8 collate utf8_unicode_ci  NOT NULL UNIQUE,
       love float (2,2) comment 'чем больше тем больше любит солнце. если love = hate = 0 то не чуствительно',
       hate float (2,2) comment 'чем больше тем больше любит тень',
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'чуствительность к солнцу';
       
CREATE TABLE used_products (
       id BIGINT AUTO_INCREMENT,
       amount BIGINT comment 'кол-во на один букет',
       product_id BIGINT,
       posy_id BIGINT,
       INDEX product_id_idx (product_id),
       INDEX posy_id_idx (posy_id),
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'остальные элементы входящие в букет (ленты, фольга и тд)';
       
CREATE TABLE web_site (
       id BIGINT AUTO_INCREMENT,
       visitors_a_hour BIGINT DEFAULT 0 NOT NULL
                       comment 'кол-во посещений сайта за час',
       visitors_a_day BIGINT DEFAULT 0 NOT NULL
                      comment 'кол-во посещений сайта за сутки',
       support_email VARCHAR(100) character set utf8 collate utf8_unicode_ci not null,
       birth_year BIGINT 'comment год основания сайта / магазина',
       meta_keywords text comment 'содержимое для html мета тега keywords',
       meta_description text comment 'содержимое для html мета тега description',
       meta_author text comment 'содержимое для html мета тега author',
       name varchar(255) character set utf8 collate utf8_unicode_ci not null
            comment 'название сайта/сети магазинов',
       about TEXT commet 'о веб сайте',
       PRIMARY KEY(id)) ENGINE = INNODB
       comment 'о самом веб сайте ( сущность в единственном экземпляре )';
       
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
      
ALTER TABLE album_element
      ADD CONSTRAINT album_element_album_id_photo_album_id
      FOREIGN KEY (album_id)
      REFERENCES photo_album(id)
      ON DELETE CASCADE;
ALTER TABLE color_list_element
      ADD CONSTRAINT color_list_element_list_id_color_list_id
      FOREIGN KEY (list_id)
      REFERENCES color_list(id)
      ON DELETE CASCADE;
ALTER TABLE color_list_element
      ADD CONSTRAINT color_list_element_color_id_color_id
      FOREIGN KEY (color_id)
      REFERENCES color(id) ON DELETE CASCADE;
ALTER TABLE flower
      ADD CONSTRAINT flower_sex_sex_id
      FOREIGN KEY (sex_id)
      REFERENCES sex(id);
ALTER TABLE flower
      ADD CONSTRAINT flower_season_end_season_id
      FOREIGN KEY (season_end)
      REFERENCES season(id)
      ON DELETE CASCADE;
ALTER TABLE flower
      ADD CONSTRAINT flower_publisher_id_site_user_id
      FOREIGN KEY (publisher_id)
      REFERENCES site_user(id)
      ON DELETE CASCADE;
ALTER TABLE payment_type
      ADD CONSTRAINT payment_type_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE CASCADE;      
ALTER TABLE flower
      ADD CONSTRAINT flower_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE CASCADE;
ALTER TABLE flower
      ADD CONSTRAINT flower_color_id_color_id
      FOREIGN KEY (color_id)
      REFERENCES color(id)
      ON DELETE CASCADE;
ALTER TABLE flower
      ADD CONSTRAINT flower_category_id_product_category_id
      FOREIGN KEY (category_id)
      REFERENCES product_category(id);
ALTER TABLE flower
      ADD CONSTRAINT flower_album_id_photo_album_id
      FOREIGN KEY (album_id)
      REFERENCES photo_album(id)
      ON DELETE CASCADE;
ALTER TABLE flower_posy
      ADD CONSTRAINT flower_posy_posy_id_posy_id
      FOREIGN KEY (posy_id)
      REFERENCES posy(id)
      ON DELETE CASCADE;
ALTER TABLE flower_posy
      ADD CONSTRAINT flower_posy_flower_id_flower_id
      FOREIGN KEY (flower_id)
      REFERENCES flower(id)
      ON DELETE CASCADE;
ALTER TABLE flower_shop
      ADD CONSTRAINT flower_shop_views_photo_album_id
      FOREIGN KEY (views)
      REFERENCES photo_album(id)
      ON DELETE RESTRICT;
ALTER TABLE forum_post
      ADD CONSTRAINT forum_post_author_id_site_user_id
      FOREIGN KEY (author_id)
      REFERENCES site_user(id)
      ON DELETE CASCADE;
ALTER TABLE forum_post
      ADD CONSTRAINT forum_post_theme_id_forum_theme_id
      FOREIGN KEY (theme_id)
      REFERENCES forum_theme(id)
      ON DELETE CASCADE;
ALTER TABLE forum_theme
      ADD CONSTRAINT forum_theme_author_id_site_user_id
      FOREIGN KEY (author_id)
      REFERENCES site_user(id)
      ON DELETE CASCADE;
ALTER TABLE orders
      ADD CONSTRAINT orders_responsible_id_site_user_id
      FOREIGN KEY (responsible_id)
      REFERENCES site_user(id)
      ON DELETE CASCADE;
ALTER TABLE orders
      ADD CONSTRAINT orders_posy_id_posy_id
      FOREIGN KEY (posy_id)
      REFERENCES posy(id)
      ON DELETE CASCADE;
ALTER TABLE posy
      ADD CONSTRAINT posy_author_id_site_user_id
      FOREIGN KEY (author_id)
      REFERENCES site_user(id)
      ON DELETE CASCADE;
ALTER TABLE posy
      ADD CONSTRAINT posy_price_type_id_price_type_id
      FOREIGN KEY (price_type_id)
      REFERENCES price_type(id)
      ON DELETE CASCADE;
ALTER TABLE posy
      ADD CONSTRAINT posy_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE CASCADE;
ALTER TABLE posy
      ADD CONSTRAINT posy_album_id_photo_album_id
      FOREIGN KEY (album_id)
      REFERENCES photo_album(id)
      ON DELETE CASCADE;
ALTER TABLE posy_view_list
      ADD CONSTRAINT posy_view_list_posyview_id_posy_view_id
      FOREIGN KEY (posyview_id)
      REFERENCES posy_view(id)
      ON DELETE CASCADE;
ALTER TABLE posy_view_list
      ADD CONSTRAINT posy_view_list_posy_id_posy_id
      FOREIGN KEY (posy_id)
      REFERENCES posy(id)
      ON DELETE CASCADE;
ALTER TABLE product
      ADD CONSTRAINT product_sun_sun_sense_id
      FOREIGN KEY (sun)
      REFERENCES sun_sense(id);
ALTER TABLE product
      ADD CONSTRAINT product_publisher_id_site_user_id
      FOREIGN KEY (publisher_id)
      REFERENCES site_user(id);
ALTER TABLE product
      ADD CONSTRAINT product_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE CASCADE;
ALTER TABLE product
      ADD CONSTRAINT product_color_id_color_id
      FOREIGN KEY (color_id)
      REFERENCES color(id)
      ON DELETE CASCADE;
ALTER TABLE product
      ADD CONSTRAINT product_category_id_product_category_id
      FOREIGN KEY (category_id)
      REFERENCES product_category(id)
      ON DELETE CASCADE;
ALTER TABLE product
      ADD CONSTRAINT product_blossoming_id_blossoming_id
      FOREIGN KEY (blossoming_id)
      REFERENCES blossoming(id);
ALTER TABLE product
      ADD CONSTRAINT product_album_id_photo_album_id
      FOREIGN KEY (album_id)
      REFERENCES photo_album(id)
      ON DELETE CASCADE;
ALTER TABLE product_category
      ADD CONSTRAINT product_category_publisher_id_site_user_id
      FOREIGN KEY (publisher_id)
      REFERENCES site_user(id);
ALTER TABLE product_category
      ADD CONSTRAINT product_category_measure_id_measure_id
      FOREIGN KEY (measure_id)
      REFERENCES measure(id)
      ON DELETE CASCADE;
ALTER TABLE product_category
      ADD CONSTRAINT product_category_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE SET NULL;
ALTER TABLE site_user
      ADD CONSTRAINT site_user_face_id_photo_id
      FOREIGN KEY (face_id)
      REFERENCES photo(id)
      ON DELETE SET NULL;
ALTER TABLE used_products
      ADD CONSTRAINT used_products_product_id_product_id
      FOREIGN KEY (product_id)
      REFERENCES product(id)
      ON DELETE CASCADE;
ALTER TABLE used_products
      ADD CONSTRAINT used_products_posy_id_posy_id
      FOREIGN KEY (posy_id)
      REFERENCES posy(id)
      ON DELETE CASCADE;
ALTER TABLE posy_view
      ADD CONSTRAINT posy_view_icon_id_photo_id
      FOREIGN KEY (icon_id)
      REFERENCES photo(id)
      ON DELETE RESTRICT;

-- триггеры
delimiter |
create trigger forum_post_counter_inc after insert on forum_post
       for each row begin
           update forum_theme set numposts = numposts + 1 where id = new.theme_id ;
       end ;
create trigger forum_post_counter_dec after delete on forum_post
       for each row begin
           update forum_theme set numposts = numposts - 1 where id = old.theme_id ;
       end ;

create trigger posy_counter_inc after insert on posy_view_list
       for each row begin
           update posy set numlinks = numlinks + 1 where id = new.posy_id ;
       end ;
create trigger posy_counter_dec after delete on posy_view_list
       for each row begin
           update posy set numlinks = numlinks - 1 where id = new.posy_id ;
       end ;
       
-- ссылки на фотографии используется почти во всех таблицах поэтому
-- чтобы не дублировать код тригера вынес его в процедуры
-- site_user, album_element, flower, payment_type, posy, posy_view, product, product_category
create procedure inc_photo_counter ( photo_id bigint )
       begin
          update photo set numlinks = numlinks + 1 where id = photo_id ;
       end;
create procedure dec_photo_counter ( photo_id bigint )
       begin
          update photo set numlinks = numlinks - 1 where id = photo_id ;
       end;
       
create procedure update_photo_counter ( old_photo_id bigint, new_photo_id bigint)
       begin
        if old_photo_id <> new_photo_id then
          call dec_photo_counter ( old_photo_id );
          call inc_photo_counter ( new_photo_id );          
        end if;
       end;
 after delete on posy_view_list
       for each row begin
create trigger site_user_ins after insert on site_user for each row inc_photo_counter ( new.face_id );       
create trigger site_user_del after delete on site_user for each row dec_photo_counter ( old.face_id );       
create trigger site_user_upd after update on site_user for each row upd_photo_counter ( old.face_id, new.face_id );
create trigger album_element_ins after insert on album_element for each row inc_photo_counter ( new.photo_id );   
create trigger album_element_del after delete on album_element for each row dec_photo_counter ( old.photo_id );   
create trigger album_element_upd after update on album_element
       for each row upd_photo_counter (old.photo_id,new.photo_id);
create trigger flower_ins after insert on flower for each row inc_photo_counter ( new.icon_id );          
create trigger flower_del after delete on flower for each row dec_photo_counter ( old.icon_id );            
create trigger flower_upd after update on flower for each row upd_photo_counter ( old.icon_id, new.icon_id );
create trigger payment_type_ins after insert on payment_type for each row inc_photo_counter ( new.icon_id );    
create trigger payment_type_del after delete on payment_type for each row dec_photo_counter ( old.icon_id );    
create trigger payment_type_upd after update on payment_type
       for each row upd_photo_counter ( old.icon_id, new.icon_id );
create trigger posy_ins after insert on posy for each row inc_photo_counter ( new.icon_id );            
create trigger posy_del after delete on posy for each row dec_photo_counter ( old.icon_id );               
create trigger posy_upd after update on posy for each row upd_photo_counter ( old.icon_id, new.icon_id );
create trigger posy_view_ins after insert on posy_view for each row inc_photo_counter ( new.icon_id );       
create trigger posy_view_del after delete on posy_view for each row dec_photo_counter ( old.icon_id );       
create trigger posy_view_upd after update on posy_view for each row upd_photo_counter ( old.icon_id, new.icon_id );
create trigger product_ins after insert on product for each row inc_photo_counter ( new.icon_id );         
create trigger product_del after delete on product for each row dec_photo_counter ( old.icon_id );            
create trigger product_upd after update on product for each row upd_photo_counter ( old.icon_id, new.icon_id );
create trigger product_category_ins after insert on product_category for each row inc_photo_counter ( new.icon_id );
create trigger product_category_del after delete on product_category for each row dec_photo_counter ( old.icon_id );
create trigger product_category_upd after update on product_category
       for each row upd_photo_counter (old.icon_id,new.icon_id );
       
|

-- заполняем словари
insert into sun_sense (name,love,hate)
       values ('тенелюбивое', 0.0, 1.0),
              ('солнцелюбивое', 1.0, 0.0),
              ('к солнцу безразлично', 0.0, 0.0);              
insert into sex (name) values ('мужчинам', 'женщинам', 'всем');
insert into season (name,sorder) values ('зима',1), ('весна',2),('лето',3),('осень',4);
insert into blossoming (name,preriod) values ('цветет раз в год', 1),
                                             ('не цветет', -1),
                                             ('цветет постоянно', 0);
insert into color (name, rgbvalue) values ('зеленый','00EE00'),
                                          ('черный','000000'),
                                          ('белый','FFFFFF'),
                                          ('синий','0000FF'),                                          
                                          ('красный','FF0000');
-- несколько пользователей для каждого типа
insert into site_user ( login, email, firstname, lastname, patronymic,
                        personal_phone, employee_phone, is_blogger,
                        password, is_employee, is_client, is_root 
                      )
       values ( 'toma', 'toma@yandex.ru', 'Тамара', 'Глазырина', 'Николаевна',
                '+7-928-159-00-04', '+7-928-159-00-04', '1',
                sha('1'), '1', '0', '0' ),
              ( 'dan', 'rtfm.rtfm.rtfm@gmail.com', 'Данил', 'Яицков', 'Сергеевич',
                '+7-928-159-00-04', null, '1',
                sha('1'), '0', '0', '1' ),
              ( 'bree', 'eerda@inbox.ru', 'Ирина', 'Балабай', 'Викторовна',
                '+7-928-159-00-04', null, '1',
                sha('1'), '0', '1', '0' );

insert into web_site ( support_email, birth_year, meta_keywords,
                       meta_description, meta_author, about, name )
       values ( 'rtfm.rtfm.rtfm@gmail.com', 2003,
                'букет, заказ цветов, цветы, упаковка подарков, Ростов-на-Дону, Сельмаш,
                 розы, тюльпаны, лилии, открытки, удобрения, горшки, грунт,
                 Глазырина Тамара Николаевна',       
                'Заказ цветов и букетов онлайн и по телефону +7-928-159-00-04 без выходных.
                 Розы и тюльпаны, цветы, подарки, открытки, интернет-магазин цветов.',
                'Цветочный магазин donbuket.ru - заказ цветов в Ростове-на-Дону',
                'Мы настоящий цветочный магазин. Мы находимся на рынке ....',
                'Донской букет');

insert into product_category (name, catorder)
       values ('искуственные цветы', 0),
              ('открытки', 1),
              ('горшки', 2),
              ('комнатные цветы', 3);
insert into product_category (name, catorder, is_flower)
       values ('розы', 0, 1), ('тюльпаны', 1, 1);
              
--- о магазине
insert into flower_shop ( phone, start_work_at, end_work_at, email_address,
                          mail_address, outline_route, map_x, map_y, place_x,
                          place_y, name )
       values ( '+7-928-159-00-04', '08:00', '11:00', 'flowers@yandex.ru',
                'Ростов-на-Дону, ул. Строителей, д. 3',
                'Из центра к нам можно добраться на маршрутке #3 или автобусе 3А',
                39.786857, 47.267104,
                39.786857, 47.267104,
                'Трансильвания');
-- о цветы
insert into flower (comment, howcare, legheight, work_factor,
                    sex_id, publisher_id, color_id, category_id )
       values ( 'голанская', 'менять воду и подрезать на 2 см каждый день',
                80, -- cm
                1.2, --work factor
                3, -- all
                1, -- my aunt
                5, -- red
                5), -- rose
              ( 'месная', 'менять воду и подрезать на 1 см каждый день',
                40, -- cm
                1.1, --work factor
                3, -- all
                1, -- my aunt
                5, -- red
                5); -- rose                
       
-- букеты
insert into posy ( name, description, price_type_id, const_price, publisher_id, author_id)
       values ('Весна',  'Подойдет всем кому не лень', 1, 0, 1, 1),
              ('Зима',  'Врятли кому подойдет', 2, 100, 1, 1);
insert into flower_posy ( amount, flower_id, posy_id )
       values ( 3, 1, 1), ( 2, 2, 1), ( 7, 1, 2);

-- категории букетов 
insert into posy_view ( name, description, grporder )
       values ( 'Свадебный', 'Для свадьбы', 1 ),
              ( '23 февраля', 'Для мужчин', 2 );
insert into posy_view_list ( itmorder, posy_id, posyview_id )
       values ( 1, 1, 1 ) , ( 2, 2, 1 ), ( 1, 2, 2 );
-- товары
insert into product ( name, vendor, amount, price, category_id )
       values ( 'венок', 'китай', 123, 111, 1 ),
              ( 'открытка', 'китай', 221, 44, 2 ),
              ( 'фикус', 'китай', 21, 140, 4 ),
              ( 'лимонное дерево', 'китай', 1, 340, 4 );
       
-- сообщения на форуме
insert into forum_theme ( name, pinned_order, freezed, author_id )
       values ( 'Правила формуа', '1', '1', 1 ),
              ( 'Как выбрать хороший букет', '1', '1', 1 ),
              ( 'Какие цветы подходят женщинам', '1', '1', 1 ),
              ( 'Какие цветы подходят мужчинам', '1', '1', 1 ),
              ( 'Отзывы наших клиентов', '1', '1', 1 );
              
insert into forum_post ( body, author_id, theme_id )
       values ( 'П. 1 Администратор всега прав. П. 2 Если администратор не прав см. П. 1.',
                2, 1 ),
              ( 'Чтобы выбрать хороший букет обращайтесь к нам',
                2, 2 ),
              ( 'Чтобы не выбрать плохой букет не обращайтесь к другим',
                2, 2 );