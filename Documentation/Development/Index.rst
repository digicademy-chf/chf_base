..  include:: /Includes.rst.txt

..  _development:

===========
Development
===========

When you find yourself in the position of having to update an existing
extension for a new major release of TYPO3, the following steps should help
you. Before you start, make sure you know whether the upgraded extension
needs to support more than one major release of the software.

1. Use `TYPO3 Rector <https://www.typo3-rector.com/>`__ on the extension's
  code to get an idea of what needs to be changed. Rector can automatically
  implement a lot of necessary changes for you and will tell you about other
  things you need to change by hand.

2. When this is done, switch to a development environment updated according
  to the TYPO3 release's changed requirements. Use the updated system's
integrated extension testing tools to see which further changes may be needed.

3. If you made changes that affect the database, make sure there is an
  automatic upgrade script in place.

4. Check the that the extension is working as expected. This can be done
  manually or with the help of an automated testing pipeline.

5. Edit the metadata to increase the version numbers of both the extension
  and TYPO3. Add the changes to the changelog so other developers can see what
  changes were made when they use your extension.
