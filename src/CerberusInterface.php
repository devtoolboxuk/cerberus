<?php

namespace devtoolboxuk\cerberus;

interface CerberusInterface
{
    /**
     * @param $handler
     * @param $reference
     * @return mixed
     */
    public function pushHandler($handler, $reference);

    /**
     * @return mixed
     */
    public function getScore();

    /**
     * @return mixed
     */
    public function toArray();

    /**
     * @return mixed
     */
    public function getResult();


    /**
     * @return mixed
     */
    public function hasScore();

    /**
     * @return mixed
     */
    public function inputs();

    /**
     * @return mixed
     */
    public function getReferences();

    /**
     * @return mixed
     */
    public function getLogsAsJson();

    /**
     * @return mixed
     */
    public function getLogsAsArray();

}
