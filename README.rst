..  image:: https://img.shields.io/badge/PHP-8.2/8.3-blue.svg
    :alt: PHP 8.2/8.3
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-13-orange.svg
    :alt: TYPO3 13
    :target: https://get.typo3.org/version/13

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

========
CHF Base
========

The Cultural Heritage Framework (CHF) is a research software suite that helps
you build web apps to **produce and publish data in the humanities**. It is
designed for the needs of scholarly editing, lexicography, archives, GLAM
institutions, and, more generally, projects interested in making cultural
heritage, books, media, or annotated bibliographies available in their own
web-based research platform. A key strength of the CHF is the ability to
produce portals and **multimodal editions** that include various data types
with historical points of reference in a single system, including editing
interfaces, frontends, and serialisations. Specific data models are organised
as additional components around the TYPO3 extension ``chf_base``, which
provides central data types like ``Agent``, ``Location``, and ``Period``,
but also multiple types of ``Tag`` and ``Relation`` to structure and connect
data as well as services like import and export routines. The various
components are developed and maintained by the Digital Academy, a Digital
Humanities department at the Academy of Sciences and Literature Mainz.

:Repository:  https://github.com/digicademy-chf/chf_base
:Read online: https://digicademy-chf.github.io/chf_base
:TER:         https://extensions.typo3.org/extension/chf_base

Features
========

- HTML: accessible, web app, semantic tags, embedded metadata
- CSS: atomic, responsive, components, variables, dark mode, transitions
- JS: supporting CSS, no frameworks, sharing API
- Layouts: hub, page, text, one per main class, various components
- Search: dedicated configuration per main class, suggestions, expert modes
- Academic: sources, footnotes, info buttons, common serialisations/formats
- Privacy: no external APIs, no frameworks, no preprocessors, GDPR-compliant
- Optional: common APIs, visualisations, quality assurance


Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

- Unify mdlr and mrvl in this component
- Move social links here
- TCA and model work as expected
- Frontend plugin and templates?
- Embedded metadata
- Infrastructure for imports
- Infrastructure for serialisations
- Infrastructure for search configs
- Add API documentation

**Beyond 2.0.0**

- Add testing
- Generic import
- Additional serialisations
- Automation to include Leaflet files upon new releases

**Nice to have**

- Allow ``Period`` to use calendars other than the Gregorian one