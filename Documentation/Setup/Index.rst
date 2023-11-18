..  include:: /Includes.rst.txt

..  _setup:

=====
Setup
=====

The CHF provides standard TYPO3 extensions, so the resulting web project
**will behave like a regular TYPO3 project**. The official `getting started
guide <https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/Index.html>`__
provides system requirements and installation instructions.

To **kickstart development**, you may simply use the Docker container provided
by the CHF (``chf_project_docker``) and/or the sitepackage boilerplate
(``chf_project``). Please refer to the documentation of the Docker container
to see how it works, and make sure you change the credentials if you use the
container on a web server. Depending on your web server's set-up, the
container may not be useful and you may simply need the adapted boilerplate
extension and activate it in a PHP Coposer environment.

For inspiration on how to use the CHF, feel free to take a **look at two
actual sitepackages** and their Docker containers based on the boilerplate
code: ``namenforschung`` with ``namenforschung_docker`` as well as
``corpusvitrearum`` with ``corpusvitrearum_docker``.
