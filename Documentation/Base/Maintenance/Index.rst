..  include:: /Includes.rst.txt

..  _maintenance:

===========
Maintenance
===========

Maintenance of the extension may include adapting it to new TYPO3 versions or
updating dependencies and includes. The following include is used:

- Leaflet 1.9.4:
  - content of :file:`images` in :file:`Resources/Images/leaflet`
  - :file:`leaflet.js` in :file:`Resources/Public/JavaScript`
  - :file:`leaflet.css` in :file:`Resources/Public/Css` with ``url()`` values
    changed to accommodate the new image location.
