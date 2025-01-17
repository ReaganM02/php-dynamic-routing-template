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
