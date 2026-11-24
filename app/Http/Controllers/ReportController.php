<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Shared filtering logic for reports and exports
    private function filteredBooks(Request $request)
    {
        $filters = $request->validate([
            'report_type' => 'nullable|in:all,available,unavailable,category,price_list',
            'category' => 'nullable|in:Fiction,Nonfiction,Academic,Children\'s Books',
            'availability_status' => 'nullable|in:Available,Unavailable',
        ]);

        // Retrieve only the logged-in administrator's books
        $query = auth()->user()->books();

        // Apply report type conditions
        switch ($filters['report_type'] ?? 'all') {
            case 'available':
                $query->where('availability_status', 'Available');
                break;

            case 'unavailable':
                $query->where('availability_status', 'Unavailable');
                break;
        }

        // Apply category filter
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        // Apply availability filter
        if (!empty($filters['availability_status'])) {
            $query->where(
                'availability_status',
                $filters['availability_status']
            );
        }

        return $query->orderBy('title')->get();
    }

    // Display inventory reports
    public function index(Request $request)
    {
        $books = $this->filteredBooks($request);

        return view('reports.index', compact('books'));
    }

    // Export filtered records to Excel
    public function exportExcel(Request $request)
    {
        $books = $this->filteredBooks($request);

        return Excel::download(
            new BookExport($books),
            'book-inventory-report.xlsx'
        );
    }

    // Export filtered records to PDF
    public function exportPdf(Request $request)
    {
        $books = $this->filteredBooks($request);

        $pdf = Pdf::loadView(
            'reports.pdf',
            compact('books')
        );

        return $pdf->download('book-inventory-report.pdf');
    }
}
