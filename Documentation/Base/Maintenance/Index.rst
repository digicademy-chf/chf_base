..  include:: /Includes.rst.txt

..  _maintenance:

===========
Maintenance
===========

Maintenance of the extension may include adapting it to new TYPO3 versions or
updating dependencies and includes. The following include is used:

- Leaflet 1.9.4:

  - Content of :file:`images` in :file:`Resources/Images/leaflet`

  - File :file:`leaflet.js` in :file:`Resources/Public/JavaScript`

  - File :file:`leaflet.css` in :file:`Resources/Public/Css` with ``url()`` values
    changed to accommodate the new image location.
