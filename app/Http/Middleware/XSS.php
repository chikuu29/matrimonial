<?php
/* ================================================
    File Name             : XSS.php
    Description           : This is used to handle SQL INJECTION
    Author Name           : Rohit Kumar Behera
    Date Created          : 13-DEC-2022
    Update History        : 
    Devloped By           : Rohit Kumar Behera
    Devloped On           : 13-DEC-2022
    <Updated by>        <Updated On>        <Remarks>
    ==================================================*/
namespace App\Http\Middleware;

use Closure;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
          
            if($this->isSpclChar(strtolower($input)))
            {

                 return abort(UNAUTH_CODE, UNAUTH_MSG);
            }
           
        });
        
        $request->merge($input);
        return $next($request);
    }

   public function isSpclChar($strToCheck)
	{
		$arrySplChar	= explode(',',SQL_INJECTION_SPECIAL_CHARS);
        // echo '<pre>';
        // print_r(htmlspecialchars($arrySplChar));
		$errFlag		= 0;
		for ($i=0; $i<count($arrySplChar); $i++)
		{
           // echo '<pre>'.trim($arrySplChar[$i]) .'</pre>';
			$intPos=stripos($strToCheck, trim($arrySplChar[$i]));
			if ($intPos>0)
            {
				$errFlag++;
                break;  
            }
		}
		return $errFlag;
	}
}