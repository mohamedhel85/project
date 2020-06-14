<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('events_index', new Route(
    '/',
    array('_controller' => 'ClubBundle:Events:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('events_show', new Route(
    '/{id}/show',
    array('_controller' => 'ClubBundle:Events:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('events_new', new Route(
    '/new',
    array('_controller' => 'ClubBundle:Events:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('events_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'ClubBundle:Events:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('events_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ClubBundle:Events:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
