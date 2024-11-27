..  include:: /Includes.rst.txt

.. _start:

========
CHF Base
========

:Extension key:
    chf_base

:Package name:
    digicademy/chf_base

:Version:
    |release|

:Language:
    en

:Author:
    `Jonatan Jalle Steller <mailto:jonatan.steller@adwmainz.de>`__,
    CHF Base contributors

:License:
    This document is published under the
    `CC BY 4.0 <https://creativecommons.org/licenses/by/4.0/>`__
    license.

:Rendered:
    |today|

----

The Cultural Heritage Framework (CHF) is a research software suite that helps
you build web apps to **produce and publish data in the humanities**. It is
designed for the needs of scholarly editing, lexicography, archives, GLAM
institutions, and, more generally, projects interested in making cultural
heritage, books, media, or annotated bibliographies available in their own
web-based research platform. A key strength of the CHF is the ability to
produce portals and **multimodal editions** that include various data types
with historical points of reference in a single system, including editing
interfaces, frontends, and serialisations. Specific data models are organised
as additional components around the TYPO3 extension CHF Base, which
provides central data types like ``Agent``, ``Location``, and ``Period``,
but also multiple types of ``Tag`` and ``Relation`` to structure and connect
data as well as services like import and export routines. The various
components are developed and maintained by the Digital Academy, a Digital
Humanities department at the Academy of Sciences and Literature Mainz.

Features
========

- HTML: accessible, web app, semantic tags, embedded metadata
- CSS: atomic, responsive, components, variables, dark mode, transitions
- JS: supports CSS, no frameworks, sharing API
- Layouts: hub, page, text, one per main class, various components
- Search: dedicated configuration per main class, suggestions, expert modes
- Academic: sources, footnotes, info buttons, common serialisations/formats
- Privacy: no external APIs, no frameworks, no preprocessors, GDPR-compliant
- TYPO3: LinkValidator-enabled, automatic cache clearing
- Optional: common APIs, visualisations, quality assurance

----

**Table of contents:**

..  toctree::
    :maxdepth: 2
    :titlesonly:
    :caption: GENERAL

    Overview/Index
    Components/Index
    Setup/Index
    Usage/Index
    Updates/Index
    Development/Index
    DataModelsInTypo3/Index
    DesignPrinciples/Index
    Contribution/Index

..  Extension Menu

..  toctree::
    :maxdepth: 2
    :titlesonly:
    :caption: EXTENSION

    Base/Introduction/Index
    Base/InstallAndConfig/Index
    Base/EditingContent/Index
    Base/Templates/Index
    Base/DataModel/Index
    Base/ApiReference/Index
    Base/Maintenance/Index

..  Meta Menu

..  toctree::
    :hidden:

    Sitemap
