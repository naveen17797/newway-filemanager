<?php
/**
 * Loader to use templates inside the updater
 *
 *
 * Copyright (C) 2018 Naveen Muthusamy <kmnaveen101@gmail.com>
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package Newway File Manager
 * @author Naveen Muthusamy <kmnaveen101@gmail.com>
 * @link    https://github.com/naveen17797
 */
class loader
{
    private $template_directory = "templates/";
    private $extension = ".html";
    private $template_file_directory;
    private $theme_storage_file_name = "theme.json";
    private $data;
    private $output;
    /**
    * @var names array
    */
    public function load_css($directory, $names)
    {
        foreach ($names as $name) {
            echo "<link rel='stylesheet' type='text/css' href='$directory/$name.css' />";
        }
        $this->generateRootCssVariables();
    }

    public function generateRootCssVariables()
    {
        $json = file_get_contents($this->theme_storage_file_name);
        $color_settings = json_decode($json, true);
        $primary_color = $color_settings['primary_color'];
        $secondary_color = $color_settings['secondary_color'];
        $primary_text_color = $color_settings['primary_text_color'];
        $secondary_text_color = $color_settings['secondary_text_color'];
        echo "<style>
        .primary {
            background-color: $primary_color;
            color: $primary_text_color;
        }
        .primary-color {
            color: $primary_color;
        }
        .secondary {
            background-color: $secondary_color;
            color: $secondary_text_color;
        }
        </style>";
    }

    public function set_template_file($template_file)
    {
        $this->template_file_directory = $this->template_directory.$template_file.$this->extension;
    }

    public function assign($key, $value)
    {
       $this->data[$key] = $value;
    }

    public function output()
    {
        $template_file_data = file_get_contents($this->template_file_directory);
        $this->output = $template_file_data;
        if (count($this->data) != 0) {
            foreach ($this->data as $key => $value) {
                $this->output = str_replace("{".$key."}", "$value", $this->output);
            }
            echo $this->output;
        } else {
            echo $this->output;
        }
    }

    public function load_js($directory, $names)
    {
        foreach ($names as $name) {
            echo "<script src='$directory/$name.js'></script>";
        }
    }

}

$loader = new loader;
