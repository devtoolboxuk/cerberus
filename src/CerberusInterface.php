<?php

namespace devtoolboxuk\cerberus;

interface CerberusInterface
{
    public function pushHandler($handler);

    public function process();

    public function getScore();

    public function toArray();

    public function getResult();

}
