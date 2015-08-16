<?php

namespace Caffeinated\Beverage\Traits;

use Caffeinated\Beverage\Str;

/**
 * This is the NamespacedPackageTrait.
 *
 * @package        Caffeinated\Beverage
 * @author         Caffeinated Dev Team
 * @copyright      Copyright (c) 2015, Caffeinated
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
trait NamespacedPackageTrait
{
    /**
     * Returns the regex to validate and parse package names
     *
     * @return string
     */
    protected function getNamespacedPackageRegex()
    {
        $part = '([a-z\d-_]*)';
        return '/^'.$part.'\/'.$part.'$/';
    }

    /**
     * Checks if the given $packageName is valid
     *
     * @param $packageName
     * @return bool
     */
    protected function isValidPackageName($packageName)
    {
        if (! preg_match($this->getNamespacedPackageRegex(), $packageName, $matches) or count($matches) !== 3) {
            return false;
        }

        return true;
    }

    /**
     * Parses a package name (eg: codex-project/github-filesystem)
     * and returns an associative array containing the vendor and package name
     *
     * @param $packageName
     * @return array
     */
    protected function parsePackageName($packageName)
    {
        preg_match($this->getNamespacedPackageRegex(), $packageName, $matches);

        return [ 'vendor' => $matches[ 1 ], 'package' => $matches[ 2 ] ];
    }

    /**
     * Transforms a package name (eg: codex-project/github-filesystem) into a namespace (eg: CodexProject\GithubFilesystem)
     *
     * @param $packageName
     * @return string
     */
    protected function getPackageNamespace($packageName)
    {
        return Str::namespacedStudly($packageName);
    }
}
