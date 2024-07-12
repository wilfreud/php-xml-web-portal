<?php
require_once 'ViewRenderer.php';

class CinemaController
{
    private $movies;

    public function __construct()
    {
        $filename = "xml/cinema.xml";
        if (!file_exists($filename)) {
            die("<h3 class='warning-message'>Le fichier cinema.xml n'existe pas...</h3>");
        }

        $this->movies = simplexml_load_file($filename);
        if ($this->movies === false) {
            die("<h3 class='warning-message'>Erreur lors du chargement des films...</h3>");
        }
    }

    public function listMovies()
    {
        return $this->movies->film;
    }

    public function getMovie(int $id)
    {
        return $this->movies->film[$id] ?? null;
    }

    public function addMovie($data)
    {
        // Validation des données obligatoires
        $requiredFields = ['titre', 'realisateur', 'anneeProduction', 'genre', 'duree', 'langue', 'acteurs', 'intrigue', 'horaires'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                die("<h3 class='warning-message'>Erreur : Le champ $field est obligatoire.</h3>");
            }
        }

        // Création d'un nouveau film dans le XML
        $newMovie = $this->movies->addChild("film");
        $newMovie->addChild("titre", htmlspecialchars($data['titre']));
        $newMovie->addChild("duree", htmlspecialchars($data['duree']));
        $newMovie->addChild("genre", htmlspecialchars($data['genre']));
        $newMovie->addChild("realisateur", htmlspecialchars($data['realisateur']));

        // Ajout des acteurs
        $acteurs = $newMovie->addChild("acteurs");
        foreach (explode(",", $data['acteurs']) as $acteur) {
            $acteurs->addChild("acteur", htmlspecialchars(trim($acteur)));
        }

        $newMovie->addChild("anneeProduction", htmlspecialchars($data['anneeProduction']));
        $newMovie->addChild("langue", htmlspecialchars($data['langue']));

        // Ajout des éléments facultatifs
        if (!empty($data['presse'])) {
            $newMovie->addChild("presse", htmlspecialchars($data['presse']));
        }
        if (!empty($data['spectateur'])) {
            $newMovie->addChild("spectateur", htmlspecialchars($data['spectateur']));
        }

        // Ajout de la description
        $description = $newMovie->addChild("description");
        $paragraphe = $description->addChild("paragraphe");
        $paragraphe->addChild("intrigue", htmlspecialchars($data['intrigue']));

        // Ajout des horaires
        $horaires = $paragraphe->addChild("horaires");
        $splitHoraires = explode("\n", $data['horaires']);
        foreach ($splitHoraires as $horaire) {
            // Séparation des jours et des horaires
            $splitOneHoraire = explode("---", $horaire);
            if (count($splitOneHoraire) !== 2) {
                continue; // Évite les erreurs si le format n'est pas correct
            }
            $jours = trim($splitOneHoraire[0]);
            $heures = trim($splitOneHoraire[1]);
            $horaireElement = $horaires->addChild("horaire");

            // Ajout de l'attribut id à horaire
            $horaireElement->addAttribute("id", uniqid());

            // Ajout des éléments jour et heure
            $horaireElement->addChild("jour", htmlspecialchars($jours));
            $horaireElement->addChild("heure", htmlspecialchars($heures));
        }

        // Validation et sauvegarde du XML
        $xml = new DOMDocument();
        $xml->loadXML($this->movies->asXML());

        // Pour éviter les erreurs DOMDocument::validate()
        libxml_use_internal_errors(true);

        if ($xml->validate()) {
            $this->movies->asXML("xml/cinema.xml");
        } else {
            foreach (libxml_get_errors() as $error) {
                echo "<p class='warning-message'>Erreur : " . $error->message . "</p>";
            }
            libxml_clear_errors();
            die("<h2 class='warning-message'>Le film ne respecte pas la DTD spécifiée.</h2>");
        }
    }



    public function index()
    {
        ViewRenderer::render('cinema/index', ['movies' => $this->listMovies()]);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->addMovie($_POST);
            header("Location: /tp-portail/cinema");
            exit;
        }

        if ($id === "edit") {
            ViewRenderer::render('cinema/edit');
            return;
        }

        if (!is_numeric($id)) {
            $this->notFound();
            return;
        }

        $movie = $this->getMovie((int)$id);

        if (!$movie) {
            $this->notFound();
            return;
        }

        ViewRenderer::render('cinema/edit', ['film' => $movie]);
    }

    public function deleteMovie($id)
    {
        unset($this->movies->film[$id]);
        $this->movies->asXML("xml/cinema.xml");
    }


    public function notFound()
    {
        ViewRenderer::render('cinema/404');
    }
}
