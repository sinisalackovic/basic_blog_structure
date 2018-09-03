<?php

namespace Core;

interface RunnerInterface
{
    public function run();

    public function getApplicationService();

    public function getApplicationMethod();

    public function getApplicationParams();
}
