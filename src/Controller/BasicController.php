<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\BasicView;

class BasicController
{
    protected $basicView;

    protected function __construct()
    {
        global $blade;
        $this->basicView = new BasicView;
        $this->template = $blade;
    }
}
