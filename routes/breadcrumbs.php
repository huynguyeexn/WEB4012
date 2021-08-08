<?php

// use DaveJamesMiller\Breadcrumbs as Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ', route('home'));
});

// // Home >  [Category]
Breadcrumbs::for('catParent', function ($trail, $category) {
    $trail->push($category->name, route('category', $category->slug));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('catChild', function ($trail, $parent, $child) {
    $trail->parent('catParent', $parent);
    $trail->push($child->name, route('category', $child->slug));
});
