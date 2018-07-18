<?php

namespace QuickTemplates;

abstract class Controller
{
    public const CONTROLLER_DIR = 'controller' . DIRECTORY_SEPARATOR;

    public abstract function handle(Template $template);
}