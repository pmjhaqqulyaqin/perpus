<?php
/**
 * Modern Login Template
 */

if (isset($_GET['p']) && $_GET['p'] === 'visitor') {
  $imagesDisk = \SLiMS\Filesystems\Storage::images();
  include "classic.php";
  include "parts/header.php";
  echo $main_content;
  echo '</body></html>';
} else {
  include "index_template.inc.php";
}