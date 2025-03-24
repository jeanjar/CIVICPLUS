<?php

namespace App\Utils;

use App\Exceptions\RemoveMessageFromBagException;

class MessageBag
{
    private static ?MessageBag $instance = null;

    public function __construct()
    {
        if (!isset($_SESSION['message_bag'])) {
            $_SESSION['message_bag'] = [];
        }
    }

    public static function getInstance(): MessageBag
    {
        if (!self::$instance) {
            self::$instance = new MessageBag();
        }
        
        return self::$instance;
    }

    public function add($type, $key, $message): void
    {
        $_SESSION['message_bag'][$type][$key] = $message;
    }

    public function getAll(): array
    {
        return $this->hasMessages() ? $_SESSION['message_bag'] : [];
    }

    public function hasMessages(?string $type = null): bool
    {
        return $type ? !!count($_SESSION['message_bag'][$type] ?? []) : !!count($_SESSION['message_bag'] ?? []);
    }

    /**
     * @param string|null $type
     * @param string|null $key
     * @return void
     * @throws RemoveMessageFromBagException
     */
    public function remove(?string $type, ?string $key): void
    {
        if ($type && $key) {
            unset($_SESSION['message_bag'][$type][$key]);
            return;
        }

        if ($type) {
            unset($_SESSION['message_bag'][$type]);
        }

        throw new RemoveMessageFromBagException();
    }

    public function clear(): void
    {
        $_SESSION['message_bag'] = [];
    }
}