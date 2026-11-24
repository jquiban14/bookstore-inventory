<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    protected Collection $books;

    public function __construct(Collection $books)
    {
        $this->books = $books;
    }

    // Return the filtered books as spreadsheet rows
    public function collection(): Collection
    {
        return $this->books->map(function ($book) {
            return [
                $book->title,
                $book->author,
                $book->category,
                $book->unit_price,
                $book->availability_status,
            ];
        });
    }

    // Define the spreadsheet column headings
    public function headings(): array
    {
        return [
            'Book Title',
            'Author',
            'Category',
            'Unit Price (PHP)',
            'Availability Status',
        ];
    }
}
