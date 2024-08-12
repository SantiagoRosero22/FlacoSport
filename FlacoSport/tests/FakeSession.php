<?php

namespace Tests;

if (!class_exists('Tests\FakeSession')) {
    class FakeSession
    {
        private $messages = [];

        public function msg($type = null, $text = null)
        {
            if ($type && $text) {
                $this->messages = ['type' => $type, 'text' => $text];
            } else {
                return $this->messages['type'] ?? null;
            }
        }

        public function msg_text()
        {
            return $this->messages['text'] ?? null;
        }
    }
}