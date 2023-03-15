<?php

if (!function_exists('paginateItems')) {

    /**
     * Paginates array or collection
     *
     * @param array|Illuminate\Support\Collection $items
     * @param int $perPage
     * @param int $page
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    function paginateItems($items, $perPage = 25, $page = null)
    {
        $page = $page ?: (Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Illuminate\Support\Collection ? $items : Illuminate\Support\Collection::make($items);
        return new Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Illuminate\Pagination\Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }
}
