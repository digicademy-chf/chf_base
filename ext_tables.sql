# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfbase_domain_model_agent (
    forename varchar(255) DEFAULT '' NOT NULL,
    surname varchar(255) DEFAULT '' NOT NULL,
    corporateName varchar(255) DEFAULT '' NOT NULL,
    alternativeName varchar(255) DEFAULT '' NOT NULL,
    honorific varchar(255) DEFAULT '' NOT NULL,
    occupation varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_extent (
    text varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_location (
    name varchar(255) DEFAULT '' NOT NULL,
    alternativeName varchar(255) DEFAULT '' NOT NULL,
    addressStreet varchar(255) DEFAULT '' NOT NULL,
    addressNumber varchar(255) DEFAULT '' NOT NULL,
    addressZip varchar(255) DEFAULT '' NOT NULL,
    addressCity varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_period (
    text varchar(255) DEFAULT '' NOT NULL,
    alternativeText varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation (
    linkText varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_resource (
    title varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL,
    importState varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_tag (
    code varchar(255) DEFAULT '' NOT NULL,
    text varchar(255) DEFAULT '' NOT NULL
);
