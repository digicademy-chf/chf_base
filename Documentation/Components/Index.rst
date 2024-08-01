..  include:: /Includes.rst.txt

..  _components:

==========
Components
==========

The modular architecture of the Cultural Heritage Framework follows the idea
of a **separation of concerns**. There are three types of components you
should know: specific data models, independent helpers, and the
project-specific sitepackage.

..  figure:: /Components/Components.png
    :alt: Overview of the Cultural Heritage Framework
    :target: ../_images/Components.png
    :class: with-shadow

    Overview of the Cultural Heritage Framework's modular components.

The main set of available extensions are **data models organised around CHF
Base**, which provides core data structures. The base component also
includes its own user interface library for the web that is designed to be
accessible, atomic, responsive, and GDPR-compliant, as well as a few tools
needed by a number of dependent extensions. Each of these components targets
a highly specific data domain and includes data models, editing interfaces,
standard templates, common serialisations like TEI XML and embedded metadata,
data import options, and search configuration. The following extensions of
this category are available:

- `CHF Base <https://github.com/digicademy-chf/chf_base>`__ (resources,
  locations, periods, and actors; partly inspired by TEI)

- `CHF Bib <https://github.com/digicademy-chf/chf_bib>`__ (bibliographies and
  Zotero import; based on Zotero TEI)

- `CHF Lex <https://github.com/digicademy-chf/chf_lex>`__ (lexicographic
  resources with dictionary and/or encyclopedic entries; based on DMLex)

- `CHF Map <https://github.com/digicademy-chf/chf_map>`__ (geodata and image
  maps; based on GeoJSON)

- `CHF Gloss <https://github.com/digicademy-chf/chf_gloss>`__ (terms and their
  explanations)

- `CHF Pub <https://github.com/digicademy-chf/chf_pub>`__ (volumes and essays
  to model books, book series, blogs, and journals)

- `CHF Object <https://github.com/digicademy-chf/chf_object>`__ (physical
  objects and related events)

- `CHF Media <https://github.com/digicademy-chf/chf_media>`__ (image, video,
  and 3D files, galleries, and collections)

- *Not in development yet:* CHF Music (MEI data)

- *Not in development yet:* CHF Letter (correspondences)

In addition to these data models, **three optional helpers are available**.
They provide single-purpose additions to TYPO3's functionality that are useful
in a Digital Humanities-focused web app. Using these helpers may require a bit
of configuration in accordance with their individual documentation. They may
also be used without any of the CHF data models listed above:

- *Not in development yet:* `ENDPNT <https://github.com/digicademy/endpnt>`__
  (SPARQL, OAI-PMH, and SRU endpoints)

- `DASH <https://github.com/digicademy/dash>`__ (quality assurance for data,
  dashboards)

- `VIS <https://github.com/digicademy/vis>`__ (a set of visualisations)

Last but not least, **each project needs its own sitepackage**. In theory,
every aspect of the other extensions may be overwritten in this extension.
In practice, it is typically used to include and configure the extensions
you need and to adapt a few minor template elements. The CHF includes a
boilerplate that you can simply copy and adapt to your needs.

- `CHF Project <https://github.com/digicademy-chf/chf_project>`__ (sitepackage
  boilerplate)

- `CHF Container <https://github.com/digicademy-chf/chf_container>`__ (sample
  Podman or Docker container configuration)
