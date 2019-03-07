#
# Table structure for table 'tx_oollead_domain_model_enduser'
#
CREATE TABLE tx_oollead_domain_model_enduser (

	last_name varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	submission_id varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	urlsource varchar(255) DEFAULT '' NOT NULL,
	ip varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_oollead_domain_model_lead'
#
CREATE TABLE tx_oollead_domain_model_lead (

	date datetime DEFAULT NULL,
	email_used varchar(255) DEFAULT '' NOT NULL,
	soumissionid varchar(255) DEFAULT '' NOT NULL,
	end_user int(11) unsigned DEFAULT '0',
	lead_mover int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_oollead_domain_model_leadmover'
#
CREATE TABLE tx_oollead_domain_model_leadmover (

	address_from0 varchar(255) DEFAULT '' NOT NULL,
	address_from1 varchar(255) DEFAULT '' NOT NULL,
	address_to0 varchar(255) DEFAULT '' NOT NULL,
	address_to1 varchar(255) DEFAULT '' NOT NULL,
	moving_date datetime DEFAULT NULL,

);

#
# Table structure for table 'tx_oollead_domain_model_enduser'
#
CREATE TABLE tx_oollead_domain_model_enduser (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);
