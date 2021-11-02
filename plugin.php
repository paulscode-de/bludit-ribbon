<?php

class pluginRibbon extends Plugin {

    private $loadWhenController = array(
        'configure-plugin'
    );

    public function init() {
        $this->dbFields = array(
            'type' => 'ribbon',
            'title' => 'Fork me on Github',
            'url' => 'https://github.com/pauslcode-de',
            'display' => 'right',
            'color' => 'EB593C',
            'linkcolor' => 'FFFFFF',
            'zindex' => '9999'
        );
    }


    public function adminHead() {
        global $layout;
        $pluginPath = $this->htmlPath();

        $html = '';

        if (in_array($layout['controller'], $this->loadWhenController)) {
            $html .= '<script src="' . $pluginPath . 'libs/jscolor/jscolor.js"></script>' . PHP_EOL;
        }

        return $html;
    }

    public function siteHead() {
        $html = '' . PHP_EOL;


        $html .= '<style type="text/css" media="screen">
	      .ribbon{ background-color: #' . htmlentities($this->getValue('color')) . '; z-index:' . htmlentities($this->getValue('zindex')) . ';padding:3px;position:fixed;top:2em;' . htmlentities($this->getValue('display')) . ':-3em; -moz-transform:rotate(' . (htmlentities($this->getValue('display')) == 'left' ? '-45' : '45') . 'deg); -webkit-transform:rotate(' . (htmlentities($this->getValue('display')) == 'left' ? '-45' : '45') . 'deg); -moz-box-shadow:0 0 1em #888; -webkit-box-shadow:0 0 1em #888}
	      .ribbon a{ border:1px dotted rgba(255,255,255,1); color:#' . htmlentities($this->getValue('linkcolor')) . '; display:block; font:normal 81.25% "Helvetiva Neue",Helvetica,Arial,sans-serif; margin:0.05em 0 0.075em 0; padding:0.5em 3.5em; text-align:center; text-decoration:none;text-shadow:0 0 0.5em #333}
	      .ribbon a:hover{ opacity: 0.5}
	      </style>' . PHP_EOL;

        return $html;
    }

    // Load js plugin in public theme
    public function siteBodyEnd() {
        $html = '<div class="' . htmlentities($this->getValue('type')) . '">' . PHP_EOL;
        $html .= '<a href="' . htmlentities($this->getValue('url')) . '">' . htmlentities($this->getValue('title')) . '</a>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        return $html;
    }

    public function form() {
        global $L;

        $html = '<div>';
        $html .= '<label for="title">' . $L->get('Title') . '</label>';
        $html .= '<input type="text" name="title" value="' . $this->getValue('title') . '" required/>';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label for="url">' . $L->get('Link') . '</label>';
        $html .= '<input class="width-40" type="url" name="url" value="' . $this->getValue('url') . '" required/>';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label for="color">' . $L->get('Background color') . '</label>';
        $html .= '<input class="color" type="text" name="color" value="' . $this->getValue('color') . '" required/>';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label for="linkcolor">' . $L->get('Link color') . '</label>';
        $html .= '<input class="color" type="text" name="linkcolor" value="' . $this->getValue('linkcolor') . '" required/>';
        $html .= '</div>';

        if ($this->getValue('type') == 'ribbon') {
            $html .= '<div>';
            $html .= '<label for="display">' . $L->get('Horizontal orientation') . '</label>';
            $html .= '<select name="display">';
            $displayOptions = array('left' => $L->get('Left'), 'right' => $L->get('Right'));
            foreach ($displayOptions as $text => $value)
                $html .= '<option value="' . $text . '"' . (($this->getValue('display') === $text) ? ' selected="selected"' : '') . '>' . $value . '</option>';
            $html .= '</select>';
            $html .= '</div>';
        }

        $html .= '<div>';
        $html .= '<label for="zindex">' . $L->get('Z Index') . '</label>';
        $html .= '<input type="text" name="zindex" value="' . $this->getValue('zindex') . '" required/>';
        $html .= '</div>';

        return $html;
    }

}
