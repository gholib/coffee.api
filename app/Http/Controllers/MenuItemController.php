<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemStoreRequiest;
use App\MenuItem;
use App\Services\TextConverter;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function getAll()
    {
        $menuItems = MenuItem::all();

        return compact('menuItems');
    }

    public function store(MenuItemStoreRequiest $requiest)
    {
        $menuItem = new MenuItem;

        $menuItem->name = TextConverter::convertToLatin($requiest->display_name);
        $menuItem->display_name = $requiest->display_name;
        $menuItem->price = $requiest->price;

        $menuItem->save();

        return compact('menuItem');
    }

    public function update(MenuItemStoreRequiest $requiest, $menuItemId)
    {
        $menuItem = MenuItem::find($menuItemId);

        $menuItem->name = TextConverter::convertToLatin($requiest->display_name);
        $menuItem->display_name = $requiest->display_name;
        $menuItem->price = $requiest->price;

        $menuItem->update();

        return compact('menuItem');
    }

    public function destroy($menuItemId)
    {
        $menuItem = MenuItem::find($menuItemId);

        $menuItem->delete();
    }
}
