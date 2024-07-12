<?php
require_once 'ViewRenderer.php';

class RestaurantController
{
    private $ficheRestaurant;

    public function __construct()
    {
        $filename = "xml/fiche.xml";
        if (!file_exists($filename)) {
            die("<h3 class='warning-message'>Le fichier fiche.xml n'existe pas...</h3>");
        }

        $this->ficheRestaurant = simplexml_load_file($filename);
        if ($this->ficheRestaurant === false) {
            die("<h3 class='warning-message'>Erreur lors du chargement de la fiche du restaurant...</h3>");
        }
    }

    public function getFicheRestaurant()
    {
        return $this->ficheRestaurant;
    }


    public function getMenu(int $id)
    {
        return $this->ficheRestaurant->menus[$id];
    }

    public function addMenu($title, $description, $price)
    {
        // Créer un nouveau menu avec les données fournies
        $newMenu = $this->ficheRestaurant->addChild("menus");
        $newMenu->addChild("titre", htmlspecialchars($title));
        $newMenu->addChild("description", htmlspecialchars($description));
        $newMenu->addChild("prix", htmlspecialchars($price));

        // Valider le XML par rapport à la DTD
        $xml = new DOMDocument();
        $xml->loadXML($this->ficheRestaurant->asXML());

        if ($xml->validate()) {
            // Enregistrer les modifications dans le fichier XML
            $this->ficheRestaurant->asXML("xml/fiche.xml");
        } else {
            // Gérer les erreurs de validation XML
            die("<h3 class='warning-message'>Erreur : Le menu ne respecte pas la DTD spécifiée.</h3>");
        }
    }

    // Routing
    public function index()
    {
        ViewRenderer::render('restaurant/index', ['ficheRestaurant' => $this->getFicheRestaurant()]);
    }

    public function editMenu($id)
    {
        if (is_numeric($id) === false) {
            $this->notFound();
            return;
        }

        $menu = $this->getMenu($id);
        if ($menu === null) {
            $this->notFound();
            return;
        }

        ViewRenderer::render('restaurant/editMenu', ['menu' => $menu]);
    }

    private function notFound()
    {
        ViewRenderer::render('404');
    }
}
