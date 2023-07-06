<?php

namespace App\Http\Services;

class RemoteAreaService extends CacheService {

    protected function buildData($cacheKey)
    {
        $path = $this->getFilePath($cacheKey['key']);
        $file = fopen($path, 'r');
        $key = 0;
        $data = [];
        while (($row = fgetcsv($file)) !== FALSE) {
            if($key != 0) {
                if (((int)$row[3]-(int)$row[2]) != 0) {
                    $diff = (int)$row[3]-(int)$row[2];
                    for($i=0; $i<=$diff; $i++) {
                        $data[((int)$row[2]+$i)] = [
                            'service' => $cacheKey['id'],
                            'country' => $row[0],
                            'city' => $row[1],
                            'postal_code' => ((int)$row[2]+$i)
                        ];
                    }
                } else {
                    $data[$row[2]] = [
                        'service' => $cacheKey['id'],
                        'country' => $row[0],
                        'city' => $row[1],
                        'postal_code' => $row[2]
                    ];
                }
            }
            $key++;
        }

        fclose($file);
        return $data;
    }

    private function getFilePath($cacheKey) {
        return storage_path('app/public/remote-area-files/'.$cacheKey.'.csv');
    }
}