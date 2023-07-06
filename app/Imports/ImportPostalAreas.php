<?php

namespace App\Imports;

use App\Http\Controllers\RemoteAreas\Models\RemoteArea;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPostalAreas implements ToModel
{
    public $index = 0;


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $preparedData = [];
        if ($this->index == 0) {
            $this->index =+ 1;
        } else {
            $betweenPostalCodes = (int)$row[3] - (int)$row[2];
            if ($betweenPostalCodes == 0) {
                array_push($preparedData, [
                    'service_id' => (int)$row[6],
                    'country' => $row[0],
                    'city' => $row[1],
                    'postal_code' => $row[2]
                ]);
            } else {
                for($i = 0; $i<=$betweenPostalCodes; $i++) {
                    array_push($preparedData, [
                        'service_id' => (int)$row[6],
                        'country' => $row[0],
                        'city' => $row[1],
                        'postal_code' => (int)$row[2]+$i
                    ]);
                }
            }
            $remoteArea = new RemoteArea();
            $remoteArea->insert($preparedData);
        }
    }
}
