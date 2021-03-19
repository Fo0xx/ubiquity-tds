<?php


namespace services\dao;

use models\User;
use Ubiquity\orm\repositories;

class StoreRepository extends ViewRepository
{

    public function __construct(Controller $ctrl) {
        parent::__construct($ctrl,User::class);
    }

}