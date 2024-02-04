..  include:: /Includes.rst.txt

..  _install-and-config:

==================
Install and config
==================

..  rst-class:: bignums

1.  Install the extension

    Add the package name to your ``composer.json`` or install the package
    manually.

2.  Add specific data model extensions

    Select other `chf_` extensions that you need for your project. They may
    extend and use the service classes implemented in this extension.

3.  Optionally add an import task

    To import data once or periodically, go to the :guilabel:`Task` module
    in the backend and add a new task. Enter the fields required to perform the
    task and either start it manually or set an interval to run the task
    automatically.
