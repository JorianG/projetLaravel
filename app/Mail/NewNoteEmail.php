<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Eleve;
use App\Models\EvaluationEleve;

class NewNoteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $grade;
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct(Eleve $student, EvaluationEleve $grade, $date)
    {
        $this->student = $student;
        $this->grade = $grade;
        $this->date = $date;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Grade Notification')
                    ->markdown('emails.new_note')
                    ->with([
                        'student' => $this->student,
                        'grade' => $this->grade,
                        'date' => $this->date,
                    ]);
    }
}
