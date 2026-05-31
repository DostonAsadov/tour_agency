<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsService
{
    protected Sheets $service;
    protected string $spreadsheetId;
    protected string $sheetName;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(base_path(config('services.google.service_account_json')));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service       = new Sheets($client);
        $this->spreadsheetId = config('services.google.sheets_spreadsheet_id');
        $this->sheetName     = config('services.google.sheets_sheet_name');
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
