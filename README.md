## PHP Git

PHP Git is wrapper for operating git. It is easy and simple for develop.

## Install

composer:

    "require": {
        "php": ">=5.5.0",
        "jianfengye/phpgit": "dev-master",
    },

## Function

    Git::revisions()
    Git::lastRevision()
    Git::diff($sha1, $sha2)
    Git::pull()
    Git::checkout($branch)

### License

The Hades framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
