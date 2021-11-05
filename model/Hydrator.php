<?php

namespace MABytes;

/**
 * Hydratator trait
 * @see https://www.dynamic-mess.com/php/php-bdd-objet-hydrate-6-33/
 * @author Gwenaël Guiraud
 * @version 1
 */
trait Hydrator {

    /**
     * Hydrate the object
     * @param array $datas The dataset to hydrate the object
     */
    public function hydrate(array $datas) {
        foreach ($datas as $key => $value) {
            $methodName = "set".\ucfirst($key);
            if(\method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }
}