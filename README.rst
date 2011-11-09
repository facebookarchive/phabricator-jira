========================
 About Phabricator-JIRA
========================

This package provides Phabricator extensions that allows integration between
Differential code review tool and JIRA issue tracker.

This extensions should be used along with Arc-JIRA on the client side.

==============
 Installation
==============

You should put `phabricator-jira` directory in the same place where you put
`arcanist`, `phabricator` and `libphutil` directories.
::

  cd where/I/put/phabricator
  git clone git://github.com/facebook/phabricator-jira.git

Edit your Phabricator config file, add `phabricator-jira` to Phabricator load
path, and tell it to use provided event listeners.
::

  'load-libraries' => array('phabricator-jira'),
  'event.listeners' => array('JIRAMailListener'),
