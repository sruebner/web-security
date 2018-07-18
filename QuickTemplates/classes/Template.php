<?php

namespace QuickTemplates;


class Template
{
    public const TEMPLATE_DIR = 'templates' . DIRECTORY_SEPARATOR;
    public const COMPILED_DIR = 'templates' . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR;
    public const TEMPLATE_EXT = '.html';
    public const COMPILED_EXT = '.php';
    public const VAR_MASK = '/{%\s*([a-zA-Z][a-zA-Z0-9\-\_]*)\s*%}/i';
    public const INCLUDE_MASK = '/{#\s*([a-zA-Z][a-zA-Z0-9\-\_]*)\s*#}/i';
    public const IF_MASK = '/{!\s*IF\s*\(([a-zA-Z][a-zA-Z0-9\-\_]*)\)\s*!}/is';
    public const ELSE_MASK = '/{!\s*ELSE\s*!}/i';
    public const ENDIF_MASK = '/{!\s*ENDIF\s*!}/i';

    private $template;
    private $variables = [];

    private function transclude(string $template) {
        $transcludedTemplate = new Template($template);
        $transcludedTemplate->assignAll($this->variables);
        $transcludedTemplate->display();
    }

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function assign(string $variable, $value) : void {
        $this->variables[$variable] = $value;
    }

    public function assignAll(array $variables) : void {
        $this->variables += $variables;
    }

    public function display() {
        // use controller
        $controllerClassName = '\\QuickTemplates\\Controller\\' . ucfirst($this->template);
        if (class_exists($controllerClassName)) {
            $controller = new $controllerClassName;
            if ($controller instanceof Controller) {
                $controller->handle($this);
            }
        }

        $templateFile = self::TEMPLATE_DIR . $this->template . self::TEMPLATE_EXT;
        $compiledFile = self::COMPILED_DIR . $this->template . self::COMPILED_EXT;

        if (file_exists($compiledFile) && file_exists($templateFile) && filemtime($compiledFile) >= filemtime($templateFile)) {
            $this->import();
        } else if (file_exists($templateFile)) {
            $templateText = file_get_contents($templateFile);

            // replace variables
            $templateText = preg_replace(self::VAR_MASK, '<?php $this->getVariable(\'$1\', \'<!-- Variable \\\'$1\\\' nicht gefunden -->\'); ?>', $templateText);

            // replace conditions
            $templateText = preg_replace(self::IF_MASK, '<?php if ($this->getVariable(\'$1\')) { ?>', $templateText);
            $templateText = preg_replace(self::ELSE_MASK, '<?php } else { ?>', $templateText);
            $templateText = preg_replace(self::ENDIF_MASK, '<?php } ?>', $templateText);

            // replace includes
            $templateText = preg_replace(self::INCLUDE_MASK, '<?php $this->transclude(\'$1\'); ?>', $templateText);

            // write file
            if (!file_exists(self::COMPILED_DIR)) {
                mkdir(self::COMPILED_DIR);
            }
            if (file_put_contents($compiledFile, $templateText)) {
                $this->import();
            } else {
                throw new \RuntimeException('The template file could not be compiled.', 503);
            }
        } else {
            throw new \UnexpectedValueException('The template file could not be found.', 404);
        }
    }

    private function import() {
        $compiledFile = self::COMPILED_DIR . $this->template . self::COMPILED_EXT;
        include_once $compiledFile;
    }

    public function getVariable($variable, $default = '') {
        return array_key_exists($variable, $this->variables) ? $this->variables[$variable] : $default;
    }
}