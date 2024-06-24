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

# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfbase_domain_model_agent_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_location_feature_geodata_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_location_resource_floorplan_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_location_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_period_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_agent_agent_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_agent_contributor_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_any_record_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_any_relatedrecord_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_bibliographic_entry_bibentry_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_essay_essay_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_feature_feature_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_location_location_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_tag_lexrelationtype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_tag_licence_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_volume_volume_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_resource_resource_glossary_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_tag_tag_labeltype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);
