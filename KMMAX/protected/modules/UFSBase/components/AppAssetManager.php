<?php
    /**
     * Improve CAssetManager:hash() function to use Zurmo version number, when creating hash values.
     */
    class AppAssetManager extends CAssetManager
    {
        /**
        * Generate a CRC32 hash for the directory path. Collisions are higher
        * than MD5 but generates a much smaller hash string.
        * Function uses module path, Yii version and Zurmo version to generate hash value for asset folder.
        * @param string $path string to be hashed.
        * @return string hashed string.
        */
        protected function hash($path)
        {
            return sprintf('%x', crc32($path.Yii::getVersion().VERSION));
        }
    }
?>