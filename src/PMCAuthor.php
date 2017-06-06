<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/6/2017
 * Time: 3:16 PM
 */

namespace vector\PMCAdapter;


class PMCAuthor
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    private $type;

    function __construct( $name, $type )
    {
        $this->name = $name;
        $this->type = $type;
    }
}