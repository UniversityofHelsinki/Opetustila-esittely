# Theme for the University of Helsinki Spaces

UH theme uses Display suite for most content types/layouting.

### Local development

#### Set up University of Helsinki Style Guide

* From theme root (`themes/custom/uh_space`) go to lib folder `themes/custom/uh_space/lib`
* Add the styleguide as a git submodule in your project.
  * `cd themes/custom/uh_space/lib`
  * `git clone https://github.com/UH-StudentServices/Styleguide.git uh-styleguide`
  * `cd uh-styleguide/`
  * `git checkout master`
  
* Build the styleguide assets, icons, fonts etc.
  * Dependencies
    * node (version <= 8.4.0) & npm
    * gulp

  * Building
    * `npm install`
    * `gulp`

See https://github.com/UniversityofHelsinki/Styleguide for further details.

#### Compiling frontend assets

Install dependencies with `npm install` from theme root (`themes/custom/uh_space`)

Run commands in a nutshell:
* `npm run watch`
  * Execute to start the local server
* `npm run build`
  * Execute to build and exit
