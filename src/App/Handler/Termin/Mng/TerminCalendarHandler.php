<?php

declare(strict_types=1);

namespace App\Handler\Termin\Mng;

use App\Handler\Termin\AbstractTerminHandler;
use App\Model\Termin\TerminCollection;
use App\Service\HelperService;
use App\Traits\Aware\FormStorageAwareTrait;
use App\Traits\Aware\MediaRepositoryAwareTrait;
use App\Traits\Aware\TerminRepositoryAwareTrait;
use DateTime;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\Form\FormInterface;
use Laminas\Validator\Date;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TerminCalendarHandler extends AbstractTerminHandler
{
    use FormStorageAwareTrait;
    use MediaRepositoryAwareTrait;
    use TerminRepositoryAwareTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->getUrlpoolService()->save();

        // param
        $dateParam = (string)($request->getQueryParams()['date'] ?? (new DateTime())->format('Y-m-d'));
        
        $terminIdParam = (int)($request->getQueryParams()['id'] ?? 0);

        if (!(new Date())->isValid($dateParam)) {
            return new TextResponse('No valid date is given');
        }

        // init
        $terminRepository = $this->getTerminRepository();

        // collection
        $terminCollection = new TerminCollection(referenzDatum: $dateParam);

        // view
        $viewData = [
            'terminCollection'      => $terminCollection,
            'terminIdParam' => $terminIdParam,
            'dateParam' => $dateParam,
        ];

        // fetch termin
        $terminResultSet = $terminRepository->fetchTermin($this->getMappedTerminSearchValues($dateParam));

        // init collection
        $terminCollection->init($terminResultSet->toArray());

        return new HtmlResponse(
            $this->templateRenderer->render('app::termin/mng/calendar', $viewData)
        );
    }

    public function getTerminSearchForm(array $params): FormInterface
    {
        $form = $this->getForm('termin-mng-search-form');
        $form->setAttribute('method', 'GET');
        $form->setAttribute('action', '/manage/termin-calendar');

        $form->setData($params);

        return $form;
    }

    public function getMappedTerminSearchValues(string $date): array
    {
        return $this->getMappedMngSearchValues([
            'start' => HelperService::getMonthFirstDayForCalender($date)->format('Y-m-d'),
            'ende' => HelperService::getMonthLastDayForCalender($date)->format('Y-m-d'),
        ]);
    }
}
