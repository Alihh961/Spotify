1 - We install webpack-encore : composer require symfony/webpack-encore-bundle
2 - install yarn  : yarn install
3 - yarn add @symfony/webpack-encore --dev
4 - ONLY of we want to work with scss : yarn add sass-loader --dev
5 - ONLY if we want to work with typescript : yarn add typescript ts-loader --dev
6 - adding bootstrap :  yarn add bootstrap
7 - adding propperjs/core : yarn add @popperjs/core

configurations :

1 - we edit the file name assets/styles/app.css into assets/styles/app.scss;
2 - we edit the file content assets/app.js from (import './styles/app.scss'; ) into( import './styles/app.css';);
3 - adding @import "~bootstrap/scss/bootstrap"; into the file assets/styles/app.scss;
4 - ADD ENTRIES FOR EVERY FILE OF STYLE OR JS (in webpack.config.js) WE WANT TO ADD IN OUR APPLICATION
5- in webpack.config.js => addEntry is for js files , addStyleEntry for style files like css or scss. 
6- after adding an entry , we must add it in the file templates/base.html.twig 
7- enable of un comment loaders function in webpack.config.js related to our uses ; 
8- yarn watch to run the app and  the main file of compling ;