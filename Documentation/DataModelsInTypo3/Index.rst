..  include:: /Includes.rst.txt

..  _data-models-in-typo3:

====================
Data models in TYPO3
====================

Data models in TYPO3 have to be maintained as **two independent instruction
sets**. Any model needs one configuration file per database table called
**TCA** in the TYPO3 lingo. These determine what properties (or rows) a given
table has, what values are allowed, how they behave in the backend, and how
they are stored in the database.

In addition, most custom extensions also implement an **Extbase** data model
on top of this table configuration, which enables the clean getting and
setting of values by means of one PHP object per database table. For each of
these, and in addition to the TCA, Extbase needs **a model, a repository,
and a controller**. The model describes all properties, a repository
generates instances of objects from the database, and the controller
orchestrates how instances of objects may be accessed in the view. If the
TCA configures tables with **multiple types** (different sets of properties
based on the value of one property), these are implemented in models via
inheritance: an ``Abstract`` class defines all basic properties and other
classes extend the ``Abstract`` one to add the properties they need. While
simple TCA tables and models are mapped automatically, rules for model
inheritance need to be made explicit in the file
``Configuration/Extbase/Persistence/Classes.php``.

Because the Extbase logic is built on top of a standard TCA, **some aspects
may need to be implemented in both**: default sorting of object instances,
for example, needs to be configured in both the TCA (for backend views) and
the repository (for accessing object instances in code and in the frontend),
multiple types in the same TCA table need to be adapted to class inheritance,
required fields must be marked both in the TCA and in the ``__construct()``
method of a model, and if you want to limit the values that can be used in a
given property, this needs to be implemented in the TCA (for backend users)
and in the model's validators to allow for scenarios in which new object
instances are added through import routines, for example.

The **'view'** in Extbase's model/view/controller logic is realised by
TYPO3's templating engine called Fluid. In theory, Fluid also works with
basic TCA configuration without the Extbase overhead, but a full object model
maked Fluid more comfortable and allows you to add data programmatically
instead of straight into the database.
