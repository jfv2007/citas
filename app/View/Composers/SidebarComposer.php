<?php

namespace App\View\Composers;

use App\Services\Sidebar\itemGroup;
use App\Services\Sidebar\ItemHeader;
use App\Services\Sidebar\ItemLink;
use Illuminate\View\View;


class SidebarComposer
{
    public function compose(View $view)
    {
        $items = collect(config('sidebar'))
            ->map(function ($item) {
                return $this->paseItem($item);
            });

        $items = $items->filter(function ($item) {
            return $item->authorize();
        });


        $view->with('sidebarItems', $items);
    }

    public function paseItem($item)
    {
        switch ($item['type']) {
            case 'header':
                return new ItemHeader(
                    title: $item['title'],
                    can: $item['can'] ?? [],
                );

                break;
            case 'link':
                return new ItemLink(
                    title: $item['title'],
                    icon: $item['icon'] ?? 'fa-regular fa-circle',
                    href: $item['route'] ? route($item["route"]) : '#',
                    active: $item['active'] ? request()->routeIs($item['active']): false,
                    can: $item['can'] ?? [],
                );
                break;
            case 'group':

                $group= new itemGroup  (
                    title: $item['title'],
                    icon: $item['icon'] ?? 'fa-regular fa-folder',
                    active: $item['can'] ? request()->routeIs($item['can']) : false ,
                );

                foreach ($item['items'] as $subItem) {
                    $group->add($this->paseItem($subItem));
                 }

                break;

            default:
                throw new \InvalidArgumentException("Tipo de item desconocido: {$item['type']}");
                break;
        }
    }
}
