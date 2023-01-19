<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CsvData extends Model
{
    use HasFactory;
    protected $table = 'csv_data';
    protected $fillable = ['csv_filename', 'csv_header', 'csv_data'];

    // Soft delete records that are older than 1 year
// $deletedRows = ModelName::where('created_at', '<', Carbon::now()->subYears(1))
// ->update(['deleted_at' => Carbon::now()]);

// // Soft delete records that are older than 6 months
// $deletedRows = ModelName::where('created_at', '<', Carbon::now()->subMonths(6))
// ->update(['deleted_at' => Carbon::now()]);

// // Soft delete records that are older than 15 days
// $deletedRows = ModelName::where('created_at', '<', Carbon::now()->subDays(15))
// ->update(['deleted_at' => Carbon::now()]);
}
