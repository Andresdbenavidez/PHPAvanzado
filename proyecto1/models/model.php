<?php
namespace Models;

use Controller\Connection;

abstract class Model{
    public abstract function save(Connection $connection);
}

