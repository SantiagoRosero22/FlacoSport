<?php
namespace tests;

if (!class_exists('Tests\FakeDatabase')) {
    class FakeDatabase
    {
        private $data = [];

        public function escape($value)
        {
            return addslashes($value);
        }

        public function find_by_id($table, $id)
        {
            return $this->data[$id] ?? null;
        }

        public function delete_by_id($table, $id)
        {
            if (isset($this->data[$id])) {
                unset($this->data[$id]);
                return true;
            }
            return false;
        }
    }
}