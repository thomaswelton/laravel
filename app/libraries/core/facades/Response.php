<?php namespace Core\Facades;

use App;
use File;
use Illuminate\Support\Facades\Response as BaseResponse;
use Keboola\Csv\CsvFile;

class Response extends BaseResponse
{
    public static function csv($data, $filename)
    {
        // Get data to put into CSV
        if (!is_array($data)) {
            $data = $data->toArray();
        }

        // Create a tempoary file in the systme temp dir
        $tmpName = tempnam(storage_path(), 'csv');

        $csvFile = new CsvFile($tmpName);

        // Write column names
        $csvFile->writeRow(array_keys($data[0]));

        // Write rows
        foreach ($data as $row) {
            $csvFile->writeRow(array_values($row));
        }

        //Delete the file once the response is returned
        App::finish(function($request, $response) use ($tmpName) {
            File::delete($tmpName);
        });

        return parent::download($tmpName, $filename);
    }

}
