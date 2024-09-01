<?php

declare(strict_types=1);

namespace App\Handler\Home\Mng;

use App\Handler\AbstractBaseHandler;
use App\Traits\Aware\DbRunnerAwareTrait;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeTabellenHandler extends AbstractBaseHandler
{
    use DbRunnerAwareTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // param
        $q1 = (int) ($request->getQueryParams()['t'] ?? 1);

        // init
        $dbRunner = $this->getDbRunner();

        $tabellen = [
            1 => ['name' => 'tajo1_termin', 'order' => 'termin_id', 'header' => 'Termin', 'parent' => [0]],
            2 => ['name' => 'tajo1_media', 'order' => 'media_id', 'header' => 'Media', 'parent' => [0]],
            3 => ['name' => 'tajo1_user', 'order' => 'user_id', 'header' => 'User', 'parent' => [0]],
            4 => ['name' => 'tajo1_datum', 'order' => 'datum_id', 'header' => 'Datum', 'parent' => [0]],
            5 => ['name' => 'tajo1_history', 'order' => 'history_id', 'header' => 'History', 'parent' => [0]],
            6 => ['name' => 'tajo1_terminHistory', 'order' => 'terminHistory_id', 'header' => 'TerminHistory', 'parent' => [1]],
            7 => ['name' => 'tajo1_lnk_datum_termin', 'order' => 'lnk_id', 'header' => 'LnkDatumTermin', 'parent' => [1, 4]],
        ];

        $tabelle = $tabellen[$q1];

        $sqlData = "
            SELECT * FROM " . $dbRunner->getDb()->platform->quoteIdentifier($tabelle['name'])
            . " ORDER BY " . $dbRunner->getDb()->platform->quoteIdentifier($tabelle['order']) . " DESC";

        $data = $dbRunner->executeSelect($sqlData);

        // view
        $viewData = [
            'tabellen' => $tabellen,
            'data'     => $data,
        ];

        return new HtmlResponse(
            $this->templateRenderer->render('app::home/mng/tabellen', $viewData)
        );
    }
}
