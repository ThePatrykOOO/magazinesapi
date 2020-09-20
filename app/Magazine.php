<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Magazine extends Model
{
    protected $fillable = [
        'name', 'publisher_id'
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public static function findAndPaginateMagazines($data)
    {
        $publisherId = Arr::get($data, 'publisher_id');
        $magazineTitle = Arr::get($data, 'magazine_title');
        $perPage = Arr::get($data, 'per_page', 10);

        return self::query()
            ->join('publishers', 'publishers.id', '=', 'magazines.publisher_id')
            ->when($publisherId, function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
            ->when($magazineTitle, function ($query) use ($magazineTitle) {
                $query->where('magazines.name', 'like', "%$magazineTitle%");
            })
            ->select('magazines.id', 'magazines.name', 'publishers.name as publisher_name')
            ->paginate($perPage);
    }
}
