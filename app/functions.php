<?php

/**
 * Includes a specific file using a relative path.
 * 
 * This function appends the provided relative path to the base path 
 * and includes the resulting file. It ensures the file is included 
 * only once during execution.
 * 
 * Example usage:
 * ```php
 * requireFile('app/core/database.php');
 * ```
 * 
 * @param string $path Relative path to the file to include, starting from the base directory.
 * @return void
 */
function requireFile($path) {
  require_once BASE_PATH . $path;
}

/**
 * Includes a view file from the views directory with optional attributes.
 * 
 * This function appends the specified view path to the base directory path 
 * and includes the corresponding file. It ensures the file is included only once 
 * during the execution of the script. Additionally, it allows passing an associative 
 * array of attributes, which are extracted into individual variables for use within 
 * the included view.
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
