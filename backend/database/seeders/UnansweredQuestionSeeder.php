<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnansweredQuestions;

class UnansweredQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnansweredQuestions::insert([
            ['question' => 'Where is the library located?', 'answer' => 'The library is located on the second floor of the main building, near the science labs.'],
            ['question' => 'What time does the school day start?', 'answer' => 'The school day starts at 8:00 AM. Make sure to arrive a bit earlier to get settled before classes begin.'],
            ['question' => 'Where can I find the cafeteria?', 'answer' => 'The cafeteria is on the ground floor, right next to the main entrance. It\'s open for breakfast and lunch.'],
            ['question' => 'How can I get a locker?', 'answer' => 'You can get a locker by visiting the student services office. They will assign one to you and provide a key or combination.'],
            ['question' => 'Where is the gymnasium?', 'answer' => 'The gymnasium is located on the west side of the campus, behind the main building. It’s next to the outdoor sports fields.'],
            ['question' => 'What is the school’s policy on absences?', 'answer' => 'If you need to be absent, make sure to notify the school office and provide a note from a parent or guardian explaining the absence.'],
            ['question' => 'Where are the art classrooms?', 'answer' => 'The art classrooms are located on the third floor, in the east wing of the main building.'],
            ['question' => 'How do I contact a teacher?', 'answer' => 'You can contact your teacher via email or by visiting them during their office hours, which are posted on the classroom door.'],
            ['question' => 'Where is the nurse’s office?', 'answer' => 'The nurse’s office is on the ground floor, near the main office. It\'s where you should go if you feel unwell during the school day.'],
            ['question' => 'What is the procedure for dropping off a forgotten lunch?', 'answer' => 'Drop off forgotten lunches at the main office. They will ensure that your child receives it during lunch period.'],
            ['question' => 'Where can I find the principal’s office?', 'answer' => 'The principal’s office is located in the administrative building, next to the main entrance.'],
            ['question' => 'What is the school’s policy on cell phone use?', 'answer' => 'Cell phones should be turned off or on silent mode during class. They can be used during breaks and lunchtime.'],
            ['question' => 'Where is the computer lab?', 'answer' => 'The computer lab is on the second floor, adjacent to the library. It’s available for student use during free periods.'],
            ['question' => 'How do I sign up for extracurricular activities?', 'answer' => 'Sign up for extracurricular activities by visiting the activities coordinator’s office. You can also find information on the school’s website.'],
            ['question' => 'What is the school’s dress code?', 'answer' => 'The dress code requires students to wear appropriate, non-revealing clothing. Specific guidelines are outlined in the student handbook.'],
            ['question' => 'Where are the restrooms located?', 'answer' => 'Restrooms are available on every floor. They are marked with signs for easy identification.'],
            ['question' => 'How do I get a student ID card?', 'answer' => 'Student ID cards are issued during the first week of school. Visit the student services office for more information.'],
            ['question' => 'Where is the music room?', 'answer' => 'The music room is on the ground floor, near the auditorium. It’s where you can find the band and choir classes.'],
            ['question' => 'What time does school end?', 'answer' => 'School ends at 3:00 PM. If you have after-school activities, make sure to check their specific end times.'],
            ['question' => 'Where can I find information about school events?', 'answer' => 'Information about school events is posted on the school’s website and bulletin boards around the campus.'],
            ['question' => 'Where is the science lab?', 'answer' => 'The science lab is located on the second floor, next to the math classrooms.'],
            ['question' => 'How can I report a problem with my locker?', 'answer' => 'Report locker issues to the student services office. They can help with repairs or provide a new locker if needed.'],
            ['question' => 'Where can I get a map of the school?', 'answer' => 'Maps of the school are available at the main office and can also be downloaded from the school’s website.'],
            ['question' => 'What are the school’s office hours?', 'answer' => 'The school office is open from 7:30 AM to 4:00 PM, Monday through Friday.'],
            ['question' => 'Where is the outdoor sports field?', 'answer' => 'The outdoor sports field is located at the back of the campus, behind the gymnasium.'],
            ['question' => 'How do I apply for a scholarship?', 'answer' => 'Apply for scholarships by visiting the guidance office or checking the scholarship section on the school’s website.'],
            ['question' => 'Where is the school’s bookstore?', 'answer' => 'The bookstore is located in the main building, near the cafeteria. It sells school supplies and textbooks.'],
            ['question' => 'How do I access the school’s Wi-Fi?', 'answer' => 'You can access the school’s Wi-Fi using the network name and password provided by the IT department.'],
            ['question' => 'Where can I find lost and found items?', 'answer' => 'Lost and found items are kept in the main office. Check there if you’ve lost something on campus.'],
            ['question' => 'What is the policy on bringing pets to school?', 'answer' => 'Pets are generally not allowed on school grounds, except for service animals. Check with the school administration for any exceptions.'],
        ]);
    }
}
