<?php

namespace App\Http\Controllers;

use App\Models\Catalog\ProductCategory;
use App\Repositories\Catalog\ProductCategoryRepository;
use App\Repositories\Catalog\ProductRepository;
use App\Repositories\CityRepository;
use App\Services\SpeedyShipmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    const AUTOCOMPLETE_MIN_LENGTH = 2;
    const AUTOCOMPLETE_MAX_RESULTS = 30;

    public $isoCountryNumbers = [];

    // public static function test(Request $request, $datasetName)
    // {
    //   return self::index($request, $datasetName);
    // }

    public function __construct()
    {
        $this->isoCountryNumbers = [
            'bg' => 100,
            'ro' => 642,
            'gr' => 300
        ];
    }

    public function index(Request $request, $datasetName)
    {
        $query = $request->input("query");
        $locale = $request->get('locale');
        $dataset = [];

        switch ($datasetName) {
            case "users":
                $dataset=$this->getUsersDataset($query);
                break;

            default:
                return response()->json($dataset);
        }

        return response()->json($dataset, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * getUsersDataset
     *
     * @param  string $query
     *
     * @return array
     */
    protected function getUsersDataset($query)
    {
        //min. 2 chars needed to execute DB query
        if(mb_strlen($query, 'UTF-8') < self::AUTOCOMPLETE_MIN_LENGTH) {
            return '[]';
        }

        $queryResult = DB::select("SELECT `id`, `name`, `lastname`, `email`
        FROM users
        WHERE `name` LIKE ?
        OR `email` LIKE ?
        LIMIT " . self::AUTOCOMPLETE_MAX_RESULTS,[$query.'%', $query.'%']);

        return $queryResult;
    }
}
