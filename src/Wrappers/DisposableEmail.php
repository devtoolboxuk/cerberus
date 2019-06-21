<?php

namespace devtoolboxuk\cerberus\Wrappers;

use devtoolboxuk\lists\ListService;

class DisposableEmail extends Base
{

    private $domain;

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $this->getDomain();
        $this->validateDisposableEmail();
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

    private function getDomain()
    {
        $email = $this->getReference();
        $this->domain = substr($email, strpos($email, '@') + 1);
    }

    private function validateDisposableEmail()
    {
        $listService = new ListService();

        if ($listService->findInArray('throwawaydomains', $this->domain)) {
            $this->setScore($this->getRealScore());
            $this->setResult();
        }
    }
}