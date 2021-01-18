<?php 

namespace App\Http\Controllers\API;

/** add it at top **/
use App\Tag;
use App\Owner;
use App\Questions;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
/*** end ***/
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;


class ApiController extends Controller {

    function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function view()
    {
        return view('welcome');
    }

    public function chart(Request $request) {
        $chartData = [];
        $allTag = Tag::all();
        foreach ($allTag as $key => $chartTag) {
            $url = 'https://api.stackexchange.com/2.2/questions?site=stackoverflow&tagged='.$chartTag->tags;
            $response = $this->client->get($url);
            $questionsRecs = $response->getBody();
            $questionsRecResults = json_decode($questionsRecs);
            foreach ($questionsRecResults->items as $key => $value) {
                $question = new Questions();
                $question->is_answered = $value->is_answered;
                $question->view_count = $value->view_count;
                $question->answer_count = $value->answer_count;
                $question->score = $value->score;
                $question->last_activity_date = $value->last_activity_date;
                $question->creation_date = $value->creation_date;
                $question->question_id = $value->question_id;
                $question->link = $value->link;
                $question->title = $value->title;
                $question->timestamps = false;
                //store owner info
                $owner = new Owner();
                $owner->reputation = $value->owner->reputation;
                $owner->user_id = $value->owner->user_id;
                $owner->user_type = $value->owner->user_type;
                $owner->profile_image = $value->owner->profile_image;
                $owner->display_name = $value->owner->display_name;
                $owner->link = $value->owner->link;
                $owner->timestamps = false;
                $owner->save();
    
                // $question->tag_id = $tag->id;
                $question->owner_id = $owner->id;
                $question->save();
            }
            $count = [];
            $count['tag'] = $chartTag->tags;
            $allQuestionsUrl = 'https://api.stackexchange.com/2.2/questions?site=stackoverflow&tagged='.$chartTag->tags.'&filter=total';
            $response = $this->client->get($allQuestionsUrl);
            $allQuestionsCount = $response->getBody();
            $allQuestionsCountResult = json_decode($allQuestionsCount);
            $count['allquestions'] = $allQuestionsCountResult->total;
            $unansweredUrl = 'https://api.stackexchange.com/2.2/questions/unanswered?site=stackoverflow&tagged='.$chartTag->tags.'&filter=total';
            $response = $this->client->get($unansweredUrl);
            $unAnsweredCount = $response->getBody();
            $unAnsweredCountResult = json_decode($unAnsweredCount);
            $count['unanswered'] = $unAnsweredCountResult->total;
            $noansweredUrl = 'https://api.stackexchange.com/2.2/questions/no-answers?site=stackoverflow&tagged='.$chartTag->tags.'&filter=total';
            $response = $this->client->get($noansweredUrl);
            $noAnsweredCount = $response->getBody();
            $noAnsweredResult = json_decode($noAnsweredCount);
            $count['noanswers'] = $noAnsweredResult->total; 
            $chartData[] = $count;
        // break;
        }
        return $chartData;
    }

    public function tags()
    {
        return response()->json(Tag::all());
    }

    public function create()
    {
        return view('Tags');
    }
}
