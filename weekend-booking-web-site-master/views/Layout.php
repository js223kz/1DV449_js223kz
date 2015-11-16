<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-13
 * Time: 15:16
 */

namespace views;


class Layout
{
    public function render($view) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Johannas webbskrapa</title>
        </head>
        <body>
          <h1>Träffpunkt</h1>

          <div class="container">
              ' . $view. '
          </div>
         </body>
      </html>
    ';
    }
}