<?php

namespace App\Http\Controllers;

use App\Models\Currencies;

class CurrenciesController extends Controller
{
    public function create() {
        $currensies = new Currencies();

        $dataRU = simplexml_load_file('https://cbr.ru/scripts/XML_daily.asp');                                           // Подключение XML файлов ЦБР
        $dataEN = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp');

        Currencies::truncate();                                                                                         // Удаление старой информации о валютах


        foreach ($dataRU->Valute as $Valut){                                                                             // Загрузка информации о валютах
            $pr = $Valut->attributes()->ID;     //получение id используемой валюты
            $CurID = $dataEN->xpath("//Valute[@ID = '$pr']");   //получение валюты по id из английского xml файла
            $currensiesArr[] = [
                    'id'                => $Valut->attributes()->ID,
                    'name'              => $Valut->Name,
                    'english_name'      => $CurID[0]->Name,
                    'alphabetic_code'   => $Valut->CharCode,
                    'didgit_code'       => $Valut->NumCode,
                    'rate'              => bcdiv(str_replace(',', '.', $Valut->Value), str_replace(',', '.', $Valut->Nominal), 6)
                ];
            }
        Currencies::insert($currensiesArr);
    }

    public function Get_currency() {
        try{
            $allCurrency = Currencies::all();
        } catch(\Exception $e){
            echo "Ошибка подключения к базе данных";
        }                                                                                   // метод возвращает информацию о валюте в формате json
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        return response()->json($allCurrency, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function Get_currency_byID($id) { 
        try{
            $Currency = Currencies::where('id', $id)->first();
        }  catch(\Exception $e){
            echo "Ошибка подключения к базе данных";
        }                                                                         // метод возвращает информацию о валюте в формате json
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        return response()->json($Currency, 200, $headers, JSON_UNESCAPED_UNICODE); 
    }
}



