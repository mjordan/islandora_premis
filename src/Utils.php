<?php

namespace Drupal\islandora_premis;

use Drupal\Core\Site\Settings;
use Drupal\media\Entity\Media;

/**
 * Islandora-PREMIS specific utilities.
 */
class Utils {

  /**
   * Get a Fedora URL for a File entity from Gemini.
   *
   * @param string $mid
   *   The Meida entity's ID.
   *
   * @return string
   *   The Fedora URL to the file corresponding to the Media's ID, or False.
   */
  public function getUrl($mid) {
    $media = Media::load($mid);
    $media_source_service = \Drupal::service('islandora.media_source_service');
    $source_file = $media_source_service->getSourceFile($media);

    $uri = $source_file->getFileUri();
    $scheme = \Drupal::service('stream_wrapper_manager')->getScheme($uri);

    if ($scheme == 'fedora') {
      $flysystem_config = Settings::get('flysystem');
      if (isset($flysystem_config[$scheme]) && $flysystem_config[$scheme]['driver'] == 'fedora') {
        $fedora_root = $flysystem_config['fedora']['config']['root'];
        $fedora_root = rtrim($fedora_root, '/');
        $parts = parse_url($uri);
        $path = $parts['host'] . $parts['path'];
      }
      else {
        return false;
      }
      $path = ltrim($path, '/');
      $fedora_uri = "$fedora_root/$path";
      return($fedora_uri);
    }
    else {
      // 'public' or 'private' filesystem scheme.
      return(file_create_url($uri));
    }
  }

}
