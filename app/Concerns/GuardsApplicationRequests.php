<?php
/**
 * Created by PhpStorm.
 * User: Lea
 * Date: 7/3/2017
 * Time: 3:17 AM
 */

namespace App\Concerns;


use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

trait GuardsApplicationRequests
{
    /**
     * @param $application
     * @return RedirectResponse|Redirector
     */
    protected function guard($application)
    {
        try {
            $this->guardRequest($application);
        } catch (AccessDeniedException $e) {
            flash($e->getMessage())->error()->important();
            return redirect('dashboard');
        }
    }

    protected function guardRequest($application)
    {
        if ($application == null) {
            throw new AccessDeniedException('Please start an application!');
        }

        if ($application->state_id != $this->state->id) {
            throw new AccessDeniedException(
                "Somehow you got my '{$this->state->name}' generator for your '{$application->state->name}' application"
            );
        }

        if ($application->user_id != null && Auth::id() != $application->user_id) {
            throw new AccessDeniedException("You don't have permission!");
        }
    }
}
