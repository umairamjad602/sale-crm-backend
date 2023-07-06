<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;

abstract class CacheService {
    protected $cacheKey;

    public function __construct()
    {
    }

    protected abstract function buildData($cacheKey);

    public function buildCahce($cacheKey) {
        $data = $this->buildData($cacheKey);
        if(Cache::has($cacheKey['key'])) {
            Cache::forget($cacheKey['key']);
        }
        Cache::forever($cacheKey['key'], $data);
    }

    public function getById($id, $cahceKey) {
        $cacheData = Cache::get($cahceKey);
        if(isset($cacheData[$id])) {
            dd($cacheData);
            dd(array_search($id, $cacheData), "i am here");
            return array_search($id, $cacheData);
        } else {
            return null;
        }
    }

    private function getCache($cacheKey) {
        if(Cache::has($cacheKey['key'])) {
            return Cache::get($cacheKey['key']);
        } else {
            $this->buildCahce($cacheKey['key']);
            return $this->getCache($cacheKey['key']);
        }
    }
}