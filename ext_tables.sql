-- This file is part of the extension CHF Base for TYPO3.
--
-- For the full copyright and license information, please read the
-- LICENSE.txt file that was distributed with this source code.


-- Table config for 'tx_chfbase_domain_model_agent'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_agent (
    parentResource varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    forename varchar(255) DEFAULT '',
    surname varchar(255) DEFAULT '',
    corporateName varchar(255) DEFAULT '',
    alternativeName varchar(255) DEFAULT '',
    honorific varchar(255) DEFAULT '',
    occupation varchar(255) DEFAULT '',
    gender varchar(255) DEFAULT '' NOT NULL,
    isContributor smallint unsigned DEFAULT '0' NOT NULL,
    isHighlight smallint unsigned DEFAULT '0' NOT NULL,
    label int unsigned DEFAULT '0' NOT NULL,
    sameAs int unsigned DEFAULT '0' NOT NULL,
    authorshipRelation int unsigned DEFAULT '0' NOT NULL,
    licenceRelation int unsigned DEFAULT '0' NOT NULL,
    revisionNumber int unsigned DEFAULT '0',
    editorialNote varchar(2000) DEFAULT '',
    event varchar(255) DEFAULT '' NOT NULL,
    agentRelation int unsigned DEFAULT '0' NOT NULL,
    locationRelation int unsigned DEFAULT '0' NOT NULL,
    contentElement varchar(255) DEFAULT '' NOT NULL,
    footnote varchar(255) DEFAULT '' NOT NULL,
    media int unsigned DEFAULT '0' NOT NULL,
    file int unsigned DEFAULT '0' NOT NULL,
    linkRelation int unsigned DEFAULT '0' NOT NULL,
    importOrigin varchar(255) DEFAULT '',
    import varchar(100000) DEFAULT '',
    asAgentOfAgentRelation int unsigned DEFAULT '0' NOT NULL,
    asContributorOfAuthorshipRelation int unsigned DEFAULT '0' NOT NULL
);

-- Table config for 'tx_chfbase_domain_model_extent'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_extent (
    type varchar(255) DEFAULT '' NOT NULL,
    text varchar(255) DEFAULT ''
);

-- Table config for 'tx_chfbase_domain_model_footnote'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_footnote (
    text varchar(255) DEFAULT ''
);

-- Table config for 'tx_chfbase_domain_model_location'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_location (
    parentResource varchar(255) DEFAULT '' NOT NULL,
    parentLocation varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    name varchar(255) DEFAULT '',
    alternativeName varchar(255) DEFAULT '',
    isHistorical smallint unsigned DEFAULT '0' NOT NULL,
    isImaginary smallint unsigned DEFAULT '0' NOT NULL,
    isHighlight smallint unsigned DEFAULT '0' NOT NULL,
    label int unsigned DEFAULT '0' NOT NULL,
    sameAs int unsigned DEFAULT '0' NOT NULL,
    authorshipRelation int unsigned DEFAULT '0' NOT NULL,
    licenceRelation int unsigned DEFAULT '0' NOT NULL,
    revisionNumber int unsigned DEFAULT '0',
    editorialNote varchar(2000) DEFAULT '',
    event varchar(255) DEFAULT '' NOT NULL,
    agentRelation int unsigned DEFAULT '0' NOT NULL,
    contentElement varchar(255) DEFAULT '' NOT NULL,
    footnote varchar(255) DEFAULT '' NOT NULL,
    media int unsigned DEFAULT '0' NOT NULL,
    file int unsigned DEFAULT '0' NOT NULL,
    addressStreet varchar(255) DEFAULT '',
    addressNumber varchar(255) DEFAULT '',
    addressZip varchar(255) DEFAULT '',
    addressCity varchar(255) DEFAULT '',
    linkRelation int unsigned DEFAULT '0' NOT NULL,
    importOrigin varchar(255) DEFAULT '',
    import varchar(100000) DEFAULT '',
    asLocationOfLocationRelation int unsigned DEFAULT '0' NOT NULL
);

-- Table config for 'tx_chfbase_domain_model_period'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_period (
    parentResource varchar(255) DEFAULT '' NOT NULL,
    parentPeriod varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    text varchar(255) DEFAULT '',
    alternativeText varchar(255) DEFAULT '',
    calendar varchar(255) DEFAULT '' NOT NULL,
    isHighlight smallint unsigned DEFAULT '0' NOT NULL,
    label int unsigned DEFAULT '0' NOT NULL,
    sameAs int unsigned DEFAULT '0' NOT NULL,
    authorshipRelation int unsigned DEFAULT '0' NOT NULL,
    licenceRelation int unsigned DEFAULT '0' NOT NULL,
    revisionNumber int unsigned DEFAULT '0',
    editorialNote varchar(2000) DEFAULT '',
    event varchar(255) DEFAULT '' NOT NULL,
    agentRelation int unsigned DEFAULT '0' NOT NULL,
    locationRelation int unsigned DEFAULT '0' NOT NULL,
    contentElement varchar(255) DEFAULT '' NOT NULL,
    footnote varchar(255) DEFAULT '' NOT NULL,
    media int unsigned DEFAULT '0' NOT NULL,
    file int unsigned DEFAULT '0' NOT NULL,
    linkRelation int unsigned DEFAULT '0' NOT NULL,
    importOrigin varchar(255) DEFAULT '',
    import varchar(100000) DEFAULT ''
);

-- Table config for 'tx_chfbase_domain_model_relation'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_relation (
    parentResource varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    record int unsigned DEFAULT '0' NOT NULL,
    agent int unsigned DEFAULT '0' NOT NULL,
    contributor int unsigned DEFAULT '0' NOT NULL,
    location int unsigned DEFAULT '0' NOT NULL,
    licence int unsigned DEFAULT '0' NOT NULL,
    role varchar(255) DEFAULT '' NOT NULL,
    url varchar(2048) DEFAULT '' NOT NULL,
    linkText varchar(255) DEFAULT '',
    description varchar(2000) DEFAULT ''
);

-- Table config for 'tx_chfbase_domain_model_resource'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_resource (
    type varchar(255) DEFAULT '' NOT NULL,
    uri varchar(2048) DEFAULT '' NOT NULL,
    title varchar(255) DEFAULT '',
    langCode varchar(255) DEFAULT '',
    description varchar(2000) DEFAULT '',
    sameAs int unsigned DEFAULT '0' NOT NULL,
    authorshipRelation int unsigned DEFAULT '0' NOT NULL,
    licenceRelation int unsigned DEFAULT '0' NOT NULL,
    revisionNumber int unsigned DEFAULT '0',
    editorialNote varchar(2000) DEFAULT '',
    allAgents int unsigned DEFAULT '0' NOT NULL,
    allLocations int unsigned DEFAULT '0' NOT NULL,
    allPeriods int unsigned DEFAULT '0' NOT NULL,
    allRelations int unsigned DEFAULT '0' NOT NULL,
    allTags int unsigned DEFAULT '0' NOT NULL,
    importOrigin varchar(255) DEFAULT '',
    importState varchar(255) DEFAULT ''
);

-- Table config for 'tx_chfbase_domain_model_same_as'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_same_as (
    uri varchar(2048) DEFAULT '' NOT NULL
);

-- Table config for 'tx_chfbase_domain_model_tag'
-- Remove on switch to TYPO3 13
CREATE TABLE tx_chfbase_domain_model_tag (
    parentResource varchar(255) DEFAULT '' NOT NULL,
    parentLabelTag varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    labelType int unsigned DEFAULT '0' NOT NULL,
    code varchar(255) DEFAULT '',
    text varchar(255) DEFAULT '',
    description varchar(2000) DEFAULT '',
    sameAs int unsigned DEFAULT '0' NOT NULL,
    asLabelOfAgent int unsigned DEFAULT '0' NOT NULL,
    asLabelOfLocation int unsigned DEFAULT '0' NOT NULL,
    asLabelOfPeriod int unsigned DEFAULT '0' NOT NULL,
    asLabelTypeOfLabelTag int unsigned DEFAULT '0' NOT NULL,
    asLicenceOfLicenceRelation int unsigned DEFAULT '0' NOT NULL
);
