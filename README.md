# Opetustilat

[Opetustilat](https://tilavaraus.helsinki.fi) is a service offered by the University of Helsinki about its teaching facilities. The site offers information on the equipment available in the facilities, a link to a real-time booking calendar as well as contact information and instructions.

## Local development

### Setup

1. Read the [Lando docs](https://docs.lando.dev/) and install the **latest** [Lando](https://github.com/lando/lando/releases).
2. Check out the repo: `git@github.com:UniversityofHelsinki/Opetustila-esittely.git opetustilat && cd opetustilat/drupal`.
3. Start the site by running `lando start`.
4. Import data: `lando db-import <dumpfile>`.
5. Update database & enable develpoment components: `lando update`.
6. Import config if needed: `lando drush cim -y`.

### Sites

- <https://tilat.lndo.site/>

### Services

- <http://mail-tilat.lndo.site> - Mailhog for mail management.

### Tools

- `lando` - tools overview.
- `lando npm <commands>` - run [npm](https://www.npmjs.com/) commands.
- `lando update` - update local database.
