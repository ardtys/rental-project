<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorcycle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merk_motor',
        'motor_type',
        'year',
        'nama_motor',
        'plat_nomor',
        'ganti_oli',
        'cleaning_cvt',
        'service_etc',
    ];

    protected $casts = [
        'year' => 'integer',
        'ganti_oli' => 'integer',
        'cleaning_cvt' => 'integer',
        'service_etc' => 'integer',
    ];

    const MERK_MOTOR = [
        'Honda' => 'Honda',
        'Yamaha' => 'Yamaha',
        'Suzuki' => 'Suzuki',
        'Kawasaki' => 'Kawasaki',
        'Vespa' => 'Vespa',
        'TVS' => 'TVS',
        'Bajaj' => 'Bajaj',
    ];

    const MOTOR_TYPE = [
        'Sport' => 'Sport',
        'Matic' => 'Matic',
        'Cub' => 'Cub',
        'Naked' => 'Naked',
        'Adventure' => 'Adventure',
        'Cruiser' => 'Cruiser',
        'Touring' => 'Touring',
    ];

    const YEARS = [
        2000 => '2000',
    2001 => '2001',
    2002 => '2002',
    2003 => '2003',
    2004 => '2004',
    2005 => '2005',
    2006 => '2006',
    2007 => '2007',
    2008 => '2008',
    2009 => '2009',
    2010 => '2010',
    2011 => '2011',
    2012 => '2012',
    2013 => '2013',
    2014 => '2014',
    2015 => '2015',
    2016 => '2016',
    2017 => '2017',
    2018 => '2018',
    2019 => '2019',
    2020 => '2020',
    2021 => '2021',
    2022 => '2022',
    2023 => '2023',
    2024 => '2024',
    2025 => '2025',
    2026 => '2026',
    2027 => '2027',
    2028 => '2028',
    2029 => '2029',
    2030 => '2030',
    ];

    public static function getNamaMotorByMerk($merk)
    {
        $namaMotorList = [
            'Honda' => ['BeAT', 'Vario', 'PCX', 'CBR150R', 'CB150R', 'Supra X'],
            'Yamaha' => ['NMAX', 'Aerox', 'Mio', 'R15', 'XSR155', 'Vixion'],
            'Suzuki' => ['GSX-R150', 'GSX-S150', 'Nex II', 'Address', 'Satria F150'],
            'Kawasaki' => ['Ninja 250', 'Z250', 'W175', 'KLX 150', 'Versys-X 250'],
            'Vespa' => ['Primavera', 'Sprint', 'GTS', 'LX'],
            'TVS' => ['Apache RTR', 'Neo', 'Dazz'],
            'Bajaj' => ['Pulsar', 'Dominar'],
        ];

        return $namaMotorList[$merk] ?? [];
    }
}