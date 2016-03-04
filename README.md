Hueman Wordpress Theme (with optimizations from GetPageSpeed.com)
=================================================================

* !Relinks some assets to CDNJS: fonts and javascript files
* Relinks jQuery and jQuery Migrate to CDNJS and places inside footer
* Conditionally includes jPlayer and other libraries instead of including every time
* Removes "responsive" option, it is responsive always: styles.css and responsive.css merged for faster download
* Removes ?ver query variable and changes to static URL, i.e. from styles.css?ver=4.2.2 to styles.4.2.2.css. *Important!* Requires Apache or Nginx rewrite
* Removes emoji javascript in new Wordpress versions

Required Nginx rewrite
======================

```
# Rewrite for versioned CSS+JS via filemtime
location ~* ^.+\.(css|js)$ {
    rewrite ^(.+)\.(\d+)\.(css|js)$ $1.$3 last;
    expires 31536000s;
    access_log off;
    log_not_found off;
    add_header Pragma public;
    add_header Cache-Control "max-age=31536000, public";
}
```

Required Apache rewrite
=======================


Tips for speed
==============

The tips make it hard to update to new theme releases, but we are aiming for speed here:

* Go to Appearance -> Theme Options -> General: set Custom Stylesheet to Off and place any custom css into style.css of the theme
* Go to Appearance -> Theme Options -> Styling: set Dynamic Styles to Off. If you want the dynamic CSS, copy it from generated HTML into style.css

A better alternative might be to use child theme and copy original style.css and include custom CSS code at the bottom of it