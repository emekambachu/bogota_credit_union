<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class GithubDeploymentController extends Controller
{
    public function deploy($passWord)
    {
        if ($passWord !== "Xeddtech_1990") {
            return App::abort(403);
        }
        $cmd = 'cd ../ && git stash && git pull';
        ob_start();
        exec($cmd . " 2>&1", $output, $status);
        $result = ob_get_clean();
        dump($output);
        dump($result);
        //migrate the data
        Artisan::call('route:clear');
        dump(Artisan::output());
        Artisan::call('cache:clear');
        dump(Artisan::output());
        Artisan::call('view:clear');
        dump(Artisan::output());
    }

    public function postRunner(Request $request, $passWord)
    {
        //ensure its an admin
        $data = $request->all();
        if ($passWord !== "Xeddtech_1990") {
            return App::abort(403);
        }
        if (!isset($data['cmd'])) {
            return App::abort(403);
        }
        ob_start();
        exec("cd ../ && {$data['cmd']} 2>&1", $output, $status);
        $result = ob_get_clean();
        dump($output);
        dump($result);
    }
}
