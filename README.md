# Opetustilat

[Opetustilat](https://tilavaraus.helsinki.fi) is a service offered by the University of Helsinki about its teaching facilities. The site offers information on the equipment available in the facilities, a link to a real-time booking calendar as well as contact information and instructions.

## Local development

### Setup

1. Read the [Lando docs](https://docs.lando.dev/) and install the **latest** [Lando](https://github.com/lando/lando/releases).
2. Clone the repo: `git clone git@github.com:UniversityofHelsinki/Opetustila-esittely.git opetustilat && cd opetustilat/drupal`.
3. Start the site by running `lando start`.
4. Import data: `lando db-import <dumpfile>`.
5. Import config if needed: `lando drush cim -y`.

### Services

- <http://mail-tilat.lndo.site> - Mailhog for mail management.

### Tools

- `lando` - tools overview.
- `lando npm <commands>` - run [npm](https://www.npmjs.com/) commands.
- `lando reindex` - reindex the search indices.

### Theme development

To perform theming tasks, navigate to theme folder: `cd web/themes/custom/uh_space`. List of available theming tasks:

- `lando npm install` - install required modules

## Environments

| Environment | Branch       | URL                                                             |
|-------------|--------------| --------------------------------------------------------------- |
| Production  | `production` | [tilavaraus.helsinki.fi/en/](https://tilavaraus.helsinki.fi/)                         |
| Staging     | `master`     | [opetustila-staging.it.helsinki.fi/en](https://opetustila-staging.it.helsinki.fi/) |
| Testing     | `develop`    | [opetustila-test.it.helsinki.fi](https://opetustila-test.it.helsinki.fi) |
| Local       | n/a          | [tilat.lndo.site](https://tilat.lndo.site/)                        |
