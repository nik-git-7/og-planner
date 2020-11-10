<?php


namespace ogPlanner\dao\fake;


use ogPlanner\model\User;

abstract class FakeRepo
{
    protected array $db;

    public function __construct(array $db)
    {
        $this->db = $db;
    }

    protected function searchOne($fieldFun, int $value)
    {
        foreach ($this->db as $item) {
            if ($fieldFun($item) == $value) {
                return $item;
            }
        }
        return null;
    }

    protected function searchMulti($fieldFun, $value): array
    {
        $searchedUsers = [];
        foreach ($this->db as $item) {
            if ($fieldFun($item) == $value) {
                $searchedUsers[] = $item;
            }
        }
        return $searchedUsers;
    }
}