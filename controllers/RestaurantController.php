<?php

class RestaurantController
{
    private $restaurants;

    public function __construct()
    {
        $this->restaurants = simplexml_load_file("xml/fiche.xml");
        if ($this->restaurants === false) {
            die("<h3 class='warning-message'>Erreur lors du chargement de la fiche...</h3>");
        }
    }

    public function listRestaurants()
    {
        return $this->restaurants->fiche[0];
    }
}
