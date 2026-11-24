<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Find the administrator account
        $user = User::where('email', 'admin@bookstore.com')->first();

        // Use the first registered user if the sample email doesn't exist
        if (!$user) {
            $user = User::first();
        }

        if (!$user) {
            throw new \RuntimeException('Register an administrator first.');
        }

        $books = [
            [
                'title' => 'The Library at the End of the Road',
                'author' => 'Sarah Mitchell',
                'category' => 'Fiction',
                'unit_price' => 350.00,
                'description' => 'A heartwarming story about friendship, books, and unexpected adventures.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'A Map of Quiet Places',
                'author' => 'James Anderson',
                'category' => 'Fiction',
                'unit_price' => 420.00,
                'description' => 'A fictional journey through peaceful towns and hidden memories.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Everyday Budgeting for Beginners',
                'author' => 'Maria Santos',
                'category' => 'Nonfiction',
                'unit_price' => 280.00,
                'description' => 'A practical introduction to personal budgeting and financial planning.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'A Practical Guide to Urban Gardening',
                'author' => 'Robert Green',
                'category' => 'Nonfiction',
                'unit_price' => 390.00,
                'description' => 'Learn how to grow vegetables and plants in limited urban spaces.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Introduction to Web Development',
                'author' => 'John Reyes',
                'category' => 'Academic',
                'unit_price' => 550.00,
                'description' => 'An introduction to HTML, CSS, JavaScript, and web development fundamentals.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'Fundamentals of Database Design',
                'author' => 'Michael Cruz',
                'category' => 'Academic',
                'unit_price' => 620.00,
                'description' => 'Learn relational databases, normalization, SQL, and database modeling.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Mia and the Missing Kite',
                'author' => 'Anna Garcia',
                'category' => "Children's Books",
                'unit_price' => 180.00,
                'description' => 'A fun childrens story about a young girl searching for her lost kite.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'Counting Stars with Lolo',
                'author' => 'Daniel Flores',
                'category' => "Children's Books",
                'unit_price' => 200.00,
                'description' => 'An educational story that introduces children to counting.',
                'availability_status' => 'Unavailable',
            ],
        ];

        // Associate every demonstration book with the administrator
        foreach ($books as $book) {
            $user->books()->updateOrCreate(
                ['title' => $book['title']],
                $book
            );
        }
    }
}
