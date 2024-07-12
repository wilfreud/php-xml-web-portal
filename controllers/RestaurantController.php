<?php
require_once 'ViewRenderer.php';

class RestaurantController
{
    private $restaurants;

    public function __construct()
    {
        $filename = "xml/restaurants.xml";
        if (!file_exists($filename)) {
            die("<h3 class='warning-message'>Le fichier restaurants.xml n'existe pas...</h3>");
        }

        $this->restaurants = simplexml_load_file($filename);
        if ($this->restaurants === false) {
            die("<h3 class='warning-message'>Erreur lors du chargement des restaurants...</h3>");
        }
    }

    public function listRestaurants()
    {
        return $this->restaurants->restaurant;
    }

    public function getRestaurant(int $id)
    {
        return $this->restaurants->restaurant[$id] ?? null;
    }

    public function details($id)
    {
        $restaurant = $this->getRestaurant($id);
        if ($restaurant === null) {
            $this->notFound();
            return;
        }
        ViewRenderer::render('restaurant/details', ['restaurant' => $restaurant, 'id' => $id]);
    }

    public function addRestaurant($data)
    {
        $this->validateRestaurantData($data);

        // Création d'une nouvelle fiche de restaurant dans le XML
        $newRestaurant = $this->restaurants->addChild("restaurant");
        $this->populateRestaurantData($newRestaurant, $data);

        $this->saveRestaurants();
    }

    public function updateRestaurant($id, $data)
    {
        $this->validateRestaurantData($data);
        $restaurantToEdit = $this->getRestaurant($id);

        if (!$restaurantToEdit) {
            die("<h3 class='warning-message'>Erreur : Restaurant non trouvé.</h3>");
        }

        $this->populateRestaurantData($restaurantToEdit, $data);
        $this->saveRestaurants();
    }

    private function validateRestaurantData($data)
    {
        $requiredFields = ['nom', 'adresse', 'restaurateur'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                die("<h3 class='warning-message'>Erreur : Le champ $field est obligatoire.</h3>");
            }
        }
    }

    private function populateRestaurantData($restaurant, $data)
    {
        $restaurant->addChild("nom", htmlspecialchars($data['nom']));
        $restaurant->addChild("adresse", htmlspecialchars($data['adresse']));
        $restaurant->addChild("restaurateur", htmlspecialchars($data['restaurateur']));

        // Description du restaurant
        if (!empty($data['description_restaurant'])) {
            $description = $restaurant->addChild("description_restaurant");
            $description->addChild("paragraphe", htmlspecialchars($data['description_restaurant']));
        }

        // Carte des plats
        if (!empty($data['carte'])) {
            $carte = $restaurant->addChild("carte");
            foreach ($data['carte'] as $plat) {
                $platElement = $carte->addChild("plat");
                $platElement->addChild("nom", htmlspecialchars($plat['nom']));
                $platElement->addChild("description_plat", htmlspecialchars($plat['description']));
                $platElement->addChild("prix", htmlspecialchars($plat['prix']));
            }
        }

        // Menus
        if (!empty($data['menus'])) {
            $menus = $restaurant->addChild("menus");
            foreach ($data['menus'] as $menu) {
                $menuElement = $menus->addChild("menu");
                $menuElement->addChild("titre", htmlspecialchars($menu['titre']));
                $menuElement->addChild("description_menu", htmlspecialchars($menu['description']));
                $menuElement->addChild("prix", htmlspecialchars($menu['prix']));
            }
        }
    }

    private function saveRestaurants()
    {
        // Validation et sauvegarde du XML
        $xml = new DOMDocument();
        $xml->loadXML($this->restaurants->asXML());

        // Pour éviter les erreurs DOMDocument::validate()
        libxml_use_internal_errors(true);

        if ($xml->validate()) {
            $this->restaurants->asXML("xml/restaurants.xml");
        } else {
            foreach (libxml_get_errors() as $error) {
                echo "<p class='warning-message'>Erreur : " . $error->message . "</p>";
            }
            libxml_clear_errors();
            die("<h2 class='warning-message'>Le restaurant ne respecte pas la DTD spécifiée.</h2>");
        }
    }

    public function index()
    {
        ViewRenderer::render('restaurant/index', ['restaurants' => $this->listRestaurants()]);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateRestaurant((int)$id, $_POST);
            header("Location: /tp-portail/restaurant");
            return;
        }

        if ($id === "edit") {
            ViewRenderer::render('restaurant/edit');
            return;
        }

        if (!is_numeric($id)) {
            $this->notFound();
            return;
        }

        $restaurant = $this->getRestaurant((int)$id);

        if (!$restaurant) {
            $this->notFound();
            return;
        }

        ViewRenderer::render('restaurant/edit', ['restaurant' => $restaurant]);
    }

    public function deleteRestaurant($id)
    {
        $restaurant = $this->getRestaurant((int)$id);
        if (!$restaurant) {
            $this->notFound();
            return;
        }

        // Supprimer le restaurant
        $dom = dom_import_simplexml($restaurant);
        $dom->parentNode->removeChild($dom);

        // Sauvegarder les modifications
        $this->saveRestaurants();

        header("Location: /tp-portail/restaurant");
        return;
    }

    public function notFound()
    {
        ViewRenderer::render('restaurant/404');
    }
}
