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

### Theme development

To perform theming tasks, navigate to theme folder: `cd web/themes/custom/pako`. List of available theming tasks:

- `lando npm install` - install required modules,
- `lando gulp development/production` - compile and copy SCSS, JS and fonts from ./src to ./dist, minifiy css and js files,
- `lando gulp watch` - watch the scss changes,
- `lando gulp svgSprite` - update icons and generate SVG sprite.

### Search API & Solr

Following Search API commands are performed during `lando update`:

- `lando drush search-api:rebuild-tracker` - rebuild the tracker for an index,
- `lando drush search-api:index` - index all search items.

Remote Solr dashboard (_dev_/_stage_) can be accessed at <http://localhost:8983/solr/#/> after running
tunnelling command `ssh -L 8983:localhost:8983 root@10.194.81.72` (change IP to `10.194.81.80` for _prod_).

Always sync Solr `.lando/solr_8.x_config` changes with [client-fi-turku-infra](https://github.com/wunderio/client-fi-turku-infra/tree/master/local_ansible_roles/solr_config_palvelukortit) when upgrading Solr!
