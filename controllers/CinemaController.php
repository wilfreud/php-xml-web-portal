<?php
require_once 'ViewRenderer.php';
class CinemaController
{
    private $movies;

    public function __construct()
    {
        $file = simplexml_load_file("xml/cinema.xml");
        $this->movies = new SimpleXMLElement($file->asXML());
        if ($this->movies === false) {
            die("<h3 class='warning-message'>Erreur lors du chargement des films...</h3>");
        }
    }

    public function listMovies()
    {
        return $this->movies->film;
    }

    public function getMovie($id)
    {
        return $this->movies->film; //[$id] || null;
    }

    public function addMovie($title, $director, $year, $genre)
    {
        // Créer un nouveau film avec les données fournies
        $newMovie = $this->movies->addChild("film");
        $newMovie->addChild("titre", htmlspecialchars($title));
        $newMovie->addChild("realisateur", htmlspecialchars($director));
        $newMovie->addChild("anneeProduction", htmlspecialchars($year));
        $newMovie->addChild("genre", htmlspecialchars($genre));

        // Valider le XML par rapport à la DTD
        $xml = new DOMDocument();
        $xml->loadXML($this->movies->asXML());

        if ($xml->validate()) {
            // Enregistrer les modifications dans le fichier XML
            $this->movies->asXML("xml/cinema.xml");
        } else {
            // Gérer les erreurs de validation XML
            die("<h3 class='warning-message'>Erreur : Le film ne respecte pas la DTD spécifiée.</h3>");
        }
    }


    // Routing
    public function index()
    {
        ViewRenderer::render('cinema/index', ['movies' => $this->listMovies()]);
    }

    public function edit($id)
    {
        if (is_numeric($id) === false) {
            $this->notFound();
            return;
        }

        $movie = $this->getMovie((int) ($id));

        if (!$movie) {
            $this->notFound();
            return;
        }
        ViewRenderer::render('cinema/edit', ['cinema' => $this->getMovie($id)]);
    }

    public function notFound()
    {
        ViewRenderer::render('cinema/404');
    }
}
