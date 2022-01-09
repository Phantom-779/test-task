<?php

namespace App\Http\Controllers;

use App\Models\Currencies;

class CurrenciesController extends Controller
{
    public function create() {
        $currensies = new Currencies();

        $dataRU = simplexml_load_file('https://cbr.ru/scripts/XML_daily.asp');              // Подключение XML файлов ЦБР
        $dataEN = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp');

        \DB::table('currencies')->truncate();                                               // Удаление старой информации о валютах

        for ($i = 0; $i < count($dataRU); $i++){                                            // Загрузка информации о валютах
            \DB::table('currencies')->insert([
                'russian_name'      => $dataRU->Valute[$i]->Name,
                'english_name'      => $dataEN->Valute[$i]->Name,
                'alphabetic_code'   => $dataRU->Valute[$i]->CharCode,
                'didgit_code'       => $dataRU->Valute[$i]->NumCode,
                'rate'              => str_replace(',', '.', $dataRU->Valute[$i]->Value),
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s")
            ]);   
        }
    }

    public function Get_currency() {                                                        // метод возвращает информацию о валюте в формате json
        $allCurrency = \DB::table('currencies')->get();
        return json_encode($allCurrency, JSON_UNESCAPED_UNICODE);
    }

    public function Get_currency_byID($id) {                                                // метод возвращает информацию о валюте в формате json
        $Currency = \DB::table('currencies')->where('id', $id)->first();
        return json_encode($Currency, JSON_UNESCAPED_UNICODE);
    }

    public function test_metod() {                                                          // тестовый метод для проверки команд
        //$testcick = Self::Get_currency_byID(4);
        $testcick = Self::Get_currency();
        echo $testcick;
    }

}



