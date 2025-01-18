<?php

/**
 * Includes a specific file using a relative path.
 * 
 * 
 * Example usage:
 * ```php
 * requireFile('app/core/database.php');
 * ```
 * 
 * @param string $path Relative path to the file to include, starting from the base directory.
 * @param array $attributes [optional] An associative array of variables to be extracted and made available 
 *                          within the scope of the included view (e.g., ['key' => 'value']). Defaults to an empty array.
 * @return void
 */
function requireFile($path, $attributes = []) {
  extract($attributes);
  require_once BASE_PATH . $path;
}

/**
 * Includes a view file from the views directory with optional attributes.
 * 
 * Example usage:
 * ```php
 * requireView('index.view.php', ['title' => 'Home', 'user' => $user]);
 * ```
 * 
 * @param string $viewPath The relative path to the view file, starting from the views directory 
 *                         (e.g., 'index.view.php' or 'partials/header.view.php').
 * @param array $attributes [optional] An associative array of variables to be extracted and made available 
 *                          within the scope of the included view (e.g., ['key' => 'value']). Defaults to an empty array.
 * 
 * @return void
 */
function requireView($viewPath, $attributes = []) {
  extract($attributes);
  require_once BASE_PATH . 'app/views/' . $viewPath;
}

/**
 *  Includes a controller file from the views directory with optional attributes.
 * @param string $controllerPath The relative path to the controller file, starting from the controller directory 
 *                         (e.g., 'index.controller.php').
 * @param array $attributes [optional] An associative array of variables to be extracted and made available 
 *                          within the scope of the included view (e.g., ['key' => 'value']). Defaults to an empty array.
 * @return void
 */
function requireController($controllerPath, $attributes = []) {
  extract($attributes);
  require_once BASE_PATH . 'app/controllers/' . $controllerPath;
}


/**
 *  Outputs a formatted representation of an array or object for debugging purposes.
 * 
 * Example usage:
 *```php
 *  Example array
 * $data = ['key1' => 'value1', 'key2' => 'value2'];
 * 
 * Print the array without halting execution
 * prettyArray($data);
 * 
 * Print the array and halt execution
 * prettyArray($data, true);
 *```
 * @param mixed $array
 * @param mixed $die
 * @return void
 */
function prettyArray($array, $die = false) {
  echo '<pre>';
    print_r($array);
  echo '</pre>';
  if($die) {
    die();
  }
}
