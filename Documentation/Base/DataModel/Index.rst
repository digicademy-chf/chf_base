..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

This extension does not provide a fully rounded data model but a set of service
classes. A ``Location`` may be organised hierarchically to model, for example,
world regions, countries, regions, cities, and buildings. A ``Period`` may
similarly be arranged in a hierarchy to model historical periods, phases, or
dates. ``Actors``, on the other hand, may be grouped together via ``Tag``s as
labels, but otherwise stand on their own. They may refer to organisations,
individuals, or other entities in the sense of actor-network theory.

In addition, the model provides flexible ``Tag``s to group other classes,
``Relation``s to connect classes with qualifications like an ``Actor``s role,
and ``SameAs`` classes to connect entities to authority data.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /Base/DataModel/DataModel.png
    :alt: Data model of the extension
    :target: /Base/DataModel/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
