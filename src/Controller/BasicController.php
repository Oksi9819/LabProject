<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\BasicView;

class BasicController
{
    protected $basicView;

    protected function __construct()
    {
        $this->basicView = new BasicView;
    }
}
