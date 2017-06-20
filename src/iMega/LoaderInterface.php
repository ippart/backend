<?php

namespace iMega;

interface LoaderInterface
{
    public function controller($route, $data = []);
    public function model($route);
    public function view($route, $data = []);
    public function library($route);
    public function helper($route);
    public function config($route);
    public function language($route);
}
