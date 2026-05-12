<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;
use Google\Service\Sheets\Request as SheetsRequest;
use Google\Service\Sheets\AddSheetRequest;
use Google\Service\Sheets\SheetProperties;

class GoogleSheetsService
{
    protected Sheets $service;
    protected string $spreadsheetId;
    protected string $sheetName;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(base_path(env('GOOGLE_SERVICE_ACCOUNT_JSON')));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service     = new Sheets($client);
        $this->spreadsheetId = env('GOOGLE_SHEETS_SPREADSHEET_ID');
        $this->sheetName   = env('GOOGLE_SHEETS_SHEET_NAME', 'Брони');
    }

    /*     // Получить все существующие листы
    protected function getExistingSheets(): array
    {
        $spreadsheet = $this->service->spreadsheets->get($this->spreadsheetId);
        $sheets = [];

        foreach ($spreadsheet->getSheets() as $sheet) {
            $sheets[] = $sheet->getProperties()->getTitle();
        }

        return $sheets;
    }

    // Создать лист если не существует
    protected function ensureSheetExists(): void
    {
        $existing = $this->getExistingSheets();

        if (in_array($this->sheetName, $existing)) {
            return; // Лист уже есть
        }

        // Создаём новый лист
        $addSheet = new SheetsRequest([
            'addSheet' => new AddSheetRequest([
                'properties' => new SheetProperties([
                    'title' => $this->sheetName
                ])
            ])
        ]);

        $batchRequest = new BatchUpdateSpreadsheetRequest([
            'requests' => [$addSheet]
        ]);

        $this->service->spreadsheets->batchUpdate($this->spreadsheetId, $batchRequest);

        // Добавляем заголовки
        $this->addHeaders();
    }

    // Добавить заголовки в первую строку
    protected function addHeaders(): void
    {
        $headers = [
            'Дата создания заявки',
            'Имя клиента',
            'Email',
            'Город куда едет',
            'Сообщение от клиента',
        ];

        $body = new ValueRange(['values' => [$headers]]);

        $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $this->sheetName . '!A1',
            $body,
            ['valueInputOption' => 'USER_ENTERED']
        );
    } */

    // Добавить строку с данными
    public function appendRow(array $data): void
    {
        //  $this->ensureSheetExists(); // Проверяем/создаём лист

        $body = new ValueRange(['values' => [$data]]);

        $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            $this->sheetName . '!A1',
            $body,
            ['valueInputOption' => 'USER_ENTERED']
        );
    }
}
