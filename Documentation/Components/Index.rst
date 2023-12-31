..  include:: /Includes.rst.txt

..  _components:

==========
Components
==========

The modular architecture of the Cultural Heritage Framework follows the idea
of a **separation of concerns**. There are three types of components you
should know: specific data models, independent helpers, and the
project-specific sitepackage.

![Overview of the Cultural Heritage Framework's modular components](Overview.png)

..  figure:: /Components/Components.png
    :alt: Overview of the Cultural Heritage Framework
    :target: /Components/Components.png
    :class: with-shadow

    Overview of the Cultural Heritage Framework's modular components.

The main set of available extensions are **data models organised around
``chf_base``**, which provides core data structures. The base component also
includes its own user interface library for the web that is designed to be
accessible, atomic, responsive, and GDPR-compliant, as well as a few tools
needed by a number of dependent extensions. Each of these components targets
a highly specific data domain and includes data models, editing interfaces,
standard templates, common serialisations like TEI XML and embedded metadata,
data import options, and search configuration. The following extensions of
this category are available:

- [chf_base](https://github.com/digicademy-chf/chf_base) (resources, locations,
  periods, and actors; partly inspired by TEI)

- [chf_bib](https://github.com/digicademy-chf/chf_bib) (bibliographies and
  Zotero import; based on Zotero TEI)

- [chf_lex](https://github.com/digicademy-chf/chf_lex) (lexicographic
  resources with dictionary and/or encyclopedic entries; based on DMLex)

- [chf_map](https://github.com/digicademy-chf/chf_map) (geodata and image
  maps; based on GeoJSON)

- [chf_gloss](https://github.com/digicademy-chf/chf_gloss) (terms and their
  explanations)

- [chf_pub](https://github.com/digicademy-chf/chf_pub) (volumes and essays to
  model books, book series, blogs, and journals)

- [chf_object](https://github.com/digicademy-chf/chf_object) (physical objects
  and related events)

- [chf_media](https://github.com/digicademy-chf/chf_media) (image, video, and
  3D files, galleries, and collections)

- *Not in development yet:* ``chf_music`` (MEI data)

- *Not in development yet:* ``chf_letter`` (correspondences)

In addition to these data models, **three optional helpers are available**.
They provide single-purpose additions to TYPO3's functionality that are useful
in a Digital Humanities-focused web app. Using these helpers may require a bit
of configuration in accordance with their individual documentation. They may
also be used without any of the CHF data models listed above:

- [lod](https://github.com/digicademy/lod) (resolvable identifiers, content
  negotiation, RDF statements)

  - *Not in development yet:* ``lod_sru`` (generic Search/Retrieve-via-URL API)

  - *Not in development yet:* ``lod_sparql`` (generic SPARQL API)

  - *Not in development yet:* ``lod_oaipmh`` (generic OAI-PMH API)

- [qad](https://github.com/digicademy/qad) (quality assurance for data,
  dashboards)

- [vis](https://github.com/digicademy/vis) (a set of visualisations)

Last but not least, **each project needs its own sitepackage**. In theory,
every aspect of the other extensions may be overwritten in this extension.
In practice, it is typically used to include and configure the extensions
you need and to adapt a few minor template elements. The CHF includes a
boilerplate that you can simply copy and adapt to your needs.

- [chf_project](https://github.com/digicademy-chf/chf_project) (sitepackage
  boilerplate)

- [chf_project_docker](https://github.com/digicademy-chf/chf_project_docker)
  (sample Docker configuration)
