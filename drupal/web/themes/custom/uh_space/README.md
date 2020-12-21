# Theme for the University of Helsinki Spaces

UH theme uses Display suite for most content types/layouting.

### Local development

#### Set up University of Helsinki Style Guide

_Note:_ Site uses Style Guide fork from here: git@github.com:wunderio/Styleguide.git

The reason for the fork is that UH's Styleguide does not have enough contrast in the text colours to pass WCAG 2.1 AA level requirements. It also doesn't work with Webpack's image loading, because background URLs are relative to the styleguide folder. Both of these issues are fixed in the fork.

If the theme doesn't compile without errors in a fresh environment, it's possible that the styleguide submodule has not been initialised correctly so please pay attention to its location in the theme folder and the submodule commit that should be checked out.

1. Checkout git submodules in repository root (Opetustila-esittely/) by running `git submodule update --recursive`. This should add a specific version of UH’s Styleguide to drupal/web/themes/custom/uh_space/lib/uh_styleguide. The checked out commit should be ‘908d40b9be36457057f3b24ba706cc088b8e9c61’.

#### Compiling frontend assets
1. Setting up
    1. Go to the theme folder with `cd drupal/web/themes/custom/uh_space`.
    2. Ensure that you are using node version <= 8.4.0 & npm
    3. Run `npm install`.
    4. If you get errors from node-sass saying that the current environment is not yet supported, please remove the node_modules folder with rm -rf node_modules in the theme folder. Then try running “npm install” again. This happens, because sometimes npm install fails to install the required node-sass native extensions.
2. Compiling frontend assets
    1. Run `npm run watch` to build development-friendly frontend files with auto-rebuild (watch).
    2. Run `npm run build` to build production-ready frontend files without auto-rebuild.

#### Compiling frontend assets
Before committing changes, please run `npm run build`. 

We deploy pre-built frontend files from this repo, they are NOT built during deployment. They are inside dist/ in the theme folder. 

They need to be PRODUCTION-READY. Please remember to do this!
