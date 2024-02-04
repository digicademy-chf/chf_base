..  include:: /Includes.rst.txt

..  _design-principles:

=================
Design principles
=================

All data models in the Cultural Heritage Framework **adhere to common design
principles**. They are documented below to help you understand a data model
in question, to make informed decisions on how to implement changes, or to
aid in designing a new addition to the CHF.

1. Ideally, CHF data models are either based on or inspired by an existing
   model that is **widely used** in a specific domain or, if possible, even
   standardised.

2. Generic **classes that are reused** across dependent data models are stored
   in CHF Base. If a class would need lots of overrides if it were included
   here, it may be better located in the dependent data models that actually
   need it, even if this means that a bit of code needs to be duplicated.

3. Models designed to store data sets should be held together by a **central
   class** ``Resource`` (e.g., ``BibliographicResource`` for a bibliography).
   This allows for multiple data sets in the same TYPO3 instance. If data sets
   should be kept fully separate, however, they should also be stored in
   different pages (or folders).

4. Another common pattern across the CHF is to allow the use of ``SameAs`` and
   ``Tag`` classes. The former helps **identify entities** in Linked Open Data
   scenarios through identifiers from authority files, and the latter offers
   generic and, in some cases, extensible keyword and label systems.

5. The data models tend to **avoid extensive cross-dependencies**. Using
   classes from CHF Base is common, though, and some models may also
   include ``SourceRelation`` from CHF Bib or ``Feature`` and
   ``MapResource`` from CHF Map where appropriate. ``GlossaryResource`` may
   be used across all other data models if needed.

6. A data model extension **should contain** the TCA, model/repository/controller
   files, import and export formats appropriate for the data model, generic
   Fluid templates for the frontend, a search configuration, and embedded
   metadata to make the views it provides as machine-readable as possible.

7. The goal is to keep **as much logic as possible in PHP code** since it is
   relatively easy to learn and maintain, even for newcomers. TypoScript,
   which is a very powerful tool in TYPO3, is reserved for configuration
   instructions.
