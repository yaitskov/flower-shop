charset utf8;

drop database if exists user162_donbuket;
create database user162_donbuket CHARACTER SET utf8 collate utf8_unicode_ci;

use user162_donbuket;

\. schema.sql
\. procedures.sql
-- triggers with high probability will be converted
-- into php code
-- \. triggers.sql
-- boot strap data
\. bootstrap.sql