<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentController
 *
 * Handles the student home page (/student) and the middleware-protected
 * student profile page (/student/profile).
 *
 * ------------------------------------------------------------------
 * HOW TO PERSONALIZE THIS FILE
 * ------------------------------------------------------------------
 * Everything you need to change for the laboratory activity's
 * "Individualization Requirement" lives in the profile() method below.
 * Replace every placeholder value with your own real information.
 * See README.md ("Personalize Your Information") for the full guide.
 */
class StudentController extends Controller
{
    public function index()
    {
        // TODO: change the page title to something unique to you
        $data['title'] = 'CHANGE_ME — My Student Access Console';
        $this->call->view('student_home', $data);
    }

    public function profile()
    {
        $student = [
            // ===== REQUIRED FIELDS — replace with YOUR OWN information =====
            'student_id'  => 'MCC2024-00050',
            'name'        => 'Sabina Rheazel B. Elumba',
            'course'      => 'BS Information Technology',
            'year'        => '3rd Year',
            'section'     => '3F1',
            'email'       => 'sabinarheazelelumba@gmail.com',

            
        ];

        $this->call->view('student_profile', $student);
    }
}
