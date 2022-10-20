<?php

namespace Sashagm\Payment\Actions;

class ActiveService
{

    public function active($service)
    {
        if ($service != "true") {
            abort(403, 'Данный способ временно отключён!');
        }        
    }
    

}