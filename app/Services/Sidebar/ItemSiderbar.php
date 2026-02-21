<?php

namespace App\Services\Sidebar;

interface ItemSiderbar
{
    public function render(): string;
    public function authorize(): bool;
}
