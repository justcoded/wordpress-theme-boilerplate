# WordPress Theme Boilerplate

This package contains Theme Boilerplate, which has a lot of improvements and security patches, according to 
standard WordPress theme boilerplates (like underscore, etc.).

All code is classes-based (OOP) and works with PSR-4 autoload. For easier themes support base classes are
moved to a stand-alone package called [WordPress Theme Framework](https://github.com/justcoded/wordpress-theme-framework)
(which is actually a simple plugin, containing some re-usable code parts).

The main purpose of this boilerplate to separate complex logic and queries from templates. So we divide
the code into "app" and "views". 

We tried to keep as much standard WordPress features as possible, so all "views" works in the same Template
Hierarchy as standard templates, just grouped by a content types (with folders). However all standard templates
in theme root also works.

## File Structure

    |-- assets/
    |   |-- css
    |   |-- js
    |   |-- images
    |
    |-- app/
    |   |-- Admin/
    |   |   |-- Theme_Settings.php
    |   |-- Models/
    |   |   |-- {Some_Data_Object}.php
    |   |-- Post_Type/
    |   |   |-- {Some_Type}.php
    |   |-- Taxonomy/
    |   |   |-- {Some_Taxonomy}.php
    |   |-- Widgets/
    |   |   |-- {Some_Widget}.php
    |   |-- Theme.php
    |
    |-- config/
    |
    |-- inc/
    |   |-- helpers.php
    |   |-- hooks.php
    |   |-- template-funcs.php
    |
    |-- views/
    |   |-- layouts/
    |   |   |-- main.php
    |   |-- partials/
    |   |   |-- header.php
    |   |   |-- footer.php
    |   |-- page/
    |   |   |-- front-page.php
    |   |   |-- page.php
    |   |-- post/
    |   |   |-- index.php
    |   |   |-- category.php
    |   |   |-- single.php
    |   |-- search/
    |   |   |-- search.php
    |   |-- widgets/
    |   |   |-- {some-widget}.php
    |
    |-- functions.php
    |-- index.php
    |-- requirements.php
    |-- style.css