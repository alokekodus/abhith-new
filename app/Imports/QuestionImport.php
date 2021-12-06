<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToCollection, WithHeadingRow
{
    use Importable;

    private $setId;

    public function __construct(int $setId) 
    {
        $this->setId = $setId;
       
    }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        {
            Question::create([
                'question' => $row['question'],
                'option_1' => $row['option_1'],
                'option_2' => $row['option_2'],
                'option_3' => $row['option_3'],
                'option_4' => $row['option_4'],
                'correct_answer' => $row['correct_answer'],
                'set_id' => $this->setId
            ]);
        }
    }
}
