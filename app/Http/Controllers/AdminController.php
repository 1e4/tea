<?php

namespace App\Http\Controllers;

use App\Drinks;
use App\Http\Requests\StorePerson;
use App\Http\Requests\StoreRound;
use App\Round;
use App\TeaLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new user with their drink preference
     *
     * @param StorePerson $request
     * @return mixed
     */
    public function createPerson(StorePerson $request)
    {
        $person         = new Drinks();
        $person->user   = $name = $request->input('person');
        $person->drink  = $drink = $request->input('drink');
        $person->sugar  = $request->input('sugar');
        $person->milk   = $request->input('milk');
        $person->busy   = $request->input('busy');
        $person->save();

        return back()->with('success', $name . ' has been added with a preferred drink of ' . $drink);
    }

    public function createRound(StoreRound $request)
    {

        $people = $request->input('people');

        $length = count($people);

        $count = 0;

        $chosen = function() use($length, $people, &$chosen, &$count)
        {

            $count++;

            if($count === 10)
                return false;

            //Find a random person
            $person = $people[rand(0, $length - 1)];

            //Get their info
            $p = Drinks::where('user', '=', $person)->first();

            // Give them a time
            switch($p->busy)
            {
                case 1:
                    $time = Carbon::now()->subHours(5);
                    break;
                case 2:
                    $time = Carbon::now()->subHours(3);
                    break;
                case 3:
                    $time = Carbon::now();
                    break;
            }

            //Check tealog to see if the user has done a round in the past 3 hours if busy
            $log = TeaLog::where('user', '=', $person)
                ->where('created_at', '>=', $time)
                ->first();

            if($log)
            {
                echo $person . ' is too busy, trying again';
                return $chosen();
            }
            else
                return $p;
        };


        $p = $chosen();

        if($p === false)
            return back()->withErrors(['We couldn\'t find anyone that is available right now, maybe try in a few hours']);

        $round              = new Round();
        $round->started_by  = user()->name;
        $round->users       = implode(',', $request->input('people'));
        $round->chosen      = $p->user;
        $round->save();

        $log = new TeaLog();
        $log->user = $p->user;
        $log->save();


        return back()->with('success', 'A new round has started, ' . $p->user . ' has been chosen to make the round');
    }
}
