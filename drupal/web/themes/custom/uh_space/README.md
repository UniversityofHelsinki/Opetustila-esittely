# Theme for the University of Helsinki Spaces

UH theme uses Display suite for most content types/layouting.

### Local development

#### Set up University of Helsinki Style Guide

_Note:_ Site uses Style Guide fork from here: git@github.com:wunderio/Styleguide.git

1. Checkout git submodules in repository root (Opetustila-esittely/) by running `git submodule update --recursive --remote`. This should add a specific version of UH’s Styleguide to drupal/web/themes/custom/uh_space/lib/uh_styleguide. The commit ref should be ‘37cee5b0a2a754bbbd54f725793b61d0d25a33b7’.
    1. If you are pulling submodules for the first time for the project, run `git submodule update --init --recursive --remote` instead.

#### Compiling frontend assets
1. Setting up
    1. Go to the theme folder with `cd drupal/web/themes/custom/uh_space`.
    2. Ensure that you are using node version <= 8.4.0 & npm
    3. Run `lando npm install`.
    4. If you get errors from node-sass saying that the current environment is not yet supported, please remove the node_modules folder with rm -rf node_modules in the theme folder. Then try running “npm install” again. This happens, because sometimes npm install fails to install the required node-sass native extensions.
2. Compiling frontend assets
    1. Run `lando npm run watch` to build development-friendly frontend files with auto-rebuild (watch).
    2. Run `lando npm run build` to build production-ready frontend files without auto-rebuild.

#### Rebuilding sass
Rebuild node-sass if needed when changing different environment - `npm rebuild node-sass`

#### Compiling frontend assets
Before committing changes, please run `npm run build`.

We deploy pre-built frontend files from this repo, they are NOT built during deployment. They are inside dist/ in the theme folder.

They need to be PRODUCTION-READY. Please remember to do this!
