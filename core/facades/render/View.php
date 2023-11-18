<?php

namespace Core\Facades\Render;

final class View {

    /**
     * The method renders (include) template files
     * 
     * @param string $template
     * @param string $filepath
     */
    public static function get(string $template, string $filepath): void
    {
        $tempDir = getcwd().'/web/'.trim($template, ' /\\').'/'.trim($filepath, ' /\\');

        include $tempDir;
    }
}