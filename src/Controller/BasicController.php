<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\BasicView;

class BasicController
{
    protected $basicView;

    public function __construct()
    {
        $this->basicView = new BasicView;
    }
}
