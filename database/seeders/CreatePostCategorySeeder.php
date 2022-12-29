<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = PostCategory::insert([
            [
                'academic_level' => 'Hóa 8',
                'question_level' => 'Nhận biết',
            ],
            [
                'academic_level' => 'Hóa 9',
                'question_level' => 'Nhận biết',
            ],
            [
                'academic_level' => 'Hóa 10',
                'question_level' => 'Nhận biết',
            ],
            [
                'academic_level' => 'Hóa 11',
                'question_level' => 'Nhận biết',
            ],
            [
                'academic_level' => 'Hóa 12',
                'question_level' => 'Nhận biết',
            ],
            [
                'academic_level' => 'Hóa 8',
                'question_level' => 'Thông hiểu',
            ],
            [
                'academic_level' => 'Hóa 9',
                'question_level' => 'Thông hiểu',
            ],
            [
                'academic_level' => 'Hóa 10',
                'question_level' => 'Thông hiểu',
            ],
            [
                'academic_level' => 'Hóa 11',
                'question_level' => 'Thông hiểu',
            ],
            [
                'academic_level' => 'Hóa 12',
                'question_level' => 'Thông hiểu',
            ],
            [
                'academic_level' => 'Hóa 8',
                'question_level' => 'Vận dụng',
            ],
            [
                'academic_level' => 'Hóa 9',
                'question_level' => 'Vận dụng',
            ],
            [
                'academic_level' => 'Hóa 10',
                'question_level' => 'Vận dụng',
            ],
            [
                'academic_level' => 'Hóa 11',
                'question_level' => 'Vận dụng',
            ],
            [
                'academic_level' => 'Hóa 12',
                'question_level' => 'Vận dụng',
            ],
            [
                'academic_level' => 'Hóa 8',
                'question_level' => 'Vận dụng cao',
            ],
            [
                'academic_level' => 'Hóa 9',
                'question_level' => 'Vận dụng cao',
            ],
            [
                'academic_level' => 'Hóa 10',
                'question_level' => 'Vận dụng cao',
            ],
            [
                'academic_level' => 'Hóa 11',
                'question_level' => 'Vận dụng cao',
            ],
            [
                'academic_level' => 'Hóa 12',
                'question_level' => 'Vận dụng cao',
            ],
        ]);
    }
}
