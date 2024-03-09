<?php

/*
 * Class interprets divination.
 */

namespace App\FortuneTeller;

//use App\Constants;
use App\Recognizer\Recognizer;
use App\Services\Repository;
use Exception;
use App\Services\FortuneTellerService;

class FortuneTeller
{
    private array $rawHexagrams = [];

    private int $primaryHexagram = 0;
    private int $secondaryHexagram = 0;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->rawHexagrams = (new FortuneTellerService())->index();
        $recognizer = (new Recognizer($this->rawHexagrams))->analyze();
        $this->primaryHexagram = $recognizer['primary'];
        $this->secondaryHexagram = $recognizer['secondary'];
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        echo 'primary: ' . $this->primaryHexagram . '<br>';

        if ($this->secondaryHexagram) {
            echo 'secondary: ' . $this->secondaryHexagram . '<br>';
        } else {
            echo 'secondary: No changing lines.<br>';
        }

        $primaryHexagramData = (new Repository())->getHexagramDataById($this->primaryHexagram);
        $secondaryHexagramData = $this->secondaryHexagram ? (new Repository())->getHexagramDataById
        (
            $this->secondaryHexagram
        ) : '';

        echo '<h3>Тлумачення</h3>';

        if (!$primaryHexagramData) {
            echo '<p>На жаль, зараз немає тлумачення для гексаграми ' . $this->primaryHexagram . '</p><br>';

            return;
        } else {
            echo '<p>Початкова гексаграма: ' . $primaryHexagramData['name'] . '</p>';
            
            echo sprintf('<p>%s</p>', $primaryHexagramData['description']);
            echo sprintf('<p>%s</p>', $primaryHexagramData['interpretation']);
            echo sprintf('<p>%s</p>', $primaryHexagramData['worlds']);
            echo sprintf('<p>%s</p>', $primaryHexagramData['potential']);
        }

        if (!$this->secondaryHexagram) {
            echo 'Фонова (вторинна) гексаграма відсутня';

            return;
        }

        if (!$secondaryHexagramData) {
            echo 'На жаль, зараз немає тлумачення для гексаграми ' . $this->secondaryHexagram . '<br>';

            return;
        } else {
            echo 'Фонова (вторинна) гексаграма: ' . $secondaryHexagramData['name'] . '<br>';
            echo sprintf('<p>%s</p>', $secondaryHexagramData['description']);
            echo sprintf('<p>%s</p>', $secondaryHexagramData['interpretation']);
            echo sprintf('<p>%s</p>', $secondaryHexagramData['worlds']);
            echo sprintf('<p>%s</p>', $secondaryHexagramData['potential']);
        }
    }
}
