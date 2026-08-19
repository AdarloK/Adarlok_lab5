<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentMiddleware
 *
 * Protects the /student/profile route.
 *
 * Access condition (unique to this build): a session flag named
 * 'clearance_granted'. It is auto-granted the first time a visitor
 * loads the site, simulating a one-time "badge scan" — this keeps the
 * activity's request flow (Route -> Middleware -> Controller -> View)
 * fully testable in a browser without a login form.
 *
 * If the flag is ever missing or false, the visitor is bounced back
 * to /student with a denial message instead of reaching the profile.
 *
 * TODO (optional personalization): change the session key name and/or
 * the denial message below to make your access condition unique, per
 * the lab's Individualization Requirement.
 */
class StudentMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unique access condition for this activity.
        if (!isset($_SESSION['clearance_granted'])) {
            $_SESSION['clearance_granted'] = true;
        }

        if ($_SESSION['clearance_granted'] === true) {
            // Access allowed -> continue the pipeline to the controller
            return $next();
        }

        // Access denied -> redirect back to the student home page
        $_SESSION['access_message'] = 'Clearance denied by StudentMiddleware: badge scan required before viewing the profile.';
        redirect('student');
        exit;
    }
}
