# The following is an example layout for a php-calendar table. You must stick 
# to at least this bare minimum of columns. You should be able to add more, as 
# I reference by column name and not id number.

CREATE TABLE calendar (
  id int(11) DEFAULT '0' NOT NULL auto_increment,
  username varchar(255),
  stamp datetime,
  duration datetime,
  eventtype int(4),
  subject varchar(255),
  description blob,
  PRIMARY KEY (id)
);

