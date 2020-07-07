<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 

class Controller extends BaseController
{
  
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const  emails=['contacto@tenvioperu.com']; 
    // const  emails=['mensajero@tenvioperu.com','cferrercava@gmail.com','rjgutierrez@unitru.edu.pe','jhordanlcix97@gmail.com','jaironavezaroca@gmail.com','jbriceno@unitru.edu.pe']; 
}
