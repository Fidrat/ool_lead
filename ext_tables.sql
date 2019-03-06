#
# Table structure for table 'tx_oollead_domain_model_lead'
#
CREATE TABLE tx_oollead_domain_model_lead (

	last_name varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	soumissionid varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	urlsource varchar(255) DEFAULT '' NOT NULL,
	ip varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_oollead_domain_model_lead'
#
CREATE TABLE tx_oollead_domain_model_lead (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);
